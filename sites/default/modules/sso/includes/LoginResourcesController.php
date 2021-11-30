<?php
/**
 * @original loginResources.php
 *
 * @description Perform a SAML login.
 */
use Ocdla\SSOSession;
use Ocdla\User;
use Ocdla\AuthSaml;
use Ocdla\Saml\SamlAttributeCollection as SamlAttributeCollection;
use Ocdla\Http\ClientSession as ClientSession;

// @TODO, sync ClientRedirect class
use Ocdla\Http\ClientRedirect as ClientRedirect;
// require( DRUPAL_ROOT.'/core/includes/database.inc' );
// require(WEB_ROOT .'/loginpackage/bootstrap.php');

class LoginResourcesController extends ControllerBase {
  
  
  public function doLoginResources() {
	
		prgLog("Starting new client session.","saml");
		$client = new ClientSession();
		$client->enforcePolicy('ValidSessionCookie',SESSION_COOKIE_NAME);
		$client->policyFulfillmentService('clientRedirectService',SESSION_URL,
			array(
				'redirect'		=> '/login1.php',
				'server'			=> 'auth.ocdla.org'
		));

		if(!$client->passesPolicy())
		{
			prgLog("Client valid session cookie policy failed.","saml");
			prgLog("Running policy fulfillment.","saml");
			$client->fulfillPolicy();
		}

		prgLog("Creating new single sign-on session.","saml");
		// Establish connection info and session handler.
		$sso = new SSOSession(get_connection());

		$redirectClient = true;
		// $redirectUrl = 'https://membertest.ocdla.org/ocdla-home';
		$redirectUrl = SSOSession::getSsoProfileData(
			get_connection(),$client->getSessionIdentifier())['retURL'];

		$redirectUrl = !empty($redirectUrl) ? $redirectUrl : 'https://ocdla.force.com';
		// $redirectUrl = ClientRedirect::filterReturnUrl($_GET['retURL']);



		// prgLog("Enforcing policy to evaluate sso session (hasAuthenticatedSession.)","saml");
		// $client->enforcePolicy('Comparison',true,$sso->hasAuthenticatedSession());
		// $client->onPolicyPass(new ClientRedirect('https://lodtest.ocdla.org'));


		prgLog("Evaluating saml attributes.","saml");
		prgLog($sso->getSamlAttributes(),"saml");

		$samlAttrs = new SamlAttributeCollection($sso->getSamlAttributes());

		prgLog("Attempting session authentication with username: ".
			$samlAttrs->getAttr('username'),"saml");

		try
		{

			if($sso->authenticateWithPlugin(new AuthSaml(get_connection()), $samlAttrs))
			{	
				prgLog("Authentication succeeded.","saml");
				prgLog("Attempting login to LOD.","mediawikiapi");
				sso_lod_login_submit1($samlAttrs->getAttr('username'), $sso);
	
				/*
				if(in_array($samlAttrs->getAttr('OCDLA User Type'), array('Admin','Beta')))
				{
					sso_lod_login_submit2($samlAttrs->getAttr('username'), $sso);
				}
				*/
				// print "Single Sign-On Success!<p />";
				// print entity_toString($samlAttrs->getAttributeArray());
			}
			else
			{
				throw new Exception("Authenticating with plugin failed!");
			}
	
		}
		catch(\Ocdla\SessionUsernameMismatchException $e)
		{
			print "<h2>Single Sign-on Error</h2><p>There was an error completing your OCDLA login.  Please contact <a href='mailto:info@ocdla.org'>OCDLA</a> to resolve this issue.</p><p style='padding:8px; background-color:#eee;border:1px solid #666; border-radius:3px;'>Error message:<br />It appears your email address &mdash; which is your username &mdash; may need to be updated in OCDLA's registry. Please contact OCDLA to complete your email address/username update.</p>";
			exit;
		}
		catch(\Ocdla\SessionAuthenticationException $e)
		{
			print "<h2>Single Sign-on Error</h2><p>There was an error completing your OCDLA login.  Please contact <a href='mailto:info@ocdla.org'>OCDLA</a> to resolve this issue.</p><p style='padding:8px; background-color:#eee;border:1px solid #666; border-radius:3px;'>Error message:<br />We didn't recognize your username.  Please contact OCDLA to resolve this issue.</p>";
			exit;
		}

		SSOSession::clearSsoProfileData(get_connection(),$client->getSessionIdentifier());

		$redirectClient?$client->request($redirectUrl):print "<p>Authentication succeeded.  Click <a href='{$redirectUrl}' target='_new'>here</a> to continue to the target URL.</p>";

	}


}