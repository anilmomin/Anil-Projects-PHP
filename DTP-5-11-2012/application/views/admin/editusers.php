<?php 
 include 'designconstants.php';
 $userData = $userData[0];
 $active = $userData->activated ? 'checked="checked"' : '';
 $dob = explode('-', $userData->dob);
  ?>
<script>
$(function(){
	$("#picker1").birthdaypicker({});
	$("#bmonth").val(<?php echo set_value('birth[day]') . $dob[1]; ?>);
	$("#bday").val(<?php echo set_value('birth[day]') . $dob[2]; ?>);
	$("#byear").val(<?php echo set_value('birth[year]') . $dob[0]; ?>);
	$(".birth-day").wrap('<p class="input_reg2" style=" float:left; margin-right:10px;" />');
	$(".birth-month").wrap('<p class="input_reg2" style=" float:left; margin-right:10px;" />');
	$(".birth-year").wrap('<p class="input_reg2" style=" float:left; margin-right:10px;" />');

});
</script>
<div>
    	    <h1 class="formHead">
				<?php echo "Edit Users" ?>
            </h1>
            </div>
			<?php include 'sidenav.php'; ?>
            <div class="form">
            
              	<?php $this->form_validation->set_error_delimiters('<div class="error">', '</div>'); ?> 
			
				<?php echo form_open($this->uri->uri_string()); ?>
				<p>&nbsp;</p>
                <table>
                    <tr>
                        <td class="label">
                            First Name:
                        </td>
                        <td>
                            <input type="text" name="firstname" size="60" class="shortField inp_form spacer" value="<?php echo set_value('firstname') . $userData->first_name; ?>"
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
                            <input type="text" name="lastname" class="shortField" value="<?php echo set_value('lastname') . $userData->last_name; ?>" size="30" />
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
                            <input type="text" name="email" class="shortField" value="<?php echo set_value('email') . $userData->email; ?>" size="30" />
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
                            <input type="text" name="password" class="shortField" value="<?php echo set_value('password'); ?>" size="30" />
                        </td>
						<td>
						<?php echo form_error('password'); ?>
						</td>
                    </tr>
                    <tr>
                        <td class="label">
                            Date of Birth:
                        </td>
                        <td>
                            <div class="picker" id="picker1"></div>
									<?php 
									
									if(form_error("birth[month]")) 
									{
									    echo form_error("birth[month]");
									}
									else if(form_error("birth[day]"))
									{
									    echo form_error("birth[day]");
									}
									else
									{
									    echo form_error("birth[year]");
									}
									?>
									<p class="error" id="invdate" style="padding-top:3px; display:none;" >Invalid Date Selected.</p>
									<?php echo (isset($dateformat)) ? $dateformat : '' ?>
									<p>&nbsp;</p>
                        </td>
                    </tr>
					<tr>
                        <td class="label">
                            Active:
                        </td>
                        <td>
                            <p style="color:#000;"><input type="checkbox" style="margin:-130px" name="active" class="shortField" value="1" <?=$active;?> />  Is Active</p>
                        </td>
						<td>
						<?php echo form_error('active'); ?>
						</td>
                    </tr>
                    <tr>
                        <td class="label">
                            Address:
                        </td>
                        <td>
                            <textarea name="address" cols="49" rows="6"><?php echo set_value('address') . $userData->address; ?></textarea>
                            <input type="hidden" name="post" value="1" />
                        </td>
						
                    </tr>
                    <tr>
                        <td >
	                		&nbsp;        
                        </td>
                        <td>
                          <input type="image" alt="save" src="<?php echo IMG_FOLDER; ?>btnSubmit.png" class="btn _hv submit" name="save" id="save">
                        </td>
					</tr>
                    
               </table>
				<?php echo form_close() ?>
            </div>
<div class="cb"></div>