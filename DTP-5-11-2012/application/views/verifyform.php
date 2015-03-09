<?php include 'designconstants.php'; ?>
<script>
$(function(){
	$("#bmonth").val(<?php echo set_value('birth[month]'); ?>);
	$("#bday").val(<?php echo set_value('birth[day]'); ?>);
	$("#byear").val(<?php echo set_value('birth[year]'); ?>);
})
;
</script>
<div id="standardArc">
    </div>

<div id="outerContent">
        <div class="content">
<div class="banner">

<img src="<?=IMG_FOLDER;?>Registration.png" width="960" height="216">
 <p style="font-size:40px">Registration</p>
 <div style="font-size:20px"> Please note: Do not register more than once as it may eliminate you from being eligible to recieve a sample. </div>
</div>


<div id="content_pane" class="reg_pane2">
<div id="reg" class="registration_container">
<strong class="redhdng">1. Registration</strong>
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



$post = site_url('sampleregistration/registrationform/1');
$attr = array('name' => 'verifyform', 'id' => 'verifyform');
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


<label for="picker1" >Date of Birth:</label>
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

<p><strong>Do you reside in Australia?</strong> </p>
<?php
$yescheck = '';
$nocheck = '';

if($this->input->post('residence') == 'yes')
{
    $yescheck = 'checked="checked"';
}
else
{
    $nocheck = 'checked="checked"';
}

?>
<p>Yes <input name="residence" type="radio" <?=$yescheck?> value="yes" />   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No<input name="residence" type="radio" <?=$nocheck?> value="no"   /> 
</p>

<p class="border4"></p>
<?php
$yescheck = '';
$nocheck = '';
if($this->input->post('above18') == 'yes')
{
    $yescheck = 'checked="checked"';
}
else
{
    $nocheck = 'checked="checked"';
}
?>
<!-- <p><strong>Although you have advised that you are over 18 years old and reside in Australia, do you reside in a part of Australia where it is legal to receive and consume alcoholic beverages?</strong></p> 
 <p>Yes <input name="above18" type="radio"  <?=$yescheck?>  value="yes" />   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No<input name="above18" type="radio" <?=$nocheck?> value="no" /> 
</p> -->
 <p>&nbsp;</p>
<input type="hidden" value="1" name="step1">
<a href="<?php echo site_url(); ?>" > <img src="<?=IMG_FOLDER;?>cancel.png" alt="cancel button"  /> </a>&nbsp;&nbsp;&nbsp;

<input type="image" name="submit" id="submit" src="<?=IMG_FOLDER;?>next.png" alt="submit button">



<p>&nbsp;</p>
<?php echo form_close(); ?>
</div>
<div class="video">
<iframe width="500" height="315" src="http://www.youtube.com/embed/yAqgAF0K2z4" frameborder="0" allowfullscreen></iframe>
</div>
</div>
</div>

</div>
<?php 
	$status = substr($this->uri->uri_string(), -1);
	$errors = $this->session->flashdata('specialerrors') ;
	
if(!$status && $errors)
{
?>
<script type="text/javascript" >
jQuery(document).ready(function($){
	$('a[rel*=popup]').facebox({
        loadingImage : '<?php echo CSS_FOLDER; ?>facebox/src/loading.gif',
        closeImage   : '<?php echo CSS_FOLDER; ?>facebox/src/closelabel.png'
      });	
	$("#popup").trigger("click");
	$(".close_image").click(function(){
		window.location = "<?=site_url('/');?>";
		});
	
});
</script>
<a id="popup" href="#errorpane" rel="popup" ></a>

<div id="errorpane" style="display:none;">
	<center><b>Uneligible User!</b></center>
	<br/><br/>	
	<?php
		foreach($errors as $error)
			echo "<p> - $error </p>";
	?>
	<center><a href="#" class="close_image"><img src="<?php echo IMG_FOLDER . 'ok.png'; ?>" alt="close" /></a></center>	
</div>

<?php } ?>