<?php

/**
 *
 * @category		Model Class
 * @package			system/application/models
 * @author			Amir Ali Jiwani <studyboy5@hotmail.com>
 * @copyright		2009-2010 SAFE (Icarus - Project)
 * @license			http://www.php.net/license/3_0.txt  PHP License 3.0
 * @version			Release: 0.1
 */
 
require_once('sessionConstants.inc');

/**	This is the model class, used for authenticating user for ICARUS.	*/
class Authenticate extends Model
{
	const COOKIE_TIMEOUT = '432000';	// For five days
	
	/**
	  * This is the constructor and will create Authenticate model, which would be inherited from CodeIgniter's
	  * Model class.
	  * @method	constructor
	  * 
	  * @return	Model	the return of this method i.e constructor would be the model it self, hence model is the
	  *					return type with some extended functions as this is an inherited model.
	  */
	public function __construct()
	{
		parent::Model();
		$this->load->model('User');
	}
	
	
	private function setCookies($userId)
	{
		$cookie = array(
        	'name'   => USERID,
            'value'  => $userId,
			'expire' => self::COOKIE_TIMEOUT,
			);

		set_cookie($cookie);
	}
	
	
	private function getCookies()
	{
		return get_cookie(USERID);
	}
	
	
	private function deleteCookies()
	{
		delete_cookie(USERID);
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
	public function login($username, $password, $setCookie = false)
	{
		$this->logout();
		
		$whereCriteria = array(
			'userName' => $username,
			'password' => md5($password)
		);
		
		$userInfo = $this->User->getByCriteria($whereCriteria);
		if ($userInfo)
		{
			$sessionId = md5(microtime());
			$userInfo = $userInfo[0];
			
			$updateObject = array(
				'memberId' => $userInfo->memberId,
				'sessionId' => $sessionId
			);
			
			if ($this->User->update($updateObject))
			{
				$sessionInfo = array(
					USERID => $userInfo->memberId,
					USERNAME => $userInfo->userName,
					SESSIONID => $sessionId,
				);
				
				$this->session->set_userdata($sessionInfo);
				if ($setCookie)
				{
					$this->setCookies($userInfo->memberId);
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
		$userInfo = $this->User->getByPrimaryKey(array('memberId' => $this->getCookies()));
		if ($userInfo)
		{
			$sessionId = md5(microtime());
			$userInfo = $userInfo[0];
			
			$updateObject = array(
				'memberId' => $userInfo->memberId,
				'sessionId' => $sessionId
			);
			
			if ($this->User->update($updateObject))
			{
				$sessionInfo = array(
					USERID => $userInfo->memberId,
					USERNAME => $userInfo->userName,
					SESSIONID => $sessionId,
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
	
	
	/**
     * logs out completely from ICARUS unsetting all the session variables used by ICARUS.
     * @method	logout
	 * 
	 * @return	void
     */
	public function logout()
	{
		$sessionVariables = array(
			USERID => '',
			USERNAME => '',
			SESSIONID => '',
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
		$memberId = $this->session->userdata(USERID);
		
		$whereCriteria = array(
			'sessionId' => $sessionId,
			'memberId' => $memberId
		);
		
		$userInfo = $this->User->getByCriteria($whereCriteria, null, null, 'memberId');
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
					USERID => $this->session->userdata(USERID),
					USERNAME => $this->session->userdata(USERNAME),
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
			return $this->session->userdata(USERID);
		}
		else
		{
			return null;
		}
	}
	
	
	public function getCurrentRoleId()
	{
		if ($this->isLoggedIn())
		{
			$userObj = $this->User->getByPrimaryKey($this->User->preparePrimaryKeyArray($this->session->userdata(USERID)), null, null, 'roleId');
			
			return $userObj[0]->roleId;
		}
		else
		{
			return null;
		}
	}
	
	
	/**
     * gets all the users from table without any condition to follow.
     * @method	register
     *
     * @param	string		$username		the string representing a unique username.
     * @param	string		$password		the string representing the password for the given username.
     * @param	string		$name			the string representing the firstname of the user.
     * @param	string		$fatherName		the string representing the father's name of the user.
     * @param	string		$sirName		the string representing the sir name of the user.
     * @param	string		$emailAddress	the string representing a properly formatted email address.
     * @param	int			$roleId			an integer representing a role from roles table.
	 * 
	 * @return	boolean						if properly registered returns true else false.
     */
	public function register($username, $password, $name, $fatherName, $sirName, $emailAddress, $roleId)
	{
		$object = array(
			'userName' => $username,
			'password' => md5($password),
			'name' => $name,
			'fatherName' => $fatherName,
			'sirName' => $sirName,
			'emailAddress' => $emailAddress,
			'roleId' => $roleId
		);
		
		return ($this->User->insert($object)) ? true : false;
	}
}

?>