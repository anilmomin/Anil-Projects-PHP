<?php 
include 'designconstants.php';
?>
<div>
   	<h1 class="formHead">
		Add News
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
                            Date:
                        </td>
                        <td>
                 			<input type="text" name="postdate" id="postdate" />       
                        </td>
                        <td>&nbsp;</td>
                        <td>
						<?php echo form_error('postdate'); ?>
						</td>
                    </tr>
                    <tr>
                        <td class="label">
                            News:
                        </td>
                        <td>
                 			<textarea name="news" rows="10" cols="50"></textarea>       
                        </td>
                        <td>&nbsp;</td>
                        <td>
						<?php echo form_error('news'); ?>
						</td>
                    </tr>
                    <tr>
                    <td>
                    &nbsp;
                    </td>
                    	<td>
                    		<input type="submit" name="post" value="Save" />
                    	</td>
                    </tr>
                    </tbody>
        </table>    
        
					
	<?php echo form_close() ?>
            </div>
<div class="cb"></div>