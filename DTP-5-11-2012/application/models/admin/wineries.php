<?php

require_once 'adminmodel.php';

class Wineries extends AdminModel
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = TABLE_WINERIES;

		$this->addPrimaryKey('wineryId');
	}
	
	public function getAll ($columnNames = '*', $limitx = null, $limity = null)
	
	{
	
		$this->db->select($columnNames);
	
	
	
		if ($limitx != null && $limity != null)
	
		{
	
			$this->db->limit($limitx, $limity);
	
		}
	
		else if (!empty($limitx))
	
		{
	
			$this->db->limit($limitx);
	
		}
	
		$this->db->order_by('orderId','ASC');
	
		$query = $this->db->get($this->tableName);
	
	
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