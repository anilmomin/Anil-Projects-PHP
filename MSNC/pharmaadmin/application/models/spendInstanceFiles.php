<?php

/**

 *

 * @category		Model Persistence Class

 * @package			system/application/models

 * @author			Creative Chaos

 * @version			Release: 0.2
 
 
 */


require_once 'msncAdminModel.php';

class SpendInstanceFiles extends MSNCAdminModel {
	 	
 	/**
	  *	@link	tableConstants.inc
	  */
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = TABLE_SIFILES;
		
		$this->addPrimaryKey('fileId');
	}
	
	public function getFileStatus($columnNames = '*', $criteria, $limitx = null, $limity = null){
		
		$sql = 'SELECT ' . $columnNames . ',currentStatusSetOn FROM '. $this->tableName . ' sf, spendinstancesfilesstatuses sp';
		$sql .= " WHERE sf.StatusId = sp.statusId AND " . $criteria . " ORDER BY currentStatusSetOn desc";

		if($limitx)
		{
			$sql .= " LIMIT ". $limitx;
		}
		
		if($limity)
		{
			$sql .=  ", ". $limity;
		}
		
	
		$query = $this->db->query($sql);
		
		 		 	
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
	
	
	
	public function getLatestFile($columnNames = '*', $criteria, $limitx = null, $limity = null) 
	{
		
		$sql = 'SELECT ' . $columnNames . ' FROM '. $this->tableName;
		$sql .= $criteria; 
		
		$query = $this->db->query($sql);
		
		 		 	
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
	
 	
}

?>