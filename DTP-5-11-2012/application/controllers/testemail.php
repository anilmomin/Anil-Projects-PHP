<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *
 * @category		Controller Class
 * @package			application/controllers
 * @author			Anil Momin
 * @version			Release: 1.0
 * @note 			This project is yet another example of 
 */

require_once('ditchthepitchcontroller.php');

	
class TestEmail extends DitchthePitchController {
	
	

	public function __construct()
	{
		parent::__construct();
	}
	
	
	// Index page
	
	public function index()
	{
		$this->load->library(array('email', 'form_validation'));

		$this->email->from("6tauras87@gmail.com");
		$this->email->reply_to("6tauras87@gmail.com", "Anil");
		$this->email->to("6tauras87@gmail.com");
		$this->email->subject("Test");
		$this->email->message("This is a test message");
		
		if($this->email->send())
		{
			echo "Email send successfully";
		}
		else
		{
			echo "failed to send email";
		}
	}
	
}


?>