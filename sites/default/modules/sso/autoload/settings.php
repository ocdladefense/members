<?php
define( 'NOTIFICATION_EMAIL', 'jbernal.web.dev@gmail.com, info@ocdla.org' );

$wgJoseDebug = false;



define( 'DB_USER', 'wwwocdlaweb');
define( 'DB_PASS', 'buc7Uzad');
define( 'DB_HOST', '207.189.130.62');
define( 'DB_NAME', 'ocdla');
define( 'DB_CHARSET', 'utf8');


$connectionParams = array(
    'dbname' 			=> DB_NAME,
    'user' 				=> DB_USER,
    'password' 		=> DB_PASS,
    'host' 				=> DB_HOST,
    'driver' 			=> 'pdo_mysql',
);


define( 'MESSAGES_DISPLAY_ERRORS', TRUE );

define( 'SITE_NAME', 'OCDLA' );

define( 'SITE_URL', 'www.ocdla.org' );

define( 'OCDLA_SESSION_CREATED', '2015-11-15');

define( 'OCDLA_SESSION_EXPIRES', '2015-12-15');

define( 'OCDLA_SESSION_TIMEOUT', 25920000 ); // used as timeout for both OCDLA and LOD sites

define( 'LOD_COOKIE_PREFIX','lodwiki' );

define( 'LODTEST_COOKIE_PREFIX','lodtest' );

define( 'SESSION_COOKIE_NAME','OCDLA_SessionId' );

define( 'SESSION_URL','/sess' );

define( 'ERROR_LOG','/var/www/auth-error.log' );

define( 'ERROR_LOG_PATH','/var/www/log' );

define( 'UPLOAD_PATH','/inetpub/ocdla/uploads' );

define('COOKIE_PATH', '/var/www/cookies-test');

define('DEBUG',FALSE);


$wgInvalidUsernameCharacters=':';
$wgUserrightsInterwikiDelimiter=':';
$wgPreventEmailUsernames=false;

$protocol = !empty($_SERVER["HTTPS"]) ? "https://" : "http://";

//function settings
date_default_timezone_set ( "America/Los_Angeles" );


function getSessionName()
{
	return 'OCDLA_SessionId';
}


function showErrors()
{
	error_reporting(E_ALL);
	ini_set('display_errors','1');
	restore_error_handler();
}

function myErrorHandler($errno, $errstr, $errfile, $errline)
{
	$message =  "<b>My ERROR</b> [$errno] $errstr<br />\n\n";
	$message .= "Error E_WARNING on line $errline in file $errfile \n\n";
	$message .= ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n\n";
	// echo "Aborting...<br />\n";
	clickpdx_set_message( $errstr, 'error', 'alert' );
		
	if( $errno == E_USER_WARNING )
	{
		$mail = new Mail(NOTIFICATION_EMAIL,'OCDA website error',$message);
		$mail->send();
	}
	if (!(error_reporting() & $errno))
	{
		// This error code is not included in error_reporting
		return;
	}
}




function ttail( $data, $LogGroup = null)
{
	global $user;
	//	if( $LogGroup == 'lod' || $user->uid != 25060 ) return;
	// tail($user,null,null,$LogGroup);
	tail($data, null, null, $LogGroup );
}


function prgLog( $data, $LogGroup = null)
{
	tail($data, null, null, $LogGroup );
}


