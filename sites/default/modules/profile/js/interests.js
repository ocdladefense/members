	var WindowObjectReference;
	var strWindowFeatures = "width=250,height=300,left=200,top=400,location=no,resizable=yes,scrollbars=yes,status=yes";
	
	function openRequestedPopup()
	{
		WindowObjectReference = window.open("http://www.ocdla.org/help.php#aoi",
	"OCDLA Online Help", strWindowFeatures);
	}
	
	
	function checkInterestsForm(){ 
		field_match=/^p_action\[\d{1}\]$/;
		re_aoi=new RegExp("^p_aoi\\[\\d{1}\\]$");
	
	
	//return true; 
		var form=document.forms[0];
		//eval(form.p_action[i])
		tmp="";
		
		//make sure at least ONE p_action is checked when submitting this form
		action_errors=true;
		for(i=0; i<form.elements.length; i++) {
			if (form.elements[i].name.search(field_match)!=-1) { //p_action,p_aoi
				int=i;
				for(i=i;i<int+3; i++) {
					if(form.elements[i].value!="") tmp+=form.elements[i].name+"\n";
					if(form.elements[i].checked==true) {
						action_errors=false;
						tmp+=form.elements[i].name+"\n";
						break;
					}//if
				}//for
			}//if
		}//for	
		
		
	
		aoi_errors=false;
		//if a p_action is selected the value should NOT be "Choose an Interest"
	try{
		for(i=0; i<form.elements.length; i++) {
			if (form.elements[i].name.search(field_match)!=-1) { //p_action,p_aoi
					if(form.elements[i].checked==true) {
						for(i=i;i<form.elements.length; i++) {
							if(re_aoi.test(form.elements[i].name)) {
								if(form.elements[i].value=="Choose an Interest") { /*window.alert(form.elements[i].value);*/ aoi_errors=true; }
								break;
							}//if
						}//for
					}//if		
			}//if
		}//for
	} catch(e) { throw new Error("There was an error in your javascript code: "+e.toString()); }
	
		
		if(action_errors) {
			error_text='You haven\'t chosen any actions.  Select either Add, Delete or Change for an interest.';
			//window.alert( tmp );
			window.alert( error_text );
		} else if(aoi_errors) {
			error_text='You need to select a valid interest.';
			window.alert( error_text );
		}//if
	
		return (!action_errors && !aoi_errors);
	}//method checkInterestsForm
	
	
	function validateSelect( obj ) {
		var form=document.forms[0];
		//window.alert( obj.name );
	
	digi = new RegExp("\\d+");
	//digi = '/\d+/';
	row = digi.exec(obj.name);
	//window.alert( row[0] );
	
	re_action = new RegExp("^p_action\\["+row[0]+"\\]$");
	re_id = new RegExp("^p_aoi_id\\["+row[0]+"\\]$");
	
	//if(re.test( form.elements[i].name ))
	//try { myvar=evaluate('escape("p_aoi_id[0].value")'); window.alert(myvar); }
	//catch(e){window.alert(e);}
	
		
		for(i=0; i<form.elements.length; i++) {
			if ( re_id.exec(form.elements[i].name) !=null ) {
				if(form.elements[i].value=="") {
					for(i=i;i<form.elements.length; i++) {
						//if(re_action.test(form.elements[i].name)) window.alert(form.elements[i].name+": "+form.elements[i].value);
						if(form.elements[i].value=="add") { form.elements[i].checked=true; break; }
					}//for
				}
				else if(form.elements[i].value>0) {
					for(i=i;i<form.elements.length; i++) {
						//if(re_action.test(form.elements[i].name)) window.alert(form.elements[i].name+": "+form.elements[i].value);
						if(form.elements[i].value=="change") { form.elements[i].checked=true; break; }
					}//for
				}//else if
			}//if
		}//for
	
	}//validateSelect