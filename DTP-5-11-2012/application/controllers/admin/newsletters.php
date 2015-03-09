<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Dashboard
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('admincontroller.php');

class Newsletters extends AdminController 
{

	private $jsString = '';
	private $data = array();

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('tank_auth','form_validation'));
		
		$this->load->Model(array('admin/Newsletter', 'tank_auth/users'));

		$this->addCSSSource('humanity/jquery-ui-1.8.16.custom.css');

		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
		
		
	}
	
	
	/**
	 * Add News to database
	 */
	public function addnewsletter()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		else
		{
			if($this->input->post('saveemail'))
			{
				$this->form_validation->set_rules('newsletterhead', 'Heading', 'trim|required|xss_clean');
				$this->form_validation->set_rules('newsletter', 'Newsletter', 'trim|required|xss_clean');
				$statusBit = 0; //status bit legend
								// 0 means save
								// 1 means save & emailed
								
				// Sends newsletters email to the customers and save status in database
				if($this->input->post('saveemail'))
				{
					$statusBit = 1;
					$users = array();
					$emailList = '';
					
					$this->db->where('is_admin', '0');
					$query = $this->db->get('users');
					
					if ($query->num_rows() > 0) 
						 $users = $query->result();
					
					foreach ($users as $user)
						 $emailList .= $user->email . ',';
					
					$data['heading'] = $this->input->post('newsletterhead');
					$data['newsletter'] = $this->input->post('newsletter');
					$data['created_date'] = date('Y-m-d H:i:s');
					$data['site_name'] = $this->config->item('website_name', 'tank_auth');
					
					$this->load->library('email');
					$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
					$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
					$this->email->to($emailList);
					$this->email->subject(sprintf($this->lang->line('ditchthepitch_subject_newsletter'), $this->config->item('website_name', 'tank_auth')));
					$this->email->message($this->load->view('admin/email/newsletter-html', $data, TRUE));
					$this->email->set_alt_message($this->load->view('admin/email/newsletter-txt', $data, TRUE));
					$this->email->send();
					
				}				
								
				if ($this->form_validation->run() == FALSE)
				{
					$this->data['mb_data'] = $this->load->view('admin/addnewsletter', null, true);
					$this->addMainBodyData($this->data['mb_data']);
					$this->displayView();
	
				}
				else
				{
					$insertObj = array(
							'created_date' => date('Y-m-d H:i:s'),
							'updated_date' => date('Y-m-d H:i:s'),
							'newsltrtext' => $this->input->post('newsletter'),
							'heading' => $this->input->post('newsletterhead'),
							'status' => $statusBit 
					);
	
					if($this->Newsletter->insert($insertObj) && $statusBit)
					{
						$this->session->set_flashdata('message', "Newsletter has been added successfully.");
						redirect(current_url());
					}
					elseif ($this->Newsletter->insert($insertObj) && $statusBit)
					{
						$this->session->set_flashdata('message', "Newsletter have been added & emailed successfully.");
						redirect(current_url());
					}
					else
					{
						$this->session->set_flashdata('errormsg', "Fail to add Newsletter! Try again.");
						redirect(current_url());
					}
				}
			}
			else
			{
				$this->data['mb_data'] = $this->load->view('admin/addnewsletter', null, true);
				$this->addMainBodyData($this->data['mb_data']);
				$this->displayView();
			}
		}
	}
	
	/**
	 * Edit user details by admin
	 *
	 * @return void
	 */
	function editnewsletterbyadmin($newsletterId = 1)
	{
	
		$this->load->Model('admin/Newsletter');
	
		if (!$this->tank_auth->is_admin_login()) // logged in
			redirect('/');
	else
		{
			if($this->input->post('saveemail'))
			{
				$this->form_validation->set_rules('newsletterhead', 'Heading', 'trim|required|xss_clean');
				$this->form_validation->set_rules('newsletter', 'Newsletter', 'trim|required|xss_clean');
				$statusBit = 0; //status bit legend
								// 0 means save
								// 1 means save & emailed
								
				// Sends newsletters email to the customers and save status in database
				if($this->input->post('saveemail'))
				{
					$statusBit = 1;
					$users = array();
					$emailList = '';
					
					$this->db->where('is_admin', '0');
					$query = $this->db->get('users');
					
					if ($query->num_rows() > 0) 
						 $users = $query->result();
					
					foreach ($users as $user)
						 $emailList .= $user->email . ',';
					
					$data['heading'] = $this->input->post('newsletterhead');
					$data['newsletter'] = $this->input->post('newsletter');
					$data['created_date'] = date('Y-m-d H:i:s');
					$data['site_name'] = $this->config->item('website_name', 'tank_auth');
					
					$this->load->library('email');
					$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
					$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
					$this->email->to($emailList);
					$this->email->subject(sprintf($this->lang->line('ditchthepitch_subject_newsletter'), $this->config->item('website_name', 'tank_auth')));
					$this->email->message($this->load->view('admin/email/newsletter-html', $data, TRUE));
					$this->email->set_alt_message($this->load->view('admin/email/newsletter-txt', $data, TRUE));
					$this->email->send();
					
				}				
								
				if ($this->form_validation->run() == FALSE)
				{
					$this->data['mb_data'] = $this->load->view('admin/addnewsletter', null, true);
					$this->addMainBodyData($this->data['mb_data']);
					$this->displayView();
	
				}
				else
				{
					$updateObj = array(
							'created_date' => date('Y-m-d H:i:s'),
							'updated_date' => date('Y-m-d H:i:s'),
							'newsltrtext' => $this->input->post('newsletter'),
							'heading' => $this->input->post('newsletterhead'),
							'status' => $statusBit 
					);
	
					if($this->Newsletter->update($updateObj) && $statusBit)
					{
						$this->session->set_flashdata('message', "Newsletter has been added successfully.");
						redirect(current_url());
					}
					elseif ($this->Newsletter->insert($insertObj) && $statusBit)
					{
						$this->session->set_flashdata('message', "Newsletter have been added & emailed successfully.");
						redirect(current_url());
					}
					else
					{
						$this->session->set_flashdata('errormsg', "Fail to add Newsletter! Try again.");
						redirect(current_url());
					}
				}
			}
			else
			{
				$this->data['mb_data'] = $this->load->view('admin/addnewsletter', null, true);
				$this->addMainBodyData($this->data['mb_data']);
				$this->displayView();
			}
		}
	}
	
	
	/**
	 * Show News in Grid
	 */
	public function shownewsletter()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
	
		$this->addCSSSource('ui.jqgrid.css');
		//$this->addCSSSource('ui.multiselect.css');
	
		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
		$this->addJavaScriptSource('jqgrid/js/i18n/grid.locale-en.js');
		$this->addJavaScriptSource('jqgrid/js/jquery.jqGrid.min.js');
	
		$this->data['mb_data'] = $this->load->view('admin/shownewsletter', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}
	
	/**
	 * Get the News
	 */
	
	public function getNewsletters()
	{
	
		if (!$this->tank_auth->is_admin_login())
		{
			redirect('/admin/auth/login');
		}
	
	
		$req_param = array (
				"sort_by" => $this->input->post( "created_date", TRUE ),
				"sort_direction" => $this->input->post( "sord", TRUE ),
				"page" => $this->input->post( "page", TRUE ),
				"num_rows" => $this->input->post( "rows", TRUE ),
				"search" => $this->input->post( "_search", TRUE ),
				"search_field" => $this->input->post( "searchField", TRUE ),
				"search_operator" => $this->input->post( "searchOper", TRUE ),
				"search_str" => $this->input->post( "searchString", TRUE ),
		);
	
		$data->page = $this->input->post( "page", TRUE );
		$data->records = $this->Newsletter->countAll();
		$data->total = ceil($data->records / 10);
		$records = $this->Newsletter->getNewsletters($req_param);
		$data->rows = $records;
		echo json_encode ($data);
		exit( 0 );
	
	}
	
	public function actions()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
	
		$oper = $this->input->post('oper');
		if($oper == 'del')
			$this->_delnews();
		else
			$this->_editnews();
	}
	
	/**
	 * Edit News
	 */
	private function _editnewsletter()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
	
		$updateObj = array (
				'heading' => $this->input->post('newletterhead'),
				'newsltrtext' => $this->input->post('newsletter'),
				'updated_date' => date('Y-m-d H:i:s'),
				'newsletterId' => $this->input->post('id'),
				'status' => 0
		);
	
		if($this->Newsletter->update($updateObj))
			return true;
		else
			return false;
	}
	
	
	/**
	 * Delete News from Database
	 */
	private function _delnews()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
	
		$pk = array('newsletterId' => $this->input->post('id'));
		$this->Newsletter->delete($pk);
	}
	
	function sendnewsletter(){
		$this->load->Model(array('WineDeals','UserRegistration' ,'admin/Schedule', 'admin/Profiles', 'WineFeedback'));
 $this->config->item('webmaster_email', 'tank_auth');
				$config = Array(
    'protocol' => 'mail',
    
    'mailtype'  => 'html', 
    'charset'   => 'iso-8859-1'
		);
		
		
		//$config['protocol'] = 'mail';
         
		
		//$this->email->initialize($config);
		//$this->email->set_newline("\r\n");
		
		$users = $this->UserRegistration->getNewsletterUsers();
		
		
		$this->load->library('parser');
		if($users){
		
		foreach($users as $row){
			$this->sendemail12($row->username,$row->email);
		}
		}
		
	}
	private function getWines(){
		$currentDay  = date('l'); //  'Friday';
		$currentDay = 'Friday';
		$schedule = $this->Schedule->getLastSchedule(1);
		$newSchedule = $this->Schedule->getLastSchedule(2);
		$days = array(
			 'Monday' => 1,
			 'Tuesday' => 2,
			 'Wednesday' => 3,
			 'Thursday' => 4,
			 'Friday' => 5,
			 'Saturday' => 6
		);
		
		if(($currentDay == 'Monday' || $currentDay == 'Tuesday')  && $newSchedule->status == 2)
		{
			
			/**
			 *  Drops the current deal by setting to zero
			 */
			if( !empty($schedule->Latest)){
				$update = array(
					'winescheduleId' => $schedule->Latest,
					'status' => 0,
					);
				
				$this->Schedule->update($update);
			}
			/**
			 *  Initiates the pending deal by changing status from pending to active
			 *  pending = 2
			 *  active = 1
			 *  inactive = 0
			 */ 
			$update = array(
							'winescheduleId' => $newSchedule->Latest,
							'status' => 1,
							);
			
			$this->Schedule->update($update);
			
			$schedule = $this->Schedule->getLastSchedule();
			
		}
		
		/**
		 * Repeates the friday deal for weekends
		 */ 
		
        if($currentDay == 'Saturday')
			$currentDay = 'Friday';
		
		
		if(!empty($schedule->Latest) && $schedule->status == '1')
		{
			$criteria = array('winescheduleId' => $schedule->Latest, 'dayId' => $days[$currentDay]);
		
		
			$this->data['wineofday'] = $this->WineDeals->getByCriteria($criteria);
			
			
		
			// *********Gets the last 7 day wines
			
			 $prevWineIdLast = $this->data['wineofday'][0]->wineId - 1;
			 $prevWineIdFirst = $prevWineIdLast - 4;
			 
			  
			 $currentDayWine = $this->data['wineofday'][0]->wineId;
			 
			 $currentWeekWines  = $this->WineDeals->getLastSevenDeals($currentDayWine + 1, $currentDayWine + 5, 'ASC');
			 $lastWeekWines = $this->WineDeals->getLastSevenDeals($prevWineIdFirst, $prevWineIdLast, 'DESC');

			 // Merge both the current week wines & last week wines and get the first 6 records
			 $totalWines = array_merge($currentWeekWines, $lastWeekWines);
			 $this->data['lastwines'] = $totalWines = array_slice($totalWines,0,4);
			 
			 $temp_arr = $this->data['lastwines'];
			 array_push($temp_arr,$this->data['wineofday'][0]);
			 return $temp_arr;
			 //print_r(count($this->data['lastwines']));
			 ///$rand = rand(0,count($this->data['lastwines']));
			 //$this->data['wineofday'][0] = $temp_arr[$rand];
			 }
	}
	private function sendemail12($username,$email){
		//echo 'Yo!';
		
		
		//$this->email->set_newline("\r\n");
		$wines = $this->getWines();
		$data = array(
    'base_url'=>base_url(),
	'image_url'=>base_url().'assets/images/emails/newsletter/',
	'wines'=>$wines,
	'username'=>$username
    );
		
     $htmlMessage =  $this->parser->parse('emails/newsletter.php', $data, true);
		
		// Set to, from, message, etc.
		$this->load->library('email');
		$this->email->from('noreplay@ditchthepitch.com.au');
		//$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject('DitchThePitch Newsletter');
		$this->email->message($htmlMessage);
		//$this->email->set_alt_message('Alt text');
		//$this->email->alt_message('Alternative text');
		/*$fromAddress = 'newsletter@ditchthepitch.com.au' ;
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= 'To: '.$username.' <'.$email.'>' . "\r\n";
		$headers .= 'From: DitchThePitch <'.$fromAddress.'>' . "\r\n".
					 'Reply-To:'.$fromAddress. "\r\n" .
		
		$mail_sent = @mail($email, 'DitchThePitch Newsletter', $htmlMessage, $headers);*/
   
		echo $this->email->send();
		
		//echo $this->email->print_debugger();
	}
	
}	