<?php error_reporting(E_ALL ^ E_NOTICE); ?>
<?php include 'designconstants.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?=SITE_HEADER_TITLE; ?></title>

<link rel="stylesheet" href="<?=CSS_FOLDER . 'stylesheet.css';?>" type="text/css" media="screen" title="default" />

 <script src="<?=JS_FOLDER?>jquery-1.7.1.min.js" type="text/javascript"></script>
 <script src="<?=JS_FOLDER?>bday-picker.min.js" type="text/javascript"></script>
 
 <script type="text/javascript">
         function clearText(field) {
             if (field.defaultValue == field.value) field.value = '';
             else if (field.value == '') field.value = field.defaultValue;
         }
		
jQuery(document).ready(function($){

	$("#statusmsg").delay(2800).fadeOut(900);
	
});		
		
  </script>	


	<?php
	
	/**
	  *  Add Dynamically CSS and Javascript Code and files
	  *
	  */
	
	
	?>
	
	<?php if (isset($javaScriptText)) : ?>
	<script type="text/javascript">
		<?php echo $javaScriptText; ?>
	</script>
	<?php endif; ?>

	<?php if (isset($javaScriptSrc)) : ?>
		<?php foreach ($javaScriptSrc as $src) : ?>
			<script type="text/javascript" src="<?php echo JS_FOLDER . $src; ?>"></script>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if (isset($jQueryText)) : ?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				<?php echo $jQueryText; ?>
			});
		</script>
	<?php endif; ?>
	
	<?php if (isset($CSSSrc)) : ?>
		<?php foreach ($CSSSrc as $src) : ?>
			<link rel="stylesheet" type="text/css" href="<?php echo CSS_FOLDER . $src; ?>" />
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if (isset($CSSText)) : ?>
	<style type="text/css">
			<?php echo $CSSText; ?>
</style>
	<?php endif; ?>



</head>


<body> 

<div id="wrapper">
<div id="header">
<div class="logo">
	<h1><b>Ditch The Pitch</b> admin Panel</h1>
	<p>www.ditchthepitch.com</p>
</div>

<table class="searchBox">
	<tr>
                    <td>
                       <!--  <input type="text" onblur="clearText(this)" onfocus="clearText(this)" value="Search..." class="search" name="search"> -->
                    </td>
                    <td>
                    <!-- 
                        <select name="type">
                            <option>All</option>
                        </select>
                         -->
                    </td>
                    <td>
                      <!--   <input type="image" class="btnSearch" src="<?php echo IMG_FOLDER; ?>btnSearch.png" > -->
                    </td>
                </tr>
		<tr class="link">
		<td>
		<!-- <a href="#" class="account">My Account</a>  -->
		<a href="<?php echo site_url(); ?>/admin/auth/logout" class="logout">Logout</a>
		</td>
		</tr>
</table>

<div class="cb"></div>
		<ul class="topNav">
		<li><a href="<?php echo site_url(); ?>admin/dashboard">Dashboard</a></li>
		<li><a href="<?php echo site_url(); ?>admin/auth/registerbyadmin">Site Users</a></li>
		<li><a href="<?php echo site_url(); ?>admin/deals/adddeals">Wine Deals</a></li>
		<li><a href="<?php echo site_url(); ?>admin/wines">Wine Inventory</a></li>
		<li><a href="<?php echo site_url(); ?>admin/wineusers/showincreq">Wine Samples</a></li>
		<!-- <li><a href="<?php echo site_url(); ?>admin/feedbackmanager/displayfeedback">Wine Feedback</a></li> -->
		<li><a href="<?php echo site_url('admin/newsmanager/addnews');?>">News</a></li>
		<li class="noBg"><a href="<?php echo site_url('admin/newsletters/addnewsletter');?>">Newsletters</a></li>
		</ul>
		
<?php

	$display = ($this->session->flashdata('message') || $this->session->flashdata('errormsg') ) ? 'display:block;' : 'display:none;';
	$class  = ($this->session->flashdata('message')) ? 'messege blue' : '';
	$class  = ($this->session->flashdata('errormsg')) ? 'messege red' : 'messege blue';
?>
	
</div>
<div id="statusbar" >
<div id="statusmsg" class="<?php echo $class; ?>" style="<?php echo $display; ?>">
                    <p>
                       <?php  
                       echo $this->session->flashdata('message'); 
                       echo $this->session->flashdata('errormsg');
                        ?>
                    </p>
</div>
</div>