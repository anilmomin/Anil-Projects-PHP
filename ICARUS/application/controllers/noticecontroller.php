<?php

/**
 * @author 
 * @copyright 2009
 */

require_once('icaruscontroller.php');
require_once('moduleConstants.inc');

class NoticeController extends IcarusController
{
	const COURSE_CODE = "CS413";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Notice');
	}


	function index()
	{
		$id = $this->Authenticate->getCurrentUserID();
		$roleId = $this->Authenticate->getCurrentRoleId();		
		$canApprove = $this->Authorize->isAllowed($roleId, PERMISSION_CAN_EDIT, MODULE_NOTICES);
	
		if (!$canApprove)
		{
			$data = array('title' => 'This is Notice Section');
			$this->displayView();
		}
	}




function CreateNotice()
{
		$Subject = array('name' => 'Subject', 'value' => 'This is Subject');
		
		$Content = array('Name' => 'Content', 'value' => 'This is Content of Notice');
		
		
		
		$viewHtml = form_open('noticecontroller/PostNotice') .
					messageBox('Subject', form_input($Subject)) .
					messageBox('Content', form_input($Content)) . 					
					form_submit('submit', 'Post Notice') .
					form_close();
						
		$this->addMainBodyData($viewHtml);
		$this->displayView();




}

function PostNotice()
{
	

	
			$inputdata = array(
				'courseCode' => self::COURSE_CODE,
				'text' => $Content,
				'dateTime' => $this->now()
		);
		
	$id = 	$this->Notice->insert($inputdata);
		
	
	

		$this->displayView();

		
	
}





}



?>