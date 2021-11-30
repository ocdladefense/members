<?php
class JSONTwitterFeed {

	private $tweets;
	private $feed;
	private $feed_URL;//
	private $screen_name;
	private $feed_count;
	private $feed_length;
	private $base_feed;
	public static $dmlist= array(
		'in_reply_to_status_id',
		'in_reply_to_user_id',
		'in_reply_to_screen_name',
	);

	
	
	public function __construct($f, $tweet_length) {

		$this->feed = $f;
		$this->feed_length = $tweet_length;
		$this->feed_count = TWITTER_FEED_LIMIT;
	}//constructor

	public function init($n) {
		$this->screen_name = $n;
		$this->base_feed = "http://twitter.com/{$this->screen_name}";
		$this->feed_URL = "http://twitter.com/{$this->screen_name}/status/";
		$this->setHTMLOutput();
		return $this;
	}
	
	private function isDM( $c ) {
		if( empty( $c->in_reply_to_status_id ) && empty( $c->in_reply_to_user_id ) && empty($c->in_reply_to_screen_name) ) return FALSE;
		else return TRUE;
	}

	public function setHTMLOutput() {
		//tail( 'html output'.print_r($this->feed,TRUE) );
//		$this->parseXML();
		//$timeline = count( $this->feed );
		//$this->feed_count = $timeline->length < $this->feed_count ? $timeline->length : $this->feed_count;
		// @jbernal$IDs = $this->dom->getElementsByTagName("id");
		// set up variables that may be indicative
		// of Twitter DMs (Direct Messages)
		$tmp = '';
		$len = $this->feed_count ? $this->feed_count : count($this->feed); $l = array();
		for ($idx = 0, $feedid=0; $idx < $len; $idx++, $feedid+=2) {
			if( TWITTER_HIDE_DM && $this->isDM($this->feed[$idx]) ) continue;
			$zebra = $idx%2 ? "odd" : "even";
			$t = $this->feed[$idx]->text;
			$id = number_format($this->feed[$idx]->id, 0, '.', '');
			$id_str = $this->feed[$idx]->id_str;
			$a = !TWITTER_LINKS_USE_TWITTER_HOME ? $this->base_feed : $this->feed_URL . $id_str;
			// $t = substr($t,0,$this->feed_length);
			$t = StringWrapper::getWords( $t,0,10) . '...';
			$this->tweets[] = array('zebra'=>$zebra, 'link'=>$a, 'text'=>$t);
		}//for

		return $this;
	}//method getHTMLOutput
	
	public function getTweets() {
		return $this->tweets;
	}
	
}//class JSONTwitterFeed