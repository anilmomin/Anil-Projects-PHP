<?php

/**

 *

 * @category		Model Persistence Class

 * @package			application/models

 * @author			Anil Momin <momin.anil@hotmail.com>

 * @version			Release: 1.0

 */

$path = getcwd(). '/application/models/';

require_once($path . 'persistenceinterface.php');

require_once($path . 'tableconstants.php');



/**	This is the persistence class for all the tables of database.	*/

class AdminModel extends CI_Model implements PersistenceInterface

{

	protected $tableName;

	private $pkArray;



	public function __construct()

	{

		parent::__construct();

        $this->tableName = "";

		$this->pkArray = array();

	}


	protected function addPrimaryKey($primaryKeyColName)

	{

		array_push($this->pkArray, $primaryKeyColName);

	}

	

	public function preparePrimaryKeyArray()

	{

		if (func_num_args() >= count($this->pkArray))

		{

			$result = array();

			$i = 0;

		

			foreach ($this->pkArray as $key => $value)

			{

				$result[$value] = func_get_arg($i++);

			}

			

			return $result;

		}

		

		return null;

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



		$pk = array();



		foreach($this->pkArray as $key)

		{

			$pk[$key] = $primaryKey[$key];

		}

		

		$query = $this->db->get_where($this->tableName, $pk);

		
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

	

	public function update ($object)

	{

		$pk = array();
	
	
		foreach($this->pkArray as $key)

		{
			
			$pk[$key] = $object[$key];

		}

		$this->db->where($pk);

		if ($this->db->update($this->tableName, $object))

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

		$pk = array();



		foreach($this->pkArray as $key)

		{

			$pk[$key] = $primaryKey[$key];

		}



		$this->db->where($pk);

		if ($this->db->delete($this->tableName))

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

		if ($this->db->insert($this->tableName, $object))

		{

			$lastId = $this->db->insert_id();

			return ($lastId) ? $lastId : true;

		}

		else

		{

			return false;

		}			

	}
	
	public function countAll ()
	{
		return $this->db->count_all($this->tableName);
	}

}



?>