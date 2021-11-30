<?php
/**
 * mail class to replace functions
 *
 */
//echo $body;
class Mail {


	private $recipients;
	private $from;
	private $subject;
	private $headers;
	

	public function __construct() {
		$headers='MIME-Version: 1.0'."\r\n".'Content-type: text/plain; charset=iso-8859-1'."\r\n".'Content-Disposition: inline'."\r\n".'From: web@pacinfo.com'."\r\n";

	}
	
	public function send() {
	
		$sent = mail($e, $subject, $multi_body, $headers);
	}//method send
}//class Mail