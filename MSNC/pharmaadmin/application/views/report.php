 <div id="tabs-4"><!--content tab2-->
 <p style="font-size:10px; line-height: 16px; margin-bottom: 10px;">Create a Report based on any or all of the criteria below.  Hold "CTRL" + click (PC) or "Command" + click (Mac) to select more than one entry from the selection boxes.</p>
 
                       <div class="report-content">
                         <div class="report-left">
                                     <p>Status:</p>
                                     <p>
                                     <?php 
                                     	
                                     	$html_str = form_open('/');
									?>
                                    <input type="radio" name="currentDispute" value="1" onclick="document.getElementById('status').style.display='block'"/> Disputed
                                    <input type="radio" name="currentDispute" value="0" onclick="document.getElementById('status').style.display='none'"/> Not Disputed
                                    <input type="radio" name="currentDispute" value="0" checked="checked" onclick="document.getElementById('status').style.display='none'"/> All
                                    <p>
                                    <?php
                                     	$html_str .= '<ul class="report-checkbox" style="display:none;" id="status">';
                          
                                     	if($SI_status)
											
	                                     	foreach ($SI_status as $siFileStatus) {
												$html_str .= '<li>';
		                                     	$html_str .= form_checkbox('status', $siFileStatus->SIStatusId);
												$html_str .= $siFileStatus->Name . '<br />';
		                                     	$html_str .= '</li>';
		                                     	
	                                     	}
	                                     	
                                     	$html_str .= '<li>';	
                                        $html_str .= form_checkbox('status', '*');
                                        $html_str .= 'All' . '<br />';
                                        $html_str .= '</li>';
                                        
                                     	$html_str .= '</ul>';
										$html_str .= form_close();                                       	                                     
                                     	echo $html_str;
                                     ?>
                                     </p>
	</p>
                                    <br/>
                                    <div class="checkbox1">
                                    <p>Physician:</p>
                                                    <select size="10" multiple="multiple" name="physician" id="physician">
                                                    <option value="*" selected="selected">All</option>
                                                   	<?php
                                                   	 	$html_str = '';
                                                   		if(!empty($SI_physician)){
                                                   			
                                                   			foreach ($SI_physician as $spendInstance){
                                                   				$html_str .= "<option value='".$spendInstance->physicianName."'>" . $spendInstance->physicianName ."</option>";		
                                                   			}
                                                   			echo $html_str;
                                                   		}
                                                   		
                                                   	?>
                                                   	</select>
                                    </div>
                                    
                                    <ul class="report-textbox">
                                    
                                    <li>            <div class="fl-left">
                                                    Value - Minimum:<br />
                                                    <input type="text" name="minval" id="minval" class="integer" />
                                                    
                                                    </div>
                					</li>
                                    <li>
                                                    <div class="fl-left">									
                                                    Value - Maximum:<br />
                                                    <input type="text" name="maxval" id="maxval"  class="integer" />
                                                    
                                                    </div>
                                    </li>
                                    </ul>
                                    
                                    </div>
                            		
                         <div class="report-centre">
                                    
                                    <div class="fl-left">
                                        Date Range - Begin:<br />
                                        <input type="text" name="begindate" id="begindate" class="datepicker">
                                        </div>

								



                                  
<div class="checkbox2">
     			<p>Speciality:</p>
                <select size="10" multiple="multiple" name="speciality" id="speciality">
                <option value="*" selected="selected">All</option>
                 <?php
                        $html_str = '';
                        if(!empty($SI_speciality)){
                              foreach ($SI_speciality as $spendInstance){
                                  $html_str .= "<option value='".$spendInstance->speciality."' >" . $spendInstance->speciality ."</option>";		
                              }
                              echo $html_str;
                        }
                 ?>
                </select>
</div>

