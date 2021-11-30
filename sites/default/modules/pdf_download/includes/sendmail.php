<?php


/**
get and set the location of a template file for to be used to send HTML email
define a set of tokens that are to be replaced within the template file
set the headers for plain text vs. html email or both, i.e., multipart/alternative
send mail to a specific email from a specific email
set the subject of the email
*/

function sendMail($to, $subject, $data = array())
{
	$html = file_get_contents(DRUPAL_ROOT .'/sites/all/themes/ocdla/templates/email/pdf-notification.html', true);
	$text = file_get_contents(DRUPAL_ROOT .'/sites/all/themes/ocdla/templates/email/pdf-notification.txt', true);
	
	$from = "info@ocdla.org";
	$t="Your OCDLA downloads";
	$name = $data['name'];
	$download_links = $data['links'];

	$boundary = '----=_NextPart_';

	//for HTML
	$body = str_replace("[Title]",$t,$html);
	$body = str_replace("[Content]", $download_links, $body);
	$body = str_replace("[Name]", $name, $body);

	// for text file
	$text_body = str_replace("[Content]",$download_links,$text);
	$text_body = str_replace("[Title]",$t,$text_body);
	$text_body = str_replace("[Name]",$name,$text_body);

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


	$headers = 'From: OCDLA <' . $from . '>'."\r\n";
	$headers .= 'MIME-Version: 1.0'."\r\n";
	$headers .= 'Content-Type: multipart/alternative; boundary="'.$boundary.'"'."\r\n";
	$headers .= 'Content-Transfer-Encoding: 8Bit'."\r\n";
	$headers .= 'Bcc: info@ocdla.org, jbernal.web.dev@gmail.com' . "\r\n";
 
	$sent = mail($to, $subject, $multi_body, $headers);

	if( $sent ) tail("PDF notification to {$e} was sent successfully.",__FILE__);
	else tail("PDF notification email to {$e} failed.",__FILE__);
}