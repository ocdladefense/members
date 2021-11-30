<?php
// use Clickpdx\Core\DependencyInjection\DependencyInjectionContainer;
use Clickpdx\Core\Application;

require_once 'bootstrap.php';
require_once 'bootstrap_real.php';

$context = Application::returnBestGuessContext();

$app = Application::newFromContext($context);

$app->loadSession();

$app->loadUser();

/**
 * Add any ad-hoc routes here

$app->addRoutes(array('myroute/%uid'=>function($arg1,$arg2){ 	
	$this->getMailer()->send('jbernal.web.dev@gmail.com','foobar','hi!');
	return "<h1>Hello, {$arg1}</h1>";}
),array(0,1,'foo','baz'));
 */


/**
 * Add any modules here
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
//Header set Access-Control-Max-Age "1000"
header("Access-Control-Allow-Headers: x-requested-with, Content-Type, origin, authorization, Accept, client-security-token");

$out = $app->processRoute();


$app->close();