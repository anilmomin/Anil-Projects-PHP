<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('ditchthepitchcontroller.php');

class Discussions extends DitchthePitchController {

	private $data;

	private $jsString = '';

	private $perPage = 5;
	
	public function __construct()
	{
		parent::__construct();

		$this->data = array();
		$this->load->Model(array('WineDeals', 'admin/Schedule', 'Discussion'));
		$this->load->helper(array('form','url'));
		$this->load->helper('text');
		$this->load->library(array('form_validation', 'tank_auth', 'pagination'));
		$this->load->library('parser');

		$this->jsString = $this->lang->line('cufon_discussions');
		$this->addJavaScriptText($this->jsString);
		
		$this->days = array(
				'Monday' => 1,
				'Tuesday' => 2,
				'Wednesday' => 3,
				'Thursday' => 4,
				'Friday' => 5,
				'Saturday' => 6,
				'Sunday' => 7
		);

	}

	/**
	 * Main page for the discussions displays the wine of day, side wine discussions
	 * @param int $wineId
	 * @param int $start
	 */
	public function index($wineId = null)
	{
		$perPage = 5;
		$imagePath = base_url('/assets/images/');
		$this->jsString = $this->lang->line('pagination');
		$this->addJQueryText($this->jsString);
		
		// Gets the wine of the day
		$currentDay  = date('l');
		$schedule = $this->Schedule->getLastSchedule(1);

		//Repeates the friday deal for weekends
		if($currentDay == 'Saturday' OR $currentDay == 'Sunday')
			$currentDay = 'Friday';
		
		if(!empty($schedule->Latest) && $schedule->status == '1')
		{
			$criteria = array('winescheduleId' => $schedule->Latest, 'dayId' => $this->days[$currentDay]);
			$this->data['wineofday'] = $this->WineDeals->getByCriteria($criteria);

			// *********Gets the last 7 day wines
			$prevWineIdLast = $this->data['wineofday'][0]->wineId - 1 . " ";
			$prevWineIdFirst = $prevWineIdLast - 4;
			$this->data['lastwines']  = $this->WineDeals->getLastSevenDeals($prevWineIdFirst, $prevWineIdLast, 'DESC');
				
			// get discussions by wineId
			if(empty($wineId))
				$wineId = $this->data['wineofday'][0]->wineId;
			
			if(is_numeric($wineId))
			{
				// setting array for pagination
				$config['base_url'] = site_url('discussions/getmorethreads/' . $wineId);
			    $config['total_rows'] = $this->Discussion->getTotalRecords($wineId);
			    //$config['uri_segment'] = 4;
			    $config['per_page'] = $perPage;
			    $end = $config['per_page'];
			    $config['display_pages'] = FALSE;
			    $config['next_link'] = '<img src="'.$imagePath.'/view_more.png">';
			    $config['last_link'] = false;
			    $config['first_link'] = false;
			    $this->data['threads'] = $this->Discussion->getDiscussionData($wineId, 0, $end);
			
			    $this->pagination->initialize($config);
			    $this->data['pagination'] = $this->pagination->create_links();
			    
			    $this->data['mb_data'] = $this->load->view('discuss/discussions', $this->data, true);
			    
			}
			// end of get disscussion part
		}
		else
		{
			$this->data['datedealstarts'] = "The Next deal starts on Monday at 12:00 AM";
			$this->data['mb_data']  = $this->load->View('discuss/discussions', $this->data, true);
		}
		
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
	}

	/**
	 * Gets more thread based on the wineId and the start of record
	 * @param int $wineId
	 * @param int $start
	 */
	public function getmorethreads($wineId = 0, $start = 0)
	{
		$perPage = 5;
		$imagePath = base_url('/assets/images/');
		
		if(is_numeric($wineId) && is_numeric($start))
		{
			// setting array for pagination
			$config['base_url']   = site_url('discussions/getmorethreads/' . $wineId);
			$config['total_rows'] = $this->Discussion->getTotalRecords($wineId);
			$config['per_page']   = $perPage;
			$config['uri_segment'] = 4;
			$config['display_pages'] = FALSE;
			$config['next_link'] = '<img src="'.$imagePath.'/view_more.png">';
			$config['prev_link'] = '<img src="'.$imagePath.'/prev.png">';
			$config['last_link'] = false;
			$config['first_link'] = false;
			
			$this->data['threads'] = $this->Discussion->getDiscussionData($wineId, $start, $perPage);
		
			$this->pagination->initialize($config);
			$this->data['pagination'] = $this->pagination->create_links();
		
		}
		else
			echo "No data Available";
		
		echo $this->load->view('discuss/commentpane', $this->data, true); 
	}
	

	
	/**
	 * Saves the comment from the user
	 */	
	public function savepost()
	{
		if(!$this->tank_auth->is_logged_in())
		{
			$this->session->set_flashdata('errormsg', "Login required for posting discussion");
			redirect('/');
		}

		if($this->input->post('post'))
		{
			$this->form_validation->set_rules('commentbox', 'Comment', 'trim|required|xss_clean');

			if ($this->form_validation->run())
			{
				$insertObj = array(
						'comment' => $this->form_validation->set_value('commentbox'),
						'wineId' =>	$this->input->post('wineid'),
						'userId' =>	$this->tank_auth->get_user_id(),
						'created_date' => date('Y-m-d H:i:s')
				);

				if($this->Discussion->insert($insertObj))
					if(!$this->input->post('daywine')) 
						redirect(site_url('discussions/index/' . $this->input->post('wineid')));
					else 
						redirect(site_url('discussions/index/'));
			}
			else
				redirect(site_url('/'));

		}
	}
	
}
?>