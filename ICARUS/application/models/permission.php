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

require_once('icarusmodel.php');

/**	This is the persistence class for the users table of database.	*/
class Permission extends IcarusModel
{
	/**
	  *	@link	tableConstants.inc
	  */
	public function __construct()
	{
		parent::__construct();
		$this->tableName = TABLE_PERMISSIONS;
		$this->addPrimaryKey('permissionId');
	}
}

?>