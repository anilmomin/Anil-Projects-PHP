	
	<h2 style='font-weight:bold;margin-top:20px;padding-left:20px;'><a style='text-decoration: none;' href='<?php echo site_url('/pharmaaction/');?>' >Home</a>  > <?php echo $success_header; ?></h2>
	<div class='ui-tabs-panel ui-widget-content ui-corner-bottom'>
	 <div class='profile-content'> 
	
	 <div id='sub_nav' style='float:left; margin-top: 50px;'><ul><li style='margin-top: 1em;' ><a href='<?php echo site_url('/profile/'); ?>' > Edit Profile </a><br/></li><li style='margin-top: 1em;' ><a href='<?php echo site_url('/profile/changepassword'); ?>' > Change Password </a></li></ul> </div> 
	 	<div id='form_div' style='margin-left:240px;height:350px;margin-top:60px;' > 
			<p> <?php echo $success_msg; ?> </p> <br /> <a href='<?php echo site_url('/profile/index')?>';>Continue Visiting your profile </a>
		</div>
	</div>
	</div>
	
	
