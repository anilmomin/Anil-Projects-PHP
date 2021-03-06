<?php

/**

 *

 * @category		admin Operations

 * @package			system/application/models

 * @author			Creative Chaos

 * @version			Release: 0.2
 
 
 */
require_once 'msncController.php';

class PharmaAction extends MSNCController 
{
	/* Pharama Object contains its fields */
	private $pharmaObj;
	private $dashboardData;
	private $reportData;
	private $data;
	private $currentUser;
	private $uploadPath;
	private $SIFileStatus = array('Uploaded'=> "1", 'Waiting' => "2", "InProgress" => '3', "Published" => '4', "Deleted" => '5');
	private $SIStatus = array('Uploaded'=> "1", 'Waiting' => "2", "InProgress" => '3', "Published" => '4', );
	
	
	
	public function __construct(){
		parent::__construct();
		
		$this->pharmaObj = array(
				'name' => '',
				'adminName' => '',
				'adminTitle' => '',
				'adminEmail' => '',
				'adminPassword' => '',
				'description' => '',
				'address' => '',
				'phone' => '',
				'fax' => '',
				'website' => '',
				'imageLink' => '',
				'createdby' => '',
				'canSupportLogin' => ''
		);
		
		$this->dashboardData = array();
		$this->data = array();
		
		$this->load->model(array('Authenticate', 'SpendInstanceFiles', 'SpendInstanceFileStatus', 'SpendInstances', 'SpendInstancesStatus', 'Configuration'));
		$this->load->helper('flexigrid');
		$this->addJavaScriptText($this->load->view('themejs','',true));
		$this->addAdminData();
		$this->currentUser = $this->Authenticate->getCurrentUserInfo();
	}
	
	
	
	public function index(){
		$pharmaId = $this->currentUser['pharmaId'];
		
		if($this->Authenticate->isLoggedIn()){
			
			// Current Status
			
		
			$whereObj = array('StatusId' => $this->SIFileStatus['Uploaded'], 'pharmaId' => $pharmaId);
			$this->dashboardData['current_uploads'] = $this->SpendInstanceFiles->getByCriteria($whereObj, null, null, 'fileId, fileName');
			
			$this->dashboardData['currentUser'] = $this->currentUser['adminName'];
			
			// Pending Status
			$where = "( sf.StatusId  = ". $this->SIFileStatus["Waiting"] . " OR  sf.StatusId = " . $this->SIFileStatus["InProgress"] .") AND sf.pharmaId = ". $pharmaId;
			$this->dashboardData['pending_uploads'] = $this->SpendInstanceFiles->getFileStatus('fileName, Name', $where, null, null);
			
	
			// Published Status
			$whereObj = array('StatusId' => $this->SIFileStatus['Published'], 'pharmaId' => $pharmaId);
			$this->dashboardData['publish_uploads'] = $this->SpendInstanceFiles->getByCriteria($whereObj, null, null, 'fileId, fileName, currentStatusSetOn');
		
			/* Add Dashboard Html and data*/
			$data['mb_data'] = $this->load->view('dashboard', $this->dashboardData, true);
			$this->addMainBodyData($data['mb_data']);
			
			/* Add Current Disputes Html and data*/
		//	$data['mb_data'] = $this->load->view('currentdisputes','',true);
		//	$this->addMainBodyData($data['mb_data']);
			
			/* Add Resolved Disputes Html and data*/
		//	$data['mb_data'] = $this->load->view('resolveddisputes','',true);
		//	$this->addMainBodyData($data['mb_data']);
			
			
			
			
			/* Add Report Html and data*/
			
			$reportData['SI_status'] = $this->SpendInstancesStatus->getAll('SIStatusId,Name');
			
			$reportData['SI_physician'] = $this->SpendInstances->getAllDistinct('physicianName');
			
			$reportData['SI_speciality'] = $this->SpendInstances->getAllDistinct('speciality');
			
			$reportData['SI_spendmode'] = $this->SpendInstances->getAllDistinct('spendMode');
			
			$reportData['SI_drugname'] = $this->SpendInstances->getAllDistinct('drugName');
			
			$reportData['SI_spendnature'] = $this->SpendInstances->getAllDistinct('spendNature');
			
			$data['mb_data'] = $this->load->view('report',$reportData,true);
			
			$this->addMainBodyData($data['mb_data']);
			
			$this->displayView();
		
		}
		else 
		{
			redirect(site_url('/login/'),'redirect');
		}
	}
	
