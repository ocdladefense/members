/**
 * need to update line 29
 */
var pdscripts = [
	"libs",
	"all/modules/cart/js/salesforce/visualforce-actions",
	"default/modules/paidoffice/js/validate"
];



define(pdscripts,function(libs,cartActions,validate){

	
	var view = libs.getModule("view");
	
	function saveRegistrant(data){

		var errors = [];
		// clearEventRegistrationErrors();
		
		var thePromise;

		validate.validateMember(data);
		data.quantity = "1.0";

		
		thePromise = cartActions.updateItem(data.clientId,data);

		
		
		thePromise.then(function(response){
			console.log(response);
			return response;
		})
		.catch(function(e){
			console.log(e);
			throw new Error(e);
		});

			
			
		return thePromise;
	}


	function setRegistrantOpportunityLineItemId(clientId,id){
		var container = document.getElementById("registrant-"+clientId);
		var node = document.getElementById("id-"+clientId);
		node.value = id;
	}

	function removeRegistrant(registrantId,opportunityLineItemId){
		clearEventRegistrationErrors();
		console.log('Attempting to remove registrant with clientId: '+registrantId);
		$('#registrant-'+registrantId).slideUp(600,function(){ $(this).remove(); });
		if('' != opportunityLineItemId || null != opportunityLineItemId) {
			console.log('Will attempt to delete: '+opportunityLineItemId);
			removeFromCart(opportunityLineItemId);
		}
	}


	function generateCid(){
		return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
				var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
				return v.toString(16);
		});
	}



	function getMembershipOptions(){
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
			membershipOptions: getMembershipOptions()
		};

		return view.loadTemplate("//"+OCDLA.domain+"/sites/default/modules/paidoffice/js/templates/member.html?"+obj.clientId)
		.then(function(tpl){
			return view.parse(tpl,obj,{replaceAll:true});
		})
		.then(function(html){
			$("#membership-form").append(html).slideDown('600',function(){
				$(this).show();
			});
		});
	}
	
	return {
		newRegistrant: newRegistrant,
		saveRegistrant: saveRegistrant,
		removeRegistrant: removeRegistrant,
		setRegistrantOpportunityLineItemId: setRegistrantOpportunityLineItemId
	};
		
	
});