<?php

use Ocdla\SSOSession;
use Ocdla\Http\ClientSession;
use Clickpdx\Core\Http\LoginPage;
  


// require(WEB_ROOT .'/loginpackage/bootstrap.php');


class LoginSamlController extends ControllerBase {

	public function loginSaml() {
		/**
		 * Require this client to have a valid OCDLA session cookie.
		 * The cookie should be used to access session data across *.ocdla domains.
		 *
		 */
		$client = new ClientSession();
		$client->enforcePolicy('ValidSessionCookie',SESSION_COOKIE_NAME);
		$client->policyFulfillmentService('clientRedirectService',SESSION_URL,
			array(
				'redirect'		=> '/login1.php',
				'server'			=> 'auth.ocdla.org'
		));


		if(!$client->passesPolicy())
		{
			$client->fulfillPolicy();
		}



		/**
		 * Require SAML authentication here against a valid Identity Provider (IdP.)
		 * The IdP is defined in config/authsources.php.
		 */
		// We reference the appropriate service provider
		//	+ which in turn invokes the related authentication scheme and identity provider.
		$sResp = new \SimpleSAML_Auth_Simple('default-sp');

		$sResp->requireAuth();




		// print_r($sResp->getAttributes());exit;

		/**
		 * We store returned IdP info to the SSOSession object
		 *	+ so it can be access across *.ocdla domains.
		 */
		SSOSession::writeSamlData(get_connection(),$client->getSessionIdentifier(),$sResp->getAttributes());

		$client->request('/loginResources.php');

	}

}