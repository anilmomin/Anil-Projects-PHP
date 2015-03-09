<?php

if (isset($error))
{
	echo $error . br();
}

echo form_open('login/doLogin');
echo "Username : " . form_input('username');
echo br();
echo "Password : " . form_password('password');
echo br();
echo form_checkbox('rememberme', 'yes') . "Remember Me";
echo br();
echo form_submit('submit', 'Login');
echo form_close();

?>