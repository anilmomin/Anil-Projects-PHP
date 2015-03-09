<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('ditchthepitchcontroller.php');


class Feedback extends DitchthePitchController {

	private $data;
	private $jsString;

	public function __construct()
	{
		parent::__construct();

		$this->data = array();
		
		$this->jsString = '';
		
		$this->load->library(array('tank_auth','form_validation'));

		$this->load->Model(array('WineFeedback', 'admin/WineManager', 'admin/Profiles'));

	}

	public function demopage()
	{
		$this->output->cache(30);
		$this->data['mb_data'] = $this->load->view('feedbackform', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	
	}
	
	
	public function index()
	{
		
		/*if($this->tank_auth->is_logged_in())
		{
			$userId = $this->session->userdata('user_id');
			
			$feedbackStartDate = $this->WineFeedback->getFeedBackDate($userId);
			$durationLimit = strtotime($feedbackStartDate->claim_date) + (60 * 60 * 24 * FEEDBACK_EXP);
			
			if(time() > $durationLimit)
			{
				$this->session->set_flashdata('errormsg', $this->lang->line('activationcode_expired'));
				redirect('/');
			}*/
				
			$this->_getFeedback();
		/*}
		else
		{
			$this->session->set_flashdata('errormsg', $this->lang->line('invalid_access'));
			$this->session->set_userdata('reflect_url', current_url());
			redirect('/');
		}*/
	}

	private function _sendFeedbackMail($type, $email, &$data)
	{

		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('ditchthepitch_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('admin/email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('admin/email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}


	private function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/');
	}

	private function _show_error($error)
	{
		$this->session->set_flashdata('errormsg', $error);
		redirect(site_url('feedback'));
	}
	
	private function _getFeedback()
	{
		
		// Adding the validation JS
		$this->addJavaScriptSource('jquery/jquery.validate.min.js');
		 		
		/// add jquery for form validation
		$this->jsString = $this->lang->line('feedback');
		
		$this->addJQueryText($this->jsString);
				
		if($this->input->post('post'))
		{
			
			/// Deliminator change
			$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
			$this->form_validation->set_message('is_unique', 'Please provide a valid code');
			
			// Form Validation for Fields
			$this->form_validation->set_rules('firstname', 'first name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'last name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'email', 'trim|required|xss_clean');
			$this->form_validation->set_rules('productcode', 'product code', 'trim|xss_clean|required');
			$this->form_validation->set_rules('estvalue', 'Estimated Value', 'required');
			$this->form_validation->set_rules('quality', 'Quality', 'required');
			$this->form_validation->set_rules('style', 'Style Exception', 'required');
			$this->form_validation->set_rules('label', 'Wine Label', 'required');
			$this->form_validation->set_rules('labelInfo', 'Label Infomation', 'required');
			$this->form_validation->set_rules('hearaboutus', 'Hear about us', 'required|alpha');
			$this->form_validation->set_rules('comments', 'Comments', 'trim|xss_clean');
			$this->form_validation->set_rules('opinion', 'Opinion', 'trim|xss_clean');
			//$this->form_validation->set_rules('encycode', 'Activation Code', 'trim|required|xss_clean|is_unique[user_profiles.activation_code]');
			
			
			if ($this->form_validation->run() == FALSE)
			{
					
				$this->data['mb_data'] = $this->load->view('feedbackform', null, true);
				$this->addMainBodyData($this->data['mb_data']);
				$this->displayView();
			}
			else
			{
				
				$recipent = $this->session->userdata('email');
				$recipent = $this->form_validation->set_value('email');
				$firstName = $this->session->userdata('username');
				$firstName = $this->form_validation->set_value('firstname');
				$criteria = array('user_id' => $this->session->userdata('user_id'));
				$actualFeedbackCode = $this->Profiles->getByCriteria($criteria, null, null, 'activation_code');
				$userFeedbackCode = $this->form_validation->set_value('encycode');
				
				$insertObj = array(
						'firstname' => $this->form_validation->set_value('firstname'),
						'lastname' => $this->form_validation->set_value('lastname'),
						'email' => $this->form_validation->set_value('email'),
						'productcode' => $this->form_validation->set_value('productcode'),
						'estimateValue' => $this->form_validation->set_value('estvalue'),
						'quality' => $this->form_validation->set_value('quality'),
						'style' => $this->form_validation->set_value('style'),
						'label' => $this->form_validation->set_value('label'),
						'labelInfo' => $this->form_validation->set_value('labelInfo'),
						'comments' => $this->input->post('comments'),
						'hearaboutus' => $this->form_validation->set_value('hearaboutus'),
						'opinion' => $this->input->post('opinion'),
						'feedbackDate' => date('Y-m-d H:i:s')

				);
				$this->data['emaildata'] = array(
						'firstname' => $firstName
				);

				if($this->WineFeedback->insert($insertObj))
				{
					$this->load->Model('admin/Profiles');

					$this->_sendFeedbackMail('feedbackparticipant', $recipent, $this->data['emaildata']);
					
					$updateObj = array(
							'send_invitation' => 0,
							'has_claimed' => 0,
							'has_cleared' => 1,
							'activation_code' => ''
							);
					
					$key = array('user_id' => $this->session->userdata('user_id'));
					
					$this->Profiles->updateUserProfile($updateObj, $key);
					
					$updateObj = array('is_sample_user' => 0);
					
					$key = array('id' => $this->session->userdata('user_id'));
					
					$this->Profiles->updateUserData($updateObj, $key);
					
					$this->_show_message("Thank you for the feedback");
				}

			}


		}
		else
		{
			$this->data['mb_data'] = $this->load->view('feedbackform', null, true);
			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();

		}
	}

	
}