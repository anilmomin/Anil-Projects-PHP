<?php

$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
	
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'maxlength'	=> 8,
);

$loginValue = (set_value('login')) ? (set_value('login')) : 'User Name';
$passwordValue = (set_value('password')) ? (set_value('password')) : 'Password';



?>
<?php echo form_open($this->uri->uri_string()); ?>

<table class="block">
	<tr>
		<td><input type="text" class="userName" name="login" value="<?php echo $loginValue; ?>" onfocus="clearText(this)"  onblur="clearText(this)" /></td>
		<td style="color: red;"><?php echo form_error('login'); ?><?php echo isset($errors['login'])?$errors['login']:''; ?></td>
	</tr>
	<tr>
		<td><input type="password" class="password" name="password" value="<?php echo $passwordValue; ?>" onfocus="clearText(this)"  onblur="clearText(this)" /></td>
		<td style="color: red;"><?php echo form_error('password'); ?><?php echo isset($errors['password'])?$errors['password']:''; ?></td>
	</tr>


	<?php if ($show_captcha) {
		if ($use_recaptcha) { ?>
	<tr>
		<td colspan="2">
			<div id="recaptcha_image"></div>
		</td>
		<td>
			<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
		</td>
		<td><input type="text" id="recaptcha_response_field" name="recaptcha_response_field" /></td>
		<td style="color: red;"><?php echo form_error('recaptcha_response_field'); ?></td>
		<?php echo $recaptcha_html; ?>
	</tr>
	<?php } else { ?>
	<tr>
		<td >
			<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
		</td>
	</tr>
	<tr>
		
		<td><?php echo form_input($captcha); ?></td>
		<td style="color: red;"><?php echo form_error($captcha['name']); ?></td>
	</tr>
	<?php }
	} ?>
	<!--<tr>
		<td colspan="3">
			<?php echo form_checkbox($remember); ?>
			<?php echo form_label('Remember me', $remember['id']); ?>
		</td>
	</tr> -->
<tr><td>
<a href="#"><input type="image" img src="<?php echo IMG_FOLDER; ?>btnLogin.png"  class="btnLogin _hv" name="login" /></a>
</tr></td>
<tr><td>
<a href="forgot_password/" class="forget">Forgotten password</a>
</tr></td>
</table>
<?php echo form_close(); ?>