<?php

/**
 * This file contains all the constants used in authenticate class or most probably the session constants
 * which are used in session variable of CodeIgniter.
 * @category		Constants
 * @package			system/application/models
 * @author			Creative Chaos
 * @version			Release: 1.0
 */

/**	Sessions prefix constant, used before every session variable. */
define('SESSION_PREFIX', '');

/** Session constant for PharmaId.	*/
define('PHARMAID', SESSION_PREFIX . 'pharmaId');

/** Session constant for memberName.	*/
define('PHARMANAME', SESSION_PREFIX . 'name');

/** Session constant for memberName.	*/
define('PHARMAADMINNAME', SESSION_PREFIX . 'adminName');

/** Session constant for userEmail.	*/
define('PHARMAEMAIL', SESSION_PREFIX . 'adminEmail');

/** Session constant for userEmail.	*/
define('PHARMAIMG', SESSION_PREFIX . 'imageLink');


/** Session constant for sessionId.	*/
define('SESSIONID', SESSION_PREFIX . 'sessionId');


/** Session constant for temperory redirection url.	*/
define('REDIRECT_URL', SESSION_PREFIX . 'redirect_url');

?>