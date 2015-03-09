<?php

/**
 * This is a simple unit test controller, No model class would be used as model is already provided
 * in a known as Unit-Test by CodeIgniter itself. This class will deal with all the tests for user class.
 * @category		UnitTest
 * @package			system/application/unittests
 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 1.0
 */
 
// require_once('../../models/tableConstants.inc');

class TestUser extends Controller
{
	function __construct()
    {
    	parent::Controller();
    	$this->load->model('User');
    	$this->load->library('unit_test');
	}
	
	function insertCheck($userName, $password, $sessionId, $name, $fatherName, $sirName, $emailAddress, $roleId)
	{
		$object = array(
			'userName' => urldecode($userName),
			'password' => urldecode($password),
			'sessionId' => urldecode($sessionId),
			'name' => urldecode($name),
			'fatherName' => urldecode($fatherName),
			'sirName' => urldecode($sirName),
			'emailAddress' => urldecode($emailAddress),
			'roleId' => urldecode($roleId)
			);

		$insertedId = $this->User->insert($object);
		
		$test = $insertedId > 0;
		$expected_result = true;
		$test_name = 'Check for proper insertion';
		$this->unit->run($test, $expected_result, $test_name);
		
		$this->unit->use_strict();
		
		$result = $this->db->get_where(TABLE_MEMBER, array('memberId' => $insertedId))->result();
		$result = $result[0];
		
		$this->unit->run($result->userName, $object['userName'], "Username test");
		$this->unit->run($result->password, $object['password'], "Password test");
		$this->unit->run($result->sessionId, $object['sessionId'], "SessionId test");
		$this->unit->run($result->name, $object['name'], "Name test");
		$this->unit->run($result->fatherName, $object['fatherName'], "Father Name test");
		$this->unit->run($result->sirName, $object['sirName'], "Sir Name test");
		$this->unit->run($result->emailAddress, $object['emailAddress'], "Email Address test");
		$this->unit->run($result->roleId, $object['roleId'], "RoleId test");
		
		echo $this->unit->report();
	}
}

?>