function tail( $log_msg = "Msg not included...", $file = null, $function = null, $LogGroup = null )
{
	return;
	if(!in_array($LogGroup,array('saml','mediawikiapi'))) return;
	if( isset($LogGroup) )
	{
		$LogFile = $LogGroup . '.log';
		$LogFilePath = ERROR_LOG_PATH . '/' . $LogFile;
	}
	else
	{
		$LogFile = 'auth-error.log';	
	}

	$trace = debug_backtrace();
	$alltrace = print_r($trace,true);
	$function = $trace[1]['function'];
	$file = $trace[1]['file'];
	if(!isset($file)) $file = "NO FILE SPECIFIED";
	$handle = fopen( ERROR_LOG_PATH . '/'.$LogFile,'a+');
	$log_msg = is_array($log_msg) || is_object($log_msg) ? print_r($log_msg,TRUE) : $log_msg;
	// fwrite( $handle, "\n-------------------------\n" . date('Y-m-d g:i:s a') . "\nFile: {$file}\nFunction: {$function}\n{$log_msg}\n<<AllTrace{$alltrace}<<\n\n" );
	fwrite( $handle, "\n".date('Y-m-d g:i:s a')." - {$log_msg}");
	// . "\n<< Stack trace:\n{$alltrace}<<\n\n" );
	fclose( $handle );
}



if (! defined('DEBUG_FUZZY')) {
    define('DEBUG_FUZZY', FALSE);   // set to true to activate the fuzzy debugger
}

$serverIP = '173.12.176.182';
//$serverIP = '10.0.0.200';
$webCompanionPort = 80;         // for FM 7, 8, or 9, this should we the web server port
$dataSourceType = 'FMPro9';
$webUN = 'odbc';               // defaults for Book_List in FM7; both should be blank for Book_List in FM5/6
$webPW = 'ocdla';
if (strtolower($dataSourceType) == 'fmpro9') $contactsFile = 'Contacts.fp7';
$scheme = 'http';



$theme_registry = array(
	'ocdla' => array(
		'theme_path' => 'sites/all/themes/ocdla',
	),

	'local.ocdla.org' => array(
		'themes' => array(
			array(
				'name' => 'ocdla',
				'theme_path' => 'sites/all/themes/ocdla',
				'active' => TRUE,
			),
		),
	),
	'www.ocdla.org' => array(
		'themes' => array(
			array(
				'name' => 'ocdla',
				'theme_path' => 'sites/all/themes/ocdla',
				'active' => TRUE,
			),
		),
	),
	'ocdla.org' => array(
		'themes' => array(
			array(
				'name' => 'ocdla',
				'theme_path' => 'sites/all/themes/ocdla',
				'active' => TRUE,
			),
		),
	),
	'sockeye.local' => array(
		'themes' => array(
				array(
				'name' => 'sockeye',
				'theme_path' => 'sites/all/themes/sockeye',
				'active' => TRUE,
			),
		),
	),
	'sockeye.dev' => array(
		'themes' => array(
				array(
				'name' => 'sockeye',
				'theme_path' => 'sites/all/themes/sockeye_dev',
				'active' => TRUE,
			),
		),
	),
	'review.sockeye.tv' => array(
		'themes' => array(
			array(
				'name' => 'sockeye',
				'theme_path' => 'sites/all/themes/sockeye',
				'active' => TRUE,
			),
		),
	),
	'sockeye.tv' => array(
		'themes' => array(
			array(
				'name' => 'sockeye',
				'theme_path' => 'sites/all/themes/sockeye',
				'active' => TRUE,
			),
		),
	),
	'clickpdx.local' => array(
		'themes' => array(
			array(
				'name' => 'clickpdx',
				'theme_path' => 'sites/all/themes/clickpdx',
				'active' => TRUE,
			),
		),
	),
	'sandbox.clickpdx.com' => array(
		'themes' => array(
			array(
				'name' => 'clickpdx',
				'theme_path' => 'sites/all/themes/clickpdx',
				'active' => TRUE,
			),
		),
	),


);



function leftoverMeat(){
	require('PDO.php');
	$conn = new \Jbernal\PDODb();
	// $users = $conn->getUsers();

	// Set some dummy values
	$id = 25060;
	$sessionid = session_id();


	$stmt = $conn->db->prepare("UPDATE my_aspnet_Sessions SET UserID=? WHERE SessionID=?");
	$stmt->execute(array($id, $sessionid));
	$affected_rows = $stmt->rowCount();

	print $affected_rows . ' affected.';
	// print_r($users);
}



$xml = FALSE;

function file_path() {
	return '/sites/ocdla/files';
}