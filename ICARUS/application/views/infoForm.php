<?php

/**
 * @author TEAM ViRiLiTY
 * @copyright 2009
 */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Creating a sample form</title>
<style type="text/css">
body {
	font: small/1.5em Verdana, Arial, Helvetica, serif;
}
</style>
</head>
<body>
  <h1>Registration Form</h1>
  <p>Please complete the following form:</p>
  <?php echo form_open('form/submit'); ?>
  <p><label for="fname">Full Name: </label><br /><?php echo form_input($fname); ?></p>
  <p><label for="lname">Last Name: </label><br /><?php echo form_input($lname); ?></p>
  <p>Please select your sex : </p>
  <p><?php echo form_radio($gender, 'male', TRUE); ?> <label for="male">Male</label></p>
  <p><?php echo form_radio($gender, 'female', FALSE); ?> <label for="female">Female</label></p>
  <p><label for="comments">Comments: </label><br /><?php echo form_textarea($comments); ?></p>
  <p><label for="shirts">Shirt Size: </label><br /><?php echo form_dropdown('shirts', $shirtDropDown, $selectedShirts); ?></p>
  <?php echo form_submit('submit', 'Submit'); ?>
  <?php echo form_close(); ?>
</body>
</html>