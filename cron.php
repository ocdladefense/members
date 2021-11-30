<?php
header('Content-type: text/html; charset=utf-8');
define( 'DRUPAL_ROOT', dirname(__FILE__) );
error_reporting( E_ALL );
ini_set("log_errors", 1);
ini_set("error_log", "/var/www/membertest.log");
ini_set('display_errors','1');

require( DRUPAL_ROOT.'/core/bootstrap.php');

// print entity_toString(module_implements('cron'));


print entity_toString(module_invoke_all( 'cron' ));


print "\n\n<h3>OCDLA cron run on " . date( 'D, d M Y H:i:s' )."</h3>";