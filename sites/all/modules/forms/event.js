define(["all/modules/forms/form-manager"],function(manager){

	/**
		* 
		* @constructor
		*
		* @param {json} response - The JSON representation of a ClickpdxCartResponse object
		*/
	var handler = function(response){

	
		var manager = FormManager.newFromCartResponse(response);
		
		// m.setHandler(getUpdateFunc(item.opportunityLineItemId));
		console.log(manager);
		if(manager.hasForms()){
			var modal = modal || new Modal();
			modal.html(manager.getFirst().getContent());
			// modal.setHandler(manager);
			modal.show();
		}
	
	};
	
	
	return {
		handler: handler
	};
	
});