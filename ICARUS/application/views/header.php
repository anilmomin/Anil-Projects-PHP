<?php include_once('designConstants.inc'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<!-- Recommended XHTML-Editor: HTML-Kit 292 (Freeware) -->
<!-- http://www.chami.com/html-kit/download/ -->

<head>
	
	<link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url(); ?>system/application/views/assets/css/styles.css" />
	
	<title><?php if (isset($title)) echo $title; ?></title>
	<?php if (isset($javaScriptText)) : ?>
		<script type="text/javascript">
		<?php echo $javaScriptText; ?>
		</script>
	<?php endif; ?>

	<?php if (isset($javaScriptSrc)) : ?>
		<?php foreach ($javaScriptSrc as $src) : ?>
			<script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/assetsjs/<?php echo $src; ?>"></script>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if (isset($CSSSrc)) : ?>
		<?php foreach ($CSSSrc as $src) : ?>
			<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>system/application/views/assets/css/<?php echo $src; ?>" />
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if (isset($CSSText)) : ?>
		<style type="text/css">
			<?php echo $CSSText; ?>
		</style>
	<?php endif; ?>

</head>

<body>



	    <!-- Logout Box -->
		<div class="navflag-container">
			<div class="navflag">
				<ul>
					<li>Welcome <b><?php echo $currentUserName; ?></b></li>
					<li><b><a href="<?php echo site_url("login/logout"); ?>" title="Log-Out">Logout</a></b></li>
				</ul>
			</div>
		</div>

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
			<?php if (isset($coursesTaken) && count($coursesTaken)) : ?>
			<div class="br-clean">Course(s) Taken :</div>
				<ul>
					<?php foreach ($coursesTaken as $course) : ?>
						<?php if ($course['code'] == $this->session->userdata(SEL_COURSE)) : ?>
							<li><a href="<?php echo site_url(COURSE_FILE_NAME . '/studentPrespective/' . $course['code']); ?>" class="selected"><?php echo $course['name']; ?></a></li>
						<?php else : ?>
							<li><a href="<?php echo site_url(COURSE_FILE_NAME . '/studentPrespective/' . $course['code']); ?>"><?php echo $course['name']; ?></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
			<?php if (isset($coursesOffered) && count($coursesOffered)) : ?>
			<div class="br-clean">Course(s) Given :</div>
				<ul>
					<?php foreach ($coursesOffered as $course) : ?>
						<?php if ($course['code'] == $this->session->userdata(SEL_COURSE)) : ?>
							<li><a href="<?php echo site_url(COURSE_FILE_NAME . '/teacherPrespective/' . $course['code']); ?>" class="selected"><?php echo $course['name']; ?></a></li>
						<?php else : ?>
							<li><a href="<?php echo site_url(COURSE_FILE_NAME . '/teacherPrespective/' . $course['code']); ?>"><?php echo $course['name']; ?></a></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
    
		<!-- Buffer after header -->    
		<div class="buffer">
		</div>		