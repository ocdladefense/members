function returnTrue() { return true; }
var errormsg = document.getElementById( "errormsg" );

function checkForm() { 
//if( document.forms[0] )// window.alert( "Document.forms exists" );

var zip = document.forms[0].p_zip;
var inputs = new Array( zip );

var errors = false;

function clearErrors() {
	for( i=0; i<inputs.length; i++ )
		inputs[i].setAttribute('class','');
}//
clearErrors();

/*
first
last
company
bar
work
cell
fax
email
pond_email
www

address1
address2
city
county
state

zip
/\d{5}(\-\d{4})?$/

aoi
*/

text = document.createTextNode( "There are errors in your form.  Check below:" );



function checkZip( obj ) {
	rezip = /^\d{5}(\-\d{4})?$/
	if ( obj.value.search( rezip ) == -1 ) return true;
	else return false;
}//method checkURL

for( i=0; i<inputs.length; i++ ) {
	if( inputs[i].getAttribute("class") == "error" ) { inputs[i].focus(); break; }
}//for

/*try{
re = /apples/gi;
str = "APPLES are round and APPLES are delicious";
function changeCase( match ) { return ("-"+match.toLowerCase()); }
newstr = str.replace(re,changeCase);
window.alert("Old string: "+str+"\n"+"New string: "+newstr);
} catch(e){};
*/

if( checkZip( zip ) ) try{
	errors = true; zip.setAttribute('class','error');
} catch(e){};



if( errors ) { 	if( !( errormsg.firstChild ) ) errormsg.appendChild( text ); window.location = "#top"; return false; }
return true;

}