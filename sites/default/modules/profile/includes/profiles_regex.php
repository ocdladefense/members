<?php



function phoneNumberFormat( $str ) {
	// $newstr = preg_replace( '/(^\d{3})(\d{3})(\d{4})(\d*)/e',"strlen('\\4')>0?'(\\1) \\2-\\3 x\\4':'(\\1) \\2-\\3'",$str);
	$newstr = preg_replace_callback( '/(^\d{3})(\d{3})(\d{4})(\d*)/',function($matches){return strlen($matches[4])>0?"($matches[1]) $matches[2]-$matches[3] x$matches[4]":"($matches[1]) $matches[2]-$matches[3]";},$str);
	return $newstr;
}