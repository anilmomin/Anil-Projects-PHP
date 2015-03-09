<?php

require_once 'adminmodel.php';

class News extends AdminModel
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = TABLE_NEWS;

		$this->addPrimaryKey('newsId');
	}
	
	
	/**
	 * getNews
	 * Returns the news
	 *
	 * @param mixed $params This is a description
	 * @param mixed $page This is a description
	 * @return mixed This is the return value description
	 *
	 */
	public function getNews($params = "" , $page = "all")
	{
	
		$this->db->select("newsId, news, created_date")->from( $this->tableName);
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
	
				//$this->db->order_by( "{$params['sort_by']}", $params ["sort_direction"] );
	
				if ($page != "all")
				{
					$this->db->limit ($params ["num_rows"], $params ["num_rows"] *  ($params ["page"] - 1) );
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
	
	
		$this->db->order_by('newsId', 'desc');
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