<?php

function getZipInfo()
{
	
	if( !user_is_authenticated() ) {
		$redirect_to = urlencode('/index.php?q=download/zip&productid='.$productid);
		clickpdx_goto( 'https://auth.ocdla.org/login?ref='.$redirect_to);
	}

	//if( empty($i) && empty($UserID) ) { echo "This link is incomplete.  Check your email again and copy and paste the entire link to continue."; exit; }
	// first perform a lookup on the $UserID and the $productid from the URL
	// if there is no $i then assume that this is a download for a $UserID
	// redirect to the login page if the user isn't logged in
	//if( isset($UserID) && user_has_download( $UserID, $productid );
	
	// there are two possible situations:
	// either an anonymous user is wanting to download this file in which case
	// they will need to have a valid $i valid
	// or the user is trying to access a product ($productid) associated with a member
	// in which case that member needs to be logged in
	// here, check if the script has been passed a valid $i
	
	// function is_valid_download( $i=NULL, $productid=NULL, $memberid=NULL ) {
	// function is_member_download( $i ) {
	// function is_valid_member_download
	
	$catalog = $product->info;
	
	$filename = substr($catalog["DownloadLocation"],strrpos($catalog["DownloadLocation"],'\\')+1);
	

	//format startdate
	$tmp = $catalog["StartDate"]." 00:00:00";
	$seminar_startdate = date_create( $tmp );
	$seminar_startdate = date_format( $seminar_startdate, 'F j, Y');
	
	//format enddate
	$tmp = $catalog["EndDate"]." 00:00:00";
	$seminar_enddate = date_create( $tmp );
	$seminar_enddate = date_format( $seminar_enddate, 'F j, Y');
	
	
	$tmp = $catalog["ReadyDate"]." 00:00:00";
	$materials_readydate = new DateTime( $tmp );
	
	$tmp = $catalog["ExpiryDate"]." 00:00:00";
	$materials_expirydate = new DateTime( $tmp );
	
	
	//prepare information about this product
	if(strrpos($catalog["Item"],'-') !== false) {
		$option=substr($catalog["Item"],strrpos($catalog["Item"],'-')+1);
	}
	else {
		$option='';
	}
}