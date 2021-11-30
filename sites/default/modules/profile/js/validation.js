var errormsg = document.getElementById( "errormsg" );

ContactInfo = new FormChecker();
ContactInfo.addField("phones","p_work");
ContactInfo.addField("phones","p_fax");
ContactInfo.addField("phones","p_cell");
ContactInfo.addField("emails","p_email");
ContactInfo.addField("emails","p_pond_email");
ContactInfo.addField("urls","p_www");



function checkForm() { 
	//window.alert( ContactInfo.getErrors() );
	//if( document.forms[0] )// window.alert( "Document.forms exists" );
	var text = document.createTextNode( "There are errors in your form.  Check below:" );

	//this function could be moved within the FormChecker class	
	function reformatNumber( obj ) {
	//	use javascript to reformat number
		obj.value = obj.value.replace( /[\(\)\.\-\s]/g,"");
	}//method reformatNumber

	function checkZip( obj ) {
		rezip = /\d{5}(\-\d{4})?$/
		if ( obj.value.search( rezip ) == -1 ) return true;
		else return false;
	}//method checkURL
	
	ContactInfo.clearErrors();
	ContactInfo.checkPhones();
	ContactInfo.checkEmails();
	ContactInfo.checkURLs();
	//form.check();//boolean function() check throws
	if( ContactInfo.getErrors() ) if( !( errormsg.firstChild ) ) { errormsg.appendChild( text ); window.location = "#top"; }

	inputs = ContactInfo.getInputs();
	//window.alert( ContactInfo.getInputs() );
	for( i=0; i<inputs.length; i++ ) {
		if( inputs[i].getAttribute("class") == 'error' ) { inputs[i].focus(); break; }
	}//for
	
	phones = ContactInfo.getPhones();	
	if( ContactInfo.getErrors() ) return false;
	else { for( elem=0; elem<phones.length; elem++ ) reformatNumber( phones[elem] ); return true; }


}//method checkForm