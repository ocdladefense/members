define(["libData"],function(libData){


	
	var ccData = {

		AccountId: null,
		ContactId: null,
		
		OpportunityId: null,
		shoppingCartSummary: null,
		
		Id: null,
		OrderId: null,
		OrderNumber: null,
		OrderStatus: null,
		Description: null,
		Origin__c: null,
		PostingEntity__c: null,
		Payment_Info__c: null,
		
		amount: null,
		TotalAmount: null,
		
		AuthorizeDotNetCustomerProfileId__c: null,
		authNetPaymentProfileDescription: null,
		authNetPaymentProfileId: null,
		authNetCreatePaymentProfile: false,

		BillToContactId: null,
		FirstName: null,
		LastName: null,
		Email: null,
		BillingFirstName: null,
		BillingLastName: null,
		BillingStreet: null,
		BillingCity: null,
		BillingStateCode: null,
		BillingPostalCode: null,
		BillingEmail: null,
		BillingCountryCode: null,
		
		ShipToContactId: null,
		ShippingStreet: null,
		ShippingCity: null,
		ShippingStateCode: null,
		ShippingPostalCode: null,
		ShippingCountryCode: null,
		sameShipping: true,
		
		ccNum: null,
		ccExp: null,
		ccCode: null
	};
	
	
	var validate = function(ccData){
		return true;
	};
	

	var getActualData = function(){
		var wire = libData.clone(ccData);
		for(var prop in ccData){
			var elem = document.getElementById(prop);
			wire[prop] = libData.getValue(elem);
		}
		wire.amount = !wire.TotalAmount ? wire.amount : wire.TotalAmount;
		wire.ContactId = !wire.BillToContactId ? wire.ContactId : wire.BillToContactId;
		wire.Status = wire.OrderStatus;

		if(parseInt(wire.authNetPaymentProfileId) < 1000){
			delete wire.authNetPaymentProfileId;
		}
		// console.log(wire);
		return wire;
	};
	
	var setData = function(data){
		for(var prop in data){
			var elem = document.getElementById(prop);
			if(!elem) {
				console.warn(prop,": element with that id not found."); 
				continue;
			}
			libData.setValue(elem,data[prop]);
		}
	};
	

	function getDefaultCheckoutFields(){
		return libData.clone(ccData);
	}

	
	return {
		getData: getActualData,
		ccData: getActualData,
		setData: setData
	};

});