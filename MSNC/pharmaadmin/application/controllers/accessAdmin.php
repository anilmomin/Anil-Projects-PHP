<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AccessAdmin extends CI_Controller {

	function __construct() 
	{
		parent :: __construct();	
		$this->load->model(array('Authenticate', 'PharmaAdmin'));
		$this->load->library('encrypt');
	}
	
public function index(){
	redirect(site_url('/accessadmin/accesspharma','redirect'));

}	
	
	
public function accessPharma($access_id = null){
		
	
	
		if(!is_numeric($access_id))
		{
			
			$access_id = $this->encrypt->decode($access_id);
			
			$loginObject = array('pharmaId' => $access_id);
			$pharmaCreditals = $this->PharmaAdmin->getByCriteria($loginObject, null, null, 'adminEmail, adminPassword, canSupportLogin');
			$userName = $pharmaCreditals[0]->adminEmail;
			$userPassword = $pharmaCreditals[0]->adminPassword;
			$supportLogin = $pharmaCreditals[0]->canSupportLogin;
			
			if($supportLogin){
					if($this->Authenticate->login($userName, $userPassword, false, true)){
						
						redirect(site_url('/pharmaaction/'),'redirect');	
					}
					else
					{
						
						redirect(site_url('/login/'),'redirect');
					}
			}
			
			
		}
		else 
		{
			echo "Access Denied!";
		}
		
	}
	
}