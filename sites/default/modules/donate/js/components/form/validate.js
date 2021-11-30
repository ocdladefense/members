define([],function(){

	function validateForm(pricebookEntryId, price, options) {
		var theError = {
			id: null,
			message: null
		};

		if (pricebookEntryId == DEFAULT_FUND_ID) {
			theError.message = "Please select a fund to donate.";
			theError.id = 'pricebookEntryId';
			return theError;
		}

		if(price == '' || price == 0.00) {
			theError.message = "Please enter an amount greater than $0.";
			theError.id = 'otherAmount';
			return theError;
		}

		return true;
	}
	
	return {
		validate: validateForm
	};

});