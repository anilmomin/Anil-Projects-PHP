<?php

require_once 'ditchthepitchmodel.php';

class WineFeedback extends DitchThePitchModel
{
    public function __construct()
    {
        parent::__construct();
        
        $this->tableName = TABLE_WINEFEEDBACK;
        
        $this->addPrimaryKey('winefeedbackId');
    }

    /**
     * getwineFeedback
     * Returns the Feedback
     *
     * @param mixed $params This is a description
     * @param mixed $page This is a description
     * @return mixed This is the return value description
     *
     */
    public function getFeedback($params = "" , $page = "all")
    {
    
    	$this->db->select("*")->from( $this->tableName);
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
    
    public function getAvgPrice($wineId)
    {
    	$this->db->select_avg('estimateValue');
    	$this->db->where('wineId', $wineId);
    	$result = $this->db->get($this->tableName);
    	
    	if($result)
    		return $result->result();
    	
    	return null;
    }
    
    
    public function getFeedBackDate($userId)
    {
    
    	$this->db->select('claim_date');
    	$this->db->from('user_profiles');
    	$this->db->where('user_id', $userId);
    	$results = $this->db->get();
    	$results = $results->row();
    	if($results)
    	{
    		return $results;
    	
    	}
    	else
    	{
    		return null;
    	}
    
    }

}
?>