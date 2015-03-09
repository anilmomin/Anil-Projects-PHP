<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Users
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */
require_once('admincontroller.php');

class UserManagement extends AdminController 
{

	private $jsString = '';
	private $data = array();
	
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('tank_auth','form_validation'));
		
		$this->load->Model(array('admin/UserManager', 'admin/Profiles'));
		
		
	}
	
	public function actions()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		$this->_delusers();
	}
	
	/**
	 * Delete Users from Database
	 */
	private function _delusers()
	{
		$pk = array('id' => $this->input->post('id'));
		$this->UserManager->delete($pk);
	}
	
	
	/**
	 * Get the Users
	 */
	
	public function getUsers()
	{
	
		if (!$this->tank_auth->is_admin_login())
		{
			redirect('/admin/auth/login');
		}
	
	
		$req_param = array (
				"sort_by" => $this->input->post( "id", TRUE ),
				"sort_direction" => $this->input->post( "sord", TRUE ),
				"page" => $this->input->post( "page", TRUE ),
				"num_rows" => $this->input->post( "rows", TRUE ),
				"search" => $this->input->post( "_search", TRUE ),
				"search_field" => $this->input->post( "searchField", TRUE ),
				"search_operator" => $this->input->post( "searchOper", TRUE ),
				"search_str" => $this->input->post( "searchString", TRUE ),
		);
	
		$data->page = $this->input->post( "page", TRUE );
		$data->records = $this->UserManager->countAll();
		$data->total = ceil ($data->records / 10 );
		$records = $this->UserManager->getuserdata();
		$data->rows = $records;
		
		echo json_encode ($data );
		exit( 0 );
	}
	
	/**
	 * Show Users in Grid
	 */
	public function showusers()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
	
		$this->addCSSSource('humanity/jquery-ui-1.8.16.custom.css');
		
		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
		
		$this->addCSSSource('ui.jqgrid.css');
		
		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
		$this->addJavaScriptSource('jqgrid/js/i18n/grid.locale-en.js');
		$this->addJavaScriptSource('jqgrid/js/jquery.jqGrid.min.js');
	
		$this->data['mb_data'] = $this->load->view('admin/showusers', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}
	
}