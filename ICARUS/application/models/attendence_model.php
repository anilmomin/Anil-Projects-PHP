<?php
/**
 *
 * @category		Model Persistence Class
 * @package			system/application/models
 * @author			Rizwan , Anil and Shehzad 
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 0.1
 */
 
 require_once('persistenceInterface.inc');
 require_once('tableConstants.inc');
 
 Class Attendence_Model Extends Model implements persistenceInterface
 {
  const TABLE_NAME =  TABLE_ATTEND;
  
  public function getAll($columnNames ='*',$limitx=null,$limity=null)
  {
        $this->db->select($columnNames);
        
		if (!empty($limitx) && !empty($limity))
		{
			$this->db->limit($limitx, $limity);
		}
		else if (!empty($limitx))
		{
			$this->db->limit($limitx);
		}
		
		$query = $this->db->get(self::TABLE_NAME);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return null;
		}
	
    }

	public function getByPrimaryKey($primaryKey, $limitx = null, $limity = null, $columnNames = '*')
	{
	    $this->db->select($columnNames);
		
		if (!empty($limitx) && !empty($limity))
		{
			$this->db->limit($limitx, $limity);
		}
		else if (!empty($limitx))
		{
			$this->db->limit($limitx);
		}
		
		$query = $this->db->get_where(self::TABLE_NAME, array('studentID' => $primaryKey['studentID'],'			lectureId' => $primarykey['lectureId']));
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return null;
		}
		
	}
	public function getByCriteria ($criteria, $limitx = null, $limity = null, $columnNames = '*')
	{
		$this->db->select($columnNames);
		
		if (!empty($limitx) && !empty($limity))
		{
			$this->db->limit($limitx, $limity);
		}
		else if (!empty($limitx))
		{
			$this->db->limit($limitx);
		}
		
		$this->db->where($criteria);
		
		$query = $this->db->get(self::TABLE_NAME);
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return null;
		}
	}  
	public function update ($object)
	{
		$this->db->where('studentID', $object['studentID'],'lectureId', $object['lectureID']);
		if ($this->db->update(self::TABLE_NAME, $object))
		{
			return $this->db->affected_rows();
		}
		else
		{
			return false;
		}
	}
	public function delete ($primaryKey)
	{
	 	$this->db->where(array('studentID' => $primaryKey['studentID'], 'lectureId' => $primaryKey['lectureId']));
		if ($this->db->delete(self::TABLE_NAME))
		{
			return $this->db->affected_rows();
		}
		else
		{
			return false;
		}
	}
	public function insert ($object)
	{
		if ($this->db->insert(self::TABLE_NAME, $object))
		{
                        $lastId = $this->db->insert_id();
			return ($lastId) ? $lastId : true;
		}
		else
		{
			return false;
		}
	}	
}


?>