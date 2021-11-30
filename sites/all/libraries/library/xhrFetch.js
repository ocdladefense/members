define([],function(){

	var STATUSES = {
		OK: 200,
		NONE: 0,
	};
	
	var READY_STATES = {
		UNSENT: 0,
		OPENED: 1,
		HEADERS_RECEIVED: 2,
		LOADING: 3,
		DONE: 4
	};
	
	var RESPONSE_TYPES = {
		document: "document",
		json: "json",
		text: "text"
	};

	/*
	function doOnLoad(e){
		var xhr = e.target;
		var arraybuffer = xhr.response; // not responseText
	}
	*/
	
	var fn = {
		response: null,
		
		readyState: null,
		
		responseXML: null,
		
		
	};


	function msieversion() {

			var ua = window.navigator.userAgent;
			var msie = ua.indexOf("MSIE");

			return ((-1 != msie) || !!navigator.userAgent.match(/Trident.*rv\:11\./));
	}

	function fetch(url,responseType) {
		responseType = responseType || RESPONSE_TYPES.document;

		var xhr = new XMLHttpRequest();
		
		var thePromise = new Promise(function(resolve,reject){
			xhr.onreadystatechange = function(e){
				var xhr = e.target;
				// console.log("Xhr ready state is: "+xhr.readyState);
				// console.log("Xhr response type is: "+xhr.responseType);
				if(xhr.readyState === READY_STATES.DONE && xhr.status === STATUSES.OK) {
					if(responseType === RESPONSE_TYPES.text){
						// console.log(xhr.responseText);
						console.log("resolving response");
						resolve(xhr.responseText);
					} else if(responseType === RESPONSE_TYPES.json){
						// console.log(xhr.response);
						console.log("resolving response");
						if(msieversion()){
							resolve(JSON.parse(xhr.response));						
						} else {
							resolve(xhr.response);
						}

					} else if(responseType === RESPONSE_TYPES.document){
						// console.log(xhr.responseXML);
						resolve(xhr.responseXML);
						console.log("resolving response");
					}
				}
			};
		});
		
		if(responseType === RESPONSE_TYPES.json){
			xhr.overrideMimeType("application/json");
		}
		xhr.open("GET",url,true);
		xhr.responseType = responseType;

		// xhr.onload = doOnLoad;

		xhr.send();

		return thePromise;
	}
	
	
	return {
		fetch: fetch
	};

});