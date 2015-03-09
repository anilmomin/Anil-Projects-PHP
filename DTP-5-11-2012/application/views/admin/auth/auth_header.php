<?php include 'auth_constants.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Ditch the Pitch | Login</title>
<link rel="stylesheet" href="<?=CSS_FOLDER. 'stylesheet.css'; ?>" type="text/css" media="screen" title="default" />

<!--  jquery core -->

<script src="<?=JS_FOLDER . 'jquery-1.7.1.min.js'; ?>" type="text/javascript"></script>
<script type="text/javascript">
        
		 function clearText(field) {
             if (field.defaultValue == field.value) field.value = '';
             else if (field.value == '') field.value = field.defaultValue;
         }
		
		</script>	

</head>

<body> 

<div id="loginPage">
<div class="signIn">
<h1>Wel come to <b>Ditch The Pitch</b> admin Panel</h1>
<p>www.ditchthepitch.com</p>
