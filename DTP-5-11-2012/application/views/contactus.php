<?php include 'designconstants.php'; ?>

<div id="standardArc">
    </div>

<div id="outerContent">
        <div class="content">
<div class="banner">

<img src="<?=IMG_FOLDER;?>Registration.png" width="960" height="216">
 <p style="font-size:40px">Contact us</p>
</div>


<div id="content_pane">
<div id="reg" style="width:32%">
<strong class="redhdng">Contact us:</strong>
<br>
<br>
<?php 

$post = site_url('contactus');
$attr = array('name' => 'contactform');

echo form_open($post, $attr); 
?>
<p>
<label for="firstname" >First Name:</label>
<input type="text"  name="firstname" class="input_reg1" value="<?php echo set_value('firstname');?>">
<?php echo form_error('firstname'); ?>
</p>

<p>

<label for="lastname" >Last Name:</label>
<input type="text"  name="lastname" class="input_reg1" value="<?php echo set_value('lastname'); ?>">
<?php echo form_error('lastname'); ?>
</p>

<p>
<label for="email" >Email:</label>
<input type="text" name="email" class="input_reg1" value="<?php echo set_value('email'); ?>">
<?php echo form_error('email'); ?>
</p>

<p>
<label for="email" >Contact Number:</label>
<input type="text" name="contact" class="input_reg1" value="<?php echo set_value('contact'); ?>">
<?php echo form_error('contact'); ?>
</p>

<p>
<label for="email" >Message:</label>
<textarea name="msg" rows="10" cols="42" class="txt_area_reg2" ><?php echo set_value('msg'); ?></textarea>
<?php echo form_error('msg'); ?>
</p>
<input type="hidden" name="post" value="1" />
<p>&nbsp;</p>

<input type="image" name="submit" id="submit" src="<?=IMG_FOLDER;?>btn_submit2.png" alt="submit button">

<p>&nbsp;</p>
<?php echo form_close(); ?>
</div>
</div>
</div>

</div>