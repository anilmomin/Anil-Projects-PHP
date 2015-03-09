<?php

require_once('sessionConstants.php');


class Authenticate extends CI_Model {

 	
 	const COOKIE_TIMEOUT = '72000'; // For 2 hours
 	
 	public function __construct()
	{

		parent::__construct();
		$this->load->model('PharmaAdmin');

	}
 	
	
 	private function setCookies($adminId)

	{

		$cookie = array(

        	'name'   => PHARMANAME,

            'value'  => $adminId,

			'expire' => self::COOKIE_TIMEOUT

			);

		set_cookie($cookie);
	}
	
 

	private function getCookies()

	{

		return get_cookie(PHARMANAME);

	}
 	
	
	
	private function deleteCookies()

	{

		delete_cookie(PHARMANAME);

	}
	
	
	/**

     * logs in a user with a username and a password and sets some session variables for ICARUS login.

     * @method	login

     *

     * @param	string		$username	the string representing username.

     * @param	string		$password	the string representing password.

	 * 

	 * @return	boolean					if login is successfull returns true, else false.

     */
	
 	public function login($username, $password, $setCookie = false, $ismd5 = null)
	{
		
		$this->logout();

		if($ismd5){
			
			$whereCriteria = array(
	
				'adminEmail' => $username,
	
				'adminPassword' => $password
	
			);
			
		}
		else
		{
			$whereCriteria = array(
	
				'adminEmail' => $username,
	
				'adminPassword' => md5($password)
	
			);

		}

		$userInfo = $this->PharmaAdmin->getByCriteria($whereCriteria);
		
		if ($userInfo)

		{

			$sessionId = md5(microtime());

			$userInfo = $userInfo[0];

			$updateObject = array(

				'pharmaId' => $userInfo->pharmaId,

				'sessionId' => $sessionId

			);

			

			if ($this->PharmaAdmin->update($updateObject))

			{

				$sessionInfo = array(

					PHARMAID => $userInfo->pharmaId,

					PHARMANAME => $userInfo->name,
					
					PHARMAADMINNAME => $userInfo->adminName,
					
					PHARMAIMG => $userInfo->imageLink,
					
					PHARMAIMG => $userInfo->imageLink,
					
					SESSIONID => $sessionId

				);

			

				$this->session->set_userdata($sessionInfo);

				if ($setCookie)

				{

					$this->setCookies($userInfo->pharmaId);

				}

				return true;
				

			}

			else

			{

				return false;

			}
			
		}

		else

		{

			return false;

		}
		
	}

	public function loginFromCookies()

	{	

		$userInfo = $this->PharmaAdmin->getByPrimaryKey(array('pharmaId' => $this->getCookies()));

		if ($userInfo)

		{

			$sessionId = md5(microtime());

			$userInfo = $userInfo[0];

			

			$updateObject = array(

				'pharmaId' => $userInfo->pharmaId,

				'sessionId' => $sessionId

			);

			

			if ($this->PharmaAdmin->update($updateObject))

			{

				$sessionInfo = array(

					PHARMAID => $userInfo->pharmaId,

					PHARMANAME => $userInfo->name,
					
					PHARMAEMAIL => $userInfo->adminEmail,
					
					PHARMAADMINNAME => $userInfo->adminName,
					
					PHARMAIMG => $userInfo->imageLink,
					
					SESSIONID => $sessionId

				);
				

				

				$this->session->set_userdata($sessionInfo);

				return true;

			}

			else

			{

				return false;

			}

		}

		else

		{

			return false;

		}

	}
	
	
	
	
	public function logout()

	{

		$sessionVariables = array(

			PHARMAID => '',

			PHARMANAME => '',
			
			PHARMAEMAIL => '',
			
			PHARMAADMINNAME => '',
			
			PHARMAIMG => '',

			SESSIONID => ''

		);

		

		$this->session->unset_userdata($sessionVariables);

		$this->deleteCookies();

	}

	

	

	/**

     * this method checks whether a person is logged in ICARUS or not.

     * @method	isLoggedIn

	 * 

	 * @return	boolean					this boolean is true if a user is logged in else will be false.

     */

	public function isLoggedIn()

	{

		$sessionId = $this->session->userdata(SESSIONID);

		$pharmaId = $this->session->userdata(PHARMAID);
		
		//echo $sessionId . " " . $pharmaId ;
		
		
			$whereCriteria = array(

			'sessionId' => $sessionId,

			'pharmaId' => $pharmaId

		);
		
		$userInfo = $this->PharmaAdmin->getByCriteria($whereCriteria, null, null, 'pharmaId');
		
		
		//print_r($sessionId);
		
		if ($userInfo)
		{
			return true;
			
		}

		else

		{
			$this->logout();
			
			return false;

		}

	}

	public function getPassword(){
		
		$pharmaId = $this->session->userdata(PHARMAID);

		$pharmaArray = array('pharmaId' => $pharmaId);
		
		if ($this->isLoggedIn())

		{
			
			 return $this->PharmaAdmin->getByPrimaryKey($pharmaArray, null, null, 'adminPassword');
			
		}
	}

	

	/**

     * gets all the information which is stored in session by ICARUS.

     * @method	getCurrentUserInfo

	 * 

	 * @return	array					the array containing all the session information for

	 *									the currently logged in user in ICARUS.

     */

	public function getCurrentUserInfo()

	{

		if ($this->isLoggedIn())

		{

			return array(

					PHARMAID => $this->session->userdata(PHARMAID),

					PHARMANAME => $this->session->userdata(PHARMANAME),
					
					PHARMAEMAIL => $this->session->userdata(PHARMAEMAIL),
					
					PHARMAADMINNAME => $this->session->userdata(PHARMAADMINNAME),
					
					PHARMAIMG => $this->session->userdata(PHARMAIMG),

					SESSIONID => $this->session->userdata(SESSIONID),

				);

		}

		else

		{

			return null;

		}

	}

	

	

	/**

     * gets the currently logged in user id.

     * @method	getCurrentUserId

	 * 

	 * @return	int						the integer containing currently logged in user id, null if not logged in.

     */

	public function getCurrentUserId()

	{

		if ($this->isLoggedIn())

		{

			return $this->session->userdata(PHARMAID);

		}

		else

		{

			return null;

		}

	}


	
	
 	
 	
 } 
?>
