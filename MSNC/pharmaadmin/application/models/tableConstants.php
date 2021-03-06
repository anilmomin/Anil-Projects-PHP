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

/** Table constant for pharma table in database.	*/
define('TABLE_PHARMA', TABLES_PREFIX . 'pharmas');

/** Table constant for Spend Instance File Upload Staus table in database.	*/
define('TABLE_SIFILESTATUS', TABLES_PREFIX . 'spendinstancesfilesstatuses');

/** Table constant for Spend Instance File Logs table in database.	*/
define('TABLE_SIFILES', TABLES_PREFIX . 'spendinstancefiles');

/** Table constant for Spend Instances table in database.	*/
define('TABLE_SPENDINSTANCES', TABLES_PREFIX . 'spendinstances');

/** Table constant for Spend Instances table in database.	*/
define('TABLE_SPENDINSTANCESSTATUS', TABLES_PREFIX . 'spendinstancesstatus');


/** Table constant for Spend Instances table in database.	*/
define('TABLE_CONFIGURATION', TABLES_PREFIX . 'configuration');


/** Table constant for Super Admin table in database.	*/
define('TABLE_SUPERADMIN', TABLES_PREFIX . 'superadmin');


?>