<div class="checkbox3">
                <p>Form:</p>
                <select size="10" multiple="multiple" name="form" id="form">                
                <option value="*" selected="selected">All</option>
                <?php
                        $html_str = '';
                        if(!empty($SI_spendmode)){
                              foreach ($SI_spendmode as $spendInstance){
                                  $html_str .= "<option value='".$spendInstance->spendMode ."' >" . $spendInstance->spendMode ."</option>";		
                              }
                              echo $html_str;
                        }
                 ?>
                </select>

</div>

</div>

                         <div class="report-right">
                            
                                    <div class="fl-left">									
                                    Date Range - End:<br />
                                    <input type="text" class="datepicker" name="enddate" id="enddate" />
                                    </div>
                                                        
                                                        <div class="checkbox4">
                                                        <p>Drug Name:</p>
                                                        <select size="10" multiple="multiple" name="drugname" id="drugname"> 
                                                        <option value="*" selected="selected">All</option>
                                                        <?php
											                        $html_str = '';
											                        if(!empty($SI_drugname)){
											                              foreach ($SI_drugname as $spendInstance){
											                                  $html_str .= "<option value='".$spendInstance->drugName ."' >" . $spendInstance->drugName ."</option>";		
											                              }
											                              echo $html_str;
											                        }
											                 ?>
                                                        </select>
                                                        
                                                        </div>
                                                        
                                                        <div class="checkbox5">
                                                        <p>Nature:</p>
                                                        <select size="10" multiple="multiple" name="nature" id="nature">
                                                        <option value="*" selected="selected" >All</option>
                                                          <?php
											                        $html_str = '';
											                        if(!empty($SI_spendnature)){
											                              foreach ($SI_spendnature as $spendInstance){
											                                  $html_str .= "<option value='".$spendInstance->spendNature ."'>" . $spendInstance->spendNature ."</option>";		
											                              }
											                              echo $html_str;
											                        }
											                 ?>
                                                        
                                                        </select>
                                                        </div>
                                                            
            <div class="form-archive">
                  <div class="button-header"><a style="border:none !important; background:none !important;" class="ui-state-default ui-corner-all ui-select-all archive" href="javascript:"><img src="<?php echo IMG_FOLDER . 'get.jpg'; ?>" width="110" height="26" align="" alt="GET REPORT"  /></a> </div>
                            
                            </div>
                            
                            </div>
      
                         </div>
                         <div class="archive-result" style="display:none">

<div class="content-out">

<div style="overflow:hidden;">
<div  style=" float: left; width: 300px;">
<!--<div id="not"><img src="images/notification.png" /></div>-->
</div>

<div style=" float:right; ">
<!--  <img src="<?php echo IMG_FOLDER . 'display.png'; ?>"  />  -->
</div>
</div>

<div style="width:880px;">
<table border="0" style="margin-bottom: 0px;" cellspacing="0" cellpadding="0" class="list"  >
<tr  class="spacer" >
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="60" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="59" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="120" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="185" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="85" height="1" /></th>
  <th ><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="45" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="95" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="60" height="1" /></th>
  <th>&nbsp;</th>
  </tr>
<tr >
    <th>&nbsp;</th> 
    <th >Date</th>
    <th >Physician</th>
    <th >Business Address</th>
    <th >Specialty</th>
    <th >Value</th>
    <th >Form</th>
    <th >Nature</th>
    <th >Drug/Device Name</th>
    </tr>
</table>
</div>
<div style="height: 298px; overflow: auto;">
<table border="0" cellspacing="0" cellpadding="0" class="list"  >
<tbody id="reportgrid">

  <tr class="spacer">
  <th ><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="60" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="59" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="120" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="120" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="73" height="1" /></th>
  <th ><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="40" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="75" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="56" height="1" /></th>
  <th><img src="<?php echo IMG_FOLDER . 'dot.png'; ?>" alt="" width="80" height="1" /></th>
  </tr>
</tbody>
</table>
</div>

</div>

</div>

 </div>