<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('ditchthepitchcontroller.php');


class SampleRegistration extends DitchthePitchController {

	private $data;
	private $jsString = '';

	public function __construct()
	{
		parent::__construct();

		$this->data = array();
		$this->load->library(array('tank_auth','form_validation'));
		$this->jsString = $this->lang->line('cufon_form');
		$this->addJavaScriptText($this->jsString);
		$this->load->Model(array('admin/Profiles', 'UserRegistration'));
		 
		// Adding the validation JS
		$this->addJavaScriptSource('jquery/jquery.validate.min.js');
		 
	}


	public function index()
	{
		
		if($this->session->userdata('hash') && $this->session->userdata('has_claimed'))
			$this->_claim();
		else
			redirect(site_url());
	}


	public function registrationform($step = 1)
	{
		switch($step)
		{
			case 0:
				$this->_noaccess();
				break;
					
			case 1:
				$this->_step1();
				break;
					
			case 2:
				$this->_step2();
				break;
					
			case 3:
				$this->_step3();
				break;

			default:
				$this->_step1();
				
		}
	}

	private function _noaccess()
	{
		$this->data['mb_data'] = $this->load->view('verifyform', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}

	private function _step1()
	{
		
		$this->addJavaScriptSource('bday-picker.min.js');

		$this->jsString = $this->lang->line('birthdate');
		$this->addJQueryText($this->jsString);
		
		$this->jsString = $this->lang->line('step1');
		$this->addJQueryText($this->jsString);
		
		$this->form_validation->set_message('is_natural_no_zero', 'Invalid date provided');

		if($this->input->post('step1'))
		{
			// Deliminator change
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			
			// Form Validation for Fields
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules('birth[month]', 'Date of Birth', 'required|is_natural_no_zero');
			$this->form_validation->set_rules('birth[day]', 'Date of Birth', 'required|is_natural_no_zero');
			$this->form_validation->set_rules('birth[year]', 'Date of Birth', 'required|is_natural_no_zero');

				
			// if the validation is false dont submit the form
			// else submit it and save the field in the database
				
			if ($this->form_validation->run() == FALSE)
			{

				$this->data['mb_data'] = $this->load->view('verifyform', null, true);
				$this->addMainBodyData($this->data['mb_data']);
				$this->displayView();
			}
			else
			{

				$errors = array();
				$birthSegment =  $this->input->post('birth');

				 
				/**
				 * Special Validation of Age,
				 * Residence in Australia
				 * and Legal Status for Alcohol
				 */

				$age = date('Y') - $birthSegment['year'];

				if( $age < AGE_LIMIT)
					$errors[] = $this->lang->line('age_limit');
				
				if($this->input->post('residence') == 'no')
					$errors[] = $this->lang->line('reside_australia');
				
				if(!empty($errors))
				{
					$this->session->set_flashdata('specialerrors', $errors);
					redirect(site_url('sampleregistration/registrationform/0'));
				}

				/**
				 * Check for the user with duplicate registration
				 */
				 
				$user = $this->UserRegistration->alreadyUser($this->input->post('email'));
				
				// if the user is a sample user else he is not a user or he is a simple user
				if (!empty($user) && $user->is_sample_user) // is already a sample user
				{
					if($this->UserRegistration->hasProvidedFeedback($user->id))
					{
						// allow him to register again
						$this->session->set_userdata('firstname', $this->form_validation->set_value('firstname'));
						$this->session->set_userdata('lastname', $this->form_validation->set_value('lastname'));
						$this->session->set_userdata('email', $this->form_validation->set_value('email'));
						$dob = "{$birthSegment['year']}-{$birthSegment['month']}-{$birthSegment['day']}";
						$this->session->set_userdata('dob', $dob);
						redirect('sampleregistration/registrationform/2');
					}
					else 
					{
						$this->session->set_flashdata('errormsg', $this->lang->line('already_claimed'));
						redirect('/');
					}
					
				}
				elseif (!empty($user) && $user->is_sample_user == 0) // user is a simple user and wants to recieve a sample
				{
					$this->session->set_userdata('firstname', $this->form_validation->set_value('firstname'));
					$this->session->set_userdata('lastname', $this->form_validation->set_value('lastname'));
					$this->session->set_userdata('email', $this->form_validation->set_value('email'));
					$this->session->set_userdata('simpleuser', $user->id);
					$dob = "{$birthSegment['year']}-{$birthSegment['month']}-{$birthSegment['day']}";
					$this->session->set_userdata('dob', $dob);
					redirect('sampleregistration/registrationform/2');
				}
				else
				{
						
					$this->session->set_userdata('firstname', $this->form_validation->set_value('firstname'));
					$this->session->set_userdata('lastname', $this->form_validation->set_value('lastname'));
					$this->session->set_userdata('email', $this->form_validation->set_value('email'));
					$dob = "{$birthSegment['year']}-{$birthSegment['month']}-{$birthSegment['day']}";
					$this->session->set_userdata('dob', $dob);
					redirect('sampleregistration/registrationform/2');
				}	
							
			}
		}
		else
		{
			$this->data['mb_data'] = $this->load->view('verifyform', null, true);
			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();
		}

	}
	

	private function _step2()
	{
		/**
		 * Stop invalid jumping from pages
		 */

		if(!$this->session->userdata('dob'))
		{
			redirect('sampleregistration/registrationform/1');
		}

		$this->load->Model('WineStyles');
		$this->data['winesStyles'] = $this->WineStyles->getAll('winestyleName');

		if($this->input->post('step2'))
		{
			$this->session->set_userdata('step2', '1');
			 
			$winePref = $this->input->post('winepref');
			
			if(!empty($winePref))
				$this->session->set_userdata('winepref', $winePref );
			
			redirect('sampleregistration/registrationform/3');

		}
		else
		{
			$this->data['mb_data'] = $this->load->view('winepref', $this->data, true);
			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();
		}
	}

	private function _step3()
	{
		/**
		 * Stop invalid jumping from pages
		 */

		if(! $this->session->userdata('step2'))
		{
			redirect('sampleregistration/registrationform/2');
		}
		
		
		if($this->input->post('step3'))
		{
			
			if(!$this->session->userdata('winepref'))
			{
				//$this->form_validation->set_rules('winestyle', 'Wine Style', 'trim|required|xss_clean');
					//call the User registration function from auth
					$this->session->set_userdata('finish', '1');
					redirect(site_url('auth/routerequest/'));

				
			}
			else
			{
				$this->session->set_userdata('finish', '1');
				//call the User registration function from auth
				redirect(site_url('auth/routerequest/'));

			}
			 
		}
		else
		{
			$this->data['mb_data'] = $this->load->view('winestyle', null, true);
			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();
		}

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


	private function _claim()
	{
		
		$this->jsString = $this->lang->line('claim');
		
		$this->addJQueryText($this->jsString);
		
		if($this->input->post('claim'))
		{
			// Deliminator change
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			$this->form_validation->set_message('certify', 'Please certify the statement');
			$this->form_validation->set_message('is_unique', 'Please provide a valid code');
						
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('address', 'Postal Address', 'trim|required|xss_clean');
			$this->form_validation->set_rules('state', 'State', 'required');
		 	$this->form_validation->set_rules('suburb', 'Suburb', 'trim|required|xss_clean');
		 	$this->form_validation->set_rules('postcode', 'Postcode', 'trim|required|xss_clean');
		 	$this->form_validation->set_rules('encycode', 'Code', 'trim|required|xss_clean|is_unique[user_profiles.activation_code]');
		 	$this->form_validation->set_rules('certify', 'Certify', 'required');


			if ($this->form_validation->run() == FALSE)
			{

				$this->data['mb_data'] = $this->load->view('claimform', null, true);
				$this->addMainBodyData($this->data['mb_data']);
				$this->displayView();
			}
			else
			{

				$userid = $this->tank_auth->get_user_id();
				$pk = array('userid'=>$userid);
				$firstname = $this->form_validation->set_value('firstname');
				$lastname = $this->form_validation->set_value('lastname');
				$address = $this->form_validation->set_value('address') .  ' ' . $this->input->post('address1') . ', '  .$this->form_validation->set_value('suburb') . ', ' . $this->form_validation->set_value('state') . ', '. $this->form_validation->set_value('postcode');
				$updateObj = array (
						'address' => $address,
						'claim_firstname' => $firstname,
						'claim_lastname' => $lastname,
						'has_claimed' => 1,
						'activation_code' => generate_code(10),
						'claim_date' => date('Y-m-d H:i:s')
				);

				$this->Profiles->updateUserProfile($updateObj, array('user_id' => $userid));
				
				$insertObj = array (
						'user_id' => $userid,
						'claim_date' => date('Y-m-d H:i:s')
						);
				
				/// Loads the Model for the Wine dispatch
				$this->load->Model('WineDispatches');
				
				$this->WineDispatches->insert($insertObj);
				
				$this->data['emaildata'] = $this->Profiles->getEmailData($userid);
				
				$this->_sendFeedbackMail('confirmrequest', $this->data['emaildata']->email, $this->data);

				$this->session->unset_userdata(array('hash'=>'', 'has_claimed'=>''));
				$this->session->set_flashdata('message', "Thank you, your request has been submitted successfully.");
				redirect('/');
			}
		}
		else
		{
			$this->data['mb_data'] =  $this->load->view('claimform', null, true);
			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();
		}
		 
	}

	public function democlaimform()
	{
		$this->output->cache(30);
		$this->data['mb_data'] =  $this->load->view('claimform', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}
	
	
	public function activate($userid, $hash)
	{
		$user = $this->Profiles->getActivatedUser($hash);

		if(!empty($user))
		{

			/**
			 * Check if the activation time has not passed the limit
			 * that is 96 hrs
			 */
			 
			$durationLimit = strtotime($user->activate_start) + (60 * 60 * ACTIVATION_EXP);

			if(time() > $durationLimit)
			{
				$this->session->set_flashdata('errormsg', $this->lang->line('activationcode_expired'));
				redirect(site_url());
			}

			/**
			 * Logs the user in by its activation code passed
			 */

			$this->tank_auth->loginByHash($hash);
			
			$this->session->set_userdata(array('hash'=> $hash, 'has_claimed' => '1'));
					
			redirect(site_url('sampleregistration/'));
				
		}
		else
		{
			$this->session->set_flashdata('errormsg', $this->lang->line('invalid_code'));
			redirect(site_url());
			 
		}

	}

}