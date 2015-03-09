<?php

require_once 'adminmodel.php';

class WineDeals extends AdminModel
{
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = TABLE_WINEDEALS;
		
		$this->addPrimaryKey('deal_id');
		
	}	
   
}