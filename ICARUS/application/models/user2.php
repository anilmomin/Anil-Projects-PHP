<?php

/**
 *
 * @category		Model Persistence Class
 * @package			system/application/models
 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 0.2
 */

require_once('persistenceInterface.inc');
require_once('tableConstants.inc');

/**	This is the persistence class for the users table of database.	*/
class User extends Model implements PersistenceInterface
{
	/**
	  *	@link	tableConstants.inc
	  */
	const TABLE_NAME = TABLE_MEMBER;
	
	/**
	  * This is the constructor and will create User model, which would be inherited from CodeIgniter's Model class.
	  * @method	constructor
	  * 
	  * @return	Model	the return of this method i.e constructor would be the model it self, hence model is the
	  *					return type with some extended functions as this is an inherited model.
	  */
	  
	public function __construct()
	{
		parent::Model();
	}

	public function getAll ($columnNames = '*', $limitx = null, $limity = null)
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
	
	public function getByPrimaryKey ($primaryKey, $limitx = null, $limity = null, $columnNames = '*')
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
		
		$query = $this->db->get_where(self::TABLE_NAME, array('memberId' => $primaryKey['memberId']));
		
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
		$this->db->where('memberId', $object['memberId']);
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
		$this->db->where('memberId', $primaryKey['memberId']);
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
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}			
	}
}

?>