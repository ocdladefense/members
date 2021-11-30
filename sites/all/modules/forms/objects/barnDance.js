define([],function(){

	/**
	 * TEMPLATE FOR A FORM OBJECT
	 */

	var form = {
		title: "OCDLA 2019 Annual Conference... Barn Dance!",
		
		templateFile: "/barn-dance.html",
		
		message: "A FREE ticket to the Barn Dance and dinner is included with your AC 2019 ticket purchase.  Choose your meal preference for the Barn Dance dinner:",
		
		load: function(data){
			alert("will check appropriate option");
			if(data && data.meal == "veggie"){
				document.getElementById("veggie-option").checked = true;
			}
		},
		
		formData: function(){
			$meal = $("input[name='meal']:checked").val();
			return {meal: $meal};
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
				addToCart(null,null,pricebookEntryId,1,null,null,null,null,jsonData);
				
				cartUiSuccess(pricebookEntryId);
				
				return false;
			}
		}
	};
	
	return form;
});