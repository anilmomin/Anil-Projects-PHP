<?php 
 include 'designconstants.php';
 ?>
<div>
    	    <?php $pageheader = 'Site Users';?>
			<div>
    	     <h1 class="formHead">
				<?php echo $pageheader; ?>
                </h1>
            </div>
			<?php include 'sidenav.php'; ?>

            <div class="form">
            
	<h1>
		Add User
    </h1>            
              	<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?> 
			
				<?php echo form_open($this->uri->uri_string()); ?>
				<p>&nbsp;</p>
                <table>
                    <tr>
                        <td class="label">
                            First Name:
                        </td>
                        <td>
                            <input type="text" name="firstname" size="60" class="shortField inp_form spacer"  value="<?php echo set_value('firstname');  ?>"
                                 size="30" /><div style="margin-left:30px;"></div>
                        </td>
						
						<td style="width:250px">
						<?php echo form_error('firstname'); ?>
						</td>
						
                    </tr>
                    <tr>
                        <td class="label">
                            Last Name:
                        </td>
                        <td>
                            <input type="text" name="lastname" class="shortField" value="<?php echo set_value('lastname');  ?>" size="30" />
                        </td>
                        
						<td style="width:250px">
						<?php echo form_error('lastname'); ?>
						</td>
						
                    </tr>
                       <tr>
                        <td class="label">
                            Email:
                        </td>
                        <td>
                            <input type="text" name="email" class="shortField" value="<?php echo set_value('email');  ?>" size="30" />
                        </td>
						<td>
						<?php echo form_error('email'); ?>
						</td>
                    </tr>
                    <tr>
                        <td class="label">
                            Password:
                        </td>
                        <td>
                            <input type="text" name="password" class="shortField" value="<?php echo set_value('password');  ?>" size="30" />
                        </td>
						<td>
						<?php echo form_error('password'); ?>
						</td>
                    </tr>
                    <tr>
                        <td class="label">
                           Confirm Password:
                        </td>
                        <td>
                            <input type="text" name="cpassword" class="shortField" value="<?php echo set_value('cpassword');  ?>" size="30" />
                        </td>
						<td>
						<?php echo form_error('cpassword'); ?>
						</td>
                    </tr>
                    <tr>
                        <td >
	                		&nbsp;        
                        </td>
                        <td>
                          <input align="absmiddle" type="image" alt="save" src="<?php echo IMG_FOLDER; ?>btnSubmit.png" class="btn _hv submit" name="save" id="save">
                        </td>
					</tr>
               </table>
				<?php echo form_close() ?>
            </div>
<div class="cb"></div>