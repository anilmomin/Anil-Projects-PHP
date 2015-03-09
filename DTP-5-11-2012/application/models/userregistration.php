<?php

require_once 'ditchthepitchmodel.php';

class UserRegistration extends DitchThePitchModel
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = TABLE_USERS;

		$this->addPrimaryKey('id');
	}

	public function getEmailData($emailKey)
	{
		$this->db->select('first_name, last_name, email, preference');
		$this->db->from($this->tableName);
		$this->db->join('user_preferences', 'user_id = id');
		$this->db->where('new_email_key', $emailKey);
		$result = $this->db->get();
		$result = $result->row();

		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return null;
		}

	}

	
	public function alreadyUser($userEmail)
	{
		$this->db->select('id, is_sample_user');
		$this->db->from($this->tableName);
		$this->db->where('email', $userEmail);
		$result = $this->db->get();
		$result = $result->row();
		
		if(!empty($result))
			return $result;
		else
			return false;
		
	}
	
	
	public function hasProvidedFeedback($id)
	{
		
		$this->db->where('user_id', $id);
		$this->db->from('wine_feedback');
		$feedback_count = $this->db->count_all_results();
		
		if($feedback_count > 0)
		{
			
				$this->db->where('user_id', $result->id);
				$this->db->from('wine_dispatches');
				$wineDispatches_count =  $this->db->count_all_results();
			
				if($feedback_count != $wineDispatches_count)
					return false;
				else
					return true;
				
		}
		else
			return false;
	}
	function getNewsletterUsers(){
		$this->db->select('username, email');
		$this->db->from($this->tableName);
		//$this->db->where('is_sample_user', 0);
		$this->db->where_in('id', array(59,71));

		$result = $this->db->get();
		$result = $result->result();
		
		if(!empty($result))
			return $result;
		else
			return false;
	}
}
?>