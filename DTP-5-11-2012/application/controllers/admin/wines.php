<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Dashboard
 * @category		Wine Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('admincontroller.php');

class Wines extends AdminController {

	private $data = array();
	private $wines = array();
	public $config = array();

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->lang->load('ditchthepitch');
		$this->load->library(array('tank_auth','form_validation'));
		$this->load->Model(array('admin/WineManager', 'admin/Wineries', 'admin/Regions'));

		/**
		 * Uploading Configurations
		 */

		$config['upload_path'] = './uploads/wines/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '2048';	// in KB
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
			
		$this->load->library('upload', $config);
		/* End Config */
		
		if (!$this->tank_auth->is_admin_login()) // logged in
			redirect('/adminpanel');

	}

	public function index()
	{
		redirect('admin/wines/viewwines');
	}

	
	
	
	public function addwines()
	{
		$imageErrors = array();

		$this->data['regions'] = $this->Regions->getAll();
		$this->data['wineries'] = $this->Wineries->getAll();
		$js = '$("#regions").change(function(e){if($("#regions").val() == "100"){$("#insregion").fadeIn();return false;}else $("#insregion").fadeOut()});';
		$js .= '$("#winery").change(function(e){if($("#winery").val() == "1000"){$("#inswinery").fadeIn();return false;}else $("#inswinery").fadeOut()});';
			
		$this->addJQueryText($js);
		
		// If the form is posted save in db
		// else show the form only
		
		if($this->input->post('post')) {
			
			//calls the validation utility function
			$this->_validation();

			// if the validation is false dont submit the form
			// else submit it and save the field in the database

			if ($this->form_validation->run())
			{
				
				if ( ! $this->upload->do_upload('winebigImage'))
					$imageErrors = $this->upload->display_errors('<div class="error">', '</div>');
				else
					$imagelink = $this->upload->data();

				// If no error has encountered while uploading
				if(empty($imageErrors))
				{

					// Adds a new region to the database and assign id to it
					$regionId = 0;
					
					if($this->input->post('wineRegion') == "100") 
					{
						
						$regionData = array('regionName' => $this->input->post('wineRegionNew'), 'orderId' => $this->Regions->countAll());
						$regionId = $this->Regions->insert($regionData); 
					}
					else
						$regionId = $this->input->post('wineRegion');
					
					
					//Adds new winery to the database and assign its id to it
					$wineryId = 0;
					
					if($this->input->post('winery') == "1000")
					{
						$wineryData = array('wineryName' => $this->input->post('wineryNew'), 'created_date' => date('Y-m-d H:i:s'), 'orderId' => $this->Wineries->countAll());
						$wineryId = $this->Wineries->insert($wineryData);
					}
					else
						$wineryId = $this->input->post('winery');
					
					
					$wines = array(
							'wineName' => $this->input->post('wineName'),
							'wineDescription' => $this->input->post('wineDescription'),
							'wineVintage' => $this->input->post('wineVintage'),
							'wineStyle' => $this->input->post('wineStyle'),
							'regionId' => $regionId,
							'wineryId' => $wineryId,
							'wineUniqueId' => $this->input->post('wineUnqId'),
							'wineImage' => $imagelink['file_name']
					);
					
					// inserts into the database
					$this->WineManager->insertWines($wines);
					$this->session->set_flashdata('message', $this->lang->line('addwine'));
					redirect('admin/wines/addwines');

				}
				else
					$this->data['imgerror'] = $imageErrors;
					
			}

		}
		
		$this->data['mb_data'] = $this->load->view('admin/addwines', $this->data, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();			
	}


	private function _validation()
	{

		// Form Validation for Wines
		$this->form_validation->set_rules('wineName', 'Wine Brand', 'trim|required|xss_clean');
		$this->form_validation->set_rules('wineVintage', 'Wine Vintage', 'trim|xss_clean');
		$this->form_validation->set_rules('winery', 'Winery', 'trim|xss_clean');
		$this->form_validation->set_rules('wineRegion', 'Region', 'trim|xss_clean');
		$this->form_validation->set_rules('wineDescription', 'Wine Description', 'trim|required|xss_clean');
		$this->form_validation->set_rules('wineStyle', 'Wine Style', 'trim|required|xss_clean');
		$this->form_validation->set_rules('wineUniqueId', 'Wine Identification Code', 'trim|required|xss_clean');
		if($this->uri->segment(3) == 'editwines')
			$this->form_validation->set_rules('winePrice', 'Wine Price', 'trim|required|xss_clean|numeric|greater_than[0]');
	}


	public function winesuccess($msg)
	{
		switch($msg)
		{
			case 'add':
				$successMsg = "<div class=\"form\"><p>All the Wines are added successfully.<br/><br/> Click view wines to Check the Currently set Deal</p></div><div class=\"cb\"></div>";
				break;
			case 'update':
				$successMsg = "<div class=\"form\"><p>Wines Updated successfully.<br/><br/> Click view wines to Check the Currently set Deal</p></div><div class=\"cb\"></div>";
				break;
			case 'already':
				$successMsg = "<div class=\"form\"><p>Wines for the week are already set.<br/><br/> Click edit wines to Change the wines of the week.</p></div><div class=\"cb\"></div>";
				break;
			default:
				$successMsg = "<div class=\"form\"><p>Invalid Access.</p></div><div class=\"cb\"></div>";
			break;
		}


		$this->data['mb_data'] = $this->load->View('admin/sidenav', null, true);

		$this->data['mb_data'] .= $successMsg;

		$this->addMainBodyData($this->data['mb_data']);

		$this->displayView();

	}
	
	public function getWines()
	{
	
		$req_param = array (
				"sort_by" => $this->input->post( "wineId", TRUE ),
				"sort_direction" => $this->input->post( "sord", TRUE ),
				"page" => $this->input->post( "page", TRUE ),
				"num_rows" => $this->input->post( "rows", TRUE ),
				"search" => $this->input->post( "_search", TRUE ),
				"search_field" => $this->input->post( "searchField", TRUE ),
				"search_operator" => $this->input->post( "searchOper", TRUE ),
				"search_str" => $this->input->post( "searchString", TRUE ),
		);
	
		$data->page = $this->input->post( "page", TRUE );
		$data->records = $this->WineManager->countAll();
		$data->total = ceil ($data->records / 10 );
		$records = $this->WineManager->getwinedata();
		
		$data->rows = $records;
	
		echo json_encode ($data );
		exit( 0 );
	}
	
	
	/**
	 * Edit wines details by admin
	 *
	 * @return void
	 */
	function editwines($wineId = 1)
	{
	
		$this->load->Model('admin/WineManager');
	
		$this->data['wineData'] = $this->WineManager->getwinedata($wineId);
		$this->data['regions'] = $this->Regions->getAll();
		$this->data['wineries'] = $this->Wineries->getAll();
		
		$js = '$("#regions").change(function(e){if($("#regions").val() == "100"){$("#insregion").fadeIn();return false;}else $("#insregion").fadeOut()});';
		$js .= '$("#winery").change(function(e){if($("#winery").val() == "1000"){$("#inswinery").fadeIn();return false;}else $("#inswinery").fadeOut()});';
		
		$this->addJQueryText($js);
		
		$url = explode('/',uri_string());
		
			if($this->input->post('post')) {
				
			//calls the validation utility function
			$this->_validation();

			// if the validation is false dont submit the form
			// else submit it and save the field in the database

			if ($this->form_validation->run())
			{
				
				if ( ! $this->upload->do_upload('winebigImage'))
				{	
					$imageData = $this->upload->data();
					if($imageData['file_name'])
						$this->data['imgerror'] = $this->upload->display_errors();
				}
				else
					$imagelink = $this->upload->data();

					// Adds a new region to the database and assign id to it
					$regionId = 0;
					$this->input->post('wineRegion');
					
					if($this->input->post('wineRegion') == "100") 
					{
						
						$regionData = array('regionName' => $this->input->post('wineRegionNew'), 'orderId' => $this->Regions->countAll());
						$regionId = $this->Regions->insert($regionData); 
					}
					else
						$regionId = $this->input->post('wineRegion');
					
					
					//Adds new winery to the database and assign its id to it
					$wineryId = 0;
					
					if($this->input->post('winery') == "1000")
					{
						$wineryData = array('wineryName' => $this->input->post('wineryNew'), 'created_date' => date('Y-m-d H:i:s'), 'orderId' => $this->Wineries->countAll());
						$wineryId = $this->Wineries->insert($wineryData);
					}
					else
						$wineryId = $this->input->post('winery');
					
					$wines = array(
							'wineId' => $wineId,
							'wineName' => $this->input->post('wineName'),
							'wineDescription' => $this->input->post('wineDescription'),
							'wineVintage' => $this->input->post('wineVintage'),
							'wineStyle' => $this->input->post('wineStyle'),
							'regionId' => $regionId,
							'wineryId' => $wineryId,
							'winePrice' => $this->input->post('winePrice'),
							'wineDdPValue' => $this->input->post('wineDdPValue'),
							'wineUniqueId' => $this->input->post('wineUniqueId'),
							'winePitch' => $this->input->post('winePitch'),
							'wineWithoutPitch' => $this->input->post('wineWithoutPitch'),
							'wineImage' => isset($imagelink['file_name']) ? $imagelink['file_name'] : $this->data['wineData'][0]->wineImage 
					);
					
					// update wines in the database
					$this->WineManager->update($wines);
					
					$this->session->set_flashdata('message', $this->lang->line('updatewine'));
					redirect('admin/wines/editwines/'. $wineId);
					
			}

		}
					
			$this->data['mb_data'] = $this->load->view('admin/editwines', $this->data, true);
			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();
	}
	
	/**
	 * Show Users in Grid
	 */
	public function viewwines()
	{
		$this->addCSSSource('humanity/jquery-ui-1.8.16.custom.css');
	
		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
	
		$this->addCSSSource('ui.jqgrid.css');
	
		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
		$this->addJavaScriptSource('jqgrid/js/i18n/grid.locale-en.js');
		$this->addJavaScriptSource('jqgrid/js/jquery.jqGrid.min.js');
	
		$this->data['mb_data'] = $this->load->view('admin/viewwines', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}


	public function actions()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		$this->_delwines();
	}
	
	/**
	 * Delete Wines from Database
	 */
	private function _delwines()
	{
		$pk = array('wineId' => $this->input->post('id'));
		$this->WineManager->delete($pk);
	}
	
	


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */