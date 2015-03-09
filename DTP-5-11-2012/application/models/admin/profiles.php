<?php

require_once 'adminmodel.php';

class Profiles extends AdminModel
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = TABLE_PROFILES;

		$this->addPrimaryKey('id');

		$this->load->helper('generatecode');

	}

	public function getActivatedUsers($ids)
	{
		$this->db->select('user_id, activation_code, email, first_name');
		$this->db->from($this->tableName);
		$this->db->join('users', 'users.id = user_profiles.user_id');
		$this->db->where_in('user_id', $ids);
		$results = $this->db->get();
		$results = $results->result();
		if($results)
			return $results;
		else
			return null;

	}

	public function getCumulativeAvg()
	{
		/* $this->db->select('user_id, activation_code, email, first_name');
		$this->db->from($this->tableName);
		$this->db->join('users', 'users.id = user_profiles.user_id');
		$this->db->where_in('user_id', $ids);
		$results = $this->db->get();
		$results = $results->result();
		if($results)
			return $results;
		else
			return null; */
		
	}

	public function getActivatedUser($hash)
	{

		$this->db->select('user_id, activation_code, email, activate_start, has_claimed');
		$this->db->from($this->tableName);
		$this->db->join('users', 'users.id = user_profiles.user_id');
		$this->db->where('activation_code', $hash);

		$results = $this->db->get();
		$results = $results->row();
		if($results)
			return $results;
		else
			return null;

	}


	public function updateUserProfile($object, $key)
	{
		$this->db->where($key);
		$this->db->update($this->tableName, $object);

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;

	}
	

	public function updateUserData($object, $key)
	{
		$this->db->where($key);
		$this->db->update('users', $object);
	
		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;
	
	}


	public function getEmailData($userId)
	{
		$this->db->select('first_name, email, activation_code');
		$this->db->from($this->tableName);
		$this->db->join('users', 'user_profiles.user_id = users.id');
		$this->db->where('user_id', $userId);
		$result = $this->db->get();
		$result = $result->row();

		if(!empty($result))
			return $result;
		else
			return null;
		 
	}
	 
	public function getDispatchCounter()
	{
		$query = "SELECT COUNT(*) as dispatch_count FROM user_profiles WHERE has_claimed = '1'";

		$result = $this->db->query($query);

		if(!empty($result))
			return $result->row();
		else
			return null;
	}

	public function getEligibleParicipantCount()
	{
		 
		$query = "SELECT COUNT(*) AS waiting_recipants FROM user_profiles WHERE has_claimed = 0 AND CURDATE() <= DATE_ADD(activate_start, INTERVAL ". ACTIVATION_EXP/24 ." DAY );";
		 
		$result = $this->db->query($query);

		if(!empty($result))
			return $result->row();
		else
			return null;
		 
	}


	public function updateClearList($ids)
	{
		$query = '';
		$userIds = implode(',', $ids);

		
			$query = "UPDATE $this->tableName
			SET has_cleared = 1
			WHERE user_id in ($userIds)";
			
		$result = $this->db->query($query);

		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;

	}


	public function updateBulk($ids)
	{
		$query = '';
		
		//TODO: Multiple update statements doesnot work
		//HACK: used each statement in loop too costly
		
		foreach($ids as $id)
		{
				
			$query = "UPDATE $this->tableName
			SET send_invitation = 1,
			activation_code = '". generate_code(10) . "' ,
			activate_start = '". date('Y-m-d H:i:s') . "' ".
			"WHERE user_id = $id;";
			$this->db->query($query);
		}
		
		//$result = $this->db->query($query);
		
		if($this->db->affected_rows() > 0)
			return true;
		else
			return false;

	}

}