define([],function(){

	
	// Visualforce.remoting.buffer = false;
	
	function mergeArgs(source,dest){
		dest = dest || [];
		for(var i = 0; i<source.length; i++){
			dest[i] = source[i];
		}
		return dest;
	}
	
	function getSObjects(theArgs){
		return invokeAction('OrderEntryController','getSObjects',[theArgs]).then((sobjects) => {
			return sobjects;
			/*
			return sobjects.map((sobject) => {
				var obj = Object.create(fn);
				var target = Object.assign(obj,sobject);
				// t.Items = []; Would need to locate the appropriate prototype object.
				return target;
			});
			*/
		});
	}

	
	function invokeAction(ns) {
		return function(controller,method,theArgs) {
			return new Promise(function(resolve,reject){
				var fn, cb, nArgs;
			
				try {
					fn = window[ns][controller][method];
			
					if(!fn) throw new Error('This controller/method pair does not exist.');
			
					cb = function(result,event){
						DEBUG && console.log(result);
						DEBUG && console.log(event);
						if (event.status) {
							resolve(result);
						} else {
							console.info('An error occurred for the event, ',event,'. The args were: ',nArgs);
							var message = 'Error when executing '+event.method+': '+event.message;
							reject(message);
						}
					};


					nArgs = mergeArgs(theArgs);
					nArgs.push(cb,{buffer:false,escape:true});

					fn.apply(fn,nArgs);

				} catch(e) {
					console.error(e);
					reject(e.message);
				}
			});
		};
	}
	
	return {
		invokeAction: invokeAction
	};

});