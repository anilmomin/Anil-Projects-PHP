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
class DiscussionManager extends IcarusController
{
	private $courseCode;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('design');
		$this->load->model('discuss');
		$this->load->model('Post');
		$this->load->model('Reply');
		$this->load->model('user');

		$this->load->scaffolding('icarus_reply');
		$this->generateSideBar();
		$this->courseCode = $this->SelectedCourse();
	}
 
	private function generateSideBar()
	{		
		$subMenu = array(
				array('title' => 'Add New Post', 'link' => site_url('discussionManager/newPost'), 'hasSubItems' => false),
				array('title' => 'All Post', 'link' => site_url('discussionManager/getTopics'))
				);
		
		$sideMenu = array(
					array('title' => 'Discussion', 'link' => site_url('discussionManager/'), 'hasSubItems' => true, 'subMenus' => $subMenu),
					array('title' => 'Go Back to Home Page', 'link' => site_url('home/index'), 'hasSubItems' => false),
				);
		$this->addLeftSideBarData(sideBarMenuWithSubMenus("Main Menu", $sideMenu));
	}

	public function index()
	{
		$this->getTopics();
	}

	public function newPost()
	{
		$title = array('name' => 'title', 'value' => '', 'size' => '50');
		$body = array('name' => 'body', 'value' => '', 'cols' => '38', 'rows' =>'10');
		
		$contentBoxMaterial = "<table>
								<tr><td><font size = '3' face = 'Time New Roman'>Title</font></td>
								<td>".form_input($title)."</td></tr>
								<tr><td><font size = '3' face = 'Time New Roman'>Body</font></td>
								<td>".form_textarea($body)."</td></tr></table>
								<center><table><tr><td>".form_submit('submit', 'Add Post')."</td>
								<td>".form_reset('reset', 'Reset All')."</td></tr>
								</table></center>".br(1);
			
		$viewHtml = form_open('discussionManager/addNewPost') .
					contentBox('Create a New Post', $contentBoxMaterial, COLOUR_BLUE) .
					form_close();

		$this->addMainBodyData($viewHtml);
		$this->displayView();
	}

	public function addNewPost()
	{
		$columnNames = "discussId";
		$criteria = array('courseCode' => $this->courseCode);
        $query = $this->discuss->getByCriteria($criteria,null,null,$columnNames);
		
		foreach($query as $result)
		{
			$id = $result->discussId;
		}
		
		$title = $this->input->post('title', true);
		$body = $this->input->post('body', true);
		
		if (($title != "") && ($body != ""))
		{
			$inputdata = array(
				'title' => $title,
				'body' => $body,
				'dateTime' => date("Y-m-d"),
				'memberId' => $this->Authenticate->getCurrentUserId(),
				'discussId' => $id
				);
			$id = $this->Post->insert($inputdata);

			if ($id)          //if record is inserted , it has its id else not //Check to for Bool value
			{
				redirect('discussionManager/index');
			}
			else
			{
				redirect('discussionManager/index');
			}
		}
		else
		{
			redirect('discussionManager/newPost');
		}
	}

	public function getTopics()
	{
		$columnNames = "discussId,name";
		$criteria = array('courseCode' => $this->courseCode);
        $query = $this->discuss->getByCriteria($criteria,null,null,$columnNames);
		
		foreach($query as $query)
		{
			$name = $query->name;
			$Id= $query->discussId;
		}
		$subjectTopic = $name;
		$this->addMainBodyData($subjectTopic);
		
		$columnNames = '*';
		$criteria = array('discussId' => $Id);
        $allPost = $this->Post->getByCriteria($criteria,null,null,$columnNames);
        
        if ($allPost)
		{
			foreach($allPost as $query)
			{
				$contentBoxMaterial .= "<h3>".$query->title."</h3>
								<p>".$query->body."</p>
								<b>".anchor('discussionManager/comment/'.$query->postId,'Comment')."</b><hr>".br(1);
				
				contentBox('Create a New Post', $contentBoxMaterial, COLOUR_RED);
			}
		}
		else
		{
			$contentBoxMaterial = "<h2>".$subjectTopic."</h2>".br(1);
			contentBox('No post exist', $contentBoxMaterial, COLOUR_RED);
		}
		
		$viewHtml =  $contentBoxMaterial;
		$this->addMainBodyData(titleBox($viewHtml));

		$this->displayView();
	}

	public function comment()
	{
		$discussId = $this->uri->segment(3);
		$columnNames = '*';
		$criteria = array('postId' => $discussId);
        $allReply = $this->Reply->getByCriteria($criteria,null,null,$columnNames);
               
        if ($allReply)
		{
			foreach($allReply as $query)
			{
				$columnNames = "name";
				$criteria = array('memberId' => $query->memberId);
        		$uname = $this->User->getByCriteria($criteria,null,null,$columnNames);
        		foreach($uname as $query1)
				{
					$username = $query1->name;
				}
				$contentBoxMaterial .= "<h3>".$query->text."</h3>
								<p>".$username."</p>".br(1);
				
				contentBox('Create a New Post', $contentBoxMaterial, COLOUR_RED);
			}
		}
		
		$viewHtml =  $contentBoxMaterial;
		$this->addMainBodyData(titleBox($viewHtml));


		$columnNames = "name";
		$criteria = array('memberId' => $this->Authenticate->getCurrentUserId());
        $uname = $this->User->getByCriteria($criteria,null,null,$columnNames);
        
        foreach($uname as $query)
		{
			$username = $query->name;
		}
		
		
		$title = array('name' => 'title', 'value' => '', 'size' => '50');
		$body = array('name' => 'text', 'value' => '', 'cols' => '43', 'rows' =>'6');
		
		$viewHtmll  = anchor('discussionManager','Back to Blog');
		$this->addMainBodyData($viewHtmll);
		
		$contentBoxMaterial = "<table>
								<tr><td> Comment<br>".form_textarea($body)."</td></tr>
								<tr><td><font size = '3' face = 'Time New Roman'> Name : ".$username."</font></td></tr>
								<tr><td>".form_hidden('postId',$discussId)."</td></tr>
								</table>
								<table><tr><td>".form_submit('submit', 'Submit Comment')."</td>
								<td>".form_reset('reset', 'Reset All')."</td></tr>
								</table>".br(1);
			
		$viewHtml = form_open('discussionManager/addComment') .
					contentBox('Post the Comment', $contentBoxMaterial, COLOUR_GREEN) .
					form_close();

		$this->addMainBodyData($viewHtml);
		$this->displayView();
	}

	public function addComment()
	{
		$comment = $this->input->post('text', true);
		$pid = $this->input->post('postId', true);
		
		if($comment)
		{
			if($pid != null)
			{
				$inputData = array(
				'text' => $comment,
				'dateTime' => date("Y-m-d h:m:s"),
				'memberId' => $this->Authenticate->getCurrentUserId(),
				'postId' => $pid
				);
				
				$result = $this->Reply->insert($inputData);
				if ($result)
				{
					redirect('discussionManager/comment/'.$pid);
				}
				else
				{
					redirect('discussionManager/comment/'.$pid);
				}
			}
			else
			{
				redirect('discussionManager/');
			}
		}
		else
		{
			redirect('discussionManager/comment/');
		}
	}
}

/* End of file .php */
/* Location: ./system/application/controllers/redirect('discussionManager.php */
?>