	public function uploadCSV() {
		
		 $uploadArr = array('key' => 'CSVFileUploadPath');	
		
		 $uploadPath = $this->Configuration->getByCriteria($uploadArr, null, null, 'key, value');
			
			$config['upload_path'] = $uploadPath[0]->value;
			$config['allowed_types'] = 'csv';
			$config['max_size']	= '100000';
		
			$this->load->library('upload', $config);
	
				
				
				if (!$this->upload->do_upload("file"))
				{
					$error = array('error' => $this->upload->display_errors());
					echo '<p style="font-size: 12px; font-family: Arial">'.$error['error'].'</p>';
					echo '<script>
					parent.document.getElementById("file").value = null; 
					parent.document.getElementById("loading").style.display = "none";
					 </script>';
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
					
					$insertObj = array(
									'fileName' => $data['upload_data']['file_name'],
									'uploadedOn' => date('Y-m-d H:i:s', time()),
									'uploadedBy' => $this->currentUser['name'],
									'lastUploadedOn' => date('Y-m-d H:i:s', time()),
									'currentStatusSetOn' => date('Y-m-d H:i:s', time()),
									'currentStatusSetBy' => $this->currentUser['name'],
									'StatusId' => $this->SIFileStatus['Uploaded'],
									'PharmaId' => $this->currentUser['pharmaId']
									); 
									
									
					$pharmaId = $this->SpendInstanceFiles->insert($insertObj);
					
					echo '<p id="msg" style="font-size: 12px; font-family: Arial">Uploaded Successfully.</p>';
					echo ' 
					<script>
					parent.document.getElementById("file").value = null; 
					parent.document.getElementById("loading").style.display = "none";
					parent.location.reload(true)
					
					</script>';
				
													
				}
				

			 
			

		
	}
	
	public function publishSIFiles($fileid = null)
	{
			if($this->Authenticate->isLoggedIn()){
					
					if($fileid)
					{
						$updateObj = array(
											'fileId' => $fileid,
											'currentStatusSetOn' => date('Y-m-d H:i:s', time()),
											'currentStatusSetBy' =>	$this->currentUser['name'],
											'ProcessedOn' => date('Y-m-d H:i:s', time()),
											'StatusId' => $this->SIFileStatus['Waiting']
										);
					
						$this->SpendInstanceFiles->update($updateObj);
						
						$where = array('fileId' => $fileid,
										);
						
						$SIData = $this->SpendInstanceFiles->getByCriteria($where, null, null, 'fileName,StatusId');
						$fileStatus = array_search($SIData[0]->StatusId, $this->SIFileStatus);
						$className = $this->input->post('trClass');
						if($className == 'white')
						{
							echo '<tr class="greyr"><td align="left">'. $SIData[0]->fileName .'</td><td align="left">'.$fileStatus.'<img src="'. base_url().'assets/images/dot.png'.'" alt="" width="1" height="18" align="absmiddle"></td></tr>';	
						}
						else 
						{
							echo '<tr class="white"><td align="left">'. $SIData[0]->fileName .'</td><td align="left">'.$fileStatus.'<img src="'. base_url().'assets/images/dot.png'.'" alt="" width="1" height="18" align="absmiddle"></td></tr>';
						}
									
					}
					
					
				}
				else {
					redirect(site_url('/login/'),'redirect');
				}
	}
	
	
	
	public function deleteSIFiles($fileid = null)
	{
		if($this->Authenticate->isLoggedIn()){
			
			if($fileid)
			{
				$updateObj = array(
									'fileId' => $fileid,
									'currentStatusSetOn' => date('Y-m-d H:i:s', time()),
									'currentStatusSetBy' =>	$this->currentUser['name'],
									'StatusId' => $this->SIFileStatus['Deleted']
								);
			
				$this->SpendInstanceFiles->update($updateObj);				
			}
			
		}
		else {
			redirect(site_url('/login/'),'redirect');
		}
		
	}
	
