<?php

/**
 * This file contains all the table names with their unique constants to be used in the model classes,
 * all model classes use these constants for table name, no hardcoding is done, if a table name changes in
 * database, we just have to change the name in this file so that no script is affected.
 * @category		Constants
 * @package			system/application/models
 * @author			Creative Chaos
 * @version			Release: 1.0
 */

/**	Tables prefix constant as defined in database. */
define('TABLES_PREFIX', '');

/** Table constant for wines table in database.	*/
define('TABLE_WINES', TABLES_PREFIX . 'wines');

/** Table constant for wine_schedule table in database.	*/
define('TABLE_SCHEDULE', TABLES_PREFIX . 'wine_schedule');

/** Table constant for users table in database.	*/
define('TABLE_USERS', TABLES_PREFIX . 'users');

/** Table constant for profiles table in database.	*/
define('TABLE_PROFILES', TABLES_PREFIX . 'user_profiles');

/** Table constant for wine_styles table in database.	*/
define('TABLE_WINESTYLE', TABLES_PREFIX . 'wine_styles');


/** Table constant for wine_feedback table in database.	*/
define('TABLE_WINEFEEDBACK', TABLES_PREFIX . 'wine_feedback');

/** Table constant for regions table in database.	*/
define('TABLE_REGIONS', TABLES_PREFIX . 'regions');

/** Table constant for wineries table in database.	*/
define('TABLE_WINERIES', TABLES_PREFIX . 'wineries');

/** Table constant for wine_deals in database.	*/
define('TABLE_WINEDEALS', TABLES_PREFIX . 'wine_deals');

/** Table constant for sell_pack in database.	*/
define('TABLE_SELLPACK', TABLES_PREFIX . 'sell_pack');


/** Table constant for user_preferences table in database.	*/
define('TABLE_USERPREFERENCES', TABLES_PREFIX . 'user_preferences');

/** Table constant for wine_dispatches table in database.	*/
define('TABLE_WINEDISPATCHES', TABLES_PREFIX . 'wine_dispatches');

/** Table constant for discussion_threads table in database.	*/
define('TABLE_DISCUSSIONTHREADS', TABLES_PREFIX . 'discussion_threads');


/** Table constant for newsletter table in database.	*/
define('TABLE_NEWSLETTER', TABLES_PREFIX . 'newsletter');

/** Table constant for news table in database.	*/
define('TABLE_NEWS', TABLES_PREFIX . 'news');

?>