<?php
use Clickpdx\Core\System\Settings;


global $resources, $db_connection;



// Load all resources for db connections or APIs.
Settings::loadDefaults();
$resources = Settings::get('resources');


// Perform a database connection.  Default resource is a mysql database.
$db_connection = get_resource('default'); // @jbernal


/**
 * Load modules.
 *
 * Load modules from the database.  We process
 * the .module files.
 */
_drupal_load_modules(); // @jbernal



/**
 * Site maintenance.
 *
 * Check if maintenance.html exists.  If it does then the site
 *	+ is under maintenance and we should return the appropriate HTTP header.
 */
if(site_maintenance()) clickpdx_server_maintenance();