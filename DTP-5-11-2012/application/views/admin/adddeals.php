<?php 
include 'designconstants.php';
$dealForm = array('name' => 'dealForm', 'id' => 'dealForm');
?>
<div>
   	<h1 class="formHead">
		Wine Deals
    </h1>
</div>
	<?php include 'sidenav.php'; ?>
            <div class="form">

<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?> 
			
	<?php echo form_open_multipart($this->uri->uri_string(), $dealForm); ?>
				
				<h1>Add Deals</h1>
				<p>&nbsp;</p>
				<table>
				<?php foreach($days as $day)?>
                    <tr>
                        <td class="label">
                            Deal Name:
                        </td>
                        <td>
                            <input type="text" name="dealName[]" size="60" class="shortField inp_form spacer"  value="<?php echo set_value('dealName[]');  ?>" size="30" />
                                 <span><?php echo form_error('dealName[]'); ?></span>
                                 
                        </td>
                    </tr>
                     <tr>
                        <td class="label">
                            Deal Name:
                        </td>
                        <td>
                            <input type="text" name="dealName[]" size="60" class="shortField inp_form spacer"  value="<?php echo set_value('dealName[]');  ?>" size="30" />
                                 <span><?php echo form_error('dealName[]'); ?></span>
                                 
                        </td>
                    </tr>
                    
                    
                     <tr>
                        <td colspan="2" style="text-align: center">
								<input type="hidden" name="post" value="1" />
								<input type="button" onclick="window.location.href='<?=base_url() . 'admin/wines/viewwines'?>'" class="btnback" value="" />
                                <input type="submit" id="save" name="save" class="btnsave" value="" />
<!--                                 <input type="reset" name="reset" class="btnreset" value=""/> -->
                        </td>
                    </tr>
                </table>
								
            </div>
<div class="cb"></div>   