<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * @category		Controller Class
 * @package			system/application/controllers
 * @author			Creative Chaos
 * @version			Release: 0.1
 */

class MSNCController extends CI_Controller {

	
	protected $headerData = array();
	protected $leftSidebarData = array();
	protected $mainBodyData = array();
	protected $rightSidebarData = array();
	protected $footerData = array();
	private $data = array();
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Karachi');
		
		
		$this->load->model(array('Authenticate','Configuration'));
		$this->checkForLogin();
		
		
		/* initializing the required variables */
		$this->leftSidebarData['ls_data'] = '';
		$this->rightSidebarData['rs_data'] = '';
		$this->mainBodyData['mb_data'] = '';
		$this->mainBodyData['currentUser'] = '';
		$this->mainBodyData['logoLink'] = '';
		$this->headerData['headerInfo'] = '';
		$this->headerData['currentUser'] = '';
		$this->headerData['javaScriptText'] = '';
		$this->headerData['javaScriptSrc'] = array();
		$this->headerData['CSSText'] = '';
		$this->headerData['CSSSrc'] = array();
		
		
	}
	
	private function checkForLogin()
	{
		
		if (!$this->Authenticate->isLoggedIn())
		{
			/*if (!$this->Authenticate->loginFromCookies())
			{
				$redirectTo = uri_string();
				$this->session->set_flashdata('redirectTo', $redirectTo);
				redirect('/login', 'refresh');
			}*/
		}
	}
	
	
	protected function displayError()
	{	
		$this->addMainBodyData(mainBodyTitle('Permission Not Granted', COLOUR_RED, COLOUR_RED));
		$this->displayView();
	}
	
	
	protected function displayView()
	{
		$this->load->view('header', $this->headerData);
		$this->load->view('left_sidebar', $this->leftSidebarData);
		$this->load->view('main_body', $this->mainBodyData);
		$this->load->view('right_sidebar', $this->rightSidebarData);
		$this->load->view('footer', $this->footerData);
	}
	
	protected function addHeaderData($data)
	{
		if (is_string($data))
		{
			$this->headerData['headerInfo'] .= $data;
		}
	}
	
	protected function addAdminData()
	{
		
		$this->mainBodyData['currentUser'] = $this->headerData['currentUser'] =  $this->Authenticate->getCurrentUserInfo();
		$configObj = array('key' => 'superAdminPath');
		$superAdmin = $this->Configuration->getByCriteria($configObj,null, null, 'value');
		$this->headerData['logoLink']  = $superAdmin; 
		
		 
	}
	
	
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */