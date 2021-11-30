<?php
/**
 * @original mwAuthTest.php
 *
 * @about controller class is appended; function names are original.
 */
// require('/var/www/auth/web/loginpackage/settings.php');
// require('/var/www/auth/web/loginpackage/bootstrap.php');

use Ocdla\User;
use Ocdla\MediaWiki\ApiAuthenticationRequestTest;


class MediaWikiAuthController extends ControllerBase

	public function sso_lod_login_submit_test($username, $session = null)
	{	
		\prgLog('About to authenticate to mediawiki...','mediawikiapi');
		$UserID=9999999;
		$lodUsername = getValidMediaWikiUsername($username);
		$mwAuthTest = new ApiAuthenticationRequestTest(SSO_WIKI_API_TEST,$UserID,$lodUsername);
		try
		{
			$mwAuthTest->execute();
		}
		catch(Ocdla\MediaWikiException\AuthenticationException $e)
		{
			print $e->getMessage();
		}
		
		
		print "The test succeeded:<br />";
		print $mwAuthTest;
	}



}