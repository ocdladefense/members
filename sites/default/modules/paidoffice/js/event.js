/**
 * See line 155
 */


var mods = [
	"libs",
	"all/modules/cart/js/cart",
	"default/modules/paidoffice/js/actions",
	"default/modules/paidoffice/js/ui"
];




define(mods, function(libs,cart,actions,ui) {

	
	var libData = libs.getModule("data");
	
	var containers;

	
	
	function setup(){
		var members = document.getElementById("membership-form");
		containers = members.getElementsByTagName("ul");
		document.addEventListener("click",doAction,true);
	}
	

	
	
	var nodeData = function(node){
		var data = libData.getFormData(node);
		var selectNode = node.querySelectorAll("select[name*='membershipRenewalForm']");
		var selectedIndex = selectNode[0].selectedIndex;
		var options = node.querySelectorAll("select[name*='membershipRenewalForm']")[0].options;
		data.pricebookEntryId = options[selectedIndex].value;
		console.log("Data is: ",data);
		
		return data;
	};



	var getParentNode = function(node){
		for(var i = 0; i<containers.length; i++){
			if(containers[i] == node || containers[i].contains(node)) {
				return containers[i];
			}
		}
		return null;
	};
	
	
	
	var doAction = function(e){

		var target = e.target;
		
		var action = (target.dataset && target.dataset.action) || null;
		
		if(null == action) {
			return false;
		}
		
		var approvedActions = ["save","remove","new-member"];
		
		if(approvedActions.indexOf(action) == -1){
			return false;
		}
		

		e.stopPropagation();
		e.preventDefault();
		
		ui.showLoading();

		

		
		try {
		
			if(!!window.activeSave){
				window.clearTimeout(window.activeSave);
			}


		
			if("save"==action){
				ui.showStatus("Saving...");
				if(window.activeSaveRequest){
					throw new Error("Please wait for the previous save to complete.");
				}
				window.activeSaveRequest = true;
				var node = getParentNode(target);
				if(null == node) {
					throw new Error("Could not locate the parent node for this member.");
				}
	
				var data = nodeData(node);
				
				actions.saveRegistrant(data).then(function(data){
					cart.refreshCartComplete(data);
					ui.showStatus('Member saved.');
					var item = data.affectedItems[0];
					actions.setRegistrantOpportunityLineItemId(item.clientId,item.opportunityLineItemId);
					window.activeSave = window.setTimeout(ui.hideLoading,750);
					window.activeSaveRequest = false;
				})
				.catch(function(ex){
					window.activeSaveRequest = false;
					ui.hideLoading();
					alert(ex.message);
				});
				
				
			} else if("remove" == action){
				var node = getParentNode(target);
				if(null == node) return false;
	
				var data = nodeData(node);
				action.removeRegistrant(data);
				
				
			} else if("new-member" == action){
				ui.showStatus("Loading...");

				actions.newRegistrant(data).then(function(){
					window.setTimeout(ui.hideLoading,1200);
				});
			}
		
		} catch(e) {

			window.activeSaveRequest = false;
			if(window.confirm(e)){
				ui.showStatus("Fixing errors...");
				window.setTimeout(ui.hideLoading,3000);
			} else {
				ui.showStatus("Fixing errors...");
				window.setTimeout(ui.hideLoading,3000);
			}
		}
		
		return false;
	};




	function showEventRegistrationErrors(e) {
		$errorPanel = $('div[id*="eventErrorMessages"]');
		$errorPanel.css({'padding':'15px','background-color':'yellow','width':'95%','border-radius':'3px'});
	
		$errorPanel.fadeIn().delay(300);
		$errorPanel.html(e.message);
	}

	function clearEventRegistrationErrors(){
		$errorPanel = $('div[id*="eventErrorMessages"]');
		$errorPanel.slideUp().hide();
	}

	


	return {
		setup: setup
	};

});