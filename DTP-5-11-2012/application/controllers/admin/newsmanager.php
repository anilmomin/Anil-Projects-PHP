<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * @category		Controller Class
 * @package			application/controllers
 * @subpackage		NewsManager
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('admincontroller.php');

class NewsManager extends AdminController
{

	private $jsString = '';
	private $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('tank_auth','form_validation'));

		$this->load->Model(array('admin/News'));

		$this->addCSSSource('humanity/jquery-ui-1.8.16.custom.css');

		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');

	}


	/**
	 * Add News to database
	 */
	public function addnews()
	{
		// Adding the date picker script
		$this->jsString = $this->lang->line('datepicker');
		$this->addJQueryText($this->jsString);
		// end of date picker script

		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		else
		{
			if($this->input->post('post'))
			{

				$this->form_validation->set_rules('postdate', 'Post Date', 'trim|required|xss_clean');
				$this->form_validation->set_rules('news', 'News', 'trim|required|xss_clean');


				if ($this->form_validation->run() == FALSE)
				{
					$this->data['mb_data'] = $this->load->view('admin/addnews', null, true);
					$this->addMainBodyData($this->data['mb_data']);
					$this->displayView();

				}
				else
				{
					$insertObj = array(
							'created_date' => date('Y-m-d H:i:s', strtotime($this->input->post('postdate'))),
							'news' => $this->input->post('news')
					);

					if($this->News->insert($insertObj))
					{
						$this->session->set_flashdata('message', "News has been added successfully.");
						redirect(current_url());
					}
					else
					{
						$this->session->set_flashdata('errormsg', "Fail to add News! Try again.");
						redirect(current_url());
					}
				}
			}
			else
			{
				$this->data['mb_data'] = $this->load->view('admin/addnews', null, true);
				$this->addMainBodyData($this->data['mb_data']);
				$this->displayView();
			}
		}
	}


	/**
	 * Show News in Grid
	 */
	public function shownews()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		
		$this->addCSSSource('ui.jqgrid.css');
		//$this->addCSSSource('ui.multiselect.css');

		$this->addJavaScriptSource('jquery-ui-1.8.16.custom.min.js');
		//$this->addJavaScriptSource('jqgrid/js/ui.multiselect.js');
		$this->addJavaScriptSource('jqgrid/js/i18n/grid.locale-en.js');
		$this->addJavaScriptSource('jqgrid/js/jquery.jqGrid.min.js');

		$this->data['mb_data'] = $this->load->view('admin/shownews', null, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}

	/**
	 * Get the News
	 */

	public function getNews()
	{

		if (!$this->tank_auth->is_admin_login())
		{
			redirect('/admin/auth/login');
		}


		$req_param = array (

				"sort_by" => $this->input->post( "news", TRUE ),
				"sort_direction" => $this->input->post( "sord", TRUE ),
				"page" => $this->input->post( "page", TRUE ),
				"num_rows" => $this->input->post( "rows", TRUE ),
				"search" => $this->input->post( "_search", TRUE ),
				"search_field" => $this->input->post( "searchField", TRUE ),
				"search_operator" => $this->input->post( "searchOper", TRUE ),
				"search_str" => $this->input->post( "searchString", TRUE ),
		);

		$data->page = $this->input->post( "page", TRUE );
		$data->records = $this->News->countAll();
		$data->total = ceil ($data->records / 10 );
		$records = $this->News->getNews($req_param);
		$data->rows = $records;


		echo json_encode ($data );
		exit( 0 );

	}

	public function actions()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		
		$oper = $this->input->post('oper');
		if($oper == 'del')
			$this->_delnews();
		else
			$this->_editnews();
		
	}

	/**
	 * Edit News
	 */
	private function _editnews()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		
		$updateObj = array (
				'news' => $this->input->post('news'),
				'newsId' => $this->input->post('id')
		);

		if($this->News->update($updateObj))
			return true;
		else
			return false;
	}


	/**
	 * Delete News from Database
	 */
	private function _delnews()
	{
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		
		$pk = array('newsId' => $this->input->post('id'));
		$this->News->delete($pk);
	}

}