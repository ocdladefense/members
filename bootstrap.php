<?php


error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));
ini_set("log_errors", 1);
ini_set("error_log", "/var/www/membertest.log");
ini_set('display_errors','1');


define( 'DRUPAL_ROOT', dirname(__FILE__) );




// References to default db connection and other APIs.
global $resources, $db_connection;



require_once DRUPAL_ROOT .'/config.php';
require_once DRUPAL_ROOT .'/vendor/autoload.php';
require_once DRUPAL_ROOT .'/vendor/clickpdx/core/autoload.php';