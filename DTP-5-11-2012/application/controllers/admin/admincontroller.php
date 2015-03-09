<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin Controller
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */
 
class AdminController extends CI_Controller {

	protected $headerData = array();
	protected $leftSidebarData = array();
	protected $mainBodyData = array();
	protected $rightSidebarData = array();
	protected $footerData = array();
	private $data = array();
	
	public function __construct()
	{
		parent::__construct();
	
		// Set the Default Time Zone
		date_default_timezone_set(TIMEZONE);
		
		
		/* initializing the required variables */

		$this->headerData['javaScriptText'] = '';
		$this->headerData['jQueryText'] = '';
		$this->headerData['javaScriptSrc'] = array();
		$this->headerData['CSSText'] = '';
		$this->headerData['CSSSrc'] = array();
		$this->mainBodyData['mb_data'] = '';
	

        $this->lang->load('ditchthepitch');	
		/* Load Models */
		$this->load->Model('admin/adminmodel');
		
	}
	
	/**
	  * Theme Functions
	  */
	
	
	protected function addLeftSideBarData($data)
	{
		if (is_string($data))
		{
			$this->leftSidebarData['ls_data'] .= $data;
		}
	}
	
	protected function addRightSideBarData($data)
	{
		if (is_string($data))
		{
			$this->rightSidebarData['rs_data'] .= $data;
		}
	}
	
	protected function addMainBodyData($data)
	{
		if (is_string($data))
		{
			$this->mainBodyData['mb_data'] .= $data;
		}
	}

	protected function addJavaScriptSource($src)
	{
		if (is_string($src))
		{
			array_push($this->headerData['javaScriptSrc'], $src);
		}
	}

	protected function addJavaScriptText($js)
	{
		if (is_string($js))
		{
			$this->headerData['javaScriptText'] .= $js;
		}
	}
	
	protected function addJQueryText($js)
	{
		if (is_string($js))
		{
			$this->headerData['jQueryText'] .= $js;
		}
	}

	protected function addCSSSource($src)
	{
		if (is_string($src))
		{
			array_push($this->headerData['CSSSrc'], $src);
		}
	}

	protected function addCSSText($css)
	{
		if (is_string($css))
		{
			$this->headerData['CSSText'] .= $css;
		}
	}
	
	protected function displayView()
	{

		
		$this->load->view('admin/header', $this->headerData);
		//$this->load->view('left_sidebar', $this->leftSidebarData);
		$this->load->view('admin/mainbody', $this->mainBodyData);
		//$this->load->view('right_sidebar', $this->rightSidebarData);
		$this->load->view('admin/footer', $this->footerData);
	}

	protected function displayError()
	{	
		$this->addMainBodyData(mainBodyTitle('Permission Not Granted', COLOUR_RED, COLOUR_RED));
		$this->displayView();
	}

	// --- Theme Function End ---
	
	

}
