<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Dashboard
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('admincontroller.php');

class FeedbackManager extends AdminController 
{

	private $jsString = '';
	private $data = array();

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('tank_auth','form_validation'));
		
		$this->load->Model(array('WineFeedback'));
		
		$this->addCSSSource('humanity/jquery-ui-1.8.16.custom.css');
		
		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
		
	}
	
	/**
	 * calculate Avg price
	 */
	public function calcAvgPrice()
	{
		$wines = substr($this->input->post('wineId'), 0 , -1);
		$wineIds = explode(',', $wines);
		$result =  $this->WineFeedback->getAvgPrice($wineIds);
		echo "$ " . round($result[0]->estimateValue, 2);
	}
	
	
	/**
	 * Displays the Feedback in a grid form
	 */
	public function displayfeedback()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
	
		$this->addCSSSource('ui.jqgrid.css');
		//$this->addCSSSource('ui.multiselect.css');
	
		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
		//$this->addJavaScriptSource('jqgrid/js/ui.multiselect.js');
		$this->addJavaScriptSource('jqgrid/js/i18n/grid.locale-en.js');
		$this->addJavaScriptSource('jqgrid/js/jquery.jqGrid.min.js');
	
		$this->data['mb_data'] = $this->load->view('admin/displayfeedback', null, true);
		$this->addMainBodyData($this->data['mb_data']);	
		$this->displayView();
	}
	
	/**
	 * Get the feedback
	 */
	public function getfeedback()
	{
		if (!$this->tank_auth->is_admin_login())
			redirect('/admin/auth/login');
	
		$req_param = array (
	
				"sort_by" => $this->input->post( "winefeedbackId", TRUE ),
				"sort_direction" => $this->input->post( "sord", TRUE ),
				"page" => $this->input->post( "page", TRUE ),
				"num_rows" => $this->input->post( "rows", TRUE ),
				"search" => $this->input->post( "_search", TRUE ),
				"search_field" => $this->input->post( "searchField", TRUE ),
				"search_operator" => $this->input->post( "searchOper", TRUE ),
				"search_str" => $this->input->post( "searchString", TRUE ),
		);
	
		$data->page = $this->input->post( "page", TRUE );
		$data->records = $this->WineFeedback->countAll();
		$data->total = ceil ($data->records / 10 );
		$records = $this->WineFeedback->getFeedback($req_param);
		$data->rows = $records;
		echo json_encode ($data );
		exit( 0 );
	}
	
}