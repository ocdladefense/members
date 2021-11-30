<?php

define('SITE_NAME','Member Test');

define( 'EMAIL_FROM', "Site Admin <admin@test.member.ocdla.org>" );

define( 'EMAIL_RETURN_PATH', 'admin@test.member.ocdla.org' );

define( 'NOTIFICATION_EMAIL', 'jbernal.web.dev@gmail.com' );

define( 'EMAIL_ERRORS',true);

define( 'CART_DEFAULT_REDIRECT_SERVER','www.ocdla.org');

define( 'LOGIN_URL', "auth.ocdla.org/login" );

$base_url = 'https://membertest.ocdla.org';

define( 'DOWNLOAD_PATH', DRUPAL_ROOT .'/sites/default/files/downloads');
	
define( 'UPLOAD_PATH', DRUPAL_ROOT .'/sites/default/files/uploads');

define('DOWNLOADS_FOLDER','sites/default/files/downloads');

// set_error_handler("_errorHandler",E_ALL & ~8192 & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

// set_exception_handler(\Clickpdx\Core\Exception\MyExceptionHandler::getHandler('test'));
/**
 * Uploads folder
 *
 * The uploads folder for this installation.
 * The uploads folder is used to store original PDFs.  These can
 * be considered the source PDFs from which the target PDFs are then
 * altered and saved into the DOWNLOADS_FOLDER.
 */
define('UPLOADS_FOLDER','sites/default/files/uploads');

/**
 * Email log.
 *
 * Whether to always email the log.
 * If false, then the log is only emailed if there are
 * errors.  If true, then the log is always emailed, even if there are
 * no errors.
 */
define('PDF_ALWAYS_EMAIL_LOG', true);

define( 'MESSAGES_DISPLAY_ERRORS', true);

define( 'OCDLA_SESSION_CREATED', '2015-12-05' );

define( 'OCDLA_SESSION_EXPIRES', '2016-01-15' );

define( 'TWIG_DEBUG', true);

define( 'TWIG_CACHE',DRUPAL_ROOT .'/sites/default/files/cache');

define( 'OCDLA_SESSION_TIMEOUT', 25920000 );
// used as timeout for both OCDLA and LOD sites

define( 'LOD_COOKIE_PREFIX','lodwiki');

define( 'DOCUMENT_ROOT', DRUPAL_ROOT);

define('DEFAULT_RESOURCE_NAME', 'default');

define( 'MODULE_DIR',DRUPAL_ROOT.'/sites/default/modules' );

define( 'FILES_DIR', DRUPAL_ROOT.'/sites/default/files' );

define( 'CACHE_DIR', FILES_DIR . '/cache' );

define( 'DOWNLOAD_PATH',DRUPAL_ROOT.'/downloads' );

define( 'UPLOAD_PATH','/inetpub/ocdla/uploads' );

define( 'SESSION_URL','auth.ocdla.org/session' );

$protocol = !empty($_SERVER["HTTPS"])? "https://" : "http://";

//function settings
date_default_timezone_set ( "America/Los_Angeles" );


function get_connection($name = DEFAULT_RESOURCE_NAME)
{
	static $connections = array();
	global $conn2;
	
	if(isset($connections[$name]))
	{
		return $connections[$name];
	}

	$config = new \Doctrine\DBAL\Configuration();
	
	$info = get_resource_info($name);
	
	$doctrineFormat = array(
		'dbname' 		=> $info['database'],
		'user' 			=> $info['username'],
		'password' 	=> $info['password'],
		'host' 			=> $info['hostname'],
		'driver' 		=> 'pdo_mysql',
	);
	
	$conn2 = $connections[$name] = \Doctrine\DBAL\DriverManager::getConnection($doctrineFormat, $config);
	
	
	return $connections[$name];
}



function file_path()
{
	return '/sites/ocdla/files';
}


$theme_registry = array(


	'www.ocdla.org' => array(
		'themes' => array(
			array(
				'name' => 'ocdla',
				'theme_path' => 'sites/all/themes/ocdla',
				'active' => TRUE,
			)
		)
	),
	
	'membertest.ocdla.org' => array(
		'themes' => array(
			array(
				'name' => 'ocdla',
				'theme_path' => 'sites/all/themes/ocdla',
				'active' => TRUE,
			)
		)
	),
	
	'members.ocdla.org' => array(
		'themes' => array(
			array(
				'name' => 'ocdla',
				'theme_path' => 'sites/all/themes/ocdla',
				'active' => TRUE,
			)
		)
	),
	
	'auth-dev.ocdla.org' => array(
		'themes' => array(
			array(
				'name' => 'ocdla',
				'theme_path' => 'sites/all/themes/ocdla',
				'active' => TRUE,
			)
		)
	)

);