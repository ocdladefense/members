<?php
/**
 * @original logout2.php
 *
 * @description Logout of the IdP for the specified service provider.
 *
 */
require_once('/var/www/auth-dev/saml/lib/_autoload.php');

class SsoLogoutController extends ControllerBase {

	public function logout($sp = "default-sp")
	{
		$auth = new \SimpleSAML_Auth_Simple($sp);


		if($auth->isAuthenticated()) {
		
			$auth->logout(); 
		
		} else {
		
			echo "You are already logged out.";
		}

	}

}