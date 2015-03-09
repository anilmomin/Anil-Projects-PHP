<?php include 'designconstants.php'; ?>

<div id="standardArc">
    </div>

<div id="outerContent">
<div class="content">
<div class="banner">


 <p style="font-size:40px">Password Recovery</p>
</div>
<div id="content_pane">
<div id="reg" style="width:50%">
<p>Recover your password by providing your email address</p>
<?php
$new_password = array(
	'name'	=> 'new_password',
	'id'	=> 'new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'class' => 'input_reg1',
	'size'	=> 30,
);
$confirm_new_password = array(
	'name'	=> 'confirm_new_password',
	'id'	=> 'confirm_new_password',
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'class' => 'input_reg1',
	'size' 	=> 30,
);
?>
<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label('New Password:', $new_password['id']); ?></td>
		<td><?php echo form_password($new_password); ?></td>
		<td style="color: red;"><?php echo form_error($new_password['name']); ?><?php echo isset($errors[$new_password['name']])?$errors[$new_password['name']]:''; ?></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td><?php echo form_label('Confirm New Password: ', $confirm_new_password['id']); ?></td>
		<td><?php echo form_password($confirm_new_password); ?></td>
		<td style="color: red;"><?php echo form_error($confirm_new_password['name']); ?><?php echo isset($errors[$confirm_new_password['name']])?$errors[$confirm_new_password['name']]:''; ?></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td><br/><input type="image" name="change" src="<?=IMG_FOLDER. 'changepwd.png';?>" alt="change password" />
	</td>
	</tr>
</table>
<?php echo form_close(); ?>
</div>
</div>
</div>

</div>