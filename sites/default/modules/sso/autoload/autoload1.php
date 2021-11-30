<?php
define('CORE_AUTOLOADER_EXTENSION','php');

/**
 * Core autoloader.
 *
 * Responsible for loading most core classes.
 */
$core=createAutoloader(array('core/lib','dbal/lib'),DRUPAL_ROOT);


/**
 * Doctrine autoloader.
 *
 * Responsible for doing a stand-alone loading of Doctrine.
 */
$doctrine=createAutoloader(array('common/lib','dbal/lib'),DRUPAL_ROOT.'/vendor/doctrine');


$ocdlaAutoloader=createAutoloader(array(
		'mediawiki/lib',
		'pdo/lib',
		'saml/lib',
		'session/lib',
		'sso/lib',
		'http/lib',
		'user/lib',
		'auth/lib',
		'member/lib'
	),DRUPAL_ROOT .'/vendor/ocdla');
	
	

/**
 * Clickpdx autoloader.
 *
 * Load classes in the Clickpdx namespace.
 */
$_clickpdx=createAutoloader(array(
		'oauth/lib',
		'resource/lib',
		'salesforce/lib',
		'service/lib',
	),DRUPAL_ROOT .'/vendor/clickpdx');
	
	
spl_autoload_register($_clickpdx,true,false);
spl_autoload_register($core,true,false);
spl_autoload_register($doctrine,true,false);
spl_autoload_register($ocdlaAutoloader,true,false);