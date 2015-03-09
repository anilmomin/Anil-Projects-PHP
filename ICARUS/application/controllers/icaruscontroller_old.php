<?php

/**
 *
 * @category		Controller Class
 * @package			system/application/controllers
 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 0.1
 */

class IcarusController extends Controller
{
	protected $headerData = array();
	protected $leftSidebarData = array();
	protected $mainBodyData = array();
	protected $rightSidebarData = array();
	protected $footerData = array();

	public function __construct()
	{
		parent::__construct();
		$this->headerData = array();
		$this->load->model('Authenticate');
		$this->load->model('Authorize');
		$this->load->model('Registration');
		$this->load->model('TeacherCourse');
		$this->checkForLogin();

		/* initializing the required variables */

		$this->headerData['coursesOffered'] = array();
		$this->headerData['coursesTaken'] = array();
		$this->leftSidebarData['ls_data'] = '';
		$this->rightSidebarData['rs_data'] = '';
		$this->mainBodyData['mb_data'] = '';
		$this->headerData['javaScriptText'] = '';
		$this->headerData['javaScriptSrc'] = array();

		/* end initializing variables */


		$info = $this->Authenticate->getCurrentUserInfo();
		$this->headerData['currentUserName'] = $info[USERNAME];

		if ($this->Authorize->isAllowed($this->Authenticate->getCurrentRoleId(), PERMISSION_CAN_REGISTER_TO, MODULE_COURSES))
		{
			$courses = $this->Registration->getByCriteria(array('studentID' => $this->Authenticate->getCurrentUserId()));
			foreach ($courses as $course)
			{
				array_push($this->headerData['coursesTaken'], $course->courseCode);
			}
		}

		if ($this->Authorize->isAllowed($this->Authenticate->getCurrentRoleId(), PERMISSION_CAN_REGISTER_MAKE, MODULE_COURSES))
		{
			$courses = $this->TeacherCourse->getByCriteria(array('teacherID' => $this->Authenticate->getCurrentUserId()));

			foreach ($courses as $course)
			{
				array_push($this->headerData['coursesOffered'], $course->courseCode);
			}
		}
	}

	private function checkForLogin()
	{
		if (!$this->Authenticate->isLoggedIn())
		{
			if (!$this->Authenticate->loginFromCookies())
			{
				$redirectTo = uri_string();
				$this->session->set_flashdata('redirectTo', $redirectTo);
				redirect('/login', 'refresh');
			}
		}
	}
	
	protected function addLeftSideBarData($data)
	{
		if (is_string($data))
		{
			$this->leftSidebarData['ls_data'] .= $data;
		}
	}
	
	protected function addRightSideBarData($data)
	{
		if (is_string($data))
		{
			$this->rightSidebarData['rs_data'] .= $data;
		}
	}
	
	protected function addMainBodyData($data)
	{
		if (is_string($data))
		{
			$this->mainBodyData['mb_data'] .= $data;
		}
	}

	protected function addJavaScriptSource($src)
	{
		if (is_string($src))
		{
			array_push($this->headerData['javaScriptSrc'], $src);
		}
	}

	protected function addJavaScriptText($js)
	{
		if (is_string($js))
		{
			$this->headerData['javaScriptText'] .= $js;
		}
	}
	
	protected function displayView()
	{
		$this->load->view('header', $this->headerData);
		$this->load->view('left_sidebar', $this->leftSidebarData);
		$this->load->view('main_body', $this->mainBodyData);
		$this->load->view('right_sidebar', $this->rightSidebarData);
		$this->load->view('footer', $this->footerData);
	}
	
	protected function displayAuthenticationError()
	{
		$htmlData = contentBox('Warning', 'You are not allowed to perform this action .... !<br>A warning has been issued to site ADMIN, with your ID.', COLOUR_RED);
		
		$this->addMainBodyData($htmlData);
		
		$this->displayView();
	}
}

?>