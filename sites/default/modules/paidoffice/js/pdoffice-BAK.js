$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
}


$(function(){
	window.showTab = function(tabId){
		if(!$('#'+tabId).length) return false;
		$('.panel').removeClass('panel-active');
		$('.panel').hide();
		$('#'+tabId).addClass('panel-active');
		$('#'+tabId).show();
	}
	
	var selectedTickets = document.getElementsByClassName('priceBookEntryId');
	for(var i = 0; i<selectedTickets.length; i++){
		var selectedPbEntry = selectedTickets[i].dataset.selectedId;
		var options = selectedTickets[i].options;
		for(var idx = 0; idx < options.length; idx++){
		 if(options[idx].value == selectedPbEntry){
		 	options[idx].selected = true;
		 	break;
		 }
		}
	}

});


/*
ClickpdxCart.onRefreshCart(function(responseData,request,event,data){
	console.log(responseData);
});

$(function(){
	
	ClickpdxCart.onComplete(function(responseData,request,event,data){
		var pricebookEntryId, error, message;
		var clientId, ids;
		
		pricebookEntryId = responseData.item.priceBookEntryId;
		error = responseData.error || false;
		message = responseData.message || '';
		
		console.log('responseData is:');
		console.log(responseData.item);
		// alert(responseData);
		
		clientId = responseData.item.clientId;
		ids = responseData.item.ids;
		
		$('#clientId-'+clientId).val(clientId);
		var pointer = document.getElementById('clientId-'+clientId);
		pointer.dataset.opportunityLineItemId = ids;
		// $('#clientId-'+clientId).data('opportunityLineItemId',ids);
		
		// alert('oppLineId is: '+pointer.dataset.opportunityLineItemId);
		// $('#id-'+clientId).val(ids);
	});

});
*/


var eventOptions = function(html){
	return function(resolve,reject){
		var $settings;

		$settings = {
			width:'60%',
			height:'550px',
			className: 'dialog',
			closeButton: false,
			transition: 'fade',
			opacity: 1.0
		};

		$settings.html = "<div><h1>Event Options</h1><div><em>Additional registration options:</em></div>"+html+"<div style='padding-top:5px;border-top:1px solid #eee; margin-top:30px;'><div id='closeModal' class='button'>Close</div><div class='button' id='updateRegistrationOptions'>Update Registration</div></div></div>";

		$.colorbox($settings);

		var updateAction = function(e){
			e.target.removeEventListener('click',this,false);
			resolve();
		};

		var cancelAction = function(e){
			$.colorbox.close();
			reject();
		};

		var cancel = document.getElementById('closeModal');
		var update = document.getElementById('updateRegistrationOptions');
		cancel.addEventListener('click',cancelAction,false);
		update.addEventListener('click',updateAction,false);
	};
};



$(function(){
	if(!window.console){
		window.console = function(e){};
	}	
	
	
	/**
	 * show Related Event Products.
	 * We need to build HTML to display on the form
	 */
	var doShowProductOptions = function(responseData,request,event,data){
		console.log(responseData);
		if(responseData && responseData.relatedProducts && responseData.relatedProducts.length > 0) {
			var relatedProducts = responseData.relatedProducts;
			var html = '';
			for(var i = 0; i<relatedProducts.length; i++){
				var prod = relatedProducts[i];
				html += '<ul class="table-row store-product-options">';
				html += '<li class="table-cell product-option-checkbox"><input type="checkbox" value="'+prod.Product2.Id+'" /></li>';
				html += '<li class="table-cell product-option-name">'+prod.Product2.Name+'<br /><span class="product-option-description">'+prod.Product2.Description+'</span></li>';
				html += '<li class="table-cell product-option-price">$'+prod.UnitPrice+'.00</li>';
				html+= '</ul>';
			}
			eventOptions(html)();
		}
	};
	
	if($.urlParam('isTest')){
		ClickpdxCart.onComplete(doShowProductOptions);
	}
	
	
	
	
	var newRegButtons = document.getElementsByClassName('local-action-new-registrant');
	
	for(var i = 0; i<newRegButtons.length; i++){
		newRegButtons[i].addEventListener('click',function(e){
			e.stopPropagation();
			e.preventDefault();
			try{ newRegistrant(); } catch(err){ showEventRegistrationErrors(err); return false;}
			$("html, body").animate({ scrollTop: $(document).height() }, "slow");
			return false;
		});
	}
	
	// Listen for click events on the save or remove buttons.
	// var registrationForm = document.querySelector("div[id*='eventRegistrationForm']");
	document.addEventListener('click',function(e){

		var target, cid;

		target = e.target;
		
		if(typeof e.target === 'undefined' || null == target) {
			return false;
		}

	try {
		
			if(target.getAttribute('class') == 'saveRegistrantButton'){
				e.preventDefault();	
				e.stopPropagation();
				cid = target.dataset.cid;
				console.log('Will attempt to save line item with Cid of: '+cid);
				saveRegistrant(cid);
				$("div[id*='shoppingCart:shoppingCartStatus']").show().delay(2000);
					//.slideUp('fast')
					//.html('');
			}
			else if(target.getAttribute('class') == 'removeRegistrantButton'){
				e.preventDefault();	
				e.stopPropagation();
				cid = target.dataset.cid;
				$opportunityLineItemId = $('#clientId-'+cid).data('opportunityLineItemId');
				if(!window.confirm('Remove this registrant from the list?')) {
					return;
				}
				removeRegistrant(cid,$opportunityLineItemId);
				$("div[id*='shoppingCart:shoppingCartStatus']").show();
			}
			else {
				return false;
			}

		
	} catch(err){
			e.preventDefault();	
			e.stopPropagation();
			showEventRegistrationErrors(err);
		}
		
			

		
		return false;
	},true);
	
});

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


