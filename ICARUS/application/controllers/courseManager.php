<?php

/**
 * @author TEAM ViRiLiTY
 * @copyright 2009
 */

require_once('icaruscontroller.php');
require_once('moduleConstants.inc');

class CourseManager extends IcarusController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Courses');
	}

	public function studentPrespective($courseCode)
	{
		$roleId = $this->Authenticate->getCurrentRoleId();
		if ($this->Authorize->isAllowed($roleId, PERMISSION_CAN_VIEW, MODULE_HOME))
		{
			$relatedStudent = $this->Registration->getByPrimaryKey($this->Registration->preparePrimaryKeyArray($this->Authenticate->getCurrentUserId(), $courseCode));
			
			if (count($relatedStudent) == 1)
			{
				$sessionData = array(
                   SEL_COURSE  => $courseCode
				);

				$this->session->set_userdata($sessionData);
				
				$sideMenu = array(
					array('title' => 'Polls', 'link' => site_url('pollManager/showPoll/CMonth'), 'hasSubItems' => false),
					array('title' => 'Notices', 'link' => site_url('noticecontroller/index'), 'hasSubItems' => false),
				);
				
				$course = $this->Courses->getByPrimaryKey($this->Courses->preparePrimaryKeyArray($courseCode));
				$course = $course[0];

				$this->addLeftSideBarData(sideBarMenuWithSubMenus("Main Menu", $sideMenu));
				
				$courseIntroText = messageBox('Course Name : ' . $course->courseName, '') .
									messageBox('Course Code : ' . $course->courseCode, '') .
									messageBox('Credits Hours : ' . $course->courseCredits, '');
				
				$this->addMainBodyData(mainBodySingleColumnBox('Welcome', '', $courseIntroText, true, COLOUR_BLUE, COLOUR_WHITE, COLOUR_RED, COLOUR_WHITE));
				
				$this->displayView();
			}
		}
		else
		{
			$this->displayError();
		}
	}

	public function teacherPrespective($courseCode)
	{
		$roleId = $this->Authenticate->getCurrentRoleId();
		if ($this->Authorize->isAllowed($roleId, PERMISSION_CAN_VIEW, MODULE_HOME))
		{
			$relatedTeacher = $this->TeacherCourse->getByPrimaryKey($this->TeacherCourse->preparePrimaryKeyArray($this->Authenticate->getCurrentUserId(), $courseCode));

			if (count($relatedTeacher) == 1)
			{
				$sessionData = array(
                   SEL_COURSE  => $courseCode
				);

				$this->session->set_userdata($sessionData);
				
				$sideMenu = array(
					array('title' => 'Polls', 'link' => site_url('pollManager/showPoll/CMonth'), 'hasSubItems' => false),
					array('title' => 'Notices', 'link' => site_url('noticecontroller/index'), 'hasSubItems' => false),
				);
				
				$course = $this->Courses->getByPrimaryKey($this->Courses->preparePrimaryKeyArray($courseCode));
				$course = $course[0];

				$this->addLeftSideBarData(sideBarMenuWithSubMenus("Main Menu", $sideMenu));
				
				$courseIntroText = messageBox('Course Name : ' . $course->courseName, '') .
									messageBox('Course Code : ' . $course->courseCode, '') .
									messageBox('Credits Hours : ' . $course->courseCredits, '') .
									readMoreBar(anchor('#', 'Edit Course') . br(1) . anchor('#', 'Delete Course'));
				
				$this->addMainBodyData(mainBodySingleColumnBox('Welcome', '', $courseIntroText, true, COLOUR_BLUE, COLOUR_WHITE, COLOUR_RED, COLOUR_WHITE));

				$this->displayView();
			}
		}
		else
		{
			$this->displayError();
		}
	}

	public function index()
	{
		$roleId = $this->Authenticate->getCurrentRoleId();
		
		if ($this->Authorize->isAllowed($roleId, PERMISSION_CAN_VIEW, MODULE_HOME))
		{
			//print_r($this->User->getAll());
			$this->load->view('header', $this->headerData);
			$this->load->view('left_sidebar');
			$this->load->view('main_body');
			$this->load->view('right_sidebar');
			$this->load->view('footer');
		}
		else
		{
			echo "Permission not granted";
		}
	}
}

?>	