define(["all/modules/cart/js/salesforce/visualforce-actions",
"all/modules/forms/objects/morrowBase"],function(vfActions,base){


	var form = {
		title: "Ken Morrow Award Dinner - Meal Preference",
		
		message: "Please select your meal preference",
		
		renderMe: function(){
			var fn = base.renderMe.bind(this);
			return fn(1); // One row for standard reg
		},
		
		load: function(data){
			alert("will check appropriate option");
			if(data && data.meal == "veggie"){
				document.getElementById("veggie-option").checked = true;
			}
		},
		
		getFormData: base.getFormData.bind(this),
		
		actions: {
			cancel: function(clientId,reg,fdata){
				if(window.confirm("Are you sure you want to Cancel?  Your changes will not be saved.")) {
					modal.hide();
				}
				
				return false;
			},
			add: function(clientId,reg,fdata){
				
				jsonData = JSON.stringify(fdata);
				
				vfActions.updateItem(clientId,reg,jsonData).then(function(){
					modal.hide();
				});
				
				return false;
			}
		}
		

	};
	

	
	return form;
});