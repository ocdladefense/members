define(["default/modules/donate/js/components/form/data",
"default/modules/donate/js/components/form/validate"],function(modData,modValidator){


	/** @var the target for add-to-cart action */
	var selector;


	/** @var the function to be executed */
	function submitDonationForm(){
		var errors;
	
		var oppLineItemId,   
		clientId,  
		pricebookEntryId,  
		quantity,  
		firstName,  
		lastName,   
		email,  
		price,
		options;

		var errorInfo;

		$('.errors').addClass('errors-hidden');	
		$('.add-to-cart-donation-button').addClass('loading');
	
		try {
			oppLineItemId = null;
			clientId = null;
			pricebookEntryId = $('#pricebookEntryId').val();
			quantity = 1;
			firstName = null;
			lastName = null;
			email = null;
			price = $('#otherAmount').val();
			options = {
				frequency: $('#oneTime').is(':checked') ? 'single' : 'recurring',
				effectiveDate: $('#chargeDate').val(), // in the future, we can do $('#startDate').val()
				memorial: ''
			};

			// errorInfo = modValidator.validate(priceBookEntryId, price, options);
			// errorInfo = DONATE.validateForm(pricebookEntryId, price, options);
			/*
			if(null != errorInfo.id){
				console.log('#'+errorInfo.id+'-errors');
				$('#'+errorInfo.id+'-errors').removeClass('errors-hidden');
				throw new Error(errorInfo.message);
			}
			*/
		
		} catch(e) {
			errors = true;
			console.log(e);
			alert("Please completely fill out the donation form.");
			$('.add-to-cart-donation-button').removeClass('loading');
			return false;
		}
	

		console.log('PricebookEntryId is: '+pricebookEntryId);
		console.log('Price is: '+price);
		console.log(options);
	
		cartActions.addDonation(pricebookEntryId,price).then(function(){
			alert("Thank you!  The donation was added to your cart.");
		});
		// This is the Salesforce integration JavaScript method!
		// addToCart(oppLineItemId, clientId, pricebookEntryId, quantity, firstName, lastName, email, price, JSON.stringify(options)); 
		
		return false;
	}


	function changeFund(e){
		$pricebookEntryId = $(this).val();
		var fund, description, name;

		fund = modData.getFund($pricebookEntryId);
		name = fund.name;
		description = fund.description || '<span style="font-style:italic;">There is no description for this Fund.</span>';

		$('#fund-description').html('<span class="fund-name">'+name+'</span><span class="fund-description">'+description+'</span>').css({display:'block'});
	}
	
	
	
	return {
		changeFund: changeFund,
		submit: submitDonationForm
	};	

});