
<?php 
	echo br(1);
	echo "<h2 style='font-weight:bold;margin-top:20px;padding-left:20px;'><a style='text-decoration: none;' href='".site_url('/pharmaaction/')."' >Home</a>  > Change Password</h2>";
	echo "<div class='ui-tabs-panel ui-widget-content ui-corner-bottom'>";
	echo "<div class='profile-content'>";
	
	echo "<div id='sub_nav' style='float:left; margin-top: 50px;'><ul><li style='margin-top: 1em;' ><a href='".site_url('/profile/')."' > Edit Profile </a><br/></li><li style='margin-top: 1em;' ><a href='". site_url('/profile/changepassword')."' > Change Password </a></li></ul> </div>";
	echo "<div id='form_div' style='margin-left:240px;height:350px' >";
	
	$attributes = array('id' => 'passwordform');
	
	echo form_open('profile/changepassword', $attributes);
 	echo br(2);
	echo "<p>Enter a new password.</p>";
	echo br(1);
	if(isset($msg)) echo "<p class='error_msg'>" . $msg . "</p>";
	echo "<span id='passmsg' class='error_msg'></span>";
	echo br(2);
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	echo "Current Password : ";
	echo "</td>";
	
	echo "<td>";
	echo form_password('currentpwd');
	echo "<span id='errold' class='hide error_msg'>*</span>";
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "New Password : ";
	echo "</td>";
	
	echo "<td>";
	echo form_password('newpwd');
	echo "<span id='errnew' class='hide error_msg'>*</span>";
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "Confirm Password : ";
	echo "</td>";
	echo "<td>";
	echo form_password('confirmpwd');
	echo "<span id='errconfirm' class='hide error_msg'>*</span>";
	echo "</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>";
	echo "</td>";
	
	echo "<td>";
	echo form_hidden('post','post');
	echo br(1); 
	echo form_button('pass_submit', 'Save', 'onClick="submit_password_form();"');
	echo "&nbsp;";
	echo form_button('pass_cancel', 'Cancel', 'onClick="location.href=\''.site_url().'/pharmaaction/index\'" ');
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	
	echo form_close();
	echo "</div>";
	echo "</div>";
	echo "</div>";
?>

