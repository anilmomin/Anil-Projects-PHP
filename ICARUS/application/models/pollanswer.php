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

/**	This is the persistence class for the pollAns table of database.	*/
class PollAnswer extends IcarusModel
{
	/**
	  *	@link	tableConstants.inc
	  */
	public function __construct()
	{
		parent::__construct();
		$this->tableName = TABLE_POLL_ANS;
		$this->addPrimaryKey('pollID,userId');
	}

	public function getAllSolvedPolls($userId)
	{
		return $this->getByCriteria(array('userId' => $userId), null, null, 'pollID');
	}
	
	public function isAnswered($pollId, $userId)
	{
		$result = $this->getByCriteria(array('pollID'=> $pollId, 'userId' => $userId));
		return (count($result)) ? true : false;
	}
}

/* End of file pollanswer.php */

/* Location: ./system/application/models/pollanswer.php */
?>