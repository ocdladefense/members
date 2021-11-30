/** bindStateChange
* @ Helper function to correctly bind this instance
*/
function bindStateChange(obj){
	return (function(){
			if (obj.req.readyState == READY_STATE_COMPLETE) {
				if (obj.req.status == 200) {
					obj.DOMStringProcessor();//obj.DOMStringprocessor(obj.req.responseText);
				}//if
			}//if
	})//anonymous function
}

/** AjaxRequest
* @Constructor
*/
function AjaxRequest(url, method) {
	this.method = method || "GET";
	this.req = getXMLHttpRequest();
	this.href = location.protocol+"//"+url;	
	this.statechange = bindStateChange(this);	
}//ajaxRequest


AjaxRequest.prototype.DOMStringProcessor = function(){ alert(this.req.responseText) }

AjaxRequest.prototype.sendRequest = function(){
			r = this.req;
		r.open(this.method, this.href, true);
		r.onreadystatechange = this.statechange;
		//req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//req.setRequestHeader("Content-length", this.params.length);
		r.setRequestHeader("Connection", "close");
		r.send( null ); 
	}




function addButton( data ) {
	href = location.protocol+"//www.ocdla.org/logout.php";
	var navlinks = document.getElementById('navlinks');
	//alert(progressIndicator);
	mylink = document.createElement('a');
	mylink.setAttribute('href', href);
	mylink.appendChild(document.createTextNode( data ));
	navlinks.appendChild( document.createTextNode('|') );
	navlinks.appendChild(mylink);
}//addButton

var ocdlaLoginRequest = new AjaxRequest("www.ocdla.org/includes/evaluateLogin.php","POST");

//override the default DOMStringProcessor
ocdlaLoginRequest.DOMStringProcessor = function(){ alert('Hello World!') }
ocdlaLoginRequest.sendRequest();