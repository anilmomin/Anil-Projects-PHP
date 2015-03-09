<?php include_once('designConstants.inc'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<!-- Recommended XHTML-Editor: HTML-Kit 292 (Freeware) -->
<!-- http://www.chami.com/html-kit/download/ -->

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="description" content="This is a course management system, known as ICARUS." />
	<meta name="keywords" content="se, software engineer, icarus, database, course, course management, open source" />
	<meta name="author" content="ICARUS" />
	
	<link rel="stylesheet" type="text/css" media="screen,projection" href="<?php echo base_url(); ?>system/application/views/css/style_screen.css" />
	<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url(); ?>system/application/views/css/style_print.css" />
	
	<title><?php if (isset($title)) echo $title; ?></title>
</head>

<body>
	<div class="page-container-1">

	    <!-- Navigation Level 1 -->
		<div class="nav1-container">
			<div class="nav1">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Contact</a></li>
					<li><a href="#">Sitemap</a></li>
				</ul>
			</div>
		</div>
	
	    <!-- Sitename -->
		<div class="site-name">
			<p class="title"><a href="index.html"><?php echo SITE_NAME; ?></a></p>
			<p class="subtitle"><a href="index.html"><?php echo SITE_TAGLINE; ?></a></p>
		</div>
	    
	    <!-- Site slogan -->
		<div class="site-slogan-container">
			<div class="site-slogan">
				<p class="title"><?php echo SITE_SLOGAN_TITLE; ?></p>
				<p class="subtitle"><?php echo SITE_SLOGAN_SUBTITLE; ?></p>
				<p class="text"><?php echo SITE_SLOGAN_TEXT; ?></p>
				<p class="readmore"><?php echo SITE_SLOGAN_READ_MORE; ?></p>
			</div>
		</div>
	    
	    <!-- Header banner -->
		<div>
			<img class="img-header" src="<?php echo SITE_HEADER_IMAGE; ?>" alt="<?php echo SITE_HEADER_IMAGE_TITLE; ?>"/>
		</div>
    
		<!-- Navigation Level 2 -->
		<div class="nav2">			
			<ul>
				<li><a href="index.html" class="selected">Layout 1</a></li>
				<li><a href="layout2.html">Layout 2</a></li>
				<li><a href="layout3.html">Layout 3</a></li>
				<li><a href="options_basic.html">Basic Options</a></li>
				<li><a href="options_extra.html">Extra Options</a></li>
			</ul>
		</div>
    
		<!-- Buffer after header -->    
		<div class="buffer">
		</div>