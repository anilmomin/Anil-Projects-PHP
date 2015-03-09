<?php
require_once 'msncController.php';
class Profile extends MSNCController {
	
	private $currentUser;
	private $pharmaProfile;
	private $data;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('Authenticate','PharmaAdmin'));
		
		$this->load->library('upload');
				
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|gif';
		$config['max_size']	= '500';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->upload->initialize($config);
		$this->load->library('upload', $config);
		
		$this->currentUser = $this->Authenticate->getCurrentUserInfo();
		$this->Profile = array();
		$this->data = array();
		$this->addJavaScriptText($this->load->view('themejs','',true));
		$this->addAdminData();
	}
	
	
	public function index()
	{ 
			if($this->Authenticate->isLoggedIn()){
					$criteria  = array('pharmaId' => $this->currentUser['pharmaId']);
					
					$this->Profile['pharmaProfile'] = $this->PharmaAdmin->getByCriteria($criteria, null, null, 'pharmaId, name, description, address, phone, fax, website, canSupportLogin, adminName, adminTitle, imageLink');
					$data['mb_data']  = $this->load->view('form_editprofile',$this->Profile,true);
					
					$this->addMainBodyData($data['mb_data']);
					
					$this->displayView();
			}
			else {
				redirect(site_url('/login/'),'redirect');
			}
		
	}

	
	public function forgetPassword(){
		
		if($this->input->post('post'))
		{
			
			$pharmaemail = $this->input->post('pharmaemail');
			$newPassword = md5($this->input->post('newpwd'));
			$confirmpwd = md5($this->input->post('confirmpwd'));
			
			
			$where = array('adminEmail' => $pharmaemail);
			$record = $this->PharmaAdmin->getByCriteria($where, null, null, 'pharmaId');
			
				
			if(!empty($record)){
				
				$update = array('pharmaId' => $record[0]->pharmaId,'adminPassword' => $newPassword);
				
				if($this->PharmaAdmin->update($update)){
					
					$sucess['success_header'] = "Forget Password.";
					$sucess['success_msg'] = "Your password has been mailed to you on ". $pharmaemail ." you can active your account again.";
					/*
						Send Mail Code
					*/
					$this->data['mb_data'] = $this->load->view('password_success',$sucess,true);
					
				}
				else {
					$msg['msg'] = "Request not Completed!";
					$this->data['mb_data'] = $this->load->view('forget_password','',true);
				}
			
				
			}
			else {
				
				$msg['msg'] = "Invalid Email Address provided!";
				$this->data['mb_data'] = $this->load->view('forget_password', $msg , true);
				 	
			}
			
		}
		else
		{
			$this->data['mb_data'] = $this->load->view('forget_password', '' , true);
		}
		
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
		
	}
	
	
	
	public function editPharma()
	{
		if($this->Authenticate->isLoggedIn()) {
			
			$post = $this->input->post('post');
			$uploaded = array();
			
			if($post)
			{

				
				/* Upload Image Code */
								// change it to not
								if (!$this->upload->do_upload('imageupload'))
								{
									$error = array('error' => $this->upload->display_errors());
									$this->addMainBodyData($error);
									
								}
								else {
										$uploaded = $this->upload->data();
										$config['image_library'] = 'gd2';
										$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
										$config['create_thumb'] = FALSE;
										$config['maintain_ratio'] = TRUE;
										$config['width'] = 100;
										$config['height'] = 75; 

										$this->load->library('image_lib', $config); 
										$this->image_lib->resize();	
								}
				
								
								
					/* Complete Pharma Object to be inserted into database */
					$this->pharmaObj['pharmaId'] = $this->input->post('pharmaId');;
					$this->pharmaObj['name'] = $this->input->post('name', true);
					$this->pharmaObj['adminName'] = $this->input->post('adminname', true);
					$this->pharmaObj['adminTitle'] = $this->input->post('admintitle', true);
					$this->pharmaObj['description'] = $this->input->post('description', true);
					$this->pharmaObj['address'] = $this->input->post('address', true);
					$this->pharmaObj['phone'] = $this->input->post('phonenum', true);
					$this->pharmaObj['fax'] = $this->input->post('fax', true);
					$this->pharmaObj['website'] = $this->input->post('website', true);
					if(isset($uploaded['file_name']))
					{
						$this->pharmaObj['imageLink'] = $uploaded['file_name'];
					}
					if($this->input->post('loginsupport') == '')
						$status = 0;
					else
						$status = 1;
					
					$this->pharmaObj['lastupdatedby'] = $this->input->post('adminName');
					$this->pharmaObj['lastupdatedon'] = date('Y-m-d H:i:s', time());
					$this->pharmaObj['canSupportLogin'] = $status;

					
					$this->PharmaAdmin->update($this->pharmaObj);
								
				
					redirect(site_url('pharmaaction/index'), 'redirect');
				
			}
		}
		else 
		{
			redirect(site_url('/login/'),'redirect');
		}
		
	}
	
	
	public function changePassword()
	{
		if($this->Authenticate->isLoggedIn()){
		if($this->input->post('post'))
		{
			
			$oldPassword = md5($this->input->post('currentpwd'));
			$newPassword = md5($this->input->post('newpwd'));
			$confirmpwd = md5($this->input->post('confirmpwd'));
			
			
			$where = array('adminEmail' => $this->currentUser["adminEmail"]);
			$olddbPassword = $this->PharmaAdmin->getByCriteria($where, null, null, 'adminPassword');
			$olddbPassword = $olddbPassword[0]->adminPassword;
				
			if($oldPassword == $olddbPassword){
				$update = array('pharmaId' => $this->currentUser["pharmaId"],'adminPassword' => $newPassword);
				
				if($this->PharmaAdmin->update($update)){
					$sucess['success_header'] = "Change Password.";
					$sucess['success_msg'] = "Password changed successfully.";
					$this->data['mb_data'] = $this->load->view('password_success', $sucess ,true);
					
				}
				else {
					$msg['msg'] = "Same password provived!";
					$this->data['mb_data'] = $this->load->view('change_password',$msg,true);
				}
			
				
			}
			else {
				
				$msg['msg'] = "Invalid password provided!";
				$this->data['mb_data'] = $this->load->view('change_password', $msg , true);
				 	
			}
			
		}
		else
		{
			$this->data['mb_data'] = $this->load->view('change_password', '' , true);
		}
		
		
		
		$this->addMainBodyData($this->data['mb_data']);
		$this->displayView();
		}
		else
		{
			redirect(site_url('/login/'),'redirect');
		}
	}
		
		
		
		
	
}
	?>