<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');

	}

	function index()
	{
		if ($message = $this->session->flashdata('message'))
		{
			$this->load->view('admin/dashboard', array('message' => $message));
		}
		else
		{
			redirect('/auth/login/');
		}
	}



	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	function login()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('/');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('loginemail', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('loginpassword', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
					($login = $this->input->post('loginemail'))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				if ($data['use_recaptcha'])
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				else
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
			}
		
			$data['errors'] = array();
			
			if ($this->form_validation->run()) {
				// validation ok
				if ($this->tank_auth->login(
						$this->form_validation->set_value('loginemail'),
						$this->form_validation->set_value('loginpassword'),
						$this->form_validation->set_value('remember'),
						$data['login_by_username'],
						$data['login_by_email'])) {
						
					
					$reflectUrl = $this->session->userdata('reflect_url');

					if($reflectUrl)
					{
						$this->session->unset_userdata('reflect_url');
						redirect($reflectUrl);
					}
					else
						redirect('/');

				} else {

					$errors = $this->tank_auth->get_error_message();
					
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('/auth/send_again/');

					} else {	
						$errorstr = '';
						foreach ($errors as $k => $v)	$errorstr .= $this->lang->line($v) . "<br/>";
						$this->session->set_flashdata('errormsg', $errorstr);
						redirect('/');
					}
				}
			}
			else
			{
				$this->session->set_flashdata('errormsg', "Invalid Login Attempt.");
				redirect('/');
			}
			$data['show_captcha'] = FALSE;
			if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
				$data['show_captcha'] = TRUE;
				if ($data['use_recaptcha']) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}

			redirect('/');

		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{

		$this->tank_auth->logout();

		redirect('/');
	}

	/** 
	 * Subscribe user to the site
	 */
	function subscribe()
	{
		$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('subsemail', 'Email', 'trim|required|xss_clean|valid_email');
		
		
		if($this->input->post('post'))
			if ($this->form_validation->run()) {								// validation ok

			$this->data['name'] = $this->form_validation->set_value('firstname');
			$this->data['email'] = $this->form_validation->set_value('subsemail');
			$this->data['site_name'] = $this->config->item('website_name', 'tank_auth');
			   
			
				if (!is_null($userid = $this->tank_auth->create_subsciption(
						$this->form_validation->set_value('firstname'),
						$this->form_validation->set_value('lastname'),
						$this->form_validation->set_value('subsemail')
						)))
				{
					$this->data['userid'] = base64_encode($userid['user_id']);
					$this->data['userid'] = rtrim($this->data['userid'], '=');
					$this->data['unsubscribe_url'] = site_url('auth/unsubscribe/' . $this->data['userid']);
					$this->_send_email('subscribe', $this->data['email'], $this->data);
					$this->session->set_flashdata('message', "You have successfully subscribed for our newsletters");
					redirect(base_url());
				}
				else 
				{
					$errorstr = "You are already subscribed with this email address.";
					$this->session->set_flashdata('errormsg', $errorstr);
					redirect(base_url());
				}
			}
			else
			{
				$this->session->set_flashdata('errormsg', "Invalid Data provided!");
				redirect(base_url());
			}
	} 
	
	function unsubscribe($id)
	{
		$config['permitted_uri_chars'] = 'a-z 0-9~%.:_=-';
		$user_id = base64_decode($id);
		echo "You are successfully unsubscribed from our newsletter list.<br>";
		$this->tank_auth->unsubscribe_user($user_id);
		echo "Redirecting...";
		$this->output->set_header('refresh:5;url='. site_url());
	} 
	
	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	function register()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('/');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

			$captcha_registration	= $this->config->item('captcha_registration', 'tank_auth');
			$use_recaptcha			= $this->config->item('use_recaptcha', 'tank_auth');
			if ($captcha_registration)
			{
				if ($use_recaptcha)
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				else
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');

			}

			$data['errors'] = array();
			$email_activation = $this->config->item('email_activation', 'tank_auth');

			if ($this->form_validation->run()) {								// validation ok
					
				if (!is_null($data = $this->tank_auth->create_user(
						$this->form_validation->set_value('firstname'),
						$this->form_validation->set_value('firstname'),
						$this->form_validation->set_value('lastname'),
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password'),
						$email_activation))) {									// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					if ($email_activation) {									// send "activate" email
						$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

						$this->_send_email('activatesimple', $data['email'], $data);

						unset($data['password']); // Clear password (just for any case)

						$this->_show_message($this->lang->line('auth_message_registration_completed_1'));

					} else {
						if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

							$this->_send_email('welcome', $data['email'], $data);
						}
						unset($data['password']); // Clear password (just for any case)

						$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
					}
				}
				else
				{
					$errors = $this->tank_auth->get_error_message();
					$errorstr = '';
					foreach ($errors as $k => $v)
						$errorstr .= $this->lang->line($v);
					$this->session->set_flashdata('errormsg', $errorstr);
					redirect(current_url());
				}

			}

			if ($captcha_registration) {
				if ($use_recaptcha) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}

			$data['captcha_registration'] = $captcha_registration;
			$data['use_recaptcha'] = $use_recaptcha;
			$this->load->view('header');
			$this->load->view('newuser', $data);
			$this->load->view('footer');

		}
	}

	/**
	 * Route the user accourding to his membership
	 */
	function routerequest()
	{
		if($this->session->userdata('simpleuser'))
		{
			$this->_simplewinerequest();
		}
		else
		{
			$this->_registerwinerequest();
		}
	}

	/**
	 * Register the simple user it only updates the records
	 * and inserts his wine preferences
	 */
	private function _simplewinerequest()
	{
		$this->load->Model('UserPreferences');
		$simpleUserId = $this->session->userdata('simpleuser');

		if(!$this->session->userdata('finish') && !$this->session->userdata('firstname'))
		{
			redirect('sampleregistration/registrationform/3');
		}

		if(!$this->session->userdata('firstname'))
			redirect('/');


		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('/');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {

			$user = array(
					'firstname' =>  $this->session->userdata('firstname'),
					'lastname'  =>  $this->session->userdata('lastname'),
					'email'  => $this->session->userdata('email'),
					'password'  => $this->session->userdata('password'),
					'dob'   => $this->session->userdata('dob')
			);


			$this->session->unset_userdata('firstname');
			$this->session->unset_userdata('lastname');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('password');
			$this->session->unset_userdata('dob');
			$this->session->unset_userdata('finish');
			$this->session->unset_userdata('step2');
			$this->session->unset_userdata('simpleuser');

			$email_activation = $this->config->item('email_activation', 'tank_auth');

			if (!is_null($data = $this->tank_auth->update_user(
					$simpleUserId,
					$user['firstname'],
					$user['lastname'],
					$user['password'],
					$user['dob']))) {									// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');
				$userpreference  = $this->session->userdata('winestyle') . ", ";
				if($this->session->userdata('winepref'))
					$userpreference .= implode(', ', $this->session->userdata('winepref'));
				$this->session->unset_userdata('winepref');
				$this->session->unset_userdata('winestyle');

				$insertObj = array(
						'user_id' => $data['id'],
						'preference' => $userpreference
				);

				// Inserts the wines preferences
				$this->UserPreferences->insert($insertObj);
				$emailarray = array(
						'first_name' => $user['firstname'],
						'preference' => $userpreference
				);

				$data['emaildata'] = (object)$emailarray;

				if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email
					$this->_send_email('greetings', $data['email'], $data);
				}
				unset($data['password']); // Clear password (just for any case)

				$this->_show_message($this->lang->line('auth_message_registration_completed_2'));
			}

		}

			
	}



	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	private function _registerwinerequest()
	{
		$this->load->Model('UserPreferences');

		if(!$this->session->userdata('finish') && !$this->session->userdata('firstname'))
		{
			redirect('sampleregistration/registrationform/3');
		}

		if(!$this->session->userdata('firstname'))
			redirect('/');


		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('/');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {

			$user = array(
					'firstname' =>  $this->session->userdata('firstname'),
					'lastname'  =>  $this->session->userdata('lastname'),
					'email'  => $this->session->userdata('email'),
					'password'  => $this->session->userdata('password'),
					'dob'   => $this->session->userdata('dob')
			);

			$this->session->unset_userdata('firstname');
			$this->session->unset_userdata('lastname');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('password');
			$this->session->unset_userdata('dob');
			$this->session->unset_userdata('finish');
			$this->session->unset_userdata('step2');

			$email_activation = $this->config->item('email_activation', 'tank_auth');

			if (!is_null($data = $this->tank_auth->create_user(
					$user['firstname'],
					$user['firstname'],
					$user['lastname'],
					$user['email'],
					$user['password'],
					$email_activation,
					'1',
					$user['dob']))) {									// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');
				$userpreference = '';
				if($this->session->userdata('winestyle'))
					$userpreference  = $this->session->userdata('winestyle') . ", ";
				if($this->session->userdata('winepref'))
					$userpreference .= implode(', ', $this->session->userdata('winepref'));
				$this->session->unset_userdata('winepref');
				$this->session->unset_userdata('winestyle');
					
				$insertObj = array(
						'user_id' => $data['user_id'],
						'preference' => $userpreference
				);

				// Inserts the wines preferences
				$this->UserPreferences->insert($insertObj);

				if ($email_activation) {									// send "activate" email
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					unset($data['password']); // Clear password (just for any case)

					$this->_show_message($this->lang->line('auth_message_registration_completed_1'));

				} else {
					if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

						$this->_send_email('welcome', $data['email'], $data);
					}
					unset($data['password']); // Clear password (just for any case)

					$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
				}

			}

			else {

				$errors = $this->tank_auth->get_error_message();
				foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
			}
		}

	}


	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('admin/auth/send_again_form', $data);
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activateuser()
	{

		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			//$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_activation_completed'));
		} else {																// fail
			$this->_show_error($this->lang->line('auth_message_activation_failed'));
		}
	}


	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$this->load->Model('UserRegistration');
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);
		$data['emaildata'] = $this->UserRegistration->getEmailData($new_email_key);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			//$this->tank_auth->logout();
			$this->_send_email('greetings', $data['emaildata']->email, $data);
			$this->_show_message($this->lang->line('auth_message_activation_completed'));


		} else {																// fail
			$this->_show_error($this->lang->line('auth_message_activation_failed'));
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('/');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
						$this->form_validation->set_value('login')))) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);

					$this->_show_message($this->lang->line('auth_message_new_password_sent'));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('header');
			$this->load->view('passwordrecovery', $data);
			$this->load->view('footer');
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				$this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}
			
			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
				
			}
		}
		$this->load->view('header');
		$this->load->view('newpassword', $data);
		$this->load->view('footer');
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */
	function change_password()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('admin/auth/change_password_form', $data);
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password')))) {			// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
					$this->_send_email('change_email', $data['new_email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('admin/auth/change_email_form', $data);
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('admin/auth/unregister_form', $data);
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_error($error)
	{
		$this->session->set_flashdata('errormsg', $error);
		redirect('/');
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('admin/email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('admin/email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
			
			
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
				'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
				'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
				'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
				'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
				'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
				'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
				'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
				'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */