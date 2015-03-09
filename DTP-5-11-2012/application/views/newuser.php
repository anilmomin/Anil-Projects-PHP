<?php include 'designconstants.php'; ?>
<div id="standardArc">
    </div>

<div id="outerContent">
        <div class="content">
<div class="banner">
<img src="<?=IMG_FOLDER;?>Registration.png" width="960" height="216">
 <p style="font-size:40px">User Registration System</p>
</div>


<div id="content_pane" class="reg_pane">
<div id="reg" class="registration_container">
<strong class="redhdng">Registration</strong>
<br>
<br>
<?php 
$prev_firstname = $this->session->flashdata('firstname');
$prev_lastname = $this->session->flashdata('lastname');
$prev_email = $this->session->flashdata('email');
$prev_password = $this->session->flashdata('password');
$prev_cpassword = $this->session->flashdata('cpassword');
	
$firstname = (!empty($prev_firstname)) ? $prev_firstname : set_value('firstname');
$lastname = (!empty($prev_lastname)) ? $prev_lastname : set_value('lastname');
$email = (!empty($prev_email)) ? $prev_email : set_value('email');
$password = (!empty($prev_password)) ? $prev_password : set_value('password');
$cpassword = (!empty($prev_cpassword)) ? $prev_cpassword : set_value('cpassword');

$captcha = array(
		'name'	=> 'captcha',
		'id'	=> 'captcha',
		'maxlength'	=> 8,
);

$post = site_url('auth/register');
$attr = array('name' => 'userform', 'id' => 'userform');
echo form_open($post, $attr); 
?>
<p>
<label for="firstname" >First Name:</label>
<input type="text"  name="firstname" class="input_reg1" value="<?=$firstname?>">
<?php echo form_error('firstname'); ?>
</p>

<p>

<label for="lastname" >Last Name:</label>
<input type="text"  name="lastname" class="input_reg1" value="<?=$lastname?>">
<?php echo form_error('lastname'); ?>
</p>

<p>
<label for="email" >Email:</label>
<input type="text" name="email" class="input_reg1" value="<?=$email?>">
<?php echo form_error('email'); ?>
</p>


<p>
<label for="password" >Password:</label>
<input type="password" id="password" name="password" class="input_reg1" value="<?=$password?>">
<?php echo form_error('password'); ?>
<p>
<label for="cpassword" >Confirm Password:</label>
<input type="password" name="cpassword" class="input_reg1" value="<?=$cpassword?>">
<?php echo form_error('cpassword'); ?>
</p>


	<?php if ($captcha_registration) {
		if ($use_recaptcha) { ?>
		<div id="recaptcha_image"></div>
		<a href="javascript:Recaptcha.reload()">Get another CAPTCHA</a>
			<div class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Get an audio CAPTCHA</a></div>
			<div class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Get an image CAPTCHA</a></div>
			<div class="recaptcha_only_if_image">Enter the words above</div>
			<div class="recaptcha_only_if_audio">Enter the numbers you hear</div>
			<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" />
			<?php echo form_error('recaptcha_response_field'); ?>
		<?php echo $recaptcha_html; ?>
		<?php } else { ?>
		<p>Enter the code exactly as it appears:</p>
			<?php echo $captcha_html; ?>
			<?php echo form_label('Confirmation Code', $captcha['id']); ?>
			<?php echo form_input($captcha); ?>
			<?php echo form_error($captcha['name']); ?>
				<?php }
	} ?>
			

<input type="hidden" value="1" name="step1">

<input type="image" name="submit" id="submit" src="<?=IMG_FOLDER;?>btn_submit2.png" alt="submit button">

<p>&nbsp;</p>
<?php echo form_close(); ?>
</div>

<div class="video">
<iframe width="500" height="315" src="http://www.youtube.com/embed/dJfyGU6ZR4k" frameborder="0" allowfullscreen></iframe>
</div>

</div>
</div>

</div>
