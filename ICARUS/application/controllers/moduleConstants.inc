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
define('MODULE_PREFIX', 'icarus_');

/** Table constant for permissions table in database.	*/
define('MODULE_MEMBERS', MODULE_PREFIX . 'members');
define('MODULE_HOME', MODULE_PREFIX . 'home');
define('MODULE_POLL', MODULE_PREFIX . 'poll');
define('MODULE_COURSES', MODULE_PREFIX . 'courses');
define('MODULE_NOTICES', MODULE_PREFIX . 'notices');
define('MODULE_QUIZ', MODULE_PREFIX . 'quiz');


/** These are the constants for permissions of permission table, permissionName feild only.	*/
define('PERMISSION_CAN_VIEW', 'can view');
define('PERMISSION_CAN_APPROVE', 'can approve');
define('PERMISSION_CAN_REGISTER_TO', 'can register to');
define('PERMISSION_CAN_REGISTER_MAKE', 'can make');
define('PERMISSION_CAN_EDIT', 'can edit');
define('PERMISSION_CAN_DELETE', 'can delete');
define('PERMISSION_CAN_CREATE', 'can create');

/** These are the constants for controllers filenames.	*/
define('POLL_FILE_NAME', 'pollManager');
define('NOTICE_FILE_NAME', 'noticecontroller');
define('COURSE_FILE_NAME', 'courseManager');
define('QUIZ_FILE_NAME', 'quizController');
?>