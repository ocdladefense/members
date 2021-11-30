<?php
$f = "http://api.twitter.com/1/statuses/user_timeline.xml?include_entities=true&screen_name=Willamalane";
$f = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=Willamalane";
// $xml = getRemoteFeed(  $f);
$xml = loadFeed('./user_timeline-2012-10-24.xml') and print $xml->saveXML();
function loadFeed($io) {
	$io = $io and realpath($io) or die('invalid file');
	$feed = $d = Obj('DOMDocument', array('preserveWhiteSpace'=>true)) and $d->load($io)
	 /*and $d->preserveWhiteSpace*/ and $d->saveXML() or die('Could not load xml file.')	;
	 $d->loads or TRUE or die('invalid property');
	return $feed;
}//parseXML


function Obj( $func, $opt=array() ) { $f = new $func(); foreach( $opt AS $k=>$v ) { $f->{$k}=$v; } return $f; }