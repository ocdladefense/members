//ocdla_ldoc_discaimer_i_agree
//ocdla_ldoc_disclaimer_submit


function associateObjWithEvent(obj,methodName){
	//interf = interf || window;
	
    /* The returned inner function is intended to act as an event
       handler for a DOM element:-
    */
    return (function(e){
        /* The event object that will have been parsed as the - e -
           parameter on DOM standard browsers is normalised to the IE
           event object if it has not been passed as an argument to the
           event handling inner function:-
        */
        //window.alert(obj);
        e = e||window.event;// Wow!  This works in Internet Exporer
        /* The event handler calls a method of the object - obj - with
           the name held in the string - methodName - passing the now
           normalised event object and a reference to the element to
           which the event handler has been assigned using the - this -
           (which works because the inner function is executed as a
           method of that element because it has been assigned as an
           event handler):-
        */
        return obj[methodName](e, this);
    });
}


function Form_ocdla_ldoc_disclaimer( frm ) {
	this.frm = frm;
	//this.frm.onsubmit = function(){ return this.check(); } // this requires DOM binding
	this.iagree = this.frm.elements["ocdla_ldoc_disclaimer_i_agree"];
	this.submit_button = this.frm.elements["ocdla_ldoc_disclaimer_submit"];
	this.cancel_button = this.frm.elements["ocdla_ldoc_disclaimer_cancel"];
	this.action = this.frm.elements["ocdla_ldoc_disclaimer_action"].value=="submit"?"submit":"cancel";
	//window.alert(this.submit_button);
	this.iagree.onclick = associateObjWithEvent(this,"doOnClick");
	this.cancel_button.onclick = associateObjWithEvent(this,"doOnClick");
	this.frm.onsubmit = associateObjWithEvent(this,"doOnSubmit");
}//constructor

Form_ocdla_ldoc_disclaimer.prototype.alert = function(type,field_name) {
	
	switch( type ) {
		case "user_input_field_not_checked":
			break;
		
	}

}//alert

Form_ocdla_ldoc_disclaimer.prototype.toString = function() {
	tmp = '';
	for( i=0; i<this.frm.length; i++ ) {
		tmp += this.frm[i].name + ": " + this.frm[i].value + "\n\n";
	}//for
	//window.alert( tmp );
	return false;

}

Form_ocdla_ldoc_disclaimer.prototype.doOnSubmit = function(event, element){
	//set the form object
	//window.alert("form submitted");
	if( this.cancelled ) return false;
	try{
		if( this.iagree.checked == false ) { return(this.toString()); return false; }
		else return true;
	} catch(e) { return false; }
	
}//doOnSubmit

Form_ocdla_ldoc_disclaimer.prototype.setAction = function( action ) {
	switch( action ) {
		case "cancel":
			this.frm.elements["ocdla_ldoc_disclaimer_action"].value="cancel";
			this.frm.submit();
			break;
	}
}

Form_ocdla_ldoc_disclaimer.prototype.doOnClick = function(event, element){
	//window.alert(element.name);
	switch(element.name) {
		case "ocdla_ldoc_disclaimer_cancel":
			this.setAction("cancel");
			break;
		case "ocdla_ldoc_disclaimer_i_agree":
		
			if(element.checked == true) { element.value="1"; this.submit_button.disabled = false; }
			else if(element.checked == false) { element.value="0"; this.submit_button.disabled = true; }
			break;
	
	}//switch
}//method Form_ocdla_ldoc_disclaimer
	

//Form.behaviors

frm = new Form_ocdla_ldoc_disclaimer( document.getElementById('ocdla_ldoc_disclaimer') );
//document.getElementById('ocdla_ldoc_disclaimer').onsubmit = function(){ return frm.check(); }