function isEmpty(test){
	return typeof test === 'undefined' || null === test || '' === test.trim();
}

function saveRegistrant(cid){
			var sel, clientId, qty, firstName, lastName,
					email, oppLineItemId, priceBookEntryId;
			var errors = [];
			var $elem;
			
			clearEventRegistrationErrors();
			
		try {
				elem = document.getElementById('clientId-'+cid);
				oppLineItemId = elem.dataset.opportunityLineItemId;
				clientId = elem.value;
				priceBookEntryId = $('#priceBookEntryId-'+cid+' .priceBookEntryId').val();
				qty = 1;
				firstName = document.getElementById('firstName-'+cid).value;
				lastName = document.getElementById('lastName-'+cid).value;
				email = document.getElementById('email-'+cid).value;
			
			} catch(e) {
				errors.push(e.lineNumber + ': '+e.message);
				var showErrors = errors.join('<br />');
				throw Error(showErrors);
				return false;
			}
			
			if(isEmpty(firstName)){
				errors.push('Registrant First Name field cannot be empty.');
			}
			
			if(isEmpty(lastName)){
				errors.push('Registrant Last Name field cannot be empty.');
			}
			
			if(isEmpty(email)){
				errors.push('Registrant Email field cannot be empty.');
			}
			
			if(!!email && email.indexOf('@') === -1){
				errors.push('Enter email address in this form: abc@abc.com.');
			}
			
			if(!!errors.length){
				var showErrors = errors.join('<br />');
				throw Error(showErrors);
			}
			
			addToCart(oppLineItemId,clientId,priceBookEntryId,qty,firstName,lastName,email);
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

function loadEventRegistrationList(oppId){
	console.log('Loading opportunity id: '+oppId);
	apexLoadEventRegistrationList(oppId);
}

function goToOpportunity(oppId){
	oppId = $('select[id*="opportunityList"]').val();
	console.log('Selected opportunityId is: '+oppId);
	var url = 'https://cs3.salesforce.com/'+oppId;
	window.open(url);
	return false;
}




function newRegistrant(){


 var cid = generateCid();
 
 var template = registrantTemplate(cid);
 
 $('div[id*="eventRegistrantList"]').append(template).slideDown('600',function(){
 	$(this).show();
 });

}


function generateCid(){
	return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
			var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
			return v.toString(16);
	});
}


function getTicketOptions(){
	var tickets = window.tickets;
	var options = '';
	
	// ret = '<select name="j_id0:j_id1:j_id52:j_id53:eventRegistrationForm:j_id62:0:j_id64" class="productCode" size="1">';
	
	//for(var idx = 0; idx<tickets.length; idx++){
	for(var i=0; i<tickets.length; i++){
		var disabled = tickets[i].disabled ? ' disabled="disabled" ' : '';
		var option = '<option value="'+tickets[i].value+'"'+disabled+'>'+tickets[i].label+'</option>';
		options += option;
	}
	
	// ret += '</select>';
	


	return options;
}





function registrantTemplate(clientId){

var t = '<div class="registrant new-registrant" id="registrant-'+clientId+'">'+
'<input id="clientId-'+clientId+'" data-opportunity-line-item-id="'+'" name="clientId-'+clientId+'" value="'+clientId+'" type="hidden">                   '+
' <div class="no-mobile registrant-action">                        <button class="saveRegistrantButton" data-cid="'+clientId+'">                            save                        </button>                           </div>                    '+


'<div class="registrant-field" id="priceBookEntryId-'+clientId+'">'+
	'<select name="j_id0:j_id1:j_id52:j_id53:eventRegistrationForm:j_id62:0:j_id64" class="priceBookEntryId" size="1">	'+
		getTicketOptions() +
	'</select>'+
'</div>'+


'                    <div class="registrant-field">  <label class="mobile" for="firstName-"'+clientId+'">First Name</label> <input id="firstName-'+clientId+'" name="firstName-'+clientId+'" size="25" placeholder="First Name" value="" type="text">                      </div> '+

'                   <div class="registrant-field"> <label class="mobile" for="lastName-"'+clientId+'">Last Name</label>                                               <input id="lastName-'+clientId+'" name="lastName-'+clientId+'" size="25" placeholder="Last Name" value="" type="text">                      </div>                   '+

' <div class="registrant-field">         <label class="mobile" for="email-"'+clientId+'">Email</label>                                       <input id="email-'+clientId+'" name="email-'+clientId+'" size="25" placeholder="Email address" value="" type="text">                      </div>'+

' <div class="registrant-field">         <label class="mobile" for="license-"'+clientId+'">Bar/<br />Investigator #</label>                                       <input id="license-'+clientId+'" name="license-'+clientId+'" size="8" placeholder="License #" value="" type="text">                      </div>'+


'<div class="registrant-field">                        <input id="id-'+clientId+'" name="id-'+clientId+'" value="'+clientId+'" type="hidden">                      </div>  '+

' <div class="mobile registrant-action">                        <button class="saveRegistrantButton" data-cid="'+clientId+'">                            save                        </button>                         </div>                    '+

'</div>';

return t;

}