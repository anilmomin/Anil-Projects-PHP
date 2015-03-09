<?php
define('BASEPATH','');
include('database.php');
require 'logfile.php';

$lf = new logfile();
$lf->write(date('Y-m-d H:i:s')." Cron Job Start\r\n");
$lf->write(date('Y-m-d H:i:s')." Ready to start job\r\n");
  
  $link = mysql_connect($db['default']['hostname'],$db['default']['username'],$db['default']['password']) or die('Cannot connect to the DB');
  mysql_select_db($db['default']['database'],$link) or die('Cannot select the DB');

   /*Update all spendinstance files status if there process date occur*/ 
   //UpdateSpendFilesToWaiting();

  /*grab the spendInstancesfiles from the db */
  $curentdatetime  = date('Y-m-d H:i:s');
  $query = "SELECT `fileId`,`fileName`,`uploadedOn`,`uploadedBy`,`lastUploadedOn`,`currentStatusSetOn`,`currentStatusSetBy`,`totalSIs`,`processedSIs`,`duplicateSIs`,`erroneousSIs`,`StatusId`,`PharmaId` FROM `spendinstancefiles` where `StatusId`=2 and ProcessedOn <= '".$curentdatetime."'";
	//$query = "SELECT `fileId`,`fileName`,`uploadedOn`,`uploadedBy`,`lastUploadedOn`,`currentStatusSetOn`,`currentStatusSetBy`,`totalSIs`,`processedSIs`,`duplicateSIs`,`erroneousSIs`,`StatusId`,`PharmaId` FROM `spendinstancefiles` where `StatusId`=2 and ProcessedOn >= '2010-11-20'";  
  
   
  $result = mysql_query($query,$link) or die('Errant query:  '.$query);
  $lf->write(date('Y-m-d H:i:s')." Get All SI Files that are in waiting state. \r\n");
  	if (mysql_num_rows($result)) {
		$lf->write(date('Y-m-d H:i:s')." ". mysql_num_rows($result)." files found that have published \r\n");
		while($row = mysql_fetch_array($result)) {
			
			$fileName = "";
			$fileId=0;
			$pharmaId=0;
			$fileName = getValuefromConfiguration().$row['fileName'];
			$fileId=$row['fileId'];
			$pharmaId=$row['PharmaId'];
			$lf->write(date('Y-m-d H:i:s')." ".$fileName." check file exist \r\n");
			
		
			if (file_exists($fileName)) {
				$lf->write(date('Y-m-d H:i:s')." ".$fileName." file exist \r\n");
				 $fp = fopen($fileName,'r') or die("can't open file");
				  $csv_line = fgetcsv($fp,8192);
				  if(count($csv_line)>0) {
				      $lf->write(date('Y-m-d H:i:s')." ".$fileName." checking file contents to verify its contents supported \r\n");
					  if($csv_line[0]=='Date' && $csv_line[1]=='NPI'&& $csv_line[2]=='Physician'&& $csv_line[3]=='Address 1'&&$csv_line[4]=='Address 2'&&$csv_line[5]=='City'&&$csv_line[6]=='State'&&$csv_line[7]=='Zip Code'&&$csv_line[8]=='Form'&&$csv_line[9]=='Nature'&&$csv_line[10]=='TravelDestination'&&$csv_line[11]=='Value'&&$csv_line[12]=='Speciality'&&$csv_line[13]=='Drug/Device Name')
					  {
						$lf->write(date('Y-m-d H:i:s')." ".$fileName." checking file contents to verify its contents supported \r\n");
						 UpdateSpendFilesToInProgress();
						 ReadCSV();
					  }
					  else
						 echo "file contents not supported";
				  }
			}
			
		}
			fclose($fp) or die("can't close file");
	}
	
	
	

function CurrencyConvertor($value) {
	 $expldoded=explode("$",$value);
	 if ($pos = strrpos($expldoded[1], ",")) {
   	   $explodedb=explode(",",$expldoded[1]);
	   return $final=floatval($explodedb[0].$explodedb[1]);
	 }
	 else
	  return $final=floatval($expldoded[1]);
}

function UpdateSpendFilesToWaiting()
{
	global $lf;
	$lf->write(date('Y-m-d H:i:s')." Update SI File status to Waiting if process date occur \r\n");
	$curentdatetime  = date('Y-m-d');
	$query = "UPDATE `spendinstancefiles` SET  StatusId=2,  `currentStatusSetOn`='".date("Y-m-d H:i:s")."', `currentStatusSetBy`='Cron Job' WHERE ProcessedOn >= '".$curentdatetime."' AND  StatusId=1";
	$result = mysql_query($query) or die('Errant query:  '.$query);
}

function UpdateSpendFilesToInProgress()
{
	global $fileId;
	global $fileName;
	global $lf;
	$lf->write(date('Y-m-d H:i:s')."  ".$fileName." update file status to inprogress \r\n");
	$query = "UPDATE `spendinstancefiles` SET  StatusId=3,  `currentStatusSetOn`='".date("Y-m-d H:i:s")."', `currentStatusSetBy`='Cron Job' WHERE  StatusId=2 and fileid= $fileId";
	$result = mysql_query($query) or die('Errant query:  '.$query);
}