	public function getInstanceReport($fileId = null) {
			
		if($this->Authenticate->isLoggedIn()){

				$where =  array('fileId' => $fileId);
		
				$report_data = $this->SpendInstanceFiles->getByCriteria($where, null, null, 'fileName, totalSIs, processedSIs, duplicateSIs, erroneousSIs, ProcessedOn');
				
				$html_str = "<h4 style='font-weight:20px;'>SpendInstance File Summary</h3><br/>";
				$html_str .= '<table cellspacing="0" cellpadding="0" border="0" class="list" id="pendinggrid">';
				
				$html_str .= "<tr>";
				$html_str .= "<td> File Name: </td>";
				$html_str .= "<td>";
				$html_str .= $report_data[0]->fileName;
				$html_str .= "</td>";
				$html_str .= "</tr>";
				
				
				$html_str .= "<tr>";
				$html_str .= "<td> Total SpendInstances: </td>";
				$html_str .= "<td>";
				$html_str .= $report_data[0]->totalSIs;
				$html_str .= "</td>";
				$html_str .= "</tr>";
				
				
				$html_str .= "<tr>";
				$html_str .= "<td> Processed SpendInstance: </td>";
				$html_str .= "<td>";
				$html_str .= $report_data[0]->processedSIs;
				$html_str .= "</td>";
				$html_str .= "</tr>";
				
				
				$html_str .= "<tr>";
				$html_str .= "<td> Duplicate SpendInstances:  </td>";
				$html_str .= "<td>";
				$html_str .= $report_data[0]->duplicateSIs;
				$html_str .= "</td>";
				$html_str .= "</tr>";
				
				
				$html_str .= "<tr>";
				$html_str .= "<td> Erroneous SpendInstances: </td>";
				$html_str .= "<td>";
				$html_str .= $report_data[0]->erroneousSIs;
				$html_str .= "</td>";
				$html_str .= "</tr>";
				
				
				
				$html_str .= "<tr>";
				$html_str .= "<td> Processed On: </td>";
				$html_str .= "<td>";
				$html_str .= $report_data[0]->ProcessedOn;
				$html_str .= "</td>";
				$html_str .= "</tr>";
				
				
				$html_str .= "</table>";
				echo $html_str;
		}
		else {
				redirect(site_url('/login/'),'redirect');
			}
			
	
	
	}
	

	
	public function getReport() {
		
		$status = $this->input->post('status');
		$physician = $this->input->post('physician');
		$minval = $this->input->post('minval',true);
		$maxval = $this->input->post('maxval',true);
		$begindate = $this->input->post('begindate',true);
		$enddate = $this->input->post('enddate',true);
		$speciality = $this->input->post('speciality');
		$form = $this->input->post('form');
		$drugname = $this->input->post('drugname');
		$nature = $this->input->post('nature');
		$maxAmount = $this->SpendInstances->getAll('MAX(amount)as amount');
		$maxDate = $this->SpendInstances->getAll('MAX(InstanceDate) as date');
		
		$html = '';
		$where = '';
		$fileStatus = explode(',', $status);
		
		
		if($physician != '*')
		{
			$where .= ' AND physicianName = "' . $physician. '"';
		}
		
		
		if($speciality != '*')
		{
			$where .= ' AND speciality = "' . $speciality . '"';
		}
		
		if($form != '*')
		{
			$where .= ' AND spendMode = "' . $form . '"';
		}
		
		if($drugname != '*')
		{
			$where .= ' AND drugName = "' . $drugname . '"';
		}
		
		if($nature != '*')
		{
			$where .= ' AND spendNature = "' . $nature . '"';
		}
		
		if($minval != '')
		{
			$where .= ' AND amount between ' . $minval ; 
		}
		else 
		{
			$where .= ' AND amount between  0'; 
		}
		
		
		if($maxval != '')
		{
			$where .= ' AND ' . $maxval; 
		}
		else 
		{
			$where .= ' AND ' . $maxAmount[0]->amount; 
		}
		
		
		if($begindate != '')
		{
			$where .= ' AND InstanceDate between "' . $begindate .'"'; 
		}
		else 
		{
			$where .= ' AND InstanceDate between  "1970-01-01"'; 
		}
		
		
		if($enddate != '')
		{
			$where .= ' AND "' . $enddate. '"'; 
		}
		else 
		{
			$where .= ' AND "' . $maxDate[0]->date . '"'; 
		}
		
		if(!strstr($status, '*') && $status != ''){
			$where .= ' AND SIStatusId in (' . $status . ')';  
		}
		
		
		
		
		$reportData = $this->SpendInstances->getReport($where);
		$class = '';
		
		if(!empty($reportData)){
			
			foreach ($reportData as $index => $records) {
				if($index % 2 == 0)
				{
					if($index == 0)
					{
						$class = 'white deleted';
					}
					else {
						
						$class = 'white';
					}
					
					
				}
				else
				{
					$class = 'greyr';
				}
				
				
				$html .= '<tr class="'. $class .'">';
				$html .= '<td align="center" width="60"><!--<a href="#" class="dialog_inprogressr2"><img src="'. base_url() .'/assets/images/grey.png" width="20" height="20" border="0" /></a><img src="'. base_url() .'/assets/images/green.png" width="20" height="20" border="0" /> --></td>';
				$html .= '<td width="60" >' . date('d M, Y',strtotime($records->InstanceDate)) . '</td>';
				$html .= '<td width="120"  >' . $records->physicianName . '</td>';
				$html .= '<td width="187" >' . $records->address . '</td>';
				$html .= '<td width="86">' . $records->speciality . '</td>';
				$html .= '<td width="45">' . '$' .$records->amount . '</td>';
				$html .= '<td width="95" >' . $records->spendMode . '</td>';
				$html .= '<td width="60" >' . $records->spendNature . '</td>';
				$html .= '<td >' . $records->drugName . '</td>';
				
    			$html .= '</tr>';
    			
    			
    			
    			
    			
    			
					
			}
			echo $html;
		}
		else
		{
				$html .= '<tr class="white">';
				$html .= '<td align="center"  > No results available.</td>';
				$html .= '</tr>';
    			
				echo $html;
		}
		
		
	} 
	
	
	
}


?>