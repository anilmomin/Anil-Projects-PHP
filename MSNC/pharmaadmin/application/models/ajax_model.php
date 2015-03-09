<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @category  CodeIgniter
 * @package   EVD CMS
 * @author    Frederico Carvalho
 * @copyright 2008 Mentes 100Limites
 * @version   0.1
 */

require_once 'tableConstants.php';

class Ajax_model extends CI_Model 
{
	
	protected $CI;
	
	public function Ajax_model()
    {
        parent::__construct();
        
		$this->CI =&get_instance();
    }
	
    
    public function get_pharmas()
    {
    	$this->db->select('pharmaId, name, description, website, createdon, lastupdatedon, lastupdatedby, lastLogin, adminName, isActive, canSupportLogin')->from(TABLE_PHARMA)->where('isActive','1');
		$this->CI->flexigrid->build_query();
		
		//Get contents
		$return['records'] = $this->db->get();
		
		//Build count query
		$this->db->select('count(pharmaId) as record_count')->from(TABLE_PHARMA);
		$this->CI->flexigrid->build_query(FALSE);
		$record_count = $this->db->get();
		$row = $record_count->row();
		
		//Get Record Count
		$return['record_count'] = $row->record_count;
	
		//Return all
		return $return;	
    	
    	
    }
    
    
	public function delete_pharma($pharmaId) 
	{
		$delete_pharmas = $this->db->query('UPDATE '. TABLE_PHARMA .' SET isActive = 0 WHERE pharmaId='.$pharmaId);
		return TRUE;
	}
}
?>