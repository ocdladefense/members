<?php
class JSONTwitterFeed {

	private $html;
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

	
	
	public function __construct($f) {

		$this->feed = $f;
	}//constructor

	public function init($n) {
		$this->screen_name = $n;
		$this->feed_length = 41;
			$this->base_feed = "http://twitter.com/{$this->screen_name}";
			$this->feed_URL = "http://twitter.com/{$this->screen_name}/statuses/";
			return $this;
	}
	
	private function isDM( $c ) {
		empty( $c->in_reply_to_status_id ) and empty( $c->in_reply_to_user_id ) and empty($c->in_reply_to_screen_name) or $flag=TRUE;
		return FALSE;
	}


	public function setHTMLOutput() {
		//tail( 'html output'.print_r($this->feed,TRUE) );
//		$this->parseXML();
		//$timeline = count( $this->feed );
		//$this->feed_count = $timeline->length < $this->feed_count ? $timeline->length : $this->feed_count;
		// @jbernal$IDs = $this->dom->getElementsByTagName("id");
		// set up variables that may be indicative
		// of Twitter DMs (Direct Messages)
		$tmp = "";
		$len = count($this->feed);
		for ($idx = 0, $feedid=0; $idx < $len; $idx++, $feedid+=2) {
			$this->feed[$idx]->text;
			$it = $this->feed[$idx]; 
			$zebra = $idx%2 ? "odd" : "even";
			if( TWITTER_HIDE_DM && $this->isDM($it)   ){
				//tail( $it   );
				continue;//skip dms
			}

			// $tmp is all of the feeds concatenated
			// $tweet = preg_replace('/([$])/', '\\\\$1', $it->text);
			$l = TWITTER_LINKS_USE_TWITTER_HOME ? $this->base_feed : $this->feed_URL . 
			// $tmp .= "<p class=\"tweet {$zebra}\"><a href=\"{$l}\">" . substr($tweet,0,$this->feed_length) . "...</a></p>\n";
			$his = 'hi'; echo $his;
		}//for
	exit;

		$tpl = file_get_contents('twitter.tpl.html');
		$tpl = preg_replace( '/{{twitter_feed}}/', $tmp, $tpl );
		if( $tpl == NULL ) throw new Exception('There was an error reading the TwitterFeed template file.');
		$this->html = $tpl;
		return $this;
	}//method getHTMLOutput



	public function toString() {
		return $this->html;
	}
	
}//class JSONTwitterFeed