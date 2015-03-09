<?php

 include 'designconstants.php';

// form attributes
$wineForm = array('name' => 'wineForm', 'id' => 'wineForm');
$pageheader = 'Wine Inventory';
$url = explode('/',uri_string());
$wineData = isset($wineData[0]) ? $wineData[0] : null;
$wineName = (isset($wineData->wineName)) ? $wineData->wineName : set_value('wineName');
$wineDescription = (isset($wineData->wineDescription)) ? $wineData->wineDescription : set_value('wineDescription');
$wineVintage = (isset($wineData->wineVintage)) ? $wineData->wineVintage : set_value('wineVintage');
$wineStyle = (isset($wineData->wineStyle)) ? $wineData->wineStyle : set_value('wineStyle');
$winery = (isset($wineData->wineryId)) ? $wineData->wineryId : set_value('winery');
$wineRegion = (isset($wineData->regionId)) ? $wineData->regionId : set_value('wineRegion');
$winePrice = (isset($wineData->winePrice)) ? $wineData->winePrice : set_value('winePrice');
$wineUnqId = (isset($wineData->wineUniqueId)) ? $wineData->wineUniqueId : set_value('wineUniqueId'); 
$wineImage = (isset($wineData->wineImage)) ? $wineData->wineImage : set_value('wineImage');
$winePitch = (isset($wineData->winePitch)) ? $wineData->winePitch : set_value('winePitch');
$wineWithoutPitch = (isset($wineData->wineWithoutPitch)) ? $wineData->wineWithoutPitch : set_value('wineWithoutPitch');
$wineDdPValue = (isset($wineData->wineDdPValue)) ? $wineData->wineDdPValue : set_value('wineDdPValue');

