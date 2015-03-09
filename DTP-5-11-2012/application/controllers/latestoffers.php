<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('ditchthepitchcontroller.php');

	
class LatestOffers extends DitchthePitchController 
{
	
	private $data;
	
	private $jsString = '';
	
	private $days = array(
			'Monday' => 1,
			'Tuesday' => 2,
			'Wednesday' => 3,
			'Thursday' => 4,
			'Friday' => 5,
			'Saturday' => 6,
			'Sunday' => 7
	);

	public function __construct()
	{
		parent::__construct();
		
		$this->data = array();
		
		$this->jsString = $this->lang->line('cufon_latestoffer');
		$this->addJavaScriptText($this->jsString);
		
		
		$this->load->library('pagination');
		
		$this->load->Model(array('admin/WineManager', 'WineDeals', 'Regions' , 'admin/Schedule'));
      
	}
	
	private function _getthedeals()
	{
		
		$currentDay  = date('l');//'Friday';
		$schedule = $this->Schedule->getLastSchedule(1);
		$newSchedule = $this->Schedule->getLastSchedule(2);
		
		/**
		 * Repeates the friday deal for weekends
		 */
		
		if($currentDay == 'Saturday' OR $currentDay == 'Sunday')
			$currentDay = 'Friday';
		
		if(!empty($schedule->Latest) && $schedule->status == '1')
		{
			$criteria = array('winescheduleId' => $schedule->Latest, 'dayId' => $this->days[$currentDay]);
			$this->data['wineofday'] = $this->WineDeals->getByCriteria($criteria);
		
			// *********Gets all the wines before the wine of the day
			//regions
			
			$prevWineIdLast = $this->data['wineofday'][0]->wineId - 1;
			$prevWineIdFirst = $prevWineIdLast-9;
			
			$currentDayWine = $this->data['wineofday'][0]->wineId;
			 
			 $currentWeekWines  = $this->WineDeals->getLastSevenDeals($currentDayWine + 1, $currentDayWine + 5, 'ASC');
			 
			 $lastWeekWines = $this->WineDeals->getLastSevenDeals($prevWineIdFirst, $prevWineIdLast, 'DESC');

			 // Merge both the current week wines & last week wines and get the first 6 records
			 $totalWines = array_merge($currentWeekWines, $lastWeekWines);
			 $this->data['lastwines'] = $totalWines;// = array_slice($totalWines,0,4);
			 
			array_push($this->data['lastwines'],$this->data['wineofday'][0]);
			
			$this->data['allwines']  = $this->WineDeals->getLastSevenDeals(0, $prevWineIdLast, 'DESC');
		
		}
		else
			$this->data['allwines'] = null;
		
		return $this->data['lastwines'];
		
	}
	
	public function index($start = 0)
	{
		// Load the wines from database
		$perPage = 10;
		$imagePath = base_url('/assets/images/');
		$deals = $this->_getthedeals();
		
		// Configuration for Pagination
		$config['base_url']   = site_url('latestoffers/index/');
		$config['total_rows'] = count($deals);
		$config['per_page']   = $perPage;
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li>';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		$this->data['pagination'] = $this->pagination->create_links();
		
		
		// Next only pagination
		$config['prev_link'] = false;
		$config['display_pages'] = false;
		$config['prev_tag_open'] = '';
		$config['prev_tag_close'] = '';
		$config['next_tag_open'] = '';
		$config['next_tag_close'] = '';
		$config['cur_tag_open'] = '';
		$config['cur_tag_close'] = '';
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';
		$config['next_link'] = '<img src="'.$imagePath.'/btnNext.png">';
		$this->pagination->initialize($config);
		$this->data['nextpagination'] = $this->pagination->create_links();
		
		
		// End Configuration
		
		if($deals)
		foreach ($deals as $wine)
			$wineIds[] =  $wine->wineId;
		
		$this->data['wines'] = $this->WineManager->getwineByIds($wineIds, $perPage, $start);
		$this->data['regions']= $this->Regions->getAllRegions();
		
		//print_r($this->data['wines']);
		$this->data['wines'] = array_slice($this->data['wines'],5);
		rsort($this->data['wines']);
		//print_r($this->data['wines']);
		
		$latestOffers = $this->load->view('latestoffer', $this->data, true);
		$this->addMainBodyData($latestOffers);
		$this->displayView();
	}
	
}
?>