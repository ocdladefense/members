/*
 * 2011-05-17 ... having to rewrite the constructor to accept a third parameter, responseType
   ** taken from ftp://coreathl@hades.jtlnet.com/wwwroot/nptieducation.com/archive/admin.old/scripts/ajax.js
 */

var READY_STATE_UNINITIALIZED=0;
var READY_STATE_LOADING=1;
var READY_STATE_LOADED=2;
var READY_STATE_INTERACTIVE=3;
var READY_STATE_COMPLETE=4;
var SHOW_ERRORS=true;

function getXMLHttpRequest() 
{

	try{
    if (window.XMLHttpRequest) {
        return new window.XMLHttpRequest;
    }
    else return new ActiveXObject("MSXML2.XMLHTTP.3.0");
  }//try
  catch(e) {
  	if(SHOW_ERRORS) throw "getXMLHttpRequest failed.";
  }//catch
}

/** bindStateChange
* @ Helper function to correctly bind this instance

function bindStateChange(obj){
	return (function(){
			if (obj.req.readyState == READY_STATE_COMPLETE) {
				if (obj.req.status == 200) {
					obj.DOMStringProcessor();//obj.DOMStringprocessor(obj.req.responseText);
				}//if
			}//if
	})//anonymous function
}
*/
function bindStateChange(obj,method){
	function readyBind(){
				if (obj.req.readyState == READY_STATE_COMPLETE) {
					if (obj.req.status == 200 && obj.responseType == "text") {
						obj.DOMStringProcessor();//obj.DOMStringprocessor(obj.req.responseText);
					}//if
					else if (obj.req.status == 200 && obj.responseType == "xml") {
						obj.DOMStringProcessor();//obj.DOMStringprocessor(obj.req.responseText);
					}//if
					else throw "There was an error processing your request.";
				}//if
		}
		
		/* returning a closure within an anonymous object
		* here rb is an object member that refers to the function readyBind defined above
		*/
	return ({rb:readyBind,hello:method})//anonymous function
}

/** AjaxRequest
* @Constructor
* @url the url this function should call, should take the form www.ocdla.org/some/url.php
* @method - optional, assumed to be GET
* @responseType - optional, assumed to be text, also allows for xml
* ** see example declartion at /includes/top-include.htm
*/
function AjaxRequest(url, method, responseType) {
	this.method = method || "GET";
	this.responseType = responseType || "text";
	this.req = getXMLHttpRequest();
	this.href = location.protocol+"//"+url;	
	/* below, the second parameter, an anonymous function is just some test code ** 
	     */
	try {
		this.statechange = bindStateChange(this,function(){ alert('Hello World!')});//try this passing a function
	} catch(e) {
		throw "method AjaxRequest: bindStateChange error";
	}
	this.qstring;
}//ajaxRequest


AjaxRequest.prototype.setQString = function(str){ this.qstring = str }
AjaxRequest.prototype.DOMStringProcessor = function(){ return this.req.responseText }
AjaxRequest.prototype.XMLTreeProcessor = function(){ return this.req.resonseXML }

AjaxRequest.prototype.sendRequest = function(){
		try {
			r = this.req;
			r.open(this.method, this.href, true);
			r.onreadystatechange = this.statechange.rb;
			if(this.method=="POST") r.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			if(this.qstring) r.setRequestHeader("Content-length", this.qstring.length);
			r.setRequestHeader("Connection", "close");
			r.send( this.qstring || null );
		} catch(e) { if(SHOW_ERRORS) throw "AjaxRequest sendRequest error."; }
}

/*
	function onReadyXML() {
		ready=this.readyState;
		data=null;
		if (ready==READY_STATE_COMPLETE) {
			data=this.responseXML;
			toConsole(data);
		}
	}//onReadyStateChange
*/