<?php
require('includes.php');
/**
get and set the location of a template file for to be used to send HTML email
define a set of tokens that are to be replaced within the template file
set the headers for plain text vs. html email or both, i.e., multipart/alternative
send mail to a specific email from a specific email
set the subject of the email
*/


$from = "admin@hsolc.org";
$subject = "HSOLC Announcements";
$t="HSOLC Announcements";
$e='everyone@hsolc.org';
//$e = 'jbernal.web.dev@gmail.com';

/* Look-up seminar id here and insert the data in the rideshare table, if necessary */



//variables used
//$_POST["title"], description, email, location

//connect to the database and set these fields
//after inserting make sure the id is saved to the email links using str_replace



//if($_SERVER['HTTP_REFERER']!="http://oip.uoregon.edu/iss/orientation/register.php") {echo "not able to send mail"; exit;}



/*MAKE EMAIL BODY*/


//print_r($_SERVER);



/*$wd_was = getcwd();
chdir("/inetpub/ocdla/sqlconn");
require('sql_conn.php');
chdir("/inetpub/ocdla/php_mail");
*/
$html = file_get_contents('template.html', true);
$text_body = file_get_contents('template.txt', true);
$boundary = '----=_NextPart_';

//for HTML
//$body = str_replace("[Title]",$t,$html);
$body = str_replace("[Announcements]", getAnnouncements(), $html);

// for text file
$text_body = str_replace("[Announcements]",getAnnouncements( "text" ),$text_body);
//$text_body = str_replace("[Title]",$t,$text_body);

$multi_body="

This is a multi-part message in MIME format.

--$boundary
Content-Type: text/plain; charset=UTF-8; format=flowed; 
Content-Transfer-Encoding: 8bit

$text_body


--$boundary
Content-Type: text/html; charset=UTF-8; format=flowed; 
Content-Transfer-Encoding: 8bit

$body


";


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



$headers='From: HSOLC <' . $from . '>'."\r\n".'MIME-Version: 1.0'."\r\n".'Content-Type: multipart/alternative; boundary="'.$boundary.'"'."\r\n".'Content-Transfer-Encoding: 8Bit'."\r\n";
 
/*Make sure the Content-type parameter's value is all on one line!!!
$params = array(
 'MIME-Version' => '1.0',
 'Content-Type' => 'multipart/alternative; boundary="'.$boundary.'"',
 'Content-Transfer-Encoding' => '8Bit');
*/
 
 
$sent2 = mail($e, $subject, $multi_body, $headers);

if( $sent2 ) echo "<h2>Thanks, Sami for sending this email...</h2>";

//if($sent2) echo "your rideshare email was sent successfully!"; else echo "your mail could not be sent...";