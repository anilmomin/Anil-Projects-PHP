<?php

/**

 *

 * @category		Model Persistence Class

 * @package			system/application/models

 * @author			Creative Chaos

 * @version			Release: 0.2
 
 
 */


require_once 'msncAdminModel.php';

class SpendInstances extends MSNCAdminModel {
	 	
 	/**
	  *	@link	tableConstants.inc
	  */
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = TABLE_SPENDINSTANCES;
		
		$this->addPrimaryKey('SIID');
	}
	
 	public function getAllDistinct($columnNames = '*', $limitx = null, $limity = null)
	
 	{
		$query = $this->db->query('SELECT DISTINCT ' . $columnNames . ' FROM '. $this->tableName);
				
		if ($query)
		{
			if ($query->num_rows() > 0)
			{
				return $query->result();
			}
			else
			{
				return null;
			}
		}
		
		return null;	
	}
	
	public function getReport($criteria){
		$sql = 'SELECT currentStatusId, InstanceDate, physicianName,  CONCAT(address1, address2) as address, speciality, amount, spendMode, spendNature, drugName From '. TABLE_SPENDINSTANCES;
		$sql .= ' WHERE 1 = 1' . $criteria;
		$query = $this->db->query($sql);
		
		
		
		if($query){
			if ($query->num_rows() > 0)
				{
					
					
					return $query->result();
				}
				else
				{
					return null;
				}
		}
		
	}
	
	
	
}

?>