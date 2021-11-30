define(function(){
	console.log('inside define');
	console.log(window);
	
	var OCDLAForms = (function($){

		var forms, m;
	
		forms =  {
			membershipProrationForm: {
				title: 'Membership Status',
				message: 'Please select one of the following:',
				formData: function(){
					$membershipType = $('input[name="membershipType"]:checked').val();
					return {price: $membershipType};
				},
				content: getMembershipProrationForm,
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
						var formData, jsonData;
					
						formData = this.formData();
						console.log('Adding to cart... for entry: '+this.data.pricebookEntryId);
						jsonData = JSON.stringify(formData);
						addToCart(null,null,this.data.pricebookEntryId,1,null,null,null,formData['price'],jsonData);
						cartUiSuccess(this.data.pricebookEntryId);
						closeModal(e);
						return false;
					}
				}
			},
			newMemberForm: {
				title: 'OCDLA New Member Info',
				message: 'Please complete the following fields.',
				formData: function(){ return JSON.stringify({foobar:'baz',pow:'wam'}); },
				content: getNewMemberForm
			},
			vanRideForm: {
				title: "Aquarium: Van Ride",
				message: "Choose the number of passengers",
				formData: function(){
					var adults = $('#adult-passengers').val();
					var children = $('#child-passengers').val();
					console.log(adults);
					console.log(children);
					return JSON.stringify({adults:adults,children:children});
				},
				content: getVanRideForm,
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
						var formData, jsonData;
					
						formData = this.formData();
						console.log('Adding to cart... for entry: '+this.data.pricebookEntryId);
						jsonData = JSON.stringify(formData);
						addToCart(null,null,this.data.pricebookEntryId,1,null,null,null,null,jsonData);
						cartUiSuccess(this.data.pricebookEntryId);
						closeModal(e);
						return false;
					}
				}
			},
		};


		function currency(amount,isDiscount){
			var tmp = (amount+'').split('.');
			var dollars = tmp[0];
			var _cents = tmp[1] || '00';
			var cents = _cents && _cents.length <= 1 ? _cents+'0' : _cents;
			return "$"+dollars+'.'+cents;
		}

		function getMembershipProrationForm(fInfo){
			console.log('Membership Proration Form');
			console.log(fInfo);
			var fields, price, proratedPrice;
		
			fields = '';
			price = fInfo.data.prices[0].price;
			proratedPrice = fInfo.data.prices[0].proratedPrice;
		
			fields += "<div class='form-item'><label style='font-weight:bold;' for='membershipType1'>New OCDLA member</label><input type='radio' id='membershipType1' name='membershipType' value='"+proratedPrice+"'>&nbsp;I am a new OCDLA member &mdash; "+currency(proratedPrice)+"</input><div style='padding:7px;background-color:#eee;border-radius:4px;'>Your membership will be prorated through June 30, 2019.</div></div>";

			fields += "<div class='form-item'><label style='font-weight:bold;' for='LastName'>Renewing OCDLA member</label><input type='radio' id='membershipType2' name='membershipType' value='"+price+"'>&nbsp;I am renewing my membership &mdash; "+currency(price)+"</input></div>";
		
			return fields;
		}

		function getFormHtml(form){
			var formTitle = "<h2>"+form.title+"</h2>";
			var message = "<p class='form-message'>"+form.message+"</p>";
			var fHtml = "<form id='supplementary-form'><div class='modal-form-wrapper'>";
			// form += "<div><input type='hidden' 
			fHtml += form.content(form);

			fHtml += "<div class='form-actions'>";

				fHtml += "<div class='form-action form-action-add-to-cart button' data-pricebook-entry-id='"+form.pricebookEntryId+"'>Save</div>";		
				fHtml += "<div class='form-action form-action-close button'>Cancel</div>";
		
			fHtml += "</div>";

			fHtml += '</div></form>';
			
			return formTitle + message + fHtml;
		}



		function getNewMemberForm(formName){
			var fields = '';
		
			fields += "<div class='form-item'><label for='FirstName'>First Name</label><input type='text' id='FirstName' required='required' size='15' /></div>";

			fields += "<div class='form-item'><label for='LastName'>Last Name</label><input type='text' id='LastName' required='required' size='23' /></div>";
	
			fields += "<div class='form-item'><label for='Email'>Email</label><input id='Email' type='text' size='40' required='required' /></div>";
	
			fields += "<div class='form-item'><label for='bar'>Bar/Investigator number</label><input id='bar' type='text' size='15' required='required' /></div>";
		
			return fields;
		}


		function getMorrowTableMealForm(formName){
			var fields = '';
		
			fields += '<div class="modal-header">';
		
			fields += '<div class="menu-description"><span class="meal-label">Steak</span>Grilled Flat Iron Steak with Roasted Potatoes, Onions and Wild Mushroom Jus</div>';

			fields += '<div class="menu-description"><span class="meal-label">Salmon</span>Honey-Soy Glazed Salmon with Green Rice Pilaf Sesame Vegetables with Lemon Aioli</div>';

			fields += '<div class="menu-description"><span class="meal-label">Vegan</span>Quinoa and Brown Rice Stuffed Roasted Pepper with Grilled Vegetables and Marinara Sauce</div>';
		
			fields += '</div>';
		
			fields += '<div class="scrollable">';
		
			fields += '<div style="padding:10px;border:1px solid #ccc;"><input id="expandAttendees" type="checkbox" name="expandAttendees" value="Select Meals" />Select my party\'s meal preferences now.<p style="italic;">You can select your guests and meal preferences now or you can update these preferences later on, after you place your order.</p></div>';
		
			fields += '<div class="all-attendees-wrapper">';
		
			for(var i = 1; i <= 8; i++) {
				fields += '<div class="attendee-wrapper attendee-wrapper-'+i+'">';
		
					fields += '<p style="font-weight:bold; margin-top:15px; border-top:solid 1px #666;">Attendee '+i+'</p>';
		
					fields += '<div class="form-item"><label>First Name</label><input type="text" size="15" placeholder="First Name" name="FirstName" /></div>';
		
					fields += '<div class="form-item"><label>Last Name</label><input type="text" size="15" placeholder="Last Name" name="LastName" /></div>';
		
					fields += '<div class="food-menu-item"><input type="radio" name="meal-'+i+'" />Steak</div>';

					fields += '<div class="food-menu-item"><input type="radio" name="meal-'+i+'" />Salmon</div>';

					fields += '<div class="food-menu-item"><input type="radio" name="meal-'+i+'" />Vegan</div>';
		
				fields += '</div>';
			}
		
			fields += '</div>'; // end all-attendee-wrapper
			fields += '</div>'; // end scrollable
		
		
			return fields;
		}
	

		function getMorrowMealForm(formName){
			var fields = '';
		
			fields += '<div class="attendee-wrapper">';
		
				fields += '<p style="font-weight:bold; margin-top:15px; border-top:solid 1px #666;">Meal preference</p>';
				fields += '<div class="food-menu-item"><input type="radio" id="steak" name="meal" value="steak" /><span class="menu-item-description">Grilled Flat Iron Steak, Roasted Potatoes, Onions & Wild Mushroom Jus.</span></div>';

				fields += '<div class="food-menu-item"><input type="radio" id="fish" name="meal" value="fish" /><span class="menu-item-description">Honey-soy Glazed Salmon, Green Rice Pilaf, Sesame Vegetables, Lemon Aioli.</span></div>';

				fields += '<div class="food-menu-item"><input type="radio" id="vegan" name="meal" value="vegan" /><span class="menu-item-description">Quinoa & Brown Rice Stuffed Roasted Pepper, Grilled Vegetables, Marinara Sauce (Vegan).</span></div>';
		
		
			fields += '</div>';

		
			return fields;
		}
		
	
		function getVanRideForm(formName){
			var fields = '';
		
			fields += '<div class="attendee-wrapper">';
		
				fields += '<p style="font-weight:bold; margin-top:15px; border-top:solid 1px #666;">Passengers</p>';
				fields += "<div class='form-item'><label for='adult-passengers'>Adults:</label><select id='adult-passengers'><option value='0' selected='selected'>0</option></div>";
			
				var opts = [1,2,3,4,5,6,7,8];
				for(var i = 0; i< opts.length; i++){
					fields += "<option value='"+opts[i]+"'>"+opts[i]+"</option>";
				}
				fields += "</select></div><div class='form-item' style='display:block;'><label for='child-passengers'>Children:</label><select id='child-passengers'><option value='0' selected='selected'>0</option>";
			
				for(var i = 0; i< opts.length; i++){
					fields += "<option value='"+opts[i]+"'>"+opts[i]+"</option>";
				}
			
				fields += "</select></div>";
			
			
		
			fields += '</div>';

		
			return fields;
		}


			// Callbacks for modal.
			var closeForm = function(e){
				console.log('I AM THE FORM-SPECIFIC CLOSE BUTTON.');
				// initAddToCartButtons();
				return false;
			};
		
			/*
			@jbernal 2019-01-05; not sure why this is here anymore.  Name collision with window.addToCart.
			var addToCart = function(cb){
				return (function(e) {
					e.stopPropagation();
					e.preventDefault();
					window.addToCartCallback = cb;
					window.addToCartButtonClick(e);
					m.closeModal(e);
					return false;
				});
			};
			*/

		function getForm(formName,data){
			var formData;
		
			// Get data needed to render this form.
			formData = forms[formName];
			formData.data = data;
			formData.pricebookEntryId = data.pricebookEntryId;

			for(var i in formData.actions){
				formData.actions[i] = formData.actions[i].bind(formData);
			}

			formData.html = getFormHtml(formData);
		
			return formData;
		}
	
		return {
			getForm: getForm,
		};


	})(jQuery);
	return OCDLAForms;
});