<?php

require_once 'ditchthepitchmodel.php';

class WineDispatches extends DitchThePitchModel
{
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = TABLE_WINEDISPATCHES;

		$this->addPrimaryKey('winedispatchId');
		
	}
}