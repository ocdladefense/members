(function(window,CLICKPDX,$){
	if(!window.console){
		window.console = function(e){};
	}	

	var backToStep1 = function() {
		$('#contactSearch').disabled(false);
	};	
	
	var goToStep2 = function(){
		$('#contactSearch').disabled(true);		
	};

	var newContactDialog = function(contacts){
		
		function getContact(id){
			for(i=0;i<contacts.length;i++){
				if(contacts[i].Id == id) return contacts[i];
			}
		}
		// jQuery.colorbox({html:'<h1>hello world!</h1>'});
		return function(resolve,reject){
			var $settings, contactList;
			// var c = typeof contact === 'object' ? contact : {email:contact};
			$settings = {
				width:'60%',
				height:'350px',
				className: 'dialog',
				closeButton: false,
				transition: 'fade',
				opacity: 1.0
			};
			
			contactList = '<ul class="table-headings"><li class="first-name">Name</li><li class="account-name">Account Name</li></ul>';
			
			if(null != contacts){
				for(var i =0; i< contacts.length; i++){
					var acctName = contacts[i].Account && contacts[i].Account.Name ? contacts[i].Account.Name : '';
					contactList += '<ul><li><a class="availableContact" href="#" data-contact-id="'+contacts[i].Id+'">'+contacts[i].FirstName+' '+contacts[i].LastName+'</a></li><li>' +
						'<li>'+acctName+'</li></ul>';
				}
			}

			if(null == contacts || contacts.length < 1) {
				$settings.html = "<div><h1>Confirm Email Address</h1><div>The email address<p><em>"+window.searchEmail+"</em></p>isn't in our files.  Click below to continue with your new info.<div style='padding-top:5px;border-top:1px solid #eee; margin-top:30px;'><div id='changeEmail' class='button'>Use a different email</div><div class='button' id='createNewAccount'>Continue</div></div></div>";
			} else {
				$settings.html = "<div><h1>Choose your Account</h1><div>We found "+contacts.length+" matching <em>"+window.searchEmail+". Choose the appropriate Account from the list or register with a new Account.<p class='accountList'>"+contactList+"</p><div style='padding-top:5px;border-top:1px solid #eee; margin-top:30px;'><div id='changeEmail' class='button'>Search again</div><div class='button' id='createNewAccount'>Register new account</div></div></div>";
			}

			$.colorbox($settings);

			var createNewAccountAction = function(e){
				e.target.removeEventListener('click',this,false);
				$.colorbox.close();
				reject();
				return false;
			};

			
			var selectExistingContactAction = function(e){
				var target = e.target;
				var contactId = target.dataset.contactId;
				console.log('Contact id: '+contactId);
				e.target.removeEventListener('click',this,false);
				$.colorbox.close();
				resolve(getContact(contactId));
				return false;
			};

			var editEmailAction = function(e){
				$.colorbox.close();
				reject();
				return false;
			};

			var changeEmailButton = document.getElementById('changeEmail');
			var createNewAccount = document.getElementById('createNewAccount');
			changeEmailButton.addEventListener('click',editEmailAction,false);
			createNewAccount.addEventListener('click',createNewAccountAction,false);
			
			$('.availableContact').click(selectExistingContactAction);
			
			return false;
		};
	};



	var httpPost = function(url,postData){
		return new Promise(function(resolve,reject){
		
			var fn = function(data){
				var ccResp = JSON.parse(data);
				ccResp.orderId = postData.orderId;
				console.log(ccResp);
			
				// If there were errors we reject this Promise.
				if(ccResp.TransactionError || ccResp.error || ccResp.TransactionResponseMessageCode != '1') {
					reject(ccResp);
				} else {
					resolve(ccResp);
				}
			};
			
			jQuery.ajax({
				url: url,
				method: 'POST',
				type: 'POST',
				data: postData,
				
				// dataType: 'jsonp',
				
				// jsonp: 'callback',
				// jsonpCallback: 'parseAuthorizeDotNetResponse',
				success: fn
			});
		});
	};




	
	function searchByEmail(email) {
		return new Promise(function(resolve,reject){
			ClickpdxCore.Api0_1.searchByEmail(email,function(result, event){
				if (event.status) {
					resolve(result);
				} else {
					reject(event);
				}
			}, 
			{escape: true});
		});
	}
	
	function searchContacts(params) {
		return new Promise(function(resolve,reject){
			ClickpdxCore.Api0_1.searchContacts(params,function(result, event){
				if (event.status) {
					resolve(result);
				} else {
					reject(event);
				}
			}, 
			{escape: true});
		});
	}
	
	
	function doRegistration(a,c) {
		return new Promise(function(resolve,reject){
			ClickpdxCore.Api0_1.doRegistration(a,c,function(result, event){
				if (event.status) {
					resolve(result);
				} else {
					reject(event);
				}
			}, 
			{escape: true});
		});
	}
	
	
	function doSubscription(params) {
		var intf = CLICKPDX.subscriptionCallout;
		return new Promise(function(resolve,reject){
			ClickpdxCore.Api0_1.doHttpSendable(intf,params,function(result, event){
				if (event.status) {
					resolve(result);
				} else {
					reject(event);
				}
			}, 
			{escape: true});
		});
	}






	CLICKPDX.ContactForm = {
		doSubscription: doSubscription,
		searchContacts: searchContacts,
		newContactDialog: newContactDialog,
		backToStep1: backToStep1,
		httpPost: httpPost,
		searchByEmail: searchByEmail,
		doRegistration: doRegistration
	};
	
	
})(window,CLICKPDX,jQuery);