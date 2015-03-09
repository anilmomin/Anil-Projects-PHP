<?php

 include 'designconstants.php';

// form attributes
$wineForm = array('name' => 'wineForm', 'id' => 'wineForm');
$pageheader = 'Wine Inventory';
$url = explode('/',uri_string());
$wineName =  set_value('wineName');
$wineDescription = set_value('wineDescription');
$wineVintage = set_value('wineVintage');
$wineStyle = set_value('wineStyle');
$winery = set_value('winery');
$wineRegionNew = set_value('wineRegionNew');
$wineRegion = set_value('wineRegion');
$wineUnqId = set_value('wineUniqueId');
$wineImage = '';
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
				
				<h1>Add Wines</h1>
				<p>&nbsp;</p>
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
									  <option value="<?=$winry->orderId?>" <?php echo set_select('winery', $winry->orderId); ?>><?=$winry->wineryName?></option>
								<?php endforeach;?>                        		
                        	</select>
                        	<br>
                            <input type="text" id="inswinery" name="wineryNew" class="shortField hide" value="<?php echo $winery;  ?>" size="30" />
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
									  <option value="<?=$region->orderId?>" <?php echo set_select('wineRegion', $region->orderId); ?>><?=$region->regionName?></option>
								<?php endforeach;?>                        		
                        	</select>
                        	<br>
                            <input type="text" id="insregion" name="wineRegionNew" class="shortField hide" value="<?php echo $wineRegion;  ?>" size="30" />
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
                                <input type="submit" id="save" name="save" class="btnsave" value="" />
                                <input type="reset" name="reset" class="btnreset" value=""/>
                        </td>
                    </tr>
                </table>
								
				<?php echo form_close() ?>

            </div>
<div class="cb"></div>