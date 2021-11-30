//debugger;

var JSANT = function() {  
    var myPrivateProperty = null;  
    function myPrivateMethod() {  
        // some code here...  
    }  
    return {  
        ajax : {  
            someMethod:function(){ alert( this ); }
        },  
        events : {  
            // some code here...  
        },  
        dom : {  
            // some code here...  
        }  
    };  
}(); // the paranthesis will execute the function immediately  
  

var object_literal = {//object literal notation

var private_var:"My Private Variable",
alert_var:function(some_var){alert(some_var);}

}//end object literal

alert(private_var);
alert(object_literal.private_var);

window.onload = function(){

	window.alert( { whoami:function(){ return true; }, whoareu:function(){alert('hello world!')}() } );
	JSANT.ajax.someMethod();

}//onload