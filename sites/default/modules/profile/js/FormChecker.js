function FormChecker() {
	this.errors = false;
	this.phones = new Array();
	this.emails = new Array();
	this.urls = new Array();
	this.zips = new Array();
	this.inputs = new Array();
	this.addField = function( type,name ) {
		//try {
		elem = eval( "document.forms[0]."+name );	
		if(elem==null) throw new Error("The input field `"+name+"` was not found.");
		
		//} catch(e) { }
		tmp = eval("this."+type); tmp[tmp.length] = elem;
		this.inputs[this.inputs.length] = elem;
		return elem;
	}//method addField
	this.getPhones = function(){ return this.phones; }
	this.getInputs = function(){ return this.inputs; }
	this.getErrors = function(){ return this.errors; }
}//Form constructor

FormChecker.prototype.checkPhones = function() {
	for( elem=0; elem<this.phones.length; elem++ ) if( checkLength( this.phones[elem] ) ) try{
		this.errors = true; this.phones[elem].setAttribute('class','error');
	} catch(e){};
	
	function checkLength( obj ) {
		var re10digit_1 = /^\d{10}$|^$/; //regular expression defining a 10 digit number
		var re10digit_2 = /^\(\d{3}\)[\-\.\s]?\d{3}[\-\.\s]?(\d{4})$|^$/; //regular expression defining a 10 digit number
		var re10digit_3 = /^\d{3}[\-\.\s]?\d{3}[\-\.\s]?(\d{4})$|^$/;
		if (obj.value.search(re10digit_1)!=-1 || obj.value.search(re10digit_2)!=-1 || obj.value.search(re10digit_3)!=-1)
		//if re10digit_1 is null or undefined search always returns true;
		//if the phone number matches any of the acceptable formats
		return false;
		else return true;//window.alert("Please enter a valid 10 digit number inside form.")
	}//method checkLength
}//method checkPhones

FormChecker.prototype.checkEmails = function() {
	for( elem=0; elem<this.emails.length; elem++ ) if( checkEmail( this.emails[elem] ) ) try{
		this.errors = true; this.emails[elem].setAttribute('class','error');
	} catch(e){};
	
	function checkEmail( obj ) {
		var reemail = /^(\w\.?)+\100{1}[\w-]+(\56{1}[\w\-]+){1}(\56{1}[\w\-]+){0,2}$|^$/;//(\56{1}\w+)?$/; //regular expression defining a generic email address
		if (obj.value.search(reemail)==-1) //if match failed
		return true;//window.alert("Please enter a valid email address.")
		else return false;
	}//method checkEmail
}//method checkPhones

FormChecker.prototype.checkURLs = function() {
	for( elem=0; elem<this.urls.length; elem++ ) if( checkURL( this.urls[elem] ) ) try{
		this.errors = true; this.urls[elem].setAttribute('class','error');
	} catch(e){};
	
	function checkURL( obj ) {
		http = /^http:\/\/|http:\/\//;
		reurl = /^\w+(\56{1}[\w-]+){1}(\56{1}[\w-]+){0,4}(\/[^\/\.]{1}[^\/]+)*\/?$|^$/;
		//(\/[^\/]+){0,}
		test_reurl = /(\/.+){0,}$/;
		if ( obj.value.search( reurl ) == -1 || obj.value.search( http ) != -1) //if match failed
		return true;
		else return false;
	}//method checkURL	
}//method checkURLs

FormChecker.prototype.clearErrors = function clearErrors() {
		this.errors = false;
		for( i=0; i<this.inputs.length; i++ )
			this.inputs[i].setAttribute('class','');
}//method clearErrors