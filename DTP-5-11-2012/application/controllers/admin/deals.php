<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Dashboard
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('admincontroller.php');

class Deals extends AdminController {

	private $jsString = '';
	private $data = array();
	private $deals = array();
	private $days = array();
	public $config = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('tank_auth','form_validation'));

		$this->load->Model(array('admin/WineManager', 'admin/Schedule', 'admin/SellPack', 'admin/WineDeals'));

		/**
		 * Uploading Configurations
		 */

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';	// in KB
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
			
		$this->load->library('upload', $config);
		/* End Config */
		
		// If the user is not loged in redirect to login page
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		
		$this->days = array('Monday', 'Tuesday'/*, 'Wednesday', 'Thursday', 'Friday'*/);

	}

	public function index()
	{
		if (!$this->tank_auth->is_admin_login() ) {
			redirect('/admin/auth/login');

		} else {
			redirect('admin/wines/viewwines');


		}
	}


	public function viewwdeals()
	{

		if (!$this->tank_auth->is_admin_login() ) {
			redirect('/admin/auth/login');

		} else {


			$schedule = $this->Schedule->getLastSchedule(2);

			if(empty($schedule->Latest))
			{
				$this->data['mb_data'] = $this->load->view('admin/sidenav', null, true);
				$this->data['mb_data'] .= "<div class=\"form\"><p>No Wines Available for Preview.</p></div><div class=\"cb\"></div>";

			}
			else
			{
				$criteria = array('winescheduleId' => $schedule->Latest);
				$this->data['wines'] = $this->WineManager->getByCriteria($criteria);
				$this->data['mb_data'] = $this->load->view('admin/viewwines', $this->data, true);
			}

			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();


		}

	}
	
	
	public function delpage()
	{
		$this->data['mb_data'] = $this->load->view('admin/deletewines', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}

	public function deletewines()
	{
		if (!$this->tank_auth->is_admin_login() ) {
			redirect('/admin/auth/login');
		
		} else {
		
		
			$schedule = $this->Schedule->getLastSchedule(2);
		
			if(empty($schedule->Latest))
			{
				$this->data['mb_data'] = $this->load->view('admin/sidenav', null, true);
				$this->data['mb_data'] .= "<div class=\"form\"><p>No Wines Available for Preview.</p></div><div class=\"cb\"></div>";
			}
			else
			{
				$criteria = array('winescheduleId' => $schedule->Latest);
				$this->Schedule->delete($schedule->Latest);
				if($this->WineManager->deletewines($criteria) > 0)
					$this->session->set_flashdata('message', "Wines Deleted successfully");
				else
					$this->session->set_flashdata('errormsg', "Unable to Delete wines");
				redirect(site_url('admin/wines/'));
			}
		}
	}
	
	
	public function adddeals()
	{
		$imagelinks = array();
		$imageErrors = array();

		// gets the selling packages form the db
		$this->data['sellPkg'] = $this->SellPack->getAll();
		
		// get the wines from the database
		$this->data['wineData'] = $this->WineManager->getwinedata();
		$this->data['days'] = $this->days;
		
		if($this->input->post('post')) {
			
			//calls the validation utility function
			$this->_validation();

			if ($this->form_validation->run())
			{
				$dealName = $this->input->post('dealName');
				
				foreach($this->days as $id => $day)
					$this->deal[$day] = array(
							'dealName' => $dealName[$id]
					);
					
					
					print_r($this->deal);
					// inserts into the database
					//$this->WineDeals->insert($this->deal);
					echo "added successfuly";
			}
		}
		
		$this->data['mb_data'] = $this->load->view('admin/adddeals', $this->data, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}



	private function _validation()
	{

		// Form Validation for Monday
		$this->form_validation->set_rules('dealName[]', 'Deal Name', 'trim|required|xss_clean');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */