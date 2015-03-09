<?php



/**

 * @category		PollManager Controller Class

 * @package		system/application/controllers

 * @author		Salman Iftikhar khan <samspalace@gmail.com>

 * @copyright		2009-2010 SAFE (Icarus - Project)

 * @license		http://www.php.net/license/3_01.txt  PHP License 3.0

 * @version		Release: 1.3

 */



require_once('icaruscontroller.php');

include_once('moduleConstants.inc');



/**	This is the controller class for the Poll table of database. */

class PollManager extends IcarusController

{

	const COURSE_CODE = "CS413";



	public function __construct()

	{

		parent::__construct();

		$this->load->helper('design');

		$this->load->model('Poll');

		$this->load->model('PollOption');

		$this->load->model('PollAnswer');



		$this->load->scaffolding('icarus_pollAns');

		$this->generateSideBar();

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

		$this->showPoll('All');

	}



	public function createPoll()

	{

		$roleId = $this->Authenticate->getCurrentRoleId();

		

		$javaScript = 'var count = 1; ' .

				'function add()' .

				'{' .

				'var e1 = document.getElementById("id1");' .

				'var inBox = document.createElement("input");' .

				'inBox.setAttribute("type", "text");' .

				'inBox.setAttribute("name", "optionText[]");' .

				'var brBox = document.createElement("div");' .

				'var countText = document.createTextNode(count++ + " .) ");' .

				'brBox.appendChild(countText);' .

				'brBox.appendChild(inBox);' .

				'e1.appendChild(brBox);' .

				'}';

					

		$this->addJavaScriptText($javaScript);

		$this->addJavaScriptSource('datetimepicker.js');



		$question = array('name' => 'question', 'value' => '');

			

		$contentBoxMaterial = form_button(array('name' => 'aButton', 'type' => 'button', 'content' => 'Click To Add', 'onClick' => 'add();')) .br(2) .'<span id="id1"></span>';



		$input1 = array(

	              'name'        => 'startTime',

        	      'id'          => 'date1',

	              'value'       => date("Y-m-d h:m:s")

	            );



		$input2 = array(

	              'name'        => 'endTime',

        	      'id'          => 'date2',

	              'value'       => date("Y-m-d h:m:s")

	            );



		$viewHtml = form_open('pollManager/initiatePoll') .

					messageBox('Topic of Poll', form_input($question)) .

					messageBox('Start Date', form_input($input1) . '&nbsp;' . dateTimePickerBox('date1')) .

					messageBox('Expire Date', form_input($input2) . '&nbsp;' . dateTimePickerBox('date2')) .

					form_hidden('approvalStatus', $this->Authorize->isAllowed($roleId, PERMISSION_CAN_APPROVE, MODULE_POLL)) .

					contentBox('Click and Add your Options', $contentBoxMaterial, COLOUR_GREEN) .

					form_submit('submit', 'Initiate Poll') .

					form_close();

						

		$this->addMainBodyData($viewHtml);

		$this->displayView();

	}

	

	public function initiatePoll()

	{

		$tomorrow = mktime(0,0,0,date("m"),date("d")-1,date("Y"));

		$allowdate = date("Y-m-d", $tomorrow);

		

		$question = $this->input->post('question', true);

		$stime = $this->input->post('startTime', true);         //stime is for start time

		$ftime = $this->input->post('endTime', true);           //ftime is for finish time when poll becomes expire

        

		if (($question != "") && ($stime >= $allowdate) && ($stime < $ftime) && ($stime != "") && ($ftime != ""))

		{

			$inputdata = array(

				'courseCode' => self::COURSE_CODE,

				'initiator' => $this->Authenticate->getCurrentUserId(),

				'question' => $question,

				'startTime' => $stime,

				'endTime' => $ftime,

				'approvalStatus' => $this->input->post('approvalStatus', true)

				);

			

			$id = $this->Poll->insert($inputdata);

			//the subject of the poll has been inserted and it will return its id



			if ($id != null)          //if record is inserted , it has its id else not //Check to for Bool value

			{

				$data = array(

					'pollID' => $id,

					'optionText' => $this->input->post('optionText', true)

					);

					

				if ($data['optionText'] != null)

				{

					foreach ($data['optionText'] as $index => $value)

					{

						$data = array('pollID' =>$data['pollID'], 'optionID' => $index+1, 'optionText' => $value);

						if ($value != null)

						{

							$result = $this->PollOption->insert($data);

						}

					}

					redirect('pollManager');

				}

				else

				{

					$data = array('pollId' => $id);

					$this->Poll->delete($data);

					redirect('pollManager/createPoll');

				}

			}

			else

			{

				redirect('pollManager/createPoll');

			}

		}

		else

		{

			redirect('pollManager/createPoll');

		}

	}



	public function approve()

	{

		$id = $this->uri->segment(3);

		if ($id != "")

		{

			$data = array('pollId' => $id, 'approvalStatus' => true);

			$result = $this->Poll->update($data);



			if ($result > 0)

			{

				redirect('pollManager');

			}

		}

		else

		{

			redirect('pollManager');

		}

	}

	

	public function disApprove()

	{

		$id = $this->uri->segment(3);



		if ($id != null)

		{			

			$data = array( 'pollID' => $id);

			$result = $this->PollOption->delete($data);

            

			if($result >= 1)

			{

				$data = array('pollId' => $id);

				$result = $this->Poll->delete($data);



				if ($result > 0)

				{

					redirect('pollManager');

				}

			}

		}

		else

		{

			redirect('pollManager');

		}

	}

	

	public function showPoll($criteria = 'ALL')

	{

		$id = $this->Authenticate->getCurrentUserId();

		$roleId = $this->Authenticate->getCurrentRoleId();

		$canView = $this->Authorize->isAllowed($roleId, PERMISSION_CAN_VIEW, MODULE_POLL);

		$canApprove = $this->Authorize->isAllowed($roleId, PERMISSION_CAN_APPROVE, MODULE_POLL);

		/*$currentlyAnswered = $this->PollAnswer->getAllSolvedPolls($id);

		

		$alreadyAnswered = '';

		

		foreach ($currentlyAnswered as $answered)

		{

			$alreadyAnswered .= $answered->pollID . ', ';

		}

		

		$alreadyAnswered = substr($alreadyAnswered, 0, -2);

		

		$resultquery = $this->PollAnswer->getAll();*/

		

		$viewText = '';

		

		if (strtolower($criteria) == 'all')

		{

			if ($canApprove)

			{

				$allPolls = $this->Poll->getAll(); 

			}

			else

			{

				$allPolls = $this->Poll->getByCriteria(array('approvalStatus' => 'True')); 

			}

			

			if (count($allPolls))

			{

				foreach ($allPolls as $poll)

				{

					$answered = $this->PollAnswer->isAnswered($poll->pollID, $id);

					

					if ((bool)$poll->approvalStatus)

					{

						if (!$answered) 

						{

							$viewText .= "Topic : ".$poll->question."<br>

							Give Rate ".anchor('pollManager/showOption/'.$poll->pollID,'Click here')."<br>

							Status : Active<br><br><br>";

						}

						else 

						{

							$viewText .= "Topic : ".$poll->question."<br>

							Show Rating : ".anchor('pollManager/showRate/'.$poll->pollID,'Click here')."<br>

							Status : Active<br><br><br>";

						}

					}

					else if ($canApprove)

					{

						$viewText .= "Topic : ".$poll->question."<br>

						Approval : ".anchor('pollManager/approve/'.$poll->pollID,'Approve ')." / "

						.anchor('pollManager/disApprove/'.$poll->pollID,'Disapprove')."<br>

						Status : Pending for approval<br><br><br>";

					}

					else

					{

						$viewText .= "Topic : ".$poll->question."<br>

						Status : Pending for Approval<br><br>";

					}

  				}

			}

			else

			{

				$viewText .= "Start the Application by Creating the New Poll";

			}

		}

		else

		{

			$viewText = "Under Working";

		}

		$viewHtml =  $viewText;

		$this->addMainBodyData(titleBox($viewHtml));



		$this->displayView();

	}



	public function showOption()

	{

		$columnNames = "optionID,optionText";

		$criteria = array('pollID' => $this->uri->segment(3));

        	

		$query = $this->PollOption->getByCriteria($criteria,null,null,$columnNames);

		

		$columnNames = "question";

		$criteria = array('pollID' => $this->uri->segment(3));

        	

		$pollquery = $this->Poll->getByCriteria($criteria,null,null,$columnNames);

		

		$viewHtml = form_open('pollManager/saveChoice');

		$this->addMainBodyData($viewHtml);

		

		foreach($pollquery as $col)

		{			

			$view = $col->question."<br>";

			$this->addMainBodyData($view);

			

			foreach ($query as $row)

			{

				$viewHtml = form_radio('option', $row->optionID)." ".$row->optionText."<br>";

				$this->addMainBodyData($viewHtml);

			}

		}	

		$viewHtml = form_hidden('pollID',$this->uri->segment(3)).

		form_submit('submit', 'Save your Choice') .

		form_close();

		

		$this->addMainBodyData($viewHtml);

		$this->displayView();

	}



	public function saveChoice()

	{

		$id = $this->input->post('pollID', true);

		$option = $this->input->post('option', true);

		if($option >= 1)

		{

			$inputData = array(

				'pollID' => $id,

				'optionID' => $this->input->post('option', true),

				'userId' => $this->Authenticate->getCurrentUserId(),

				'dateTime' => date("Y-m-d h:m:s"),

				);

            

			$result = $this->PollAnswer->insert($inputData);

            

			if ($result >= 0)

			{

				redirect('pollManager/showRate/'.$id);

			}

			else

			{

				redirect('pollManager/showPoll');

			}

		}

		else

		{

			redirect('pollManager/showPoll');

		}

	}



	public function showRate()

	{	

		$columnNames = "question";

		$criteria = array('pollID' => $this->uri->segment(3));

        	

		$pollquery = $this->Poll->getByCriteria($criteria,null,null,$columnNames);

		if ($pollquery)

		{

			foreach($pollquery as $col)

			{

				$view = $col->question."<br>";

			}

			

			$this->addMainBodyData(mainBodySingleColumnBox('Current Poll Rating', '<br><font size = 4>'.$view, 

				'</font>', true, COLOUR_GREEN, COLOUR_YELLOW, COLOUR_RED, COLOUR_WHITE));

			

			$this->addJavaScriptSource('progressBar.js');

			$this->addCSSSource('progressBar.css');

			

			$this->addMainBodyData(titleBox('<script type="text/javascript">drawProgressBar(\'#00ff00\', 300, 90);</script>'));

			$this->addMainBodyData(titleBox('<script type="text/javascript">drawProgressBar(\'#ffff00\', 300, 90);</script>'));

			$this->addMainBodyData(titleBox('<script type="text/javascript">drawProgressBar(\'#ff3333\', 300, 90);</script>'));

			

			$this->displayView();

		}

		else

		{

			$this->displayView();

		}

	}

}



/* End of file .php */

/* Location: ./system/application/controllers/welcome.php */