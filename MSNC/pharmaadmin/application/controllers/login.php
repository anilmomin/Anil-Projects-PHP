<?php
 
class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Authenticate');
	}
	
	public function index()
	{ 
		if ($this->Authenticate->isLoggedIn() || $this->Authenticate->loginFromCookies())
		{
			if ($this->session->flashdata('redirectTo'))
			{
				redirect(site_url('/') . $this->session->flashdata('redirectTo'), 'redirect');
			}
			else
			{
				redirect(site_url('/pharmaaction/'),'redirect');
			}
			
			
		}
		else
		{
			
			if ($this->session->flashdata('redirectTo'))
			{
				$this->session->keep_flashdata('redirectTo');
			}
			
			$this->load->view('loginform');
		}
	}
	
	
	public function doLogin()
	{
		
		if(!($this->Authenticate->isLoggedIn()  || $this->Authenticate->loginFromCookies()))
		{
			$username = $this->input->post('username', true);
			$password = $this->input->post('password');
			$rememberCheck = $this->input->post('rememberme');
			
			if ($this->session->flashdata('redirectTo'))
			{
				$this->session->keep_flashdata('redirectTo');
			}
			
			$rememberCheck = ($rememberCheck == 'yes') ? true : false;
				
				if ($this->Authenticate->login($username, $password, $rememberCheck))
				{
					
					redirect('login/index', 'redirect');
				}
				else
				{
					$data['error'] = "Sorry, invalid Email or Password..";
					$this->load->view('loginform', $data);
				}
		}
		else
		{
			
			redirect(site_url('/'), 'redirect');
			
		}	
			
	}
	
	
	public function logout()
	{
		if ($this->Authenticate->isLoggedIn() || $this->Authenticate->loginFromCookies())
		{
			$this->Authenticate->logout();
			redirect(site_url('/login/'), 'redirect');
		}
		else
		{
			redirect(site_url(), 'redirect');
		}
	}
	
	
}


?>