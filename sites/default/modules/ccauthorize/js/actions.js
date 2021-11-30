define([],function(){

	var DEBUG = false;
	
	function log(m){
		DEBUG && console.log(m);
	}


	/**
	 * @method, complete Transaction
	 *
	 * @description, for free Orders.
	 *
	 */
	var completeTransaction = function(ccData){

		return OCDLA.Checkout.callouts.convertShoppingCartToOrder(ccData.OpportunityId,{})
		.then(function(orderStub){
			orderStub.OrderId = !orderStub.Id ? orderStub.OrderId : orderStub.Id;
			console.log("Order stub is: ");
			console.log(orderStub);
			return Promise.resolve({order:orderStub,ccResp:{}});
		});
		
	};
	/**
	 * @method, pay
	 *
	 * @param, cartId, the Id of the Opportunity assigned to this Shopping Cart experience.
	 *
	 * @description, The pay() method takes the customer's checkout data and
	 * calls backend methods to convert the Opportunity to an Order in Salesforce.
	 *
	 */
	var pay = function(ccData) {

		return OCDLA.Checkout.callouts.convertShoppingCartToOrder(ccData.OpportunityId,ccData).
		then(function(orderStub){
			var reqData, $form, mockResp;
		
			log('order stub created.');
			log(orderStub);

			ccData.OrderNumber = orderStub.OrderNumber;
			ccData.OrderId = orderStub.Id;
			ccData.httpDelegate = OCDLA.authNetCalloutDelegate;

			if(window.isTest) {
				log('Not doing callout... using test response.');
				return Promise.resolve({order:ccData,ccResp:{}});
			} else {
				$form = jQueryPostPayment(OCDLA.authorizeDotNetWebService,ccData);
				return $form.then(function(ccResp){
					return {order:ccData,ccResp:ccResp};
				});
			}
		});
	};
	
	
	var payNow = function(url,postData){
		return fetch(url,{
			method: "POST",
			// mode: "same-origin",
			cache: "no-cache",
			headers: {
				'Accept': 'application/json',
				//'Content-Type':'application/json'
				'Content-Type':'application/x-www-form-urlencoded'
			},
			body: postData//postData//JSON.stringify(postData)
		})
		.then( function(resp){
			return resp.json();
		});
	};
	
	var checkAuthNetResponse = function(auth) {
		log(auth);
		var code = auth.TransactionResponseMessageCode;
		var isError = code.indexOf('Error') === 0; // Need better error parsing.
		var message = (code.trim() + ':\n\n'+auth.TransactionResponseDescription);
		if(isError) {
			throw new Error('Authorize.net responded with the following	'+message);
		}
		return auth;
		// modal.setStatus('Your card was successfully charged.');
	};
	

	var jQueryPostPayment = function(url,postData){
		return new Promise(function(resolve,reject){
	
			var fn = function(data){
				DEBUG && console.log(data);
				var ccResp = JSON.parse(data);
				// ccResp.orderId = postData.orderId;
				DEBUG && console.log(ccResp);
		
				// If there were errors we reject this Promise.
				if(ccResp.TransactionError || ccResp.error || ccResp.TransactionResponseMessageCode != '1') {
					reject(ccResp.TransactionResponseDescription);
				} else {
					resolve(ccResp);
				}
			};
		
			jQuery.ajax({
				url: url,
				method: 'POST',
				type: 'POST',
				data: postData,
				cache: false,
				// dataType: 'jsonp',
			
				// jsonp: 'callback',
				// jsonpCallback: 'parseAuthorizeDotNetResponse',
				success: fn
			});
		});
	};

	
	function finalizeOrder(orderId,ccResp) {
		console.log("Preparing to finalize Order for OrderId: "+orderId);
		return new Promise(function(resolve,reject){
			ClickpdxCheckoutController.finalizeOrder(orderId,ccResp,function(result, event){
				if (event.status) {
					resolve(result);
				} else if (event.type === 'exception') {
					reject(event.message + event.where);
				} else {
					reject(event.message);
				}
			}, 
			{escape: true});
		});
	}


	return {
		finalizeOrder: finalizeOrder,
		completeTransaction: completeTransaction,
		pay: pay,
		payNow: payNow,
		checkAuthNetResponse: checkAuthNetResponse
	};
	
});