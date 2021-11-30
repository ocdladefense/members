<?php
// @jbernal
// This file should be removed after the profile module is rebuilt.

function getJavaScripts() {
	global $page;
	$path = '/sites/ocdla/modules/profile/js';
	$scripts = "";

	$scripts .= "<script src='{$path}/FormChecker.js' type=\"text/javascript\"></script>";
	
	switch( $page ) {
		case "ldoc_disclaimer":
			$scripts .= "<script src='{$path}/Form_ldoc_disclaimer.js' type=\"text/javascript\"></script>";
			return $scripts;
		
	}//switch
	
	
	switch($page) {
		case "contact": $src=$path."/validation.js"; break;
		case "address": $src=$path."/address_validation.js"; break;
		case "interests": $src=$path."/interests.js";
	}//switch
	
	

	if( !( is_null( $src ) ) ) $scripts .= "<script src=\"$src\" type=\"text/javascript\"></script>";

	return $scripts;
}