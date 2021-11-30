<?php

require('settings.php');
require('clickpdx/core/includes/database.inc');
// perform a database connection
$db_connection = new DB_Mysql( DB_USER, DB_PASS, DB_HOST, DB_NAME );
$date = '2013-01-01 12:12:12';
$results = db_query("insert into system_status (module,message,level) values('PDF Download','Download application ran on {$date}.','notice')");


