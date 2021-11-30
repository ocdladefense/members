var showMatchingFields = true;

$(function(){
		$('.fs-section').hide();


var doSearch = function(e) {
	e.preventDefault();
	e.stopPropagation();
	
	window.searchEmail = $('#contactSearch').val();
	window.selectedContact = {};
	
	CLICKPDX.ContactForm.searchContacts({Email: window.searchEmail}).then( function(results){
		console.log(results);
		return new Promise(CLICKPDX.ContactForm.newContactDialog(results));
	})
	.then( function(contact){
		selectedContact = contact;
		$('input[name*="Email"]').val(window.searchEmail);
		console.log(contact);
		for(var i in contact){
			var sel = '*[name="'+i+'"]';
			console.log('setting sel to: '+sel);
			$(sel).val(contact[i]);
		}

		$('.package-default-account-lookup').slideUp();
		$('.fs-section').show();
	})
	.catch( function(reason){
		$('.package-default-account-lookup').slideUp();
		$('.fs-section').show();	
		// console.log(reason);
		// alert(reason.message);
	});
	
	return false;
};


var doRegistration = function(e) {

	try {
	e.preventDefault();
	e.stopPropagation();
	
	$('#doRegistration').addClass('loading');
	document.getElementById('doRegistration').removeEventListener('click', doRegistration, false);
	
	var contact = window.selectedContact;
	contact.OrderApi__Personal_Email__c = $('#contactSearch').val();
	contact.Price_Level__c = 'Registration Form';
	contact.Email = $('#contactSearch').val();
	
	// for each field with a class of field-name
	  // pull the actual field name and add it as a property of this Contact object
	$('.fs-section-Contact .form-field').each(function(elem){
		var name = $(this).prop('name');
		contact[name] = $(this).val();
	});
	
	var accountId = window.selectedContact.AccountId || CLICKPDX.parentAccountId || null;
	contact.AccountId = accountId;
	
	var account = {
		Id: accountId
	};
	
	
	if(account.Id != CLICKPDX.parentAccountId){
			account.Name = (contact.FirstName + ' ' + contact.LastName);
	}

	var processUpdate = function(results){
		console.log(results);
		// alert('Saved!  Should probably redirect to a welcome page that also explains that a new registration email has been sent.');
		return contact;
	};



	CLICKPDX.ContactForm.doRegistration(account,contact).then( processUpdate )
	.then( function(contact){
		var params = {
			email: contact.Email,
			firstName: contact.FirstName,
			lastName: contact.LastName
		};
		if(!$('#subscriptionCheck').prop('checked')) {
			console.log('subscription is not checked');
			return contact;
		} 
		else return CLICKPDX.ContactForm.doSubscription(params).then( function(result){
			// alert(result.body);
		})
	})
	.then( function(){
		updateViewCompleteRegistration();
	})
	.catch( function(reason){
			console.log(reason);
			$('#doRegistration').removeClass('loading');
			 var submit = document.getElementById('doRegistration');
			 submit.addEventListener('click', doRegistration, false);
			alert(reason.message);
			return false;
	});

	} catch(e) {
		$('#doRegistration').removeClass('loading');
		 var submit = document.getElementById('doRegistration');
		 submit.addEventListener('click', doRegistration, false);
		alert(e);
		return false;		
	}
	
	return false;

};


var updateViewCompleteRegistration = function(){
	$('#doRegistration').removeClass('loading');
	$('#doRegistration').addClass('registration-success');
	$('#doRegistration .button-label').text('Success!');
	document.getElementById('doRegistration').removeEventListener('click', doRegistration, false);
};

// Testing code
var doSubscription = function(e){
	e.preventDefault();
	e.stopPropagation();
	var params = {
		email: 'jbernal.web.dev@gmail.com',
		firstName: 'Jose',
		lastName: 'Bernal'
	};
	CLICKPDX.ContactForm.doSubscription(params).then( function(result){
		alert(result.body);
	})
	.catch( function(error){
		console.log(error);
	});
};
 
 var submit = document.getElementById('searchContacts');
 submit.addEventListener('click', doSearch, false);
 
 
 
 var submit = document.getElementById('doRegistration');
 submit.addEventListener('click', doRegistration, false);
 	


var submit = document.getElementById('doSubscription');
submit.addEventListener('click', doSubscription, false);	
});