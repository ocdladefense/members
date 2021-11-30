<?php
header("Cache-Control: no-cache");
header("Expires: -1");
?>

<?php error_reporting(0); ?>

<?php

$i = $_GET["productid"];
$orderid = $_GET["Order_ID"];
$pdfi = $_GET["Order_I"];
$contact_id = $_GET["contact_id"];
?>


/* global functions */




/**
 * global function createDownloadLink to insert a link to this unique download
 * 
 */
function createDownloadLink( ajaxobj ) {
	var progressIndicator = document.getElementById('progressIndicator');
	if(ajaxobj.req.status != 200 ) {
		progressIndicator.innerHTML = '<h4>There was an error retrieving your document.</h4>';
	}
	else progressIndicator.innerHTML = ajaxobj.req.responseText;
}







window.onload=function(){

		/**
		 * create a new instance of AjaxRequest to generate the ZIP archive asynchronously
		 * the "progressIndicator" icon does its thing while the AjaxRequest object is being constructed and executed
		 *
		 */
		req = new AjaxRequest(CartLibrary.zipgenerationurl,"POST");





		
		/**
		 * set the following variables in the query string:
		 * pdfi = the unique index in the documents table (ocdla.downloads)
		 * contact_id = the contact id of the member who purchased this document
		 * Item_ID = the Product Serial Number of the Item to archive or password-protect
		 */		
		req.setQString(<?php error_reporting(0); echo "\"pdfi=$pdfi&contact_id=$contact_id&Item_ID=$i\"";?>);
		
		
		
		
		/**
		 * override the native DOMStringProcessor method with this one and
		 * instead call the createDownLink function to do some further processing on the AjaxRequest object itself
		 * 
		 */
		req.DOMStringProcessor = function(){ createDownloadLink(this) }
		
		


		
		/**
		 * send the AjaxRequest to create the ZIP archive
		 * processing can take few minutes, this depends on the size of the folder/files to be archived
		 */
		req.sendRequest();
}