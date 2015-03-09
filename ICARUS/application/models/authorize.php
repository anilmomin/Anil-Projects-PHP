<?php

/**
 *
 * @category		Model Class
 * @package			system/application/models
 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 0.1
 */
 
require_once('sessionConstants.inc');

/**	This is the model class, used for authorizing user for ICARUS.	*/
class Authorize extends Model
{
	/**
	  * This is the constructor and will create Authenticate model, which would be inherited from CodeIgniter's
	  * Model class.
	  * @method	constructor
	  * 
	  * @return	Model	the return of this method i.e constructor would be the model it self, hence model is the
	  *					return type with some extended functions as this is an inherited model.
	  */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('RoleModulePermissions');
		$this->load->model('Permission');
		$this->load->model('Module');
	}
	
	public function isAllowed($roleId, $permissionName, $moduleName)
	{
		$permissionId = $this->Permission->getByCriteria(array('permissionName' => $permissionName));
		$permissionId = (count($permissionId)) ? $permissionId[0]->permissionId : null;
		
		$moduleId = $this->Module->getByCriteria(array('moduleName' => $moduleName));
		$moduleId = (count($moduleId)) ? $moduleId[0]->moduleId : null;
		
		$results = $this->RoleModulePermissions->getByPrimaryKey($this->RoleModulePermissions->preparePrimaryKeyArray($roleId, $permissionId, $moduleId));
		
		if (count($results) == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}

?>