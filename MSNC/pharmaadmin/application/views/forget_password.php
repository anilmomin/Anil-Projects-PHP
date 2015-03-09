<?php 
	echo br(1);
	echo "<h2 style='font-weight:bold;margin-top:20px;padding-left:20px;'> Forget Password</h2>";
	echo "<div class='ui-tabs-panel ui-widget-content ui-corner-bottom'>";
	echo "<div class='profile-content'>";
	
	echo "<div id='form_div' style='margin-left:240px;height:350px' >";
	
	$attributes = array('id' => 'passwordform');
	
	echo form_open('profile/forgetpassword', $attributes);
 	echo br(2);
	echo "<p>Enter you Login Email.</p>";
	echo br(1);
	if(isset($msg)) echo "<p class='error_msg'>" . $msg . "</p>";
	echo "<span id='passmsg' class='error_msg'></span>";
	echo br(2);
	echo "<table>";
	echo "<tr>";
	echo "<td>";
	echo "Email Address : ";
	echo "</td>";
	
	echo "<td>";
	echo form_input('pharmaemail');
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
	echo form_button('pass_submit', 'Save', 'onClick="submit_forget_form();"');
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

