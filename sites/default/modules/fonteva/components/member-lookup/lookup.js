	/**
	 * @queryMember,
	 *
	 * @description, Query a member from their MemberId.
	 *
	 *	@param, memberId
	 *		The member id of the IABC Contact.
	 *
	 *	@param, data
	 *		The data, a serialized JSON string to be saved into the OpportunityLineItem.Data__c field.
	 */
	function queryMember(memberId){
		console.log("inside query member");
		return new Promise(function(resolve,reject) {
			Member.lookup(memberId,function(result, event){
				if(event.status) {
					resolve(result);
				} else {
					reject(event)
				}
			}, 
			{escape: true});
		});
	}
	
	
	function getMessage(key){
		var NO_RESULTS_FOUND = "Sorry, we couldn't find a current IABC account with that Member ID.<br /> If you're a new member or rejoining <a style='text-decoration:underline;' href='/joinapi__membershiplist?id=a27f2000004ZLxgAAG&order=1'>click here.</a>";
		
		var DUP_RESULTS_FOUND = "There was an issue retrieving your IABC account.  Please contact IABC at <a href='tel:8007764222'>800.776.4222</a> or <a href='mailto:member_relations@iabc.com?subject=IABC%20Membership%20Renewal'>email us.</a>";
		
		var messages = {
			NO_RESULTS_FOUND: NO_RESULTS_FOUND,
			DUP_RESULTS_FOUND: DUP_RESULTS_FOUND
		};
		
		return messages[key];
	}



function setup(){	
		var button = document.getElementById("member-lookup-button");
		console.log(button);
		
		var fn = function(e){
			console.log("hello");
			$("body").removeClass("show-errors");
			e.preventDefault();
			e.stopPropagation();
			var target = e.target;
			var className = target.id+"-loading";
			var memberId = document.getElementById("member-id").value;
			// id 
			$("body").addClass(className);
			$("body").toggleClass("loading");
			
			
			var validate = new Promise(function(resolve,reject){
				if(memberId == "" || memberId.trim() == "" || null == memberId){
					reject("This value cannot be blank.");
				} else {
					resolve(memberId);
				}
			});
			
			var custom = function(memberId){
				
				return queryMember(memberId)
				.then(function(member){
				
					console.log(member);
					if(!member || !member.c){
						var message = getMessage(NO_RESULTS_FOUND);

						throw new Error(message);
					}

					window.location.href="/MembershipRenewal?id="+member.c.Id;

				});
				
				$('body').removeClass(className);
				$("body").toggleClass("loading");
			};
			
			validate.then(custom)
			.catch(function(err){
				var error = document.getElementById("member-id-field-messages");
				error.innerHTML=err;
				$('body').addClass("show-errors");
				$('body').removeClass(className);
				$("body").toggleClass("loading");
			});

			return false;
		};
	
		addMyEvent(button,"click",fn,{"capture":true});
}
                
	
	
	function addMyEvent(elem,type,fn,opts){
		elem.addEventListener(type,fn,opts);
	}