function UpdateSpendInstanceFilesToPublished()
{
		//update file status and SpendInstance status
	$query = "UPDATE `spendinstancefiles` SET `totalSIs`=$totalRecords, `currentStatusSetOn`='".date("Y-m-d H:i:s")."', `currentStatusSetBy`='Cron Job', `StatusId`=4, `processedSIs`=$totalRecords, `duplicateSIs`=$numRecordsAlreadyExist, `erroneousSIs`=0 WHERE `fileId`=$fileId";
	$result = mysql_query($query) or die('Errant query:  '.$query);
}


function ReadCSV() {
	global $fileName;
	global $fileId;
	global $pharmaId;
	
	$fp = fopen($fileName,'r') or die("can't open file");
		$tempVariableforProcess=0;
		$numRecordsAlreadyExist=0;
		$numRecordsAdded=0;
		$totalRecords=0;
	
	while($csv_line = fgetcsv($fp,1024)) {
	
		if($tempVariableforProcess>0) {
						 
			  /* grab the spendInstances from the db */
			  $amount=CurrencyConvertor($csv_line[11]);
			  $query = "SELECT createdOn 
						  FROM spendinstances  
						  WHERE physicianId='".$csv_line[1]."' AND physicianName='".$csv_line[2]."' AND AMOUNT='$amount' AND speciality='".$csv_line[12]."'  AND spendNature='".$csv_line[9]."' AND spendMode='".$csv_line[8]."' AND InstanceDate = '".date('Y-m-d',strtotime($csv_line[0]))." 00:00:00'";
			  $result = mysql_query($query) or die('Errant query:  '.$query);
			  $numResults = mysql_num_rows($result);
			 global $lf;
			  //print $query;
			  if ($numResults > 0) 
			  {
			    $numRecordsAlreadyExist ++;
				
				
				$lf->write(date('Y-m-d H:i:s')." ".$fileName."  ".$csv_line[1]." record already exist in database \r\n");
			  }
			  else{
					  $query = "INSERT INTO spendinstances(CREatedOn,updatedOn,DESCrIPTION,currentStatusId,PhysicianName,SPENdMode,SPeNDNATURE,InstanceDate,ADdress1,address2,CITY,state,zipcode,physicIANID,destination,amount,speciality,ITEm,CURRentStatusSetOn,currenTSTAtusSetBy,CuRRENTDiSPUTEID,currentDisputeSetOn,currentDisputeSetBy,DrugName,FileId,SIStatusId,SIDisputeId,PharmaId) 
								VALUES('".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','',1,'$csv_line[2]','$csv_line[8]', '$csv_line[9]','".date("Y-m-d H:i:s",strtotime($csv_line[0]))."','$csv_line[3]','$csv_line[4]','$csv_line[5]','$csv_line[6]','$csv_line[7]','$csv_line[1]','',$amount,'$csv_line[12]',' ','".date("Y-m-d H:i:s")."','Administrator',NULL,NULL,'','$csv_line[13]',0,1,0,$pharmaId);";
					  $result = mysql_query($query) or die('Errant query:  '.$query);
					  $addedRecord = mysql_affected_rows();																
					  $numRecordsAdded+=$addedRecord;
					  
					  $lf->write(date('Y-m-d H:i:s')." ".$fileName."  ".$csv_line[1]." record successfully inserted \r\n");
			  }
		}
		$tempVariableforProcess++;
	}
	$totalRecords=$numRecordsAdded+$numRecordsAlreadyExist;
	$lf->write(date('Y-m-d H:i:s')." ".$fileName."  ".$totalRecords." total records processed \r\n");
	$lf->write(date('Y-m-d H:i:s')." ".$fileName."  ".$numRecordsAdded." records inserted \r\n");
	$lf->write(date('Y-m-d H:i:s')." ".$fileName."  ".$numRecordsAlreadyExist." duplicated records found \r\n");
	print ' Records alredy exist in database = '. $numRecordsAlreadyExist ."</br>";
	print ' Added Records in Database = '.$numRecordsAdded ."</br>";
	print ' total record found in csv = '.$totalRecords ."</br>";
	
	
			//update file status and SpendInstance status
	$query = "UPDATE `spendinstancefiles` SET `totalSIs`=$totalRecords, `currentStatusSetOn`='".date("Y-m-d H:i:s")."', `currentStatusSetBy`='Cron Job', `StatusId`=4, `processedSIs`=$totalRecords, `duplicateSIs`=$numRecordsAlreadyExist, `erroneousSIs`=0 WHERE `fileId`=$fileId";
	$result = mysql_query($query) or die('Errant query:  '.$query);

	
	fclose($fp) or die("can't close file");
}


function getValuefromConfiguration() {
 /* grab the spendInstancesfiles from the db */
  $query = "SELECT `key`, `value`, `description` FROM `configuration` WHERE `key`='CSVFileUploadPath'";
  $result = mysql_query($query) or die('Errant query:  '.$query);
  if ($result) {
	  while($rowdata = mysql_fetch_array($result)) {
	    return $rowdata['value'];
	  }
  }
}
?>



