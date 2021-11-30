<?php
/**
 * @original login1.php
 *
 * @description Perform a SAML login.
 */
use Ocdla\SSOSession;
use Ocdla\Http\ClientSession;
use Clickpdx\Core\Http\LoginPage;


// require(DOCUMENT_ROOT .'/config/bootstrap.php');


class LoginController extends ControllerBase {


	public function doLogin() {

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
				'retURL'			=> !empty($_GET['retURL']) ? $_GET['retURL'] : SAML_SERVER
		));


		if(!$client->passesPolicy())
		{
			$client->fulfillPolicy();
		}


		$samlData = SSOSession::getSamlData(get_connection(),$client->getSessionIdentifier());


		SSOSession::writeSsoProfileData(get_connection(),$client->getSessionIdentifier(),
			array('retURL' => !empty($_GET['retURL']) ? $_GET['retURL'] :
				SAML_SERVER));

		// print "Displaying Sso Profile data...<br />";
		// print_r(SSOSession::getSsoProfileData(get_connection(),$client->getSessionIdentifier()));
		// exit; 
		/**
		 * Require SAML authentication here against a valid Identity Provider (IdP.)
		 * The IdP is defined in config/authsources.php and 
		 */
 
		// We reference the appropriate service provider
		//	+ which in turn invokes the related authentication scheme and identity provider.
		$sResp = new \SimpleSAML_Auth_Simple('default-sp');


		$sResp->requireAuth();

		// Testing code...
		// print $sResp->authSource;
		// print_r($sResp->getAuthDataArray());exit;

		/*
		if(!$samlData['userId'])
		{
			$loginPage = new LoginPage('ocdladev-ocdla.cs17.force.com',
				array(
					'secure' => true,		// But should be true by default
					'returl' => 'ocdla_sso_redirect'
				)
			);
			$client->request((string)$loginPage);
		}
		*/

		$client->request('/loginSaml.php');

	}
}