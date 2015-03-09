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
class QuizController extends IcarusController
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('design');
		$this->load->model('Quiz');
		$this->load->model('QuizQsOptions');
		$this->load->model('QuizQs');
		$this->load->library('pagination');
	}
	
	private function eliminateQuestionNumbers($array)
	{
		$keysStr = "";
	
		$keys = array_keys($array);
	
		foreach ($keys as $value)
		{
			$keysStr .= $value . "\n";
		}
	
		$regEx = "/QuestionNumber([\d])*\n/i";
		preg_match_all($regEx, $keysStr, $matches);
		return @$matches[1];
	}

	private function getOptionsWithCorrectAnswers($array, $questionNumbers)
	{
		$result = array();
		$cnt = 1;
		
		foreach ($questionNumbers as $question)
		{
			$options = $array['QuestionNumber' . $question];
			$corrOptions = @$array['QuestionNumber' . $question . 'CorOps'];
			
			$result[$cnt]['options'] = $options;
			$result[$cnt]['text'] = $array['QuestionNumber' . $question . 'Text'];
			$result[$cnt]['correctOptions'] = array();
			
			if (!empty($corrOptions))
			{
				foreach ($corrOptions as $corrOp)
				{
					array_push($result[$cnt]['correctOptions'], array_search($corrOp, $options));
				}
			}
					
			$cnt++;
		}
	
		return $result;
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
	
	public function index()
	{
		/*$object = array(
			'dateTime' => '2008-02-02 00:00:00',
			'courseCode' => 'ABC123'
			);*/
		echo $this->Quiz->insert($object);
	}

	public function createQuiz()
	{
		$roleId = $this->Authenticate->getCurrentRoleId();
		
		if ($this->Authorize->isAllowed($roleId, PERMISSION_CAN_CREATE, MODULE_QUIZ))
		{
			$this->addJavaScriptSource('quizJs.js');
			$this->addJavaScriptSource('datetimepicker.js');

			$addQuestionButton = array('type' => 'button', 'content' => 'Add Another Question', 'onclick' => 'addQuestion(\'Quiz\');');
			
			$dateBox = array('name' => 'dateTime', 'id' => 'date1', 'value' => '');
			$duration = array('name' => 'duration', 'value' => '20', 'size' => '2');

			$viewHtml = form_open('QuizController/finalizeCreateQuiz') .
						form_button($addQuestionButton) .
						contentBox('Quiz', '<div id="Quiz"></div>' . br() . 'Quiz Time : ' . form_input($dateBox) . '&nbsp;' . dateTimePickerBox('date1') . br() . 'Duration (In Minutes) : ' . form_input($duration) , COLOUR_BLUE) .
						br(1) .
						form_submit('submit', 'Create Quiz') .
						form_close();
						
			$this->addMainBodyData($viewHtml);
			$this->displayView();
		}
		else
		{
			$this->displayAuthenticationError();
		}
	}
	
	public function finalizeCreateQuiz()
	{
		$roleId = $this->Authenticate->getCurrentRoleId();
		
		if ($this->Authorize->isAllowed($roleId, PERMISSION_CAN_CREATE, MODULE_QUIZ))
		{	
			$quiz = $this->getOptionsWithCorrectAnswers($_POST, $this->eliminateQuestionNumbers($_POST));
			$dateTime = $this->input->post('dateTime', true);
			$duration = $this->input->post('duration', true);
			
			if (!empty($quiz))
			{
				$object = array(
						'dateTime' => $dateTime,
						'courseCode' => 'CC123',
						'duration' => $duration
						);

				$quizId = $this->Quiz->insert($object);
				
				foreach ($quiz as $questionNumber => $question)
				{
					foreach ($question['options'] as $opNum => $option)
					{
						$object = array(
								'quizId' => $quizId,
								'quesId' => $questionNumber,
								'qsOptionNo' => $opNum,
								'text' => $option
								);
						
						$this->QuizQsOptions->insert($object);
					}
					
					if ($question['correctOptions'])
					{
						foreach ($question['correctOptions'] as $option)
						{
							$object = array(
								'quesId' => $questionNumber,
								'text' => $question['text'],
								'quizId' => $quizId,
								'corrOptionNo' => $option
								);
							
							$this->QuizQs->insert($object);
						}
					}
				}
				
				$viewHtml = contentBox('Success', 'Quiz created successfully and will start at your given time.', COLOUR_GREEN);
						
				$this->addMainBodyData($viewHtml);
				$this->displayView();
			}
			else
			{
				$viewHtml = contentBox('Failure', 'Quiz was not created successfully, please try again later.', COLOUR_RED);
						
				$this->addMainBodyData($viewHtml);
				$this->displayView();
			}
		}
		else
		{
			$this->displayAuthenticationError();
		}
	}
	
	public function showQuizes()
	{
		// have to do paging work
		$countQuizes = $this->Quiz->countAll();
		$config['base_url'] = site_url('QuizController/showQuizes');
		$config['total_rows'] = $countQuizes;
		$config['per_page'] = 1;
		$config['uri_segment'] = 3;
		
		$startLimit = ($this->uri->segment(3) * $config['per_page'] != 0) ? $this->uri->segment(3) * $config['per_page'] : 1;
		$endLimit = $config['per_page'];
		echo "Start : " . $startLimit . "<br>";
		echo "End : " . $endLimit . "<br>";
		$display = $this->Quiz->getAll('*', $startLimit, $endLimit);
		
		print_r($display);
		
		$this->pagination->initialize($config);
		echo $this->pagination->create_links();
		
				//
//		$viewHtml = anchor('QuizController/deleteQuiz/Id', ' X ', array('onclick' => 'return confirmDelete();'));
	}
	
	public function deleteQuiz($quizId)
	{
		
	}
}



/* End of file .php */

/* Location: ./system/application/controllers/welcome.php */