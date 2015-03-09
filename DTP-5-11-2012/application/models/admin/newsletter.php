<?php

require_once 'adminmodel.php';

class Newsletter extends AdminModel
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = TABLE_NEWSLETTER;

		$this->addPrimaryKey('newsletterId');
	}
	
	
	/**
	 * getNewLetters
	 * Returns the newletters
	 *
	 * @param mixed $params This is a description
	 * @param mixed $page This is a description
	 * @return mixed This is the return value description
	 *
	 */
	public function getNewsLetters($params = "" , $page = "all")
	{
		
		$this->db->select("newsletterId, heading, newsltrtext, created_date, status")->from( $this->tableName);
		$query = '';
		$result = array();
	
		if (!empty($params))
		{
			
			if ( (($params ["num_rows"] * $params ["page"]) >= 0 && $params ["num_rows"] > 0))
			{
				
				if  ($params ["search"] === TRUE)
				{
					
					$ops = array (
	
							"eq" => "=",
							"ne" => "<>",
							"lt" => "<",
							"le" => "<=",
							"gt" => ">",
							"ge" => ">="
					);
	
				}
	
				if ( !empty ($params['search_field_1']))
				{
					$this->db->where ($params['search_field_1'], $params['user_id']);
				}
	
				if ( !empty ($params['search_field_2']))
				{
					$this->db->where ($params['search_field_2'], "1");
				}
	
				if ($page != "all")
				{
					$this->db->limit ($params ["num_rows"], $params ["num_rows"] * ($params ["page"] - 1) );
				}
	
				$query = $this->db->get();
				$result = $query->result_array();
			}
		}
		else
		{
			$this->db->limit (5);
			$query = $this->db->get ($this->_table);
			$result = $query->result_array();
	
		}
		
		return $result;	
	}
	
}