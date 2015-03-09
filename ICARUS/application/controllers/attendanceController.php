<?php

/**
 * @category	PollManager Controller Class
 * @package		system/application/controllers
 * @author		Salman Iftikhar khan <samspalace@gmail.com>
 * @copyright	2009-2010 SAFE (Icarus - Project)
 * @license		http://www.php.net/license/3_01.txt  PHP License 3.0
 * @version		Release: 1.3
 */

require_once('icaruscontroller.php');
include_once('moduleConstants.inc');

/**	This is the controller class for the Poll table of database. */
class AttendanceController extends IcarusController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('design');
	}
	
	private function generateSideBar()
	{
		$showPollSubItems = array(
				array('title' => 'Current Month', 'link' => site_url('pollManager/showPoll/CMonth')),
				array('title' => 'All', 'link' => site_url('pollManager/showPoll/All'))
				);
		
		$sideMenu = array(
				array('title' => 'Dashboard', 'link' => site_url('pollManager'), 'hasSubItems' => false),
				array('title' => 'Create Poll', 'link' => site_url('pollManager/createPoll'), 'hasSubItems' => false),
				array('title' => 'Show Polls', 'hasSubItems' => true, 'subMenus' => $showPollSubItems)
				);
		
		$this->addLeftSideBarData(sideBarMenuWithSubMenus("Poll Menu", $sideMenu));
		$this->addMainBodyData(messageBox('Welcome to ICARUS Polling', ''));
	}
	
	private function getAllStudents()
	{
		return array(
				'val0' => 'sea zero',
				'val1' => 'sea one',
				'val2' => 'sea two',
				'val3' => 'sea three',
				'val4' => 'sea four',
				'val5' => 'sea five',
				'val6' => 'sea six',
				'val7' => 'sea seven',
				'val8' => 'sea eight',
				'val9' => 'sea nine',
				'val10' => 'sea ten'
				);
	}
	
	public function index()
	{
		$this->addJavaScriptSource('attendanceJs.js');
		$this->addCSSSource('attendanceCss.css');
		
		$listPresentProperties = array(
									'name' => 'presents[]',
									'size' => '10',
									'id' => 'presentList',
									'class' => 'list'
									);
		
		$listPresentOptions = $this->getAllStudents();
		
		$listLateProperties = array(
									'name' => 'lates[]',
									'size' => '10',
									'id' => 'lateList',
									'class' => 'list'
									);
									
		$listAbsentProperties = array(
									'name' => 'absents[]',
									'size' => '10',
									'id' => 'absentList',
									'class' => 'list'
									);
									
		$presentDiv = form_input(array('type' => 'text', 'name' => 'ib', 'value' => '', 'id' => 'presentListAdd')) .
					form_input(array('type' => 'button', 'name' => 'markPresentButton', 'value' => 'Mark Present', 'onclick' => 'mark(\'presentListAdd\', \'presentList\', \'presentList,absentList,lateList\');')) .
					br(2) .
					form_multipleSelect($listPresentProperties, $listPresentOptions) . 
					br(2).
					form_input(array('type' => 'button', 'name' => 'populateList', 'value' => 'Late', 'onclick' => 'moveSelected(\'presentList\', \'lateList\');')) .
					form_input(array('type' => 'button', 'name' => 'populateList', 'value' => 'Absent', 'onclick' => 'moveSelected(\'presentList\', \'absentList\');'));
					
		$lateDiv = form_input(array('type' => 'text', 'name' => 'ib', 'value' => '', 'id' => 'lateListAdd')) .
					form_input(array('type' => 'button', 'name' => 'markLateButton', 'value' => 'Mark Late', 'onclick' => 'mark(\'lateListAdd\', \'lateList\', \'presentList,absentList,lateList\');')) .
					br(2) .
					form_multipleSelect($listLateProperties, array()) . 
					br(2).
					form_input(array('type' => 'button', 'name' => 'populateList', 'value' => 'Present', 'onclick' => 'moveSelected(\'lateList\', \'presentList\');'));
					
		$absentDiv = form_input(array('type' => 'text', 'name' => 'ib', 'value' => '', 'id' => 'absentListAdd')) .
					form_input(array('type' => 'button', 'name' => 'markAbsentButton', 'value' => 'Mark Absent', 'onclick' => 'mark(\'absentListAdd\', \'absentList\', \'presentList,absentList,lateList\');')) .
					br(2) .
					form_multipleSelect($listAbsentProperties, array()) . 
					br(2) .
					form_input(array('type' => 'button', 'name' => 'populateList', 'value' => 'Present', 'onclick' => 'moveSelected(\'absentList\', \'presentList\');'));
		
		
		
		/* main body html starts here */
		$viewHtml = form_open('attendancecontroller/takeAttendance') .
					'<div id="attendance">' .
					contentBox('Presents :', $presentDiv, COLOUR_GREEN) .
					br(2) .
					contentBox('Lates :', $lateDiv, COLOUR_NICE_BLUE) .
					br(2) .
					contentBox('Absents', $absentDiv, COLOUR_RED) .
					'</div>' .
					br() .
					form_submit(array('name' => 'submit', 'value' => 'Take Attendance', 'onclick' => 'selectAllItemsOfList(\'absentList,presentList,lateList\');')) .
					form_close();
					
					$this->addMainBodyData($viewHtml);
					$this->displayView();
	}
	
	public function takeAttendance()
	{
		print_r($_POST);
	}
	
	
}

?>