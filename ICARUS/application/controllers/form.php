<?php

/**
 * @author TEAM ViRiLiTY
 * @copyright 2009
 */
 
include_once('http://fastology.byethost3.com/CodeIgniter/system/application/models/persistanceInterface.php');

class Form extends Controller implements PersistanceInterface {
	
	var $dbconf = array();
			
	function __construct()
	{
		parent::Controller();
		$this->dbconf['hostname'] = "localhost";
		$this->dbconf['username'] = "root";
		$this->dbconf['password'] = "";
		$this->dbconf['database'] = "testDB";
		$this->dbconf['dbdriver'] = "mysql";
		$this->dbconf['dbprefix'] = "";
		$this->dbconf['pconnect'] = FALSE;
		$this->dbconf['db_debug'] = TRUE;
		$this->dbconf['cache_on'] = FALSE;
		$this->dbconf['cachedir'] = "";
		$this->dbconf['char_set'] = "utf8";
		$this->dbconf['dbcollat'] = "utf8_general_ci";
		
		$this->load->scaffolding('users');
	}
	
    function index()
    {
    	# text boxes
		$data['fname'] = array('name' => 'firstname', 'id' => 'id_firstname');
		$data['lname'] = array('name' => 'lastname', 'id' => 'id_lastname');
		
		# radio buttons
		$data['gender'] = array('name' => 'gender', 'id' => 'id_gender');
		
		# text area
		$data['comments'] = array('name' => 'comments', 'id' => 'id_comments');
		
		# drop down box
		$data['shirtDropDown'] = array(
                  'small'  => 'Small Shirt',
                  'med'    => 'Medium Shirt',
                  'large'   => 'Large Shirt',
                  'xlarge' => 'Extra Large Shirt',
                );

		$data['selectedShirts'] = array('small', 'large');
		
		$this->load->view('infoForm', $data);
    }
    
    function allDomiciles()
    {
		$this->load->model('Domicile');
		$this->load->library('table');
		
		$domiciles = $this->Domicile->fetch();
		print_r($domiciles);
/*		$tableArray = array();
		$cnt = 0;
		
		foreach ($domiciles as $domicile)
		{
			$tableArray[$cnt++] = array(
				'CNIC' => $domicile->CNIC,
				'name' => $domicile->name
				);
		}*/

//        $data['domiciles'] = $tableArray;

        $this->load->view('checkDomicile', $data);
	}
     
	function doSomething()
    {
		$data['name'] = $this->uri->segment(3);
		$data['fathername'] = $this->uri->segment(4);
		
    	$this->load->view('staticPage', $data);
	}
	
	function addUser($username, $password)
	{
		$this->load->database($this->dbconf);
		
		$qry = "INSERT INTO `users` (`username`, `password`) VALUES ('" . $username . "', '". $password . "')";
		
		$query = $this->db->query($qry);
		
		if ($query == 1)
		{
			echo "User Added";
		}
		else
		{
			echo "Sorry Adding User Failed";
		}
	}
	
	function submit()
	{
		echo "Hey, wow! u are in submit !";
		print_r($_POST);
		print_r($_GET);
	}
}

?>
