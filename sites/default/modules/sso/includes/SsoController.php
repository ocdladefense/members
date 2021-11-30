<?php

// use Sso, Sesson, MediaWiki, etc
use Ocdla\Session as Session;
use Ocdla\Http\LodCookie as LodCookie;
use Clickpdx\Core\System\Settings;


class SsoController extends DefaultController {



	public function __construct() {
	
	}
	
	/**
	 * @route logout
	 *
	 * @method doLogout
	 *
	 * @description Logout of the specified Service Provider.
	 *  if no Service Provider is specified then logout of the default
	 *   Provider.
	 * @param $sp The Service Provider from which to logout.
	 */
	public function doLogout($sp = "default-sp") {
	
		$auth = new \SimpleSAML_Auth_Simple($sp);


		if($auth->isAuthenticated()) {
		
			$auth->logout(); 
		
		} else {
		
			echo "You are already logged out.";
		}

	}
	
	
	/**
	 * OCDLA Cookie
	 *
	 * Give the client a valid cookie.
	 * We delegate php session handling to the Ocdla\Session
	 * object.  When the object is instantiated it creates the 
	 * OCDLA cookie whose value is the PHP session id.
	 *
	 * Once the session id is stored we either send the user on to their 
	 * intended destination or we prompt them to login, depending on 
	 * the action that was requested.
	 */
	public function generateSession() {

		$_SESSION['auth'] = AUTH_SERVER_NAME;


		return "generateSession complete.";
		
		/*
			$redirect = $this->getUserRequestedAction()=='login'?
			$this->getLoginRedirect():
			$this->getLocation();		

			return $this->redirect($redirect);		
		*/
	}
	
	
	// @method=post
	public function doLogin(){
	
	}
	
	
	// @method=get
	// public function doLogin(){}



}