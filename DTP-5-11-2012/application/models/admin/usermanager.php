<?php

require_once 'adminmodel.php';

class UserManager extends AdminModel
{
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = TABLE_USERS;
		
		$this->addPrimaryKey('id');
		
	}	
    
    
    /**
     * get_data
     * Returns the new wine request from the user
     * 
     * @param mixed $params This is a description
     * @param mixed $page This is a description
     * @return mixed This is the return value description
     *
     */	
	public function get_data($params = "" , $page = "all")
	{

        $this->db->select("users.id, username, first_name, last_name, email, address, preference, created")->from( $this->tableName);
        $this->db->join ('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->join ('user_preferences', 'user_preferences.user_id = users.id');
        $this->db->where ('is_admin', '0');
        $this->db->where ('send_invitation', '0');
        $this->db->where ('is_sample_user', '1');

		$query = $this->db->get();
		$result = $query->result_array();
		
		return $result;
	}


    /**
     *  get_claimed_data
     *  Returns the successfull candidates for the wines sample
     *  waiting to be dispatched the wines
     * 
     * @param mixed $params This is a description
     * @param mixed $page This is a description
     * @return mixed This is the return value description
     *
     */	
    public function get_claimed_data($params = "" , $page = "all")
    {

        $this->db->select("user_id, username, first_name, last_name, email, address, created")->from( $this->tableName);
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->where ('has_claimed', '1');
        
        $query = '';
        $result = array();
        
        if (!empty($params))
        {
            //echo "1";
            if ( (($params ["num_rows"] * $params ["page"]) >= 0 && $params ["num_rows"] > 0))
            {
                //echo "2";
                if  ($params ["search"] === TRUE)
                {
                    //echo "3";
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
    
    public function get_pending_data($params = "" , $page = "all")
    {
    
    	$this->db->select("user_id, username, first_name, last_name, email, address, created")->from( $this->tableName);
    	$this->db->join('user_profiles', 'user_profiles.user_id = users.id');
    	$this->db->where ('send_invitation', '1');
    	$this->db->where ('has_claimed', '0');
    	
    	$query = '';
    	$result = array();
    
    	if (!empty($params))
    	{
    		//echo "1";
    		if ( (($params ["num_rows"] * $params ["page"]) >= 0 && $params ["num_rows"] > 0))
    		{
    			//echo "2";
    			if  ($params ["search"] === TRUE)
    			{
    				//echo "3";
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
    
    
    public function getuserdata($userid = 0)
    {
    	$this->db->select('users.id, first_name, last_name, dob, email, address, activated')->from( $this->tableName);
    	$this->db->join('user_profiles', 'user_profiles.user_id = users.id');
    	$this->db->where ('is_admin', '0');
    	
    	if($userid)
    		$this->db->where ('users.id', $userid);
    
    	$results = $this->db->get();
    	
    	if($results)
    		return $results->result();
    	else
    		return false;
    }
    
      /**
        * get_dispatched_data
        * Returns the list of users be dispatched the wines
        * 
        * @param mixed $params This is a description
        * @param mixed $page This is a description
        * @return mixed This is the return value description
        *
        */	
    public function get_dispatched_data($params = "" , $page = "all")
    {

        $this->db->select("user_id, username, first_name, last_name, email, address, created")->from( $this->tableName);
        $this->db->join('user_profiles', 'user_profiles.user_id = users.id');
        $this->db->where ('is_admin', '0');
        $this->db->where ('send_invitation', '1');
        $this->db->where ('is_sample_user', '1');
        $this->db->where ('has_claimed', '1');
        $this->db->where ('has_cleared', '1');

        $query = '';
        $result = array();
        
        if (!empty($params))
        {
            //echo "1";
            if ( (($params ["num_rows"] * $params ["page"]) >= 0 && $params ["num_rows"] > 0))
            {
                //echo "2";
                if  ($params ["search"] === TRUE)
                {
                    //echo "3";
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

    
    public function delete($pk)
    {
    	$this->db->where($pk);
    	
    	if ($this->db->delete($this->tableName))
    	{
    		$criteria = array('user_id' => $pk['id']);
    		$this->db->where($criteria);
    		$this->db->delete("user_profiles");
    		
    		return $this->db->affected_rows();
    	}
    	else
    		return false;
    }
	
}