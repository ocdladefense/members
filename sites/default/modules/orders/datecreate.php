<?php

define('ENABLE_TEST_VARIABLES',FALSE);

/**
 @addition - the Unix timestamp increases by 86,400 seconds each day
 @description - so to figure out what the timestamp will be five days in the future we have 86,400x
 */


/**
 @method strtotime
 */

$was_dir = getcwd();
chdir('\inetpub\ocdla');
require('sql_conn4.php');
chdir($was_dir);


$product_query = "SELECT * FROM catalog WHERE i=923";
$product_resource = mysql_query( $product_query );
$this_product = mysql_fetch_assoc( $product_resource );

$datetime = date_create();
echo "<h2>Standard date from MySQL date field:</h2> <p>{$this_product['ReadyDate']}</p>";


echo "<h2>Array produced from <i>getdate()</i></h2><p>".print_r( getdate() )."</p>";


$past_date = date_create($this_product['ReadyDate'].' 00:00:00');

if( date_create() < $past_date ) echo "Today is greater than the past date.";
print_r( $past_date );

echo "<p>**********</p>";
$times = array();
$times[] = strtotime( $this_product['ReadyDate'] );
$times[] = strtotime( '2010-04-25 00:00:21' );

$ready_date = getdate( $times[0] );
$ready_month = $ready_date["month"];
$ready_day = 	$ready_date["mday"];
$ready_year = $ready_date["year"];

foreach( $times AS $timestamp ) echo "<h2>$timestamp</h2>";

echo "<h1>$ready_month $ready_day, $ready_year</h1>";

echo "<h1>Example using strtotime to get the timestamp from a 2010-01-01-style date and formatting the date using date()</h1>";
echo "<p style='color:red;'>".date('F j, Y',strtotime('2010-04-25'))."</p>";
?>