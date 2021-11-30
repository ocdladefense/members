<?php
header('Content-type: text/html; charset=utf-8');
define('DRUPAL_ROOT', dirname(__FILE__));
error_reporting(E_ALL);
ini_set("log_errors", 1);
ini_set("error_log", "/var/www/membertest.log");
ini_set('display_errors','1');

require( 'bootstrap.php');
require( 'bootstrap_real.php');




// cron_register_modules();


print "\n\n<h3>Module list:</h3><pre>".print_r(_get_modules(),true)."</pre>";




function cron_register_modules()
{
	$all_modules = _read_modules();
	$all_modules += _read_modules(DRUPAL_ROOT.'/sites/default/modules');
	$module_data = serialize($all_modules);
	db_query('UPDATE cms_config SET data=:1 WHERE variable="modules"',$module_data);
}