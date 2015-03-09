<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Ajax extends CI_Controller {

	function Ajax ()
	{
		parent :: __construct();	
		$this->load->model('ajax_model');
		$this->load->library('flexigrid');
	}
	
	function index()
	{
		//List of all fields that can be sortable. This is Optional.
		//This prevents that a user sorts by a column that we dont want him to access, or that doesnt exist, preventing errors.
		$valid_fields = array('pharmaId','name','description');
		
		$this->flexigrid->validate_post('pharmaId','asc',$valid_fields);

		$records = $this->ajax_model->get_pharmas();
		
		$this->output->set_header($this->config->item('json_header'));
		
		/*
		 * Json build WITH json_encode. If you do not have this function please read
		 * http://flexigrid.eyeviewdesign.com/index.php/flexigrid/example#s3 to know how to use the alternative
		 */
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array($row->pharmaId,
			$row->pharmaId,
			$row->name,
			'<span style=\'color:#ff4400\'>'.addslashes($row->description).'</span>',
			//$row->website,
			//$row->createdon,
			//$row->lastupdatedon,
			$row->lastupdatedby,
			//$row->lastLogin,
			$row->adminName,
			$row->isActive,
			//$row->canSupportLogin,
			'<a href=\'viewpharma/'.$row->pharmaId.'/\'><img border=\'0\' alt=\'view\' title=\'view\' src=\''.$this->config->item('base_url').'assets/images/details.png\'></a> <a href=\'pharmaForm/editpharma/'.$row->pharmaId.'/\'><img border=\'0\' alt=\'edit\' title=\'edit\' src=\''.$this->config->item('base_url').'assets/images/edit.png\'></a>&nbsp;'
			
			);
		}
		//Print please
		$this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
	}
	
	
	//Delete Country
	function deletec()
	{
		$pharma_ids_post_array = explode(",",$this->input->post('items'));
		
		foreach($pharma_ids_post_array as $index => $pharma_id)
			if (is_numeric($pharma_id) && $pharma_id > 1) 
				$this->ajax_model->delete_pharma($pharma_id);
						
			
		//$error = "deleted with success";

		//$this->output->set_header($this->config->item('ajax_header'));
		//$this->output->set_output($error);
	}
}
?>