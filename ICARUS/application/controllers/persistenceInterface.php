<?php

/**
 * @author Amir Ali
 * @copyright 2009
 * Use Active Records For Persistance Classes, So That The Work May Boost Up
 * @description 
 */

interface PersistenceInterface
{
	// all the returning data will be either a boolean or in array of object form for simplicity :)
	
	public function getAll($limitx = null, $limity = null);
	// this method is for getting all the contents of the table from database.
	/* @return_value : would be the records, as the active records returns it like object, please obey this. */
	
	public function getByPrimaryKey ($primaryKey, $limitx = null, $limity = null, $columnNames = null);
	// this is to get all the contents with the search on primary key, a $primaryKey can be a single key or a composite depending over the table structure.
	/* @return_value : would be the records, as the active records returns it like object, please obey this. */
	
	public function getByCriteria ($criteria, $limitx = null, $limity = null, $columnNames = null);
	// this method is for getting records from table including a where criteria, the criteria would be an array just the same as the input for active records library.
	/* @return_value : would be the records, as the active records returns it like object, please obey this. */
	
	public function update ($object);
	// this is the method for updating old record to a new record depending on the primary key provide in the variable $object, $object should be an associative array which contains feilds of the table, example :
	
	/* $object = array (
		'id' => 24,
		'name' => 'Amir Ali',
		'dob' => '15-April-1989'
		);
		
		in the above example id is the primary key function would update the record with id = 24
	*/
	
	/* @return_value : would be a boolean indicating that if the record has been updated or not, please remember its a boolean not an int, please obey this. */
	
	public function delete ($primaryKey);
	// this is to delete all the contents with the search on primary key, a $primaryKey can be a single key or a composite depending over the table structure.
	
	/* @return_value : would be a boolean indicating that if the record has been deleted or not, please remember its a boolean not an int, please obey this. */
	
	public function insert ($object);
	// this is the method for inserting new record depending on the primary key provide in the variable $object, $object should be an associative array which contains feilds of the table, if the primary key is autoincrement we do not have to provide a primary key else we have to.
	
	/* @return_value : would be a boolean indicating that if the record has been inserted or not, please remember its a boolean not an int, please obey this. */
	
}

?>