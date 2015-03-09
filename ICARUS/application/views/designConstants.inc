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
 
 define('IMG_FOLDER', base_url() . 'system/application/views/img/');

/** Header image */
define('SITE_HEADER_IMAGE', IMG_FOLDER . 'header.jpg');
define('SITE_HEADER_IMAGE_TITLE', 'ICARUS - PROJECT');

/** Site Name and tagline */
define('SITE_NAME', 'ICARUS - Project');
define('SITE_TAGLINE', 'SAFE - Section A Future Engineers');

/** Site Slogan */
define('SITE_SLOGAN_TITLE', 'Jahangir ..... !');
define('SITE_SLOGAN_SUBTITLE', 'Quality is our passion.');
define('SITE_SLOGAN_TEXT', 'Serving the webcommunity<br />with XHTML/CSS designs');
define('SITE_SLOGAN_READ_MORE', '&rsaquo;&rsaquo;&rsaquo;&nbsp;<a href="#">Go to templates</a>');

/** Company Credits */
define('COMPANY_NAME', 'SAFE');

?>