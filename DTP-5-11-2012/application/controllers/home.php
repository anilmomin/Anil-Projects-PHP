<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 * @note 			This project is yet another example of 
 */

require_once('ditchthepitchcontroller.php');

	
class Home extends DitchthePitchController {
	
	private $data;
	
	private $days;
	
	private $jsString = '';
	

	public function __construct()
	{
		parent::__construct();
		
		$this->data = array();
		
		$this->load->Model(array('WineDeals', 'Discussion' ,'admin/Schedule', 'admin/Profiles', 'admin/News', 'WineFeedback'));
		
		$this->days = array(
			 'Monday' => 1,
			 'Tuesday' => 2,
			 'Wednesday' => 3,
			 'Thursday' => 4,
			 'Friday' => 5,
			 'Saturday' => 6
		);
	}
	
	
	// Index page
	
	public function index()
	{
		//$this->output->cache(3);
		$this->load->library('Tank_auth');
		$this->jsString = $this->lang->line('homeform');
		$this->addJavaScriptText($this->jsString);
		$this->addJavaScriptSource('jcarousellite.min.js');
		$this->jsString = $this->lang->line('newsticker');
		$this->addJQueryText($this->jsString);
		
		// ********* Gets the News ******** 
		
		$this->data['newsdata'] = $this->News->getAll('*', 10, 0);
		
		
		// ********* Gets the Discussions ********
		
		//$this->data['discussiondata'] = $this->Discussion->getAllDiscussions(0, 10);
				
		// *********Gets the wine of the day ******** 
		
	        $currentDay  = date('l'); //  'Friday';
	        //temporarily override day.
		$currentDay = 'Friday';
		
		$schedule = $this->Schedule->getLastSchedule(1);
		$newSchedule = $this->Schedule->getLastSchedule(2);
		
		if(($currentDay == 'Monday' || $currentDay == 'Tuesday')  && $newSchedule->status == 2)
		{
			
			/**
			 *  Drops the current deal by setting to zero
			 */
			if( !empty($schedule->Latest)){
				$update = array(
					'winescheduleId' => $schedule->Latest,
					'status' => 0,
					);
				
				$this->Schedule->update($update);
			}
			/**
			 *  Initiates the pending deal by changing status from pending to active
			 *  pending = 2
			 *  active = 1
			 *  inactive = 0
			 */ 
			$update = array(
							'winescheduleId' => $newSchedule->Latest,
							'status' => 1,
							);
			
			$this->Schedule->update($update);
			
			$schedule = $this->Schedule->getLastSchedule();
			
		}
		
		/**
		 * Repeates the friday deal for weekends
		 */ 
		
        if($currentDay == 'Saturday')
			$currentDay = 'Friday';
		
		
		if(!empty($schedule->Latest) && $schedule->status == '1')
		{
			$criteria = array('winescheduleId' => $schedule->Latest, 'dayId' => $this->days[$currentDay]);
		
		
			$this->data['wineofday'] = $this->WineDeals->getByCriteria($criteria);
			
			
		
			// *********Gets the last 7 day wines
			
			 $prevWineIdLast = $this->data['wineofday'][0]->wineId - 1;
			 $prevWineIdFirst = $prevWineIdLast - 4;
			 
			  
			 $currentDayWine = $this->data['wineofday'][0]->wineId;
			 
			 $currentWeekWines  = $this->WineDeals->getLastSevenDeals($currentDayWine + 1, $currentDayWine + 5, 'ASC');
			 $lastWeekWines = $this->WineDeals->getLastSevenDeals($prevWineIdFirst, $prevWineIdLast, 'DESC');

			 // Merge both the current week wines & last week wines and get the first 6 records
			 $totalWines = array_merge($currentWeekWines, $lastWeekWines);
			 $this->data['lastwines'] = $totalWines = array_slice($totalWines,0,4);
			 
			 $temp_arr = $this->data['lastwines'];
			 array_push($temp_arr,$this->data['wineofday'][0]);
			 //print_r(count($this->data['lastwines']));
			 $rand = rand(0,count($this->data['lastwines']));
			 $this->data['wineofday'][0] = $temp_arr[$rand];
			 
			 // ********* Get Avg Feedback Price *****
			
			$this->data['feedback'] = $this->WineFeedback->getAvgPrice($this->data['wineofday'][0]->wineId);
			//print_r($this->data['feedback']);
			 
			 //print_r($this->data['wineofday'][0]);
			 unset($temp_arr[$rand]);
			 $this->data['lastwines'] = $temp_arr;
			 unset($temp_arr);
			 $this->data['mb_data']  = $this->load->View('home', $this->data, true);
			
		}
		elseif(!empty($schedule->Latest) && $schedule->status == '2')
		{
			$this->data['datedealstarts'] = "The Next deal starts on Monday at 12:00 AM";
			$this->data['mb_data']  = $this->load->View('home', $this->data, true);
		}
		else 
		{
			$this->data['datedealstarts'] = "The Next deal starts on Monday at 12:00 AM";
			$this->data['mb_data']  = $this->load->View('home', $this->data, true);
		}
		
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
		
	}
	
	// How it works
	
	public function howitworks()
	{
		//$this->output->cache(30);
		$howitwork = $this->load->view('howitwork', null, true);  
		$this->addMainBodyData($howitwork);
		$this->displayView();
		
	}
	
	//History
	
	public function history()
	{
		//$this->output->cache(30);
		$history = $this->load->view('history', null, true);
		$this->addMainBodyData($history);
		$this->displayView();
		
	}
	
	public function awards()
	{
		$awards = $this->load->view('awards', null, true);
		$this->addMainBodyData($awards);
		$this->displayView();
	}
	
	
	// FAQS
	
	public function faqs()
	{
		//$this->output->cache(30);
		$faqs = $this->load->view('faqs', null, true);
		$this->addMainBodyData($faqs);
		$this->displayView();
		
	}
	
	// Privacy
	public function privacy()
	{
		//$this->output->cache(30);
		$privacy = $this->load->view('privacy', null, true);
		$this->addMainBodyData($privacy);
		$this->displayView();
	}
	
	// About us
	public function aboutus()
	{
		//$this->output->cache(30);
		$aboutus = $this->load->view('aboutus', null, true);
		$this->addMainBodyData($aboutus);
		$this->displayView();
	}
	
	// Terms and Conditions
	
	public function terms()
	{
		//$this->output->cache(30);
		$terms = $this->load->view('terms', null, true);
		$this->addMainBodyData($terms);
		$this->displayView();
	}
}


?>