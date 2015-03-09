<?php include_once('designConstants.php'); 
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<title><?php echo SITE_HEADER_TITLE; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo CSS_FOLDER. 'style.css'; ?>" type="text/css" media="screen"/>
	<link rel="stylesheet" href="<?php echo CSS_FOLDER. 'jquery-ui-1.8.12.custom/css/smoothness/jquery-ui-1.8.12.custom.css'; ?>" />
	
	<script type="text/javascript" src="<?php echo JS_FOLDER . 'jquery-1.5.1.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo JS_FOLDER . 'jquery-ui-1.8.12.custom.min.js';?>"></script>
	<script type="text/javascript" src="<?php echo JS_FOLDER . 'jquery.numeric.js';?>"></script>
	
		
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
		<div class="wrap">
	    	<div id="logo">
	    		<h1>
	    		<a href="<?php echo site_url(); ?>/pharmaaction/index"></a>
	    		</h1>
				
 			</div>
 			
 			<?php 
 				$url = $this->uri->segment(2);
 				if($url != 'forgetpassword')
 				{
 			?>
 			<div style="float: right; width: 480px;">
       			<div id="left" class="red" style="width:350px; text-align:right">
       					<?php echo $currentUser['name']; ?> is logged in | 
       					<span class="orange"> 
       						<a href="<?php echo site_url("profile/"); ?>" title="Settings">Settings</a>
       					</span> | 
       					<span class="orange"> 
       						<a href="<?php echo site_url("login/logout/"); ?>" title="Log-Out">Logout</a>
       					</span>  |   
       					<img height="15" width="15" alt="help" src="<?php echo IMG_FOLDER . 'help-icon.png'; ?>">  
       					<a href="#" class="help">help</a> 
       			</div>
			    <div style="width: 120px; float: right; margin-top: 26px;">
				<?php
				$imageLink = ''; 
				if($currentUser['imageLink'] == null)
				{
					$imageLink = 'default.jpg';
				}
				else
				{
					$imageLink = $currentUser['imageLink'];
				}
				
				?>			    
			    
			    	<img height="34" width="119" alt="logo" src="<?php  echo $logoLink[0]->value .'/uploads/' . $imageLink; ?>" />
			    </div>
		 </div>
		<?php }?> 
		</div>
	</div>
  
  
  <!--
 			
 			
 			
		<ul id="top-navigation">
			<li class="active"><span><span>Homepage</span></span></li>
			<li><span><span><a href="<?php echo site_url(); ?>/adminaction/showpharma">Show Pharmas</a></span></span></li>
			<li><span><span><a href="<?php echo site_url(); ?>/adminaction/pharmaform/addpharma">Add Pharma Company</a></span></span></li>
		</ul>
		
		
-->