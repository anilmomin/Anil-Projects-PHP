<?php

require_once 'adminmodel.php';

class Schedule extends AdminModel
{
	public function __construct()
	{
		parent :: __construct();
		$this->tableName = TABLE_SCHEDULE;
		
		$this->addPrimaryKey('winescheduleId');
	}
	
	public function getLastSchedule($statusid = 1)
	{
		
		$query = $this->db->query("Select Max(winescheduleId) as Latest, status From wine_schedule Where status = $statusid");
		$result = $query->row();
		
		if (!empty($result->Latest))
		{
			return $result;
			
		}
		elseif ($statusid == 2 && empty($result->Latest))
		{
			$query = $this->db->query("Select Max(winescheduleId) as Latest, status From wine_schedule Where status = 1");
			return $query->row();
		}
		else 
		{
			return null; 
		}
		
		
	}
		
		
	
	
}

?>