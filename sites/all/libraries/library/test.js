define([],function(){

	var isRunningTest = false;

	var assert = function(exp,msg){
		msg = msg || ("Assert failed.");
		if(exp === false){
			throw new Error(msg);
		}
	};

	var assertEquals = function(op1,op2,msg){
		msg = msg || ("Assert Equals failed.  Expected: "+op1+". Actual: "+op2+".");
		if(op1 != op2){
			throw new Error(msg);
		}
	};
	
	var assertNotEquals = function(op1,op2,msg){
		msg = msg || ("Assert Not Equals failed.  Expected: "+op1+". Actual: "+op2+".");
		if(op1 == op2){
			throw new Error(msg);
		}
	};
	
	var run = function(funcs){
		window.Test = {
			isRunningTest: true
		};
		
		isRunningTest = true;
		
		if(funcs.mockResponse){
			window.require = function(paths,resolve,reject){
				resolve(funcs.mockResponse);
			}
		}

		
		var results = {};
		for(var testName in funcs){
			if(!(typeof funcs[testName] === "function")) continue;
			try {
				funcs[testName]();
				console.log(testName+": Passed.");
			} catch(e) {
				console.error(testName,": ",e.message,e);
			}
		}
	};
	


	
	return {
		runTests: run,
		assert: assert,
		assertEquals: assertEquals,
		assertNotEquals: assertNotEquals
	};
	
});