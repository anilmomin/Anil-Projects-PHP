<?php

/**
 * This file contains all the table names with their unique constants to be used in the model classes,
 * all model classes use these constants for table name, no hardcoding is done, if a table name changes in
 * database, we just have to change the name in this file so that no script is affected.
 * @category		Constants
 * @package			system/application/models
 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 1.0
 */

/**	Tables prefix constant as defined in database. */
define('TABLES_PREFIX', 'icarus_');

/** Table constant for permissions table in database.	*/
define('TABLE_PERMISSIONS', TABLES_PREFIX . 'permissions');

/** Table constant for roles table in database.	*/
define('TABLE_ROLES', TABLES_PREFIX . 'roles');

/** Table constant for modules table in database.	*/
define('TABLE_MODULES', TABLES_PREFIX . 'modules');

/** Table constant for roleModulePermissions table in database.	*/
define('TABLE_ROLE_MODULE_PERMISSIONS', TABLES_PREFIX . 'roleModulePermissions');

/** Table constant for member table in database.	*/
define('TABLE_MEMBER', TABLES_PREFIX . 'member');

/** Table constant for courses table in database.	*/
define('TABLE_COURSES', TABLES_PREFIX . 'courses');

/** Table constant for teacher table in database.	*/
define('TABLE_TEACHER', TABLES_PREFIX . 'teacher');

/** Table constant for student table in database.	*/
define('TABLE_STUDENT', TABLES_PREFIX . 'student');

/** Table constant for admin table in database.	*/
define('TABLE_ADMIN', TABLES_PREFIX . 'admin');

/** Table constant for teacherCourse table in database.	*/
define('TABLE_TEACHER_COURSE', TABLES_PREFIX . 'teacherCourse');

/** Table constant for registration table in database.	*/
define('TABLE_REGISTRATION', TABLES_PREFIX . 'registration');

/** Table constant for markType table in database.	*/
define('TABLE_MARK_TYPE', TABLES_PREFIX . 'markType');

/** Table constant for courseMarkAlloc table in database.	*/
define('TABLE_COURSE_MARK_ALLOC', TABLES_PREFIX . 'courseMarkAlloc');

/** Table constant for marks table in database.	*/
define('TABLE_MARKS', TABLES_PREFIX . 'marks');

/** Table constant for poll table in database.	*/
define('TABLE_POLL', TABLES_PREFIX . 'poll');

/** Table constant for pollOptions table in database.	*/
define('TABLE_POLL_OPTIONS', TABLES_PREFIX . 'pollOptions');

/** Table constant for pollAns table in database.	*/
define('TABLE_POLL_ANS', TABLES_PREFIX . 'pollAns');

/** Table constant for notice table in database.	*/
define('TABLE_NOTICE', TABLES_PREFIX . 'notice');

/** Table constant for attend table in database.	*/
define('TABLE_ATTEND', TABLES_PREFIX . 'attend');

?>