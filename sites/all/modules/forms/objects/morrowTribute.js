define(["all/modules/cart/js/salesforce/visualforce-actions",
"all/modules/forms/objects/morrowBase"],function(vfActions,base){


	var form = {
		title: "Message to Susan Reese",
		
		message: "Please enter your message",
		
		renderMe: function(rows) {
			rows = rows || 1;

			var data = this.getData();
			
			var container = h("div",{style:"overflow-y:scroll;"},[h("h2",{},this.title),h("p",{className:"description"},this.message)]);
			
			
	
			container.children.push(h("textarea",{cols:"30",rows:"15"}));
			
			return container;
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