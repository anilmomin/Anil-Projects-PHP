<?php include 'designConstants.php'; ?>
	<div id="tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom"> 

					<!-- Tab 1 Content /////////////// -->
				<p style="font-size: 16px;">Welcome <?php print_r($currentUser); ?>. </p>
				<div style="overflow:hidden;">
		 	<div class="content-outleft">
				
				<!--<div style="overflow:hidden;">
				    <div  style=" float: left; width: 300px;">
				        <div id="not"><img src="../../assets/images/yournotifications.png"/></div>
				    </div>
				</div>
				
				<div class="outline"> <img src="../../assets/images/totaldisputes.jpg" alt="" width="179" height="89" /></div>
				
				<div class="outline">
				<img src="../../assets/images/mostrecent.jpg" alt="" width="172" height="20" />
				<div style=" width:auto;">
					   <table  border="0"  style="margin-bottom: 0px;"cellspacing="0" cellpadding="0"class="list"  >
				    
				  <tr  class="spacer" >
				    <th ><img src="../../assets/images/dot.png" alt="" width="60" height="1" /></th>
				    <th><img src="../../assets/images/dot.png" alt="" width="59" height="1" /></th>
				    <th><img src="../../assets/images/dot.png" alt="" width="120" height="1" /></th>
				    <th ><img src="../../assets/images/dot.png" alt="" width="40" height="1" /></th>
				    <th><img src="../../assets/images/dot.png" alt="" width="59" height="1" /></th>
				  </tr>
				    
				  <tr >
				    <th >Status</th>
				    <th >Date</th>
				    <th >Physician</th>
				    <th >Value</th>
				    <th >Details</th>
				    </tr>
				  </table>
				</div>
				<div style="overflow:auto;">
				 <table  border="0" cellspacing="0"  cellpadding="0"class="list">
				
				  <tr class="white">
				    <td align="center" ><img src="../../assets/images/grey.png" alt="" width="20" height="20" border="0" /><img src="../../assets/images/yellow.png" width="20" height="20" border="0" /><a href="#"  class="dialog_disp" ><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td>4/13/2011</td>
				    <td>Dr. Bryan Stinehour</td>
				    <td>$337 </td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				  </tr>
				  <tr class="greyr">
				    <td align="center" ><img src="../../assets/images/grey.png" alt="" width="20" height="20" border="0" /><img src="../../assets/images/yellow.png" width="20" height="20" border="0" /><a href="#"  class="dialog_dispr2" ><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td >4/13/2011</td>
				    <td >Dr. Bryan Stinehour </td>
				    <td >$2,500</td>
				    <td><a href="#" class="dialog_details2" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				    </tr>
				  <tr class="white">
				    <td align="center" ><img src="../../assets/images/red.png" width="20" height="20" border="0" /><a href="#" class="dialog_link"><img src="../../assets/images/grey.png" class="status" width="20" height="20" border="0" /></a><a href="#" class="dialog_disp" ><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td>4/11/2011</td>
				    <td>Mike Farr, MD</td>
				    <td>$1,250</td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				    </tr>
				  <tr class="greyr">
				    <td align="center" ><img src="../../assets/images/red.png" width="20" height="20" border="0" /><a href="#" class="dialog_link2"><img src="../../assets/images/grey.png" class="status" width="20" height="20" border="0" /></a><a href="#" class="dialog_dispr2"><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td >4/7/2011</td>
				    <td >Carl Lewis, MD</td>
				    <td >$350</td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				    </tr>
				  <tr class="white">
				    <td align="center" ><img src="../../assets/images/red.png" width="20" height="20" border="0" /><a href="#" class="dialog_link"><img src="../../assets/images/grey.png" class="status" width="20" height="20" border="0" /></a><a href="#" class="dialog_disp"><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td>4/7/2011</td>
				    <td>Carl Lewis, MD</td>
				    <td>$2,000</td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				    </tr>
				  <tr class="greyr">
				    <td align="center" ><img src="../../assets/images/red.png" width="20" height="20" border="0" /><a href="#" class="dialog_link"><img src="../../assets/images/grey.png" class="status" width="20" height="20" border="0" /></a><a href="#" class="dialog_disp"><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td >4/6/2011</td>
				    <td >Carl Lewis, MD</td>
				    <td >$1,500</td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				    </tr>
				  <tr class="white">
				    <td align="center" ><img src="../../assets/images/red.png" width="20" height="20" border="0" /><a href="#" class="dialog_link"><img src="../../assets/images/grey.png" class="status" width="20" height="20" border="0" /></a><a href="#" class="dialog_disp"><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td>4/6/2011</td>
				    <td> Mary Connors, MD</td>
				    <td>$300</td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				    </tr>
				  <tr class="greyr">
				    <td align="center" ><img src="../../assets/images/red.png" width="20" height="20" border="0" /><a href="#" class="dialog_link"><img src="../../assets/images/grey.png" class="status" width="20" height="20" border="0" /></a><a href="#" class="dialog_disp"><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td >4/1/2011</td>
				    <td >John Jacobs, MD</td>
				    <td >$175</td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				  </tr>
				  
				  <tr class="white">
				    <td align="center" ><img src="../../assets/images/red.png" width="20" height="20" border="0" /><a href="#" class="dialog_link"><img src="../../assets/images/grey.png" class="status" width="20" height="20" border="0" /></a><a href="#" class="dialog_disp"><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td>4/1/2011</td>
				    <td>John Jacobs, MD</td>
				    <td>$90</td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				    </tr>
				  <tr class="greyr">
				    <td align="center" ><img src="../../assets/images/red.png" width="20" height="20" border="0" /><a href="#" class="dialog_link"><img src="../../assets/images/grey.png" class="status" width="20" height="20" border="0" /></a><a href="#" class="dialog_disp"><img src="../../assets/images/grey.png" width="20" height="20" border="0" /></a></td>
				    <td >4/1/2011</td>
				    <td >Mathew Kahn, MD</td>
				    <td >$120</td>
				    <td><a href="#" class="dialog_details" ><img src="../../assets/images/details.png" width="60" height="20" border="0" /></a></td>
				  </tr>
				  </table>
				</div>
				</div>-->
				
				</div>
				
				<div class="content-outright">
				
				<div style="overflow:hidden;">
				    <div  style=" float: left; width: 300px;">
				        <div id="not"><img src="<?php echo IMG_FOLDER. 'prosess.png'; ?>"/></div>
				    </div>
				</div>
				
				<div class="outline"> 
					<h2>Upload Spend Instances:</h2>
				
						<br />
					   
						<div style="margin-bottom:10px">
							<form name="iform" action="<?php echo site_url('pharmaaction/uploadCSV'); ?>" target="uploadframe" method="post" enctype="multipart/form-data">
								<input id="file" size="50" name="file" type="file" /><br>
								<span style="font-size:11px; color:#666666;"></span><br />
								<input type="image" src="<?php echo IMG_FOLDER . 'upload.png'; ?>" id="upload" name="upload" value="Upload" />
							</form>
							<img src="<?php echo base_url(); ?>/assets/images/uploading.gif" alt="Loading.." id="loading"  />
							<iframe name="uploadframe" id="uploadframe" scrolling="no" allowtransparency="1" frameborder="0" height="40" width="400"></iframe> 
							
						</div>
				</div>
				
				<div class="outline">
				<p style=" font-size: 14px; margin-bottom: 10px; ">Current Uploads</p>
				<div style=" width: 411px; ">
				 <table id="currentuploads"  border="0" cellspacing="0"  cellpadding="0"class="list">
					<tr >
				    <th >File Name</th>
				    <th >Publish </th>
				    <th >Delete</th>
				    </tr>
				 
				 <?php
				 if(!empty($current_uploads)) { 
				 	foreach ($current_uploads as $index => $curr_uploads)
				 	{
				 		if(($index % 2) == 0){
				 			$class_name = "white";
				 		}
				 		else {
				 			$class_name = "greyr";
				 		}
				 		
			 			echo '<tr class="'. $class_name .'">';
			 			echo '<td align="left" style="width: 300px;" >'. $curr_uploads->fileName .'</td>'; 
			 			echo '<td align="center"><a id = "'.$curr_uploads->fileId.'" href="#" class="publish"><img src="'. IMG_FOLDER .'publish.png'.'" alt="" width="18" height="18" border="0" /></a></td>';
			 			echo '<td align="center"><a id = "'.$curr_uploads->fileId.'" href="#" class="deletepopup" ><img src="'. IMG_FOLDER .'delete.png'.'" alt="" width="18" height="18" border="0" /></a></td>';
			 			echo '</tr>';
				 	}
				 }
				 else
				 {
				 	echo '<tr class="white">';
		 			echo '<td align="center" colspan="3">No Records available.</td>';
		 			echo '</tr>';
				 }
				 ?>
				  </table>
				</div>
				<?php  if(!empty($pending_uploads)) { $class_name = ""; } else {  $class_name = "hide"; } ?>
				<div id="pending_container" class = "<?php echo $class_name;?>">
					<p style=" font-size: 14px; margin-bottom: 10px; ">Pending Uploads</p>
						<div style=" width: 411px; ">
						 <table id="pendinggrid" border="0" cellspacing="0"  cellpadding="0"class="list">
							<tr >
						    <th >File Name</th>
						    <th width="80" >Status</th>
						    </tr>
						    
						     <?php 
						     if(!empty($pending_uploads))
						     	foreach ($pending_uploads as $index => $pend_uploads)
							 	{
							 		if(($index % 2) == 0){
							 			$class_name = "white";
							 		}
							 		else {
							 			$class_name = "greyr";
							 		}
							 		
						 			echo '<tr class="'. $class_name .'">';
						 			echo '<td align="left" >'. $pend_uploads->fileName .'</td>'; 
						 			echo '<td align="left" >'.$pend_uploads->Name .'<img src="'. IMG_FOLDER .'dot.png'.'" alt="" width="1" height="18" align="absmiddle" /></td>';
						 			echo '</tr>';
						 		}
						 ?>
						  </table>
						</div>
				</div>
		
				
				<p style=" font-size: 14px; margin-bottom: 10px; ">Published Uploads</p>
				<div style=" width: 411px; ">
				 <table  border="0" cellspacing="0"  cellpadding="0"class="list">
					<tr >
				    <th >File Name</th>
				    <th width="80" >Published</th>
				    <th width="80" >Report</th>
				    </tr>
				    
				     <?php 
				     if(!empty($publish_uploads)){
					 	foreach ($publish_uploads as $index => $pub_uploads)
					 	{
					 		if(($index % 2) == 0){
					 			$class_name = "white";
					 		}
					 		else {
					 			$class_name = "greyr";
					 		}
					 		
				 			echo '<tr class="'. $class_name .'">';
				 			echo '<td align="left" style="width: 400px;" >'. $pub_uploads->fileName .'</td>'; 
				 			echo '<td align="center" >'.$pub_uploads->currentStatusSetOn .'<img src="'. IMG_FOLDER .'dot.png'.'" alt="" width="1" height="18" align="absmiddle" /></td>';
				 			echo '<td align="center" ><a  id = "'.$pub_uploads->fileId.'" href="#" class="reportdetails" >View</a></td>';
				 			echo '</tr>';
				 		}
				 	} 
				 	else
					 {
					 	echo '<tr class="white">';
			 			echo '<td align="center" colspan="3">No Records available.</td>';
			 			echo '</tr>';
					 }
				 ?>
				  </table>
				</div>
				
				
				</div>
				
				</div>
				</div>
</div>

<!--end tabs-->