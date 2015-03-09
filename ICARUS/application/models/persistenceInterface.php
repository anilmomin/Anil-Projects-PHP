<?php



/**

 * This is the persistence interface to be implemented by all persistence classes,

 * for all the db operations Active Records class of Code Igniter would be used.

 * @category		Interface

 * @package			system/application/models

 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>

 * @copyright		2009-2010 SAFE (Icarus - Project)

 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0

 * @version			Release: 1.1

 */



interface PersistenceInterface

{

	/**

     * gets all the users from table without any condition to follow.

     * @method	getAll

     *

     * @param	string		$columnNames	the string representing the column names to select from table.

     * @param	int			$limitx			an integer representing the start limit of SQL.

     * @param	int			$limity			an integer representing the end limit of SQL.

	 * 

	 * @return	array						the array containing user objects from the user table,

	 *										where each feild is the datamember of the object, null in case

	 *										of no results.

     */

	public function getAll ($columnNames = '*', $limitx = null, $limity = null);

	

	

	/**

     * gets user from table which fulfills the primary key condition supplied by parameter.

     * @method	getByPrimaryKey

     *

     * @param	array		$primaryKey		an array containing keys as the names of primary columns in

	 *										database and the value correspondant to it,

	 *										eg:- $primaryKey = array('Id' => 'AaoObBC'),

	 * 										where Id is the pk column and AaoObBC is the value of it.

     * @param	int			$limitx			an integer representing the start limit of SQL.

     * @param	int			$limity			an integer representing the end limit of SQL.

	 * @param	string		$columnNames	the string representing the column names to select from table.

	 *

	 * @return	array						the array containing single user object from the user table,

	 *										where each feild is the datamember of the object, null in case

	 *										of no results.

     */

	public function getByPrimaryKey ($primaryKey, $limitx = null, $limity = null, $columnNames = '*');

	

	

	/**

     * gets all the users from table which fulfills the criteria supplied by parameter.

     * @method	getByCriteria

     *

     * @param	array		$criteria		an array containing keys as the names of table columns or names

	 *										with a condition (i.e. either 'id' or 'id <') from the

	 *										database and the value correspondant to it, or it can be a

	 *										where clause string of SQL,

	 *										eg:- $criteria = array('Id' => 'AaoObBC');, or it can be like

	 *										eg:- $criteria = 'Id=\'AaoObBC\' OR something=\'value\'';

	 *										by default criteria works on AND method of SQL.

     * @param	int			$limitx			an integer representing the start limit of SQL.

     * @param	int			$limity			an integer representing the end limit of SQL.

	 * @param	string		$columnNames	the string representing the column names to select from table.

	 *

	 * @return	array						the array containing user objects from the user table,

	 *										where each feild is the datamember of the object, null in case

	 *										of no results.

     */

	public function getByCriteria ($criteria, $limitx = null, $limity = null, $columnNames = '*');





	/**

     * updates the database by primary key condition supplied in the array of object by parameter.

     * @method	update

     *

     * @param	array		$object			the array containing all the feild to be updated, with primary key(s),

	 *										as a must index.

	 *										eg:- $object = array (

	 *														'id' => 24,

	 *														'name' => 'Amir Ali',

	 *														'dob' => '15-April-1989'

	 *														);

	 *										in the above example id is the primary key, method would update the

	 *										record with id = 24.

     *

	 * @return	int							the integer containing the number of rows affected after the update

	 *										operation, minimum value of this int can be zero.

     */

	public function update ($object);



	

	/**

     * deletes the database by primary key condition supplied in the parameter.

     * @method delete

     *

     * @param	array		$primaryKey		an array containing keys as the names of primary columns in

	 *										database and the value correspondant to it,

	 *										eg:- $primaryKey = array('Id' => 'AaoObBC'),

	 * 										where Id is the pk column and AaoObBC is the value of it.

     *

     * @return	int							the integer containing the number of rows affected after the delete

	 *										operation, minimum value of this int can be zero.

     */

	public function delete ($primaryKey);



	

	/**

     * inserts a new record int the database by primary key condition supplied in the array of object by parameter,

     * if any previous record is already present with the same primary key insert operation fails.

     * @method	insert

     *

     * @param	array		$object			the array containing all the feild to be inserted, with primary key(s),

	 *										as a must index.

	 *										eg:- $object = array (

	 *														'id' => 24,

	 *														'name' => 'Amir Ali',

	 *														'dob' => '15-April-1989'

	 *														);

	 *										in the above example id is the primary key, method would insert the

	 *										record with id = 24.

     *

	 * @return	int							the integer would contain the last inserted id of database if insert is

	 *										sucessful, else a zero valued integer is returned.

     */

	public function insert ($object);
	
	public function countAll ();

}



?>