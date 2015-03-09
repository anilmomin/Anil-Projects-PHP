<div id="tabs-3"><!--content tab2-->
 <h2 style='font-weight:bold;margin-top:20px;padding-left:20px;'><a style='text-decoration: none;' href='<?php echo site_url('/pharmaaction/'); ?>' >Home</a>  >  Edit Profile</h2>
 <div class="profile-content">

<?php
	/*
	 *	Form Interface for adding pharmas 
	 * */
	// action url to load the controller
	$action_url = 'profile/editpharma/';
	$pharmaProfile = $pharmaProfile[0];
	
	if($pharmaProfile == null)
	{
		$pharmaProfile = (object) array(
						'pharmaId' => '',
						'name' => '',
						'adminName' => '',
						'adminTitle' => '',
						'adminEmail' => '',
						'adminPassword' => '',
						'description' => '',
						'address' => '',
						'phone' => '',
						'fax' => '',
						'website' => '',
						'imageLink' => '',
						'createdby' => '',
						'lastupdatedby' => '',
						'canSupportLogin' => ''
					);	
	}
	
	
	/* Form for Adding and Editing Pharmas */
	
	$form_str = '';
	$textarea = array('name'=>'', 'cols'=>'', 'rows'=>'', 'onKeyPress' => '');
	$attributes = array('id' => 'pharmaform');

	
	$form_str .= "<div id='sub_nav' style='float:left; margin-top: 50px;'><ul><li style='margin-top: 1em;' ><a href='".site_url('/profile/')."' > Edit Profile </a><br/></li><li style='margin-top: 1em;'><a href='". site_url('/profile/changepassword')."' > Change Password </a></li></ul> </div>";
	$form_str .= "<div id='form_div' style='margin-left:240px' >";
	if(isset($error)){ $form_str .= $error['error'];}
	$form_str .= form_open_multipart($action_url, $attributes);
	//$form_str .= "<img style='float:right' src='". $logo_url[0]->value . 'uploads/'  . $pharmaProfile->imageLink . "' />";
	
	//$form_str .= "<p> $success_msg </p>"; 
	$form_str .= br(1);
	$form_str .= "<span id='usrerrmsg' style='color:red'></span>";
	$form_str .= br(2);
	
	$form_str .= "<table height=400>";
	
	$form_str .= "<tr>";	
	$form_str .= "<td width=150>";
	$form_str .= "Pharma Name : ";
	$form_str .= "</td>";
	
	
	$alpha_name = array(
						'name' => 'name',
						'class'=> 'alphabets',
						'maxlength' => '30'
						);
	
	$form_str .= "<td>";
	$form_str .= form_input($alpha_name, $pharmaProfile->name);
	$form_str .= "<span id='errname' class='hide error_msg'>*</span>";
	//$form_str .= br(2);
	$form_str .= "</td>";
	$form_str .= "</tr>";
	
	
	$alpha_adminName = array(
						'name' => 'adminname',
						'class'=> 'alphabets',
						'maxlength' => '30'
						);
	
	
	$form_str .= "<tr>";	
	$form_str .= "<td>";
	$form_str .= "Admin Name : ";
	$form_str .= "</td>";
	
	$form_str .= "<td>";
	$form_str .= form_input($alpha_adminName, $pharmaProfile->adminName);
	$form_str .= "<span id='erradminname' class='hide error_msg'>*</span>";
	//$form_str .= br(2);
	$form_str .= "</td>";
	$form_str .= "</tr>";

	
	$alpha_adminTitle = array(
					'name' => 'admintitle',
					'class'=> 'alphabets',
					'maxlength' => '30'
					);
	
	
	
	$form_str .= "<tr>";	
	$form_str .= "<td>";
	$form_str .= "Admin Title : ";
	$form_str .= "</td>";
	
	$form_str .= "<td>";
	$form_str .= form_input($alpha_adminTitle, $pharmaProfile->adminTitle);
	$form_str .= "<span id='erradmintitle' class='hide error_msg'>*</span>";
	//$form_str .= br(2);
	$form_str .= "</td>";
	$form_str .= "</tr>";
	
	//Shows can support Login in Edit Form
	

		$status = ($pharmaProfile->canSupportLogin  == 1) ? TRUE : FALSE;
		
		$form_str .= "<tr>";
		$form_str .= "<td>";
		$form_str .= "Can Support Login : ";
		$form_str .= "</td>";
	
		$form_str .= "<td>";
		$form_str .= form_checkbox('loginsupport', '1', $status) . " Allowed";
		$form_str .= "</td>";
		$form_str .= "</tr>";
		
	
	
	
	
	$form_str .= "<tr>";
	$form_str .= "<td>";
	$form_str .= "Pharma Image : "; 
	$form_str .= "</td>";
	
	$form_str .= "<td>";
	$form_str .= form_upload('imageupload',$pharmaProfile->imageLink).'<br><span style="color:gray;font-size:9px;">Upload 100 x 75 size image for best result</span>';
	$form_str .= "<span id='errimgupload' class='hide error_msg' >*</span>";
	//$form_str .= br(2);
	$form_str .= "</td>";
	$form_str .= "</tr>";
	
	$check = ($pharmaProfile->canSupportLogin)? TRUE : FALSE;
	
	/*$form_str .= "Login Support : " . form_checkbox('loginsupportchk','1', $check) . " Yes";
	$form_str .= br(2);
	*/
	$textarea = array('name'=>'description', 'cols'=>'30', 'rows'=>'3', 'onKeyPress' => 'RestrictTyping(500,this,\'limit1\');');
	
	
	$form_str .= "<tr>";
	$form_str .= "<td>";
	$form_str .= "Description : ";
	$form_str .= "</td>";
	
	$form_str .= "<td>";
	$form_str .= form_textarea($textarea, $pharmaProfile->description);
	$form_str .= "<span id='errdescription' class='hide error_msg' >*</span>";
	$form_str .= "<p class='hint'><label id='limit1' >500</label> Characters Left</p> ";
	//$form_str .= br(2);
	$form_str .= "</td>";
	$form_str .= "</tr>";
	
	$textarea = array('name'=>'address', 'cols'=>'30', 'rows'=>'3', 'onKeyPress' => 'RestrictTyping(500,this,\'limit2\');');
	
	
	$form_str .= "<tr>";
	$form_str .= "<td>";
	$form_str .= "Address : ";
	$form_str .= "</td>";
	
	$form_str .= "<td>"; 
	$form_str .= form_textarea($textarea, $pharmaProfile->address);
	$form_str .= "<span id='erraddress' class='hide error_msg' >*</span>";
	$form_str .= "<p class='hint'><label id='limit2' >500</label> Characters Left</p> ";
	//$form_str .= br(2);
	$form_str .= "</td>";
	$form_str .= "</tr>";
	
	
	$phoneInput = array(
              'name'        => 'phonenum',
              'class'       => 'phonenum',
			  'maxlength'   => '20'	
            );
	
	$form_str .= "<tr>";
	$form_str .= "<td>";
	$form_str .= "Phone Number : ";
	$form_str .= "</td>"; 
	
	$form_str .= "<td>";
	$form_str .= form_input($phoneInput, $pharmaProfile->phone);
	$form_str .= "<span id='errphone' class='hide error_msg' >*</span>";
	//$form_str .= br(2);
	$form_str .= "</td>";
	$form_str .= "</tr>";
	
	$faxInput = array(
              'name'        => 'fax',
              'class'       => 'phonenum',
			  'maxlength'   => '20'
            );
	
	$form_str .= "<tr>";
	$form_str .= "<td>";
	$form_str .= "Fax Number : ";
	$form_str .= "</td>";
	
	$form_str .= "<td>";
	$form_str .= form_input($faxInput, $pharmaProfile->fax);
	$form_str .= "<span id='errfax' class='hide error_msg' >*</span>";
	$form_str .= "</td>";
	$form_str .= "</tr>";
	
	
	$form_str .= "<tr>";
	$form_str .= "<td>";
	$form_str .= "Website : ";
	$form_str .= "</td>";
	
	$form_str .= "<td>";	
	$form_str .= form_input('website', $pharmaProfile->website);
	$form_str .= "<span id='errweb' class='hide error_msg' >*</span>";
	$form_str .= "</td>";
	$form_str .= "</tr>";
	

	$form_str .= form_hidden('post', 'post');
	$form_str .= form_hidden('pharmaId', $pharmaProfile->pharmaId);
	$form_str .= form_hidden('adminName', $pharmaProfile->adminName);
	$form_str .= "<tr><td></td><td>&nbsp;</td></tr>";


	$form_str .= "<tr>";
	$form_str .= "<td>";
	$form_str .= "</td>";
	$form_str .= "<td>";
	$btntext = "Update";
	
	$form_str .= form_button('save',$btntext, 'onClick="submit_form();"');
	$form_str .= "&nbsp;";
	$form_str .= form_button('cancel', 'Cancel', 'onClick="location.href=\''.site_url().'/pharmaaction/\'" '); 
	$form_str .= "</td>";
	$form_str .= "</tr>";
	
	$form_str .= "</table>";
	
	$form_str .= form_close();
	$form_str .= '</div>';
	
	echo $form_str;
?>
</div>
</div>