<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('ditchthepitchcontroller.php');

	
class WineDetails extends DitchthePitchController {
	
	private $data;
	
	private $jsString = '';
	

	public function __construct()
	{
		parent::__construct();
		
		$this->data = array();
		
		$this->jsString = $this->lang->line('cufon_details');
		$this->addJavaScriptText($this->jsString);
		
		$this->load->Model(array('admin/WineManager', 'WineFeedback'));
		
	}
	
	public function index($wineId = null)
	{
		if(!empty($wineId))
		{
			$this->data['pageData'] = $this->WineManager->getwinedata($wineId);
			//$this->data['feedbackPrice'] = $this->WineFeedback->getAvgPrice($wineId);
			$this->data['feedback'] = $this->WineFeedback->getAvgPrice($wineId);
			$this->data['mb_data'] = $this->load->View('detailspage', $this->data , true);
			$this->addMainBodyData($this->data['mb_data']);
			$this->displayView();
			
		}
		
	}
}