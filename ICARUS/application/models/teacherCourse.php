<?php

/**
 *
 * @category		Model Persistence Class
 * @package			system/application/models
* @author			Mehdi Maujood <maujood@gmail.com>
 * @author			Murtaza Munawar Fazal <mmf1988@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 0.2
 */

require_once('icarusmodel.php');

/**	This is the persistence class for the users table of database.	*/
class TeacherCourse extends IcarusModel
{
	/**
	  *	@link	tableConstants.inc
	  */
	public function __construct()
	{
		parent::__construct();
		$this->tableName = TABLE_TEACHER_COURSE;
		$this->addPrimaryKey('teacherID');
		$this->addPrimaryKey('courseCode');
	}
}

?>