/* Global JavaScript library for OCDLA.org */
function getSetting(key)
{
	return { // Selector
		animate: true, // Boolean: Use CSS3 transitions, true or false
		transition: 284, // Integer: Speed of the transition, in milliseconds
		label: "", // String: Label for the navigation toggle
		insert: "before", // String: Insert the toggle before or after the navigation
		customToggle: "", // Selector: Specify the ID of a custom toggle
		closeOnNavClick: false, // Boolean: Close the navigation when one of the links are clicked
		openPos: "relative", // String: Position of the opened nav, relative or static
		navClass: "nav-collapse", // String: Default CSS class. If changed, you need to edit the CSS too!
		navActiveClass: "js-nav-active", // String: Class that is added to  element when nav is active
		jsClass: "js", // String: 'JS enabled' class which is added to  element
		init: function(){}, // Function: Init callback
		open: function(){}, // Function: Open callback
		close: function(){} // Function: Close callback
	};
}

if(!$){
	var $ = jQuery;
}
$(function(){
	
	var responsiveNavSettings = getSetting('responsiveNav');

	$( "#menu-left" ).menu();	


	
	init();
	
	var home;
	if(location.pathname=="\/" || location.pathname=="\/index.shtml") {
		var twitter_id="feed-control-right";
		var feedlength = 40;

		//home = document.getElementById( twitter_id );
		//var url = location.hostname + "/twitter/twitter.php";
		//var twitter = new AjaxRequest( url, {fl:"feed_length="+feed_length} );
		//twitter.sendRequest();
		$.get('sites/ocdla/files/cache/twitter/twitter-sidebar.html', { feed_length : feedlength}, function(data) {
		  $('#feed-control-right').html(data);
		});
	
		$.get('sites/ocdla/files/cache/mediawiki/lod-feed.html', function(data) {
		  $('#lod-feed-replace').html(data);
		});
	
	}
	//document.write(feed);
	
	//window.alert(home);
	
	/*var headID = document.getElementsByTagName("head")[0];         
	var cssNode = document.createElement('link');
	cssNode.type = 'text/css';
	cssNode.rel = 'stylesheet';
	cssNode.href = '/twitter/themes/default/style.css';
	cssNode.media = 'screen';
	headID.appendChild(cssNode);
	*/
	
	/*
	(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	*/
});

function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

/*function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
*/


function currencyformat(inputnumber) { //v1.0
	var inputstring = new String(inputnumber);
		if (inputstring.length==(inputstring.indexOf(".")+3)) {
			outputstring = inputstring;
		}
		if (inputstring.length>(inputstring.indexOf(".")+3)) {
			outputstring = inputstring.substr(0,(inputstring.indexOf(".")+3));
		}
		if ((inputstring.length-inputstring.indexOf("."))==2) {
			outputstring = inputstring+"0";
		}
		if (inputstring.indexOf(".")==-1) {
			outputstring = inputstring+".00";
		}
	return outputstring;
}
	
	



function setfocus(){
	document.Form.UserName.focus();
	 return true; 
}

var signon = true;

function send(){
 	if(document.Form.UserName.value == "" && signon){
        alert("Please enter your OCDLA Username.\n\nIf you've forgotten your OCDLA Username,\nPlease contact OCDLA.");
        document.Form.UserName.focus();
        document.Form.UserName.select();
        return false;
 	}

	return true;
	
}

function clearForm(){
	elems=document.forms[0].elements;
	arr=new Array();
	//window.alert(document.forms[0].elements);
	//loop through quantities and assign 0 values, where appropriate
	for(i=0; i<elems.length; i++){
		//window.alert(elems[i].name+": "+elems[i].value);
		if(elems[i].name=="quantity") elems[i].value="";
	}//
	

	return true;  
}//clearForm

function checkForm(){
	elems=document.forms[0].elements;
	arr=new Array();
	//window.alert(document.forms[0].elements);
	//loop through quantities and assign 0 values, where appropriate
	try {
	for(i=0; i<elems.length; i++){
		//window.alert(elems[i].name+": "+elems[i].value);
		if(elems[i].name=="quantity" && elems[i].value=="") elems[i].value=0;
		if(elems[i].name=="quantity" && elems[i].value=="0") elems[i].value=0;
	}//
	} catch(e){ throw "Unable to reset default quantity to 0."; }
	

	return true;  
}//checkForm



