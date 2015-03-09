<?php

/**
 * This file contains all the constants used in authenticate class or most probably the session constants
 * which are used in session variable of CodeIgniter.
 * @category		Constants
 * @package			system/application/models
 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 1.0
 */

/**	Sessions prefix constant, used before every session variable. */
define('SESSION_PREFIX', 'icarus_session_');

/** Session constant for memberId.	*/
define('USERID', SESSION_PREFIX . 'member_id');

/** Session constant for userName.	*/
define('USERNAME', SESSION_PREFIX . 'user_name');

/** Session constant for sessionId.	*/
define('SESSIONID', SESSION_PREFIX . 'session_id');

/** Session constant for memberName.	*/
define('ORIGINALNAME', SESSION_PREFIX . 'name');

/** Session constant for memberRoleId.	*/
define('ROLEID', SESSION_PREFIX . 'role_id');

/** Session constant for temperory redirection url.	*/
define('REDIRECT_URL', SESSION_PREFIX . 'redirect_url');

/** Session constant for currently selected course code.	*/
define('SEL_COURSE', SESSION_PREFIX . 'currently_selected_course');

?>