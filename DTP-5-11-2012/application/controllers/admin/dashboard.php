<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Dashboard
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('admincontroller.php');

class Dashboard extends AdminController {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
        /*var_dump($this->tank_auth->is_admin());
        die;*/
        if (!$this->tank_auth->is_admin_login()) {
			redirect('/admin/auth/login');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$data['lastlogin']	= $this->tank_auth->get_last_login();
			$data['mb_data']	= $this->load->view('admin/sidenav', null, true);
			$data['mb_data']	.= $this->load->view('admin/dashboard', $data, true);
            $this->addMainBodyData($data['mb_data']);
			$this->displayView();
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */