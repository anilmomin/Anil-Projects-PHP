<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Users
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 */

require_once('admincontroller.php');

class WineUsers extends AdminController {

	private $jsString = '';
	private $data = array();
	
	public function __construct()
	{
		parent::__construct();

		$this->load->library(array('tank_auth','form_validation'));
		
		$this->load->Model(array('admin/UserManager', 'admin/WineManager', 'admin/Profiles'));
		
		if (!$this->tank_auth->is_admin_login() )
			redirect('/admin/auth/login');
		
		
	}
	
    public function showincreq()
	{
		$this->addJavaScriptSource('jquery/jquery.ddslick.min.js');
		
		$js = "$('#selectwine').ddslick();$('#selectuser').ddslick();";
		
		
		$this->addJQueryText($js);
		
		$this->data['wineData'] = $this->WineManager->getwinedata();
		$this->data['userData'] = $this->UserManager->get_data();
		
		$this->load->Model('WineDispatches');
		
		if($this->input->post('post')) {
			$wineId = $this->input->post('selectwine');
			$userId = $this->input->post('selectuser');
			
			$insObj = array('user_id' => $userId, 'wineId' => $wineId, 'sample_request_date' => date('Y-m-d H:i:s'));
			$status = $this->WineDispatches->insert($insObj);
			
			if($status){
				
				$statusBit = array('send_invitation' => '1', 'activation_code' => generate_code(10), 'activate_start' => date('Y-m-d H:i:s'));
				
				if($this->Profiles->updateUserProfile($statusBit,array('user_id'=>$userId)));
				{
				
					$user = $this->Profiles->getActivatedUsers($userId);
				
						$this->data['emaildata'] = array(
								'firstname' =>  $user[0]->first_name,
								'activationcode' => $statusBit['activation_code'],
								'user_id' => $userId
						);
				
						$this->_send_email('sampleinvitation', $user[0]->email, $this->data);
					
				}
				
				$this->session->set_flashdata('message', 'Invitation send successfully');
				redirect(site_url('admin/wineusers/showincreq'));
				$this->session->set_flash_data('message', 'Successfully inserted record & sent an invitation email to the user');
				
			}
			
		}
		
		$this->data['mb_data'] = $this->load->view('admin/winerequests', $this->data, true);
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
		 
	}
	
	
	private function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('ditchthepitch_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('admin/email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('admin/email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	
	
	}
	
	
	public function sendinvitation($ids)
	{
       
		$idsarray = explode('-', $ids);	

		if($this->Profiles->updateBulk($idsarray));
		{
			
			$users = $this->Profiles->getActivatedUsers($idsarray);
				
			foreach($idsarray as $key => $ids)
			{
				
				$this->data['emaildata'] = array(
						'firstname' =>  $users[$key]->first_name,
						'activationcode' => $users[$key]->activation_code,
						'user_id' => $users[$key]->user_id,
						);
				
				$this->_send_email('sampleinvitation', $users[$key]->email, $this->data);	
				
			}
		}
		
		$this->session->set_flashdata('message', 'Invitation send successfully');
		redirect(site_url('admin/wineusers/showincreq'));
			
	}
	
    

    /**
     * getNewWineRequests
     *
     * @return json for the grid for fresh wine requests
     *
     */	
    public function getNewWineRequests()
	{
        
		$req_param = array (

			"sort_by" => $this->input->post( "username", TRUE ),
			"sort_direction" => $this->input->post( "sord", TRUE ),
			"page" => $this->input->post( "page", TRUE ),
			"num_rows" => $this->input->post( "rows", TRUE ),
			"search" => $this->input->post( "_search", TRUE ),
			"search_field" => $this->input->post( "searchField", TRUE ),
			"search_operator" => $this->input->post( "searchOper", TRUE ),
			"search_str" => $this->input->post( "searchString", TRUE ),
			);

		$data->page = $this->input->post( "page", TRUE );
		$data->records = count ($this->UserManager->get_data ($req_param,"all"));
		$data->total = ceil ($data->records / 10 );
		$records = $this->UserManager-> get_data ($req_param);
		$data->rows = $records;
		

		echo json_encode ($data );
		exit( 0 );
		
	}
	
	/**
	 * getPendingRequests
	 *
	 * @return json for the grid for Accepted wine requests
	 *
	 */
	
	
	public function getPendingRequests()
	{
	
	
		$req_param = array (
	
				"sort_by" => $this->input->post( "username", TRUE ),
				"sort_direction" => $this->input->post( "sord", TRUE ),
				"page" => $this->input->post( "page", TRUE ),
				"num_rows" => $this->input->post( "rows", TRUE ),
				"search" => $this->input->post( "_search", TRUE ),
				"search_field" => $this->input->post( "searchField", TRUE ),
				"search_operator" => $this->input->post( "searchOper", TRUE ),
				"search_str" => $this->input->post( "searchString", TRUE ),
		);
	
		$data->page = $this->input->post( "page", TRUE );
		$data->records = count ($this->UserManager->get_pending_data ($req_param,"all"));
		$data->total = ceil ($data->records / 10 );
		$records = $this->UserManager->get_pending_data($req_param);
		$data->rows = $records;
	
	
		echo json_encode ($data );
		exit( 0 );
	
	}
	
    
    /**
     * getAcceptedRequests
     * 
     * @return json for the grid for Accepted wine requests
     * 
     */ 


    public function getAcceptedRequests()
    {
        
        
        $req_param = array (

            "sort_by" => $this->input->post( "username", TRUE ),
            "sort_direction" => $this->input->post( "sord", TRUE ),
            "page" => $this->input->post( "page", TRUE ),
            "num_rows" => $this->input->post( "rows", TRUE ),
            "search" => $this->input->post( "_search", TRUE ),
            "search_field" => $this->input->post( "searchField", TRUE ),
            "search_operator" => $this->input->post( "searchOper", TRUE ),
            "search_str" => $this->input->post( "searchString", TRUE ),
            );

        $data->page = $this->input->post( "page", TRUE );
        $data->records = count ($this->UserManager->get_claimed_data ($req_param,"all"));
        $data->total = ceil ($data->records / 10 );
        $records = $this->UserManager->get_claimed_data($req_param);
        $data->rows = $records;
        

        echo json_encode ($data );
        exit( 0 );
        
    }

    /**
     * getClaimedRequest
     * 
     * @return json for the grid for Accepted wine requests
     * 
     */ 


    public function getClaimedRequest()
    {
        
        
        $req_param = array (

            "sort_by" => $this->input->post( "username", TRUE ),
            "sort_direction" => $this->input->post( "sord", TRUE ),
            "page" => $this->input->post( "page", TRUE ),
            "num_rows" => $this->input->post( "rows", TRUE ),
            "search" => $this->input->post( "_search", TRUE ),
            "search_field" => $this->input->post( "searchField", TRUE ),
            "search_operator" => $this->input->post( "searchOper", TRUE ),
            "search_str" => $this->input->post( "searchString", TRUE ),
            );

        $data->page = $this->input->post( "page", TRUE );
        $data->records = count ($this->UserManager->get_dispatched_data ($req_param,"all"));
        $data->total = ceil ($data->records / 10 );
        $records = $this->UserManager->get_dispatched_data($req_param);
        $data->rows = $records;
  
        echo json_encode ($data );
        exit( 0 );
        
    }
    
    /**
     * Clears the list of the dispatched wine requestees
     */
    public function clearlist($ids)
    {
    
    	
    	$idsarray = explode('-', $ids);
    	
    	if($this->Profiles->updateClearList($idsarray));
    	{
    	
    		$users = $this->Profiles->getActivatedUsers($idsarray);
    	
    		
    	}
    	
    	redirect(site_url('admin/wineusers/showincreq'));
    
    }
    
	
}	