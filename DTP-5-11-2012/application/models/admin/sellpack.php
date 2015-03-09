<?php

require_once 'adminmodel.php';

class SellPack extends AdminModel
{
	public function __construct()
	{
		parent::__construct();

		$this->tableName = TABLE_SELLPACK;

		$this->addPrimaryKey('sell_pack_id');
	}
	
	

}