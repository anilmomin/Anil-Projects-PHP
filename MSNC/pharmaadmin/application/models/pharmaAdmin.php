<?php

/**

 *

 * @category		Model Persistence Class

 * @package			system/application/models

 * @author			Creative Chaos

 * @version			Release: 0.2
 
 
 */



require_once 'msncAdminModel.php';

class PharmaAdmin extends MSNCAdminModel {
	 	
 	/**
	  *	@link	tableConstants.inc
	  */
	
	public function __construct()
	{
		parent::__construct();
		
		$this->tableName = TABLE_PHARMA;
		
		$this->addPrimaryKey('pharmaId');
	}
	
 	
}


?>
