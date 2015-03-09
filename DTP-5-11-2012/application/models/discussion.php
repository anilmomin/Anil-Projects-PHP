<?php

require_once 'ditchthepitchmodel.php';

class Discussion extends DitchThePitchModel
{
    public function __construct()
    {
        parent::__construct();
        
        $this->tableName = TABLE_DISCUSSIONTHREADS;
        
        $this->addPrimaryKey('threadId');
    }
    
    /**
     * Gets total Record for the Discussion of specific wine
     * @param int $wineId
     */
    public function getTotalRecords($wineId)
    {
    	$this->db->where('wineId', $wineId);
    	$result = $this->db->get($this->tableName);
    	return $result->num_rows();
    }
    
    
    /**
     * Get Paged Discussion of a specific wine
     * @param int $wineId
     * @param int $perPage
     * @return Paged discussions of a particular wine 
     */
    public function getDiscussionData($wineId, $start, $offset)
    {
    	 $query_string = "SELECT CONCAT(first_name, \" \" ,last_name) as `name`, `comment`, DATEDIFF(CURDATE(), created_date) as day_ago, created_date
    	 FROM (`discussion_threads`)
    	 JOIN `users` ON `userId` = `id`
    	 WHERE `wineId` = ?
    	 ORDER BY created_date DESC
    	 LIMIT $start, $offset";
    	
    	$query = $this->db->query($query_string, array($wineId));
    	
  		if($query->num_rows() > 0)
    		return $query->result();	
    	else
    		return null;	
    }
    
    
    /**
     * Get All Discussion of a specific wine
     * @param int $wineId
     * @param int $perPage
     * @return Paged discussions of a particular wine
     */
    public function getAllDiscussions($start, $offset)
    {
    	$query_string = "SELECT wineId, CONCAT(first_name, \" \" ,last_name) as `name`, `comment`, DATEDIFF(CURDATE(), created_date) as day_ago, created_date
    	FROM (`discussion_threads`)
    	JOIN `users` ON `userId` = `id`
    	ORDER BY created_date DESC
    	LIMIT $start, $offset";
    	
    	$query = $this->db->query($query_string);
    
    	if($query->num_rows() > 0)
    		return $query->result();
    	else
    		return null;
    }
    
    
}

?>
