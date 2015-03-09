<?php

/**
 * @category			Student Lecture Controller Class
 * @package			system/application/controllers
 * @author			Murtaza Munawar Fazal <mmf1988@hotmail.com>
 * @copyright			2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 1.0
 */

/**	This is the controller class for the Lecture table of database. */

require_once('icaruscontroller.php');
require_once('moduleConstants.inc');

class Student_Lecture_Con extends IcarusController
{
	function index()
	{
		
		//$this->ShowView();
		
		$CourseCode = $this->selectedCourse();
		$studentID = $this->Authenticate->getCurrentUserID();


		$this->load->model("registration",'Registration_Model');
		$sections = array();

		$temp_sections = $this->Registration_Model->getByCriteria('courseCode = \'' . $CourseCode . '\' AND studentID =' . $studentID, null, null,'section');

		$section = $temp_sections[0]->section;
				
		$this->load->model("Lecture_Model",'',TRUE);		
		$result = $this->Lecture_Model->getByCriteria('isTaken = 1 AND courseCode =\'' . $CourseCode . '\' AND section =\'' . $section . '\'',null,null);
		$data['result'] = $result;
		$this->load->view("student_lecture_view",$data);
	}

	/**
	  * This will display the ViewPage , where the student will be able to download all the previous lectures which have been uploaded for his section
	  * Function will return error msg if it could not upload the file or could not insert into database
	  *
	  * @method	ShowView
	  *
	  * @param	SESSION					CourseCode
	  *							studentID
	  *
	  */

	function ShowView($msg = null)
	{
		$CourseCode = $this->getSelectedCourse();
		$studentID = $this->Authenticate->getCurrentUserId();


		$this->load->model("Registration_Model",'',TRUE);
		$sections = array();

		$temp_sections = $this->Registration_Model->getByCriteria('courseCode = \'' . $CourseCode . '\' AND studentID =' . $studentID, null, null,'section');

		$section = $temp_sections[0]->section;
				
		$this->load->model("Lecture_Model",'',TRUE);		
		$result = $this->Lecture_Model->getByCriteria('isTaken = 1 AND courseCode =\'' . $CourseCode . '\' AND section =\'' . $section . '\'',null,null);
		$data['result'] = $result;
		if ($msg != null)
			$data['msg'] = $msg;

		if ( isset($msg) ) echo $msg;
			$this->load->helper('form');

		$viewHtml = '';
				
		foreach ($result as $row)
		{
			$viewHtml .= "<li>" . "Title = " . $row->title ."</li>";
			$viewHtml .= "<ul>" . "LectureID = " .$row->lectureId . "</ul>";
			$viewHtml .= "<ul>" . "Description = " .$row->description . "</ul>";
			$viewHtml .= "<ul>" . "Lecture Date = " .$row->lectureDate . "</ul>";
			$viewHtml .= "<ul>" . "startTime = " .$row->startTime . "</ul>";
			$viewHtml .= "<ul>" . "endTime = " .$row->endTime . "</ul>";
	
			$viewHtml .= "<ul>" ."<a href = 'DownloadAssignment/$row->courseCode/$row->lectureId'  > Download </a></ul>";				
		}

		$this->addMainBodyData($viewHtml);
		$this->displayView();


//		$this->load->view("student_lecture_view",$data);
	}

	/**
	  * This function enables the student to download the lecture file from the server
	  * Function will return error msg if it could not upload the file or could not insert into database
	  *
	  * @method	DownloadAssignment
	  *
	  * @param	GET					CourseCode
	  *							lectureNo
	  *
	  */

	function DownloadAssignment()
	{

		$this->load->helper('url');
		$this->load->helper('download');
		
		$url = explode("/",uri_string());

		$courseCode = $url[3];
		$lectureNo = $url[4];
		
		$path = './' . $courseCode . '/lectures/Lecture' . $lectureNo. '/Lecture' .$lectureNo . '.zip';
		if(file_exists($path))
		{
			$data = file_get_contents($path); // Read the file's contents
			$name = 'LectureNo' . $lectureNo. '.zip';
			@force_download($name, $data);
		}
		else
		{
			$msg = "file not found";			
			$this->ShowView($msg);			

		}
	}

}

?>