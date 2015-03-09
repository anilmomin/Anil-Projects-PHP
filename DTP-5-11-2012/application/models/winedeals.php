<?php

require_once 'ditchthepitchmodel.php';

class WineDeals extends DitchThePitchModel
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = TABLE_WINES;

		$this->addPrimaryKey('wineId');
	}


	public function getLastSevenDeals($startId, $endId, $sort)
	{

		$query = "SELECT *,(SELECT wineryName FROM wineries WHERE wineryId = wn.wineryId) as wineryName,(SELECT regionName from regions WHERE regionId=wn.regionId) as regionName FROM wines AS wn WHERE wineid BETWEEN $startId AND $endId AND wineQuantity > 0 ORDER BY wineId $sort";
		$result = $this->db->query($query);

		if($result)
			return $result->result();
		else
			return null;

	}
	
	public function getByCriteria ($criteria, $limitx = null, $limity = null, $columnNames = '*')
	{
	
		$this->db->select('*');
		$this->db->join('regions r', 'r.regionId = wines.regionId');
		$this->db->join('wineries w', 'w.wineryId = wines.wineryId');
	
	
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

}