?>		
			<div>
    	        <h1 class="formHead">
				<?php echo $pageheader; ?>
                </h1>
            </div>
			<?php include 'sidenav.php'; ?>
            <div class="form">
            
              	<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?> 
			
				<?php echo form_open_multipart($this->uri->uri_string(), $wineForm); ?>
				
				<h1>Edit Wines</h1>
				<p>&nbsp;</p>
				<div id="imgcontainer" style="float:right">
				<?php if(!empty($wineImage)):?>
					
					<img src="<?= UPLOAD_FOLDER . 'wines/' .$wineImage ?>" alt="wineImage" width="250" />
					
				<?php else: ?>
				
					<img src="<?= NO_IMG  ?>" alt="wineImage"/>
					
				<?php endif; ?>
				</div>
							
                <table>
                    <tr>
                        <td class="label">
                            Wine Brand:
                        </td>
                        <td>
                            <input type="text" name="wineName" size="60" class="shortField inp_form spacer"  value="<?php echo $wineName;  ?>"
                                 size="30" />
                                 <span><?php echo form_error('wineName'); ?></span>
                                 
                        </td>
                    </tr>
                     <tr>
                        <td class="label">
                            Wine Vintage:
                        </td>
                        <td>
                            <input type="text" name="wineVintage" class="shortField" value="<?php echo $wineVintage;  ?>" />
                        </td>
				    </tr>
                    <tr>
                        <td class="label">
                            Wine Style:
                        </td>
                        <td>
                            <input type="text" name="wineStyle" class="shortField" value="<?php echo $wineStyle;  ?>" size="30" />
                            <span><?php echo form_error('wineStyle'); ?></span>
                        </td>
			        </tr>
			         <tr>
                        <td class="label">
                            Winery Name:
                        </td>
                        <td>
                        	<select name="winery" id="winery" class="longField selectbox">
                        		<option value="0"></option>
								<?php foreach ($wineries as $winry): ?>
									  <option <?php if($winry->wineryId == $winery): ?>selected="selected" <?php endif;?> value="<?=$winry->wineryId?>"><?=$winry->wineryName?></option>
								<?php endforeach;?>                        		
                        	</select>
                        	<br>
                            <input type="text" id="inswinery" name="wineryNew" class="shortField hide" value="" size="30" />
                        </td>
						
                    </tr>
                    <tr>
                        <td class="label">
                            Wine Region:
                        </td>
                        <td>
                        
                        	<select name="wineRegion" id="regions" class="longField selectbox">
                        		<option value="0"></option>
								<?php foreach ($regions as $region): ?>
									  <option <?php if($region->regionId == $wineRegion): ?>selected="selected" <?php endif;?> value="<?=$region->regionId?>"><?=$region->regionName?></option>
								<?php endforeach;?>                        		
                        	</select>
                        	<br>
                            <input type="text" id="insregion" name="wineRegionNew" class="shortField hide" value="" size="30" />
                        </td>
				    </tr>
				    <tr>
                        <td class="label">
                            Wine Idenfication Code:
                        </td>
                        <td>
                        	<input type="text" name="wineUniqueId" class="shortField" value="<?php echo $wineUnqId;  ?>" size="30" />
                        	<span><?php echo form_error('wineUniqueId'); ?></span>
                        </td>
				    </tr>
				     <tr>
                        <td class="label">
                            Wine description:
                        </td>
                        <td>
                            <textarea name="wineDescription" class="longField inp_form spacer" rows="" cols="" name="" style="width: 292px;
                                height: 100px;"><?php echo $wineDescription; ?></textarea>
                            <span><?php echo form_error('wineDescription'); ?></span>    
                        </td>
						
                    </tr>
					 <tr>
                        <td class="label">
                            The Pitch:
                        </td>
                        <td>
                            <textarea name="winePitch" class="longField inp_form spacer" rows="" cols="" name="" style="width: 292px;
                                height: 100px;"><?php echo $winePitch; ?></textarea>
                            <span><?php echo form_error('winePitch'); ?></span>    
                        </td>
						
                    </tr>
					 <tr>
                        <td class="label">
                            Without the Pitch:
                        </td>
                        <td>
                            <textarea name="wineWithoutPitch" class="longField inp_form spacer" rows="" cols="" name="" style="width: 292px;
                                height: 100px;"><?php echo $wineWithoutPitch; ?></textarea>
                            <span><?php echo form_error('wineWithoutPitch'); ?></span>    
                        </td>
						
                    </tr>
                    <tr>
                        <td class="label">
                            Wine Price/Per Dozen(Special):
                        </td>
                        <td>
                            <p>$ <input type="text" name="winePrice" value="<?php echo $winePrice;  ?>" maxlength="8" size="7" /> AUD</p> 
                            <span><?php echo form_error('winePrice'); ?></span>    
                        </td>
						
                    </tr>
					<tr>
                        <td class="label">
                            Wine Price per unit(standard):
                        </td>
                        <td>
                            <p>$ <input type="text" name="wineDdPValue" value="<?php echo $wineDdPValue;  ?>" maxlength="8" size="7" /> AUD</p> 
                            <span><?php echo form_error('wineDdPValue'); ?></span>    
                        </td>
						
                    </tr>
                    <tr>
                        <td class="label">
                            Wine Image:
                        </td>
                        <td>
                            <input type="file" name="winebigImage" size="50" class="longField spacer" />
								<?php echo isset($imgerror) ? $imgerror : '';?>
                        </td>
						
                    </tr>
                     <tr>
                        <td colspan="2" style="text-align: center">
								<input type="hidden" name="post" value="1" />
								<input type="button" onclick="window.location.href='<?=base_url() . 'admin/wines/viewwines'?>'" class="btnback" value="" />
                                <input type="submit" id="save" name="save" class="btnsave" value="save" />
<!--                                 <input type="reset" name="reset" class="btnreset" value=""/> -->
                        </td>
                    </tr>
                </table>
								
				<?php echo form_close() ?>

            </div>
<div class="cb"></div>