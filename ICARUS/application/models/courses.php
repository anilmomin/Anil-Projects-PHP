<?php

/**
 * This is the model class for database operations on courses.
 * @category			Model Class/Persistence Class
 * @package			system/application/models
 * @author			Mehdi Maujood <maujood@gmail.com>
 * @author			Murtaza Munawar Fazal <mmf1988@hotmail.com>
 * @copyright			2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 1.0
 */

require_once('icarusmodel.php');

/**	This is the persistence class for the users table of database.	*/
class Courses extends IcarusModel
{
	/**
	  *	@link	tableConstants.inc
	  */
	const TABLE_NAME = TABLE_COURSES;
	const TEACHERCOURSE_TABLE_NAME = TABLE_TEACHER_COURSE;
	const REGISTRATION_TABLE_NAME = TABLE_REGISTRATION;

	public function __construct()
	{
		parent::__construct();
		$this->tableName = TABLE_COURSES;
		$this->addPrimaryKey('courseCode');
	}

	/**
	  * Returns details of all courses being taught by a teacher identified by the teacher ID supplied as a parameter.
	  * Function will return null if no such course is present.
	  *
	  * @method	getCoursesByTeacherID
	  *
	  * @param	int		$teacherID		The teacherID of the teacher against which courses have to be selected.
	  *
	  * @return	array					The array containing the results of the query. The results would look something like:
	  *							
	  *							Array ( [0] => stdClass Object ( [courseCode] => TH-201 [courseName] => Extreme Tharkiism
	  *							[courseCredits] => 4 [teacherID] => 1 ) [1] => stdClass Object ( [courseCode] => TH-301
	  *							[courseName] => Professional Tharki [courseCredits] => 5 [teacherID] => 1 ) )
	  */
	function getCoursesByTeacherID($teacherID)
	{
		$this->db->select();
		$this->db->from(self::TABLE_NAME);
		$this->db->join(self::TEACHERCOURSE_TABLE_NAME, self::TABLE_NAME.'.courseCode = '.self::TEACHERCOURSE_TABLE_NAME.'.courseCode');
		$this->db->where('teacherID', $teacherID);
		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return null;
		}
	}
}
?>