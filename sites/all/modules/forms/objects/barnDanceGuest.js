define([],function(){

	/**
	 * TEMPLATE FOR A FORM OBJECT
	 */

	var form = {
		title: "AC 2019 Barn Dance!",
		templateFile: "/barn-dance-guest.html",
		message: "Now select your guest(s) meal preferences:",
		formData: function(){
			$meat = $("select[name='meat'] option:selected").val();
			$veggie = $("select[name='veggie'] option:selected").val();
			return {meat: $meat, veggie: $veggie};
		},
		actions: {
			close: function(e){
				if(window.confirm("Are you sure you want to Cancel?  Your changes will not be saved.")) {
					cartUiFail(this.data.pricebookEntryId);
					closeModal(e);
				} else {
					return false;
				}
				return false;
			},
			add: function(e){
				var formData, jsonData, target, pricebookEntryId;
		
				target = e.target;
				
				pricebookEntryId = target.dataset.pricebookEntryId;
				
				formData = this.formData();
				console.log("Adding data, ",formData," to cart for pricebookEntryId: "+pricebookEntryId);
				jsonData = JSON.stringify(formData);
				
				// Global function call
				addToCart(null,null,pricebookEntryId,this.quantity,null,null,null,null,jsonData);
				
				cartUiSuccess(pricebookEntryId);
				
				return false;
			}
		}
	};
	
	return form;
});