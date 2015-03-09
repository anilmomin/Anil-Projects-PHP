<?php

/**
 *
 * @category		Model Persistence Class
 * @package			system/application/models
 * @author			Salman Iftikhar khan <samspalace@gmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 0.1
 */

require_once('icarusmodel.php');

/**	This is the persistence class for the polloptions table of database.	*/
class PollOption extends IcarusModel
{
	/**
      * @link	tableConstants.inc
      */
	public function __construct()
	{
		parent::__construct();
		$this->tableName = TABLE_POLL_OPTIONS;
		$this->addPrimaryKey('pollID');
	}
}

/* End of file polloption.php */
/* Location: ./system/application/models/polloption.php */
