<?php

use Symfony\Component\ClassLoader\ApcClassLoader;
use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';


/**
 * Drupal root
 *
 * For legacy purposes define
 * the DRUPAL_ROOT constant so that we can
 * use related includes and functions.
 */
define('DRUPAL_ROOT',__DIR__);
define('WEB_ROOT',__DIR__);
define('APP_ROOT',__DIR__.'/..');
define('BASE_URL','auth-test.ocdla.org/sso'); 
define('DOCUMENT_ROOT','/var/www/auth-test/web');
define('SAML_URL','https://ocdpartial-ocdla.cs70.force.com/secur/logout.jsp?retURL=Ocdla_Foo_Bar&retUrl=Ocdla_Foo_Bar');

define('REDIRECT_DEFAULT_SERVER','www.ocdla.org');
define('REDIRECT_DEFAULT_URL','/index.shtml');
define('REDIRECT_DEFAULT_PROTOCOL','https');
define('AUTH_SERVER_NAME','auth-test.ocdla.org');
// print "foobar";exit;


// Require some legacy code.
require(WEB_ROOT .'/../config/bootstrap.php');

// Use APC for autoloading to improve performance.
// Change 'sf2' to a unique prefix in order to prevent cache key conflicts
// with other applications also using APC.
/*
$apcLoader = new ApcClassLoader('sf2', $loader);
$loader->unregister();
$apcLoader->register(true);
*/

require_once __DIR__.'/../app/AppKernel.php';
//require_once __DIR__.'/../app/AppCache.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();


$request = Request::createFromGlobals();
$response = $kernel->handle($request);
// print_r($response);
// Our login app requires caching to be disabled
$response->setPrivate();
$response->setMaxAge(0);
$response->headers->addCacheControlDirective('must-revalidate', true);


// Wrap-up
$response->send();
$kernel->terminate($request, $response);