var CartLibrary = {
	hello : function(){ alert(location.hostname); },
	loginurl : location.hostname+"/login/eval",
	zipgenerationurl : location.hostname+"/download/zip-link",
	
	getLoginWidget : function(ajaxobj) {
	// next commented line is the original function declaration
//function toConsole(data){
	var data = ajaxobj.req.responseXML;
	var navlinks = document.getElementById('navlinks');
	var logout_url = "https://auth.ocdla.org/logout";
	xmlDoc = data.documentElement;	
	

	
	/**
	 * 		* find out if the user is logged in or not
	 * if not then exit
	 */
	loggedin = xmlDoc.getElementsByTagName('loggedin') || null;
	var roles = xmlDoc.getElementsByTagName('roles') || null;
	var id = null;
	var is_admin = false;
	var is_lodtest = false;
	try {
		id = xmlDoc.getElementsByTagName('id')[0].firstChild.nodeValue;
		is_admin = xmlDoc.getElementsByTagName('admin')[0].firstChild.nodeValue == '1' ? true : false;
	} catch(e) { }
	
	if( is_admin ) {
	   var store_admin = document.createElement('a');
	   store_admin.setAttribute('href','https://www.ocdla.org/admin/store');
	   store_admin.setAttribute('target','_new');
	   store_admin.appendChild( document.createTextNode( 'Store Admin' ) );
	}
	if( is_admin || is_lodtest ) {
	   var lod_test = document.createElement('a');
	   lod_test.setAttribute('href','https://lodtest.ocdla.org');
	   lod_test.setAttribute('target','_new');
	   lod_test.appendChild( document.createTextNode( 'LOD Test Site' ) );
	}
	if( loggedin ) {
		IsLoggedIn = loggedin[0].firstChild.nodeValue;
		if( IsLoggedIn != "true" ) return false;
	}
	
	
	
	/*
	  * below we can pull various nodes from our xml tree *
	   *  **
	  */
	function getElemValue(xml,name) {
		var elems = xml.getElementsByTagName(name);
		return elems[0].firstChild?elems[0].firstChild.nodeValue:'';
	}
	try {	
		// firstname = xmlDoc.getElementsByTagName('firstname');
		var firstname = getElemValue(xmlDoc,'firstname');

		// is_tester = xmlDoc.getElementsByTagName('tester');
		var is_tester = getElemValue(xmlDoc,'tester') == 1 ? true : false;

		txt_firstname = document.createTextNode( firstname );
		elem_firstname = document.createElement( 'span' );
		elem_firstname.setAttribute('id','login-firstname');
		elem_firstname.appendChild( txt_firstname );
	}
	catch(e) {
	
	}
	/*
	  *** create the logout button since the user is logged in
	  *
	   */
	   
	   link_to_profile = document.createElement('a');
	   link_to_profile.setAttribute('href','//auth.ocdla.org/login1.php?retURL=https://ocdla.force.com/CPBase__profile');
	   link_to_profile.appendChild( document.createTextNode( 'My Profile' ) );
	   		
		logout = document.createElement('a');
		logout.setAttribute('href', logout_url);
		logout.setAttribute('class','item last');
		logout.appendChild(document.createTextNode('Logout'));//ajaxobj.req.responseText ));

		user_widget=document.getElementById('user-widget');	
		if( is_admin ) {
			user_widget.appendChild( store_admin );		
		}
		if( is_admin || is_tester ){
			user_widget.appendChild( lod_test );			
		}
		user_widget.appendChild( link_to_profile );
		// user_widget.appendChild( link_to_lod );
		user_widget.appendChild( logout );
		
		removeElementById( 'login-block' );//remove the login button if the user has authenticated
	

},

	
	getCookie : function(NameOfCookie) {
		
		// First we check to see if there is a cookie stored.
		// Otherwise the length of document.cookie would be zero.
		
		if (document.cookie.length > 0)
		{
		
		// Second we check to see if the cookie's name is stored in the
		// "document.cookie" object for the page.
		
		// Since more than one cookie can be set on a
		// single page it is possible that our cookie
		// is not present, even though the "document.cookie" object
		// is not just an empty text.
		// If our cookie name is not present the value -1 is stored
		// in the variable called "begin".
		
		begin = document.cookie.indexOf(NameOfCookie+"=");
		if (begin != -1) // Note: != means "is not equal to"
		{
		
		// Our cookie was set.
		// The value stored in the cookie is returned from the function.
		
		begin += NameOfCookie.length+1;
		end = document.cookie.indexOf(";", begin);
		if (end == -1) end = document.cookie.length;
		return unescape(document.cookie.substring(begin, end)); }
		}
		return null;
		
		// Our cookie was not set.
		// The value "null" is returned from the function.
	
	}//getCookie
	

};//CartLibrary

var Feed = {
	getFeed: function(ajaxobj){
		var feed_elem = document.getElementById('feed');
		feed_elem.innerHTML = ajaxobj.req.responseText;
	}
};



	
function wwwsecure(){
		
	var protocol=/https:\/\//gi;
	var www=/www/;
	var hostname, redirect;
	
	if(window.location.protocol!="https:" || window.location.hostname.search(www)==-1) {
		hostname=window.location.hostname.search(www)==-1?"www."+window.location.hostname:window.location.hostname; 
		redirect="https://"+hostname+window.location.pathname;
		window.location=redirect;
	}//if
}//wwwsecure


function init(){
	// quit if this function has already been called
	if (arguments.callee.done) return;
	
	// flag this function so we don't do the same thing twice
	arguments.callee.done = true;
	
	link_to_lod = document.getElementById('lod_link');
	var lod_href = "https://libraryofdefense.ocdla.org";
	link_to_lod.setAttribute('target','_blank');
	

	var login = document.getElementById('login') || null;
	//check here to see if we are appending an additional querystring value or adding the query string  
	// i.e., check for a ? in the querystring
	if( login ) {
		var referrer = location.pathname == '/' ? '/index.shtml' : location.pathname;
		var querystring = encodeURI(location.search) || '';
		login.href += login.href.indexOf('?')>0 ? "&" : "?";
		login.href +='action=forceLogin&ref='+referrer + querystring;
		login.href += '&server='+window.location.hostname;
		var proto = window.location.protocol;
		login.href += '&protocol='+proto.substring(0,proto.length-1);
	}
	
	var ocdlaLoginRequest = new AjaxRequest(CartLibrary.loginurl);
	//override the default DOMStringProcessor with the addButton function from the CartLibrary
	ocdlaLoginRequest.DOMStringProcessor = function(){CartLibrary.getLoginWidget(this);}
	ocdlaLoginRequest.sendRequest();	
}



function removeElementById( elem_id ) {
	try {
		elem = document.getElementById( elem_id );
		p=elem.parentNode;
		p.removeChild( elem );

	} catch(e) { throw 'removeElementById: element with id='+elem_id+' not found.'; }

}