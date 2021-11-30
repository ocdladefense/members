var READY_STATE_UNINITIALIZED=0;
var READY_STATE_LOADING=1;
var READY_STATE_LOADED=2;
var READY_STATE_INTERACTIVE=3;
var READY_STATE_COMPLETE=4;


function getXMLHttpRequest() 
{
    if (window.XMLHttpRequest) {
        return new window.XMLHttpRequest;
    }
    else {
        try {
            return new ActiveXObject("MSXML2.XMLHTTP.3.0");
        }
        catch(ex) {
            return null;
        }
    }
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
			if (obj.req.status == 200) {
				obj.DOMStringProcessor();//obj.DOMStringprocessor(obj.req.responseText);
				//obj.req.close(); not supported in IE? received error on 2010-12-8
			}//if
			//else obj.DOMStringProcessor();
		}//if
	}
	return ({rb:readyBind,hello:method});//anonymous function
}

/** AjaxRequest
* @Constructor
*/
function AjaxRequest(url, params) {
	this.method = params.method || "GET";
	this.req = getXMLHttpRequest();
	this.href = location.protocol+"//"+url;	
	this.statechange = bindStateChange(this,function(){ alert('Hello World!')});//try this passing a function
	this.qstring = ("?"+params.fl) || "?feed_length=42";
	this.postvars;

}//ajaxRequest


AjaxRequest.prototype.setQString = function(str){ this.qstring = str }
	//AjaxRequest.prototype.DOMStringProcessor = function(){ return this.req.responseText; }
	AjaxRequest.prototype.DOMStringProcessor = function(){
	//window.alert(this.req.responseText);
	home.innerHTML=this.req.responseText;
}

AjaxRequest.prototype.sendRequest = function(){

		this.req.open(this.method, this.href+this.qstring, true);
		//this.req.open(this.method, "http://www.willamalane.org/twitter/twitter.php?feed_length=34", true);
		this.req.onreadystatechange = this.statechange.rb;
		//if(this.method=="POST") this.req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//if(this.qstring) { window.alert('qstring'); this.req.setRequestHeader("Content-length", this.qstring.length); }
		//r.setRequestHeader("Connection", "close");
		//this.req.send( this.qstring || null ); 
		this.req.send( this.postvars || null );
	}