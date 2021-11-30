<?php
header('Content-Type: text/html');
require( 'twitter.settings.php' );
require( INCLUDE_DIR . '/settings.php');
include( INCLUDE_DIR . '/sqlconn.php');//MAY NOT NEED THIS
include( INCLUDE_DIR . '/Exceptions.php');
include( INCLUDE_DIR . '/DBQuery.php');
include( 'misc.inc');
require('TwitterFeed.php');
tail('Hello World!');
// determine the length of the feed
$feed_length = isset($_GET["feed_length"]) ? $_GET["feed_length"] : NULL;

// log a notice if the length of the requested feed doesn't correspond to either
// of the twitter render variables, above
if( $feed_length != TWITTER_RENDER_FRONT_PAGE && $feed_length != TWITTER_RENDER_LEFT_SIDEBAR ) {
	tail( "Twitter NOTICE: requested unorthodox twitter length of {$feed_length}" );
}


try{
 send_email();
} catch(Exception $e) { tail('sending mail failed'); }


if (!isset($feed_length)) $feed_length = TWITTER_RENDER_DEFAULT;
// define the time in the past with which to enforce the cache query
$past = time() - 60*TWITTER_CACHE_EXPIRE;
//echo $past;


try {
	if( TWITTER_CACHE_USE_CACHE ) {
		$twitter_query = new DBQuery(
		
			array(
				"type"=>"select",
				"tablenames"=>array(
					0=>array(
						"name"=>"twitter",
						"op"=>"",
						"fields"=>array(),
					)
				),//tables
				"where"=>array(
					"cache_time > {$past}",
					"AND feed_length = {$feed_length}",
					" ORDER BY cache_time DESC"//make sure we are always pulling the most recent cache
				)//where
			)
		
		);
	
		tail( $twitter_query->getQuery() );
		$results = $twitter_query->exec();
		//tail("Latest result is: " .print_r($results[0],TRUE) );
		//if( FALSE){
		if( count( $results )>=1 ) {
			tail('using cached version of feed...');
			print $results[0]['twitter_html'];
		
		}// if there is a timely cache result (e.g., within the last 5 minutes)
		else throw new Exception('Twitter Application NOTICE: no timely cache feed available, using live results.');
	}// if using cache
	
	else throw new Exception('Twitter Application NOTICE: caching disabled, using live results.');


} catch( Exception $e ) {
	tail( $e->getMessage(), __FILE__);


// otherwise refresh the cache
	// perform the live query
	// display those result first
	// then cache the result
	
	//print $feed->getRawXML();
	$feed = new TwitterFeed( FEED_NAME, TWITTER_FEED_LIMIT, $feed_length);
	$html = $feed->getHTMLOutput();
	print $html;
	/**
	 * @inline
	 *
	<div style="height:200px; padding-bottom:5px;" id="feed-control-left"><h2 id="latest_news"><a href="http://twitter.com/Willamalane">Latest News</a></h2>
	<p class="tweet even"><a href="http://twitter.com/Willamalane/statuses/182979794202406912">Shallow, warm pool @ Wi...</a></p>
	<p class="tweet odd"><a href="http://twitter.com/Willamalane/statuses/179298280969220096">I uploaded a @YouTube v...</a></p>
	<p class="tweet even"><a href="http://twitter.com/Willamalane/statuses/177071560740446209">The Mystery of Sherwood...</a></p>
	<p class="tweet odd"><a href="http://twitter.com/Willamalane/statuses/177070673963913216">Happy Birthday! Ask us ...</a></p>
	<p class="tweet even"><a href="http://twitter.com/Willamalane/statuses/175649592640155648">New parking spaces at L...</a></p>
	</div>
	*/
	
	// attempt to update the local database with a cached version of this feed
	try {	
		$twitter_cache = new DBQuery(
			array(
				"type"=>"insert",
				"tablenames"=>array(
					0=>array(
						"name"=>"twitter",
						"op"=>"",
						"fields"=>array()
					)
				),
				"fields"=>array(
					"twitter_html"=>$html,
					"cache_time"=>time(),
					"feed_length"=>$feed_length,
				)
			)
		
		);//twitter_cache
	} catch( Exception $e ) {
		tail( $e->getMessage(), __FILE__);
	}

}//catch