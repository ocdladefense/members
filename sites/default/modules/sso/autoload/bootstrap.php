<?php
use Doctrine\Common\ClassLoader;



$files = array(
	'/core/includes/autoload.inc',

	'/core/includes/string.inc',

	'/core/includes/system.inc',

	'/config/settings.php',

	'/core/autoload.php',

	'/core/vendor/ocdla/autoload.php',

	/**
	 * Simple SAML Autoloader
	 *
	 * Require the autoloader for Simple SAML.
	 */
	'/saml/lib/_autoload.php'

);

foreach($files as $file){
	require_once APP_ROOT.$file;
}



require(APP_ROOT .'/vendor/doctrine/common/lib/Doctrine/Common/ClassLoader.php');

// updated in repo
require(APP_ROOT .'/core/vendor/ocdla/sso/sso.module');

// updated in repo
require(APP_ROOT .'/core/vendor/ocdla/http/curl.inc');

// updated in repo
require(APP_ROOT .'/core/vendor/ocdla/http/cookie.inc');

// updated in repo
require(APP_ROOT .'/core/vendor/ocdla/session/session.inc');



$classLoader = new ClassLoader('Doctrine', APP_ROOT .'/vendor/doctrine');

$classLoader->register();

$config = new \Doctrine\DBAL\Configuration();


$conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);

function get_connection()
{
	global $conn;
	return $conn;
}