<?php

/**
 *
 * @category		Controller Class
 * @package			system/application/controllers
 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 0.1
 */

class Login extends Controller
{
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
				redirect('/' . $this->session->flashdata('redirectTo'), 'redirect');
			}
			else
			{
				redirect(index_page());
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
		if (!($this->Authenticate->isLoggedIn() || $this->Authenticate->loginFromCookies()))
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
				redirect('/login/index', 'redirect');
			}
			else
			{
				$data['error'] = "Invalid Username/Password Match";
				$this->load->view('loginform', $data);
			}
		}
		else
		{
			redirect(index_page());
		}
	}
}

?>