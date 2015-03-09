<?php include 'designconstants.php'; ?>

<div id="standardArc">
    </div>

<div id="outerContent">
<div class="content">
<div class="banner">


 <p style="font-size:40px">Password Recovery</p>
</div>
<div id="content_pane">
<div id="reg">
<p>Recover your password by providing your email address</p>
<?php
$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'maxlength'	=> 80,
	'class' => 'input_reg1',	
	'size'	=> 30,
);
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = 'Email or login';
} else {
	$login_label = 'Email: ';
}
?>
<?php echo form_open($this->uri->uri_string()); ?>
<table>
	<tr>
		<td><?php echo form_label($login_label, $login['id']); ?></td>
		<td><?php echo form_input($login); ?>&nbsp;</td>
		<td style="color: red;"><?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?></td>
	</tr>
</table>
<br/>
<input type="image" name="reset" src="<?=IMG_FOLDER. 'forgetpwd.png';?>" alt="get password" />
<?php echo form_close(); ?>
</div>
</div>
</div>

</div>