<?php 
include 'designconstants.php';
?>
<div>
   	<h1 class="formHead">
		Add Newsletter
    </h1>
</div>
	<?php include 'sidenav.php'; ?>
            <div class="form">
            
    <?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?> 
			
	<?php echo form_open($this->uri->uri_string()); ?>
		<table>
                    <tbody>
                    <tr>
                        <td class="label">
                           Newsletter Heading:
                        </td>
                        <td>
                 			<input type="text" name="newsletterhead" id="newsletterhead" />       
                        </td>
                        <td>&nbsp;</td>
                        <td>
						<?php echo form_error('newsletterhead'); ?>
						</td>
                    </tr>
                    <tr>
                        <td class="label">
                            Newsletter Content:
                        </td>
                        <td>
                 			<textarea name="newsletter" rows="20" cols="50"></textarea>       
                        </td>
                        <td>&nbsp;</td>
                        <td>
						<?php echo form_error('newsletter'); ?>
						</td>
                    </tr>
                    <tr>
                    	<td>
                    	&nbsp;
                    	</td>
                    	<td>
                    		<input type="submit" name="Send" value="Save & Email" />
                    	</td>
                    </tr>
					<tr>
						<td colspan="2"><a href="<?=base_url()?>admin/newsletters/sendnewsletter" style="color:black;">Send newsletter.</a> </td>
					</tr>
                    </tbody>
        </table>    
        
					
	<?php echo form_close() ?>
            </div>
<div class="cb"></div>