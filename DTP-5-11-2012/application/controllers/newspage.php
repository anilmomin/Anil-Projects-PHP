<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('ditchthepitchcontroller.php');


class Newspage extends DitchthePitchController 
{

	private $data;
	private $jsString;

	public function __construct()
	{
		parent::__construct();

		$this->data = array();
		
		$this->jsString = '';
		
		$this->load->library(array('tank_auth'));

		$this->load->Model('admin/News');
	}
	
	public function index()
	{
		// ********* Gets the News ********
		
		$this->data['newsdata'] = $this->News->getAll();
		$this->data['mb_data'] = $this->load->view('news', $this->data, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}
}
	
?>