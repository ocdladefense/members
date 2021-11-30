(function(window,OCDLA,$){
	var DEBUG = false;

	function validateContact(email) {
		return new Promise(function(resolve,reject){
			ClickpdxCheckoutController.checkOrderEmail(email,function(result, event){
				DEBUG && console.log(result);
				DEBUG && console.log(event);
				if (event.status) {
					resolve(result);
				} else {
					reject(result,event);
				}
			}, 
			{escape: true});
		});
	}
	
	
	function hasShippableItems(cartId) {
		return new Promise(function(resolve,reject){
			ClickpdxShoppingCart.hasShippableItems(cartId,function(result, event){
				DEBUG && console.log(result);
				DEBUG && console.log(event);
				if (event.status) {
					resolve(result);
				} else {
					reject(result,event);
				}
			}, 
			{escape: true});
		});
	}

	
	function generateGuestCheckoutContact(c,shoppingCartId) {
		return new Promise(function(resolve,reject){
			ClickpdxCheckoutController.generateGuestCheckoutContact(c,shoppingCartId,function(result, event){
				DEBUG && console.log(result);
				DEBUG && console.log(event);
				if (event.status) {
					resolve(result);
				} else {
					reject(result,event);
				}
			}, 
			{escape: true});
		});
	}
	
	
	function attachAccountToShoppingCart(contact,shoppingCartId) {
		return new Promise(function(resolve,reject){
			ClickpdxCheckoutController.attachAccount(contact,shoppingCartId,function(result, event){
				DEBUG && console.log(result);
				DEBUG && console.log(event);
				if (event.status) {
					resolve(result);
				} else {
					reject(event);
				}
			}, 
			{escape: true});
		});
	}
	
	
	function convertShoppingCartToOrder(oppId,billingData) {
		console.log('Billing Data is');
		console.log(billingData);
		return new Promise(function(resolve,reject){
			ClickpdxCheckoutController.processOrderStub(oppId,billingData,function(result, event){
				if (event.status) {
					resolve(result);
				} else {
					reject(event);
				}
			}, 
			{escape: true});
		});
	}

	
	var doAuthorizeDotNetCallout = function(ccData,settings) {
		var intf = {
			'apexType':appSettings.authorizeDotNetCallableImplementation || null,
			'domain':settings.remoteCCProcessingDomain,
			'endpoint':'ccAuthorize'
		};
		
		ccData.apexType = intf.apexType;
		ccData.domain = intf.domain;
		ccData.endpoint = intf.endpoint;
		


		
		return new Promise(function(resolve,reject){
		
			var fn = function(result,event){
				var ccResp = JSON.parse(result.body);
				ccResp.OrderId = ccData.OrderId;
				// console.log(ccResp);
			
				// If there were errors we reject this Promise.
				if(ccResp.TransactionError || ccResp.error || ccResp.TransactionResponseMessageCode != '1') {
					reject(ccResp);
				} else {
					resolve(ccResp);
				}
			};
		
			if(!ccData.apexType) {
				delete ccData.apexType;
				ClickpdxCore.Api0_1.doDefaultHttpCallout(ccData,fn,{escape: false});				
			} else {
				ClickpdxCore.Api0_1.doHttpCallout(intf,{},function(result, event){
					if (event.status) {
						resolve(result);
					} else {
						reject(event);
					}
				}, 
				{escape: false});
			}
		});
	};

	
	
	var callouts = {
		doAuthorizeDotNetCallout: doAuthorizeDotNetCallout,
		validateContact: validateContact,
		hasShippableItems: hasShippableItems,
		generateGuestCheckoutContact: generateGuestCheckoutContact,
		attachAccountToShoppingCart: attachAccountToShoppingCart,
		convertShoppingCartToOrder: convertShoppingCartToOrder
	};


	OCDLA.Checkout.callouts = callouts;

})(window,OCDLA,jQuery);