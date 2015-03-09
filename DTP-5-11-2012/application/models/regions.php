<?php

require_once 'ditchthepitchmodel.php';

class Regions extends DitchThePitchModel
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = 'regions';

		$this->addPrimaryKey('regionId');
	}


	public function getAllRegions()
	{

		$query = "SELECT * FROM regions;";
		$result = $this->db->query($query);

		if($result)
			return $result->result();
		else
			return null;

	}

}