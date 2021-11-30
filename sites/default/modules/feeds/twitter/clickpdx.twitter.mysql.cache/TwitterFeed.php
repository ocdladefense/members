<?php
class TwitterFeed {


	const REST_URL = "http://api.twitter.com/1/statuses/user_timeline.xml?include_entities=true&screen_name=";
	private $feed;
	private $feed_URL;//
	private $screen_name;
	private $feed_count;
	private $feed_length;
	private $base_feed;
	private $dom;

	public function __construct( $screen_name, $feed_count = 10, $feed_length = 41 ) {

		if( !isset($screen_name) ) throw new Exception('TwitterFeed error: no screenname found.');
		else {
			$this->screen_name = $screen_name;
			$this->base_feed = "http://twitter.com/{$this->screen_name}";
			$this->feed_URL = "http://twitter.com/{$this->screen_name}/statuses/";			
		}
		$this->feed_count = $feed_count;
		$this->feed_length = $feed_length;
		$tmp = self::REST_URL . $this->screen_name;
		//$tmp .= "&exclude_replies=true";
		$ch = curl_init( $tmp );
		curl_setopt($ch, CURLOPT_HEADER, 0);
		//print_r($post);
		//curl_setopt($ch, CURLOPT_POST, 1);
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$this->feed = curl_exec($ch);      
		curl_close($ch);	
	}//constructor
	
	public function loadXMLFile() {
		$xml = new DOMDocument();
		$xml->formatOutput = TRUE;
		$xml->preserveWhiteSpace= FALSE;		
	}

	public function getRawXML() {
		return $this->feed;
	}
	
	public function parseXML() {
		$this->dom = new DOMDocument();
		$this->dom->preserveWhiteSpace = true;
		if( TWITTER_LOAD_FROM_LOCAL_FILE ) $this->dom->load(realpath('./user_timeline-2012-10-24.xml') ) or $this->dom->loadXML($this->feed)	;
//		tail($this->feed);
	}//parseXML

	public function getHTMLOutput() {
		$this->parseXML();
		$timeline = $this->dom->getElementsByTagName("text");
		$this->feed_count = $timeline->length < $this->feed_count ? $timeline->length : $this->feed_count;
		$dates = $this->dom->getElementsByTagName("created_at");
		$IDs = $this->dom->getElementsByTagName("id");
		// set up variables that may be indicative
		// of Twitter DMs (Direct Messages)
		// so that we can hide these later...
		$dm1 = $this->dom->getElementsByTagName("in_reply_to_status_id");
		$dm2 = $this->dom->getElementsByTagName("in_reply_to_user_id");
		$dm3 = $this->dom->getElementsByTagName("in_reply_to_screen_name");
		$tmp = "";
		for ($idx = 0, $feedid=0; $idx < $this->feed_count; $idx++, $feedid+=2) {
			if( TWITTER_HIDE_DM && (!empty($dm1->item($idx)->nodeValue) || !empty($dm2->item($idx)->nodeValue) || !empty($dm3->item($idx)->nodeValue)) ) {
				tail("dm1: " . $dm1->item($idx)->nodeValue . "\r\ndm2: " . $dm2->item($idx)->nodeValue . "\r\ndm3: " . $dm3->item($idx)->nodeValue);
			}
			$zebra = $idx%2 ? "odd" : "even";
			// $tmp is all of the feeds concatenated
			$tweet = preg_replace('/([$])/', '\\\\$1', $timeline->item($idx)->nodeValue);
			$l = TWITTER_LINKS_USE_TWITTER_HOME ? $this->base_feed : $this->feed_URL . $IDs->item($feedid)->nodeValue;
			$tmp .= "<p class=\"tweet {$zebra}\"><a href=\"{$l}\">" . substr($tweet,0,$this->feed_length) . "...</a></p>\n";
		}//for

		$tpl = file_get_contents('twitter.tpl.html');
		$tpl = preg_replace( '/{{twitter_feed}}/', $tmp, $tpl );
		if( $tpl == NULL ) throw new Exception('There was an error reading the TwitterFeed template file.');
		return $tpl;
	}//method getHTMLOutput

	
}//class TwitterFeed