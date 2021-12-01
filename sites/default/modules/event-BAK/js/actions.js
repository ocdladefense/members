define(["all/modules/cart/js/salesforce/visualforce-actions",
"libView",
"default/modules/event/js/validate"],function(cartActions,view,validate){

	var templatePath;
	
	var availableActions = {
		// Cb should be determined based on the currently executing add-to-cart pricebookEntryId
		forms: function(manager,cb) {
			// m.setHandler(getUpdateFunc(item.opportunityLineItemId));
			console.log(manager);
		
			modal = modal || new Modal();		

			if(OCDLA._get("useForms") && manager.hasForms()) {
				console.log(manager.loaded());
				manager.loaded().then(function(){
					var first = manager.getFirst();
					modal.append(first.render());
					modal.setHandler(first.getHandler());
					modal.addActions(first.buttons());
					modal.show();
				});
			}
		},
		
		error: function(resp) {
			modal.html("<h2>OCDLA Cart Error</h2><p>"+resp.message+"</p>");
			modal.show();
		}
	};
	
	function saveRegistrant(data){
	
		var errors = [];
		
		var thePromise;

		validate.validateMember(data);
		data.quantity = "1.0";

		
		thePromise = cartActions.updateItem(data.clientId,data);
		console.log(thePromise);
		
		
		thePromise.catch(function(resp) {
			// $buttonSelector.removeClass('loading');
			
			if(resp.errorType == "ClickpdxShoppingCartInvalidFormException"){
				var manager = FormManager.newFromCartResponse(resp);
				availableActions.forms(manager);	
				return false;	
			}

			
			availableActions.error(resp);
		});
			

		return thePromise;
	}


	function setRegistrantOpportunityLineItemId(clientId,id){
		var container = document.getElementById("registrant-"+clientId);
		var node = document.getElementById("id-"+clientId);
		node.value = id;
	}



	function removeRegistrant(data){
		var clientId = data.clientId;
		var opportunityLineItemId = data.opportunityLineItemId;
		// clearEventRegistrationErrors();
		console.log('Attempting to remove registrant with clientId: '+clientId);

		var thePromise = cartActions.removeItem(data.clientId,data);
		
		return thePromise.then(function(response){
			console.log(response);
			return response;
		})
		.catch(function(e){
			console.log(e);
			// throw new Error(e);
		});
	}


	function generateCid(){
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
				var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
				return v.toString(16);
		});
	}



	function getOptions(){
		var tickets = window.tickets;
		var options = '';
	
		// ret = '<select name="j_id0:j_id1:j_id52:j_id53:eventRegistrationForm:j_id62:0:j_id64" class="productCode" size="1">';
	
		//for(var idx = 0; idx<tickets.length; idx++){
		for(var i=0; i<tickets.length; i++){
			var disabled = tickets[i].disabled ? ' disabled="disabled" ' : '';
			var option = '<option value="'+tickets[i].value+'"'+disabled+'>'+tickets[i].label+'</option>';
			options += option;
		}

		return options;
	}
	
	
	function newRegistrant(cid){

		var obj = {
			clientId: generateCid(),
			options: getOptions()
		};

		return view.loadTemplate("//"+OCDLA.domain+"/"+templatePath+"?"+obj.clientId)
		.then(function(tpl){
			return view.parse(tpl,obj,{replaceAll:true});
		})
		.then(function(html){
			$("#registration-form").append(html).slideDown('600',function(){
				$(this).show();
			});
		});
	}
	
	return {
		setTemplatePath: function(url){ templatePath = url; },
		newRegistrant: newRegistrant,
		saveRegistrant: saveRegistrant,
		removeRegistrant: removeRegistrant,
		setRegistrantOpportunityLineItemId: setRegistrantOpportunityLineItemId
	};
	
	
});