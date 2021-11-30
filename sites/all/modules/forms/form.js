define(["libView"],function(view){


	var fn = {
		data: null,
		
		getName: function(){
			return this.name;
		},
		
		getData: function(){
			return this.data;
		},
		
		setData: function(data){
			this.data = data;
		},
		
		loaded: false,
		
		render: function(){
			var vnode = this.renderMe();
			return view.createElement(vnode);
		},

		loadObject: function(obj){
			for(var i in obj) {
				this[i] = obj[i];
			}
		},

		getHandler: function() {
			var fn = function(e) {
				// alert("you clicked me.");
				var data = this.getData();
				var fdata = this.getFormData();

				console.log(fdata);
				
				var reg = {
					opportunityLineItemId: data.opportunityLineItemId,
					pricebookEntryId: data.pricebookEntryId,
					quantity: data.quantity,
					contactId: data.contactId,
					firstName: data.firstName,
					lastName: data.lastName,
					email: data.email,
					license: data.license
				};
				

				var target = e.target;
				if(target.dataset && target.dataset.action == "cancel"){
					this.actions["cancel"](data.clientId, reg, fdata);
				}
				
				else if(target.dataset && target.dataset.action == "add"){
					this.actions["add"](data.clientId, reg, fdata);
				}

			};
			
			return {
				handleEvent: fn.bind(this)
			};
		},
		
		setHandler: function(fn){
			this.handler = fn;
		},

		
		send: function(){
			console.log(this.data);
		},

		/**
		 * Return vnode buttons for the target display.
		 *
		 * @return array<vnode>
		 */
		buttons: function() {
			var cancel = h("button",{"className":"target-button","data-action":"cancel"},"cancel");
			var addToCart = h("button",{"className":"target-button","data-action":"add"},"add to cart");
			return [cancel,addToCart];
		}

	};
	
	
	
	function Form(params){
		this.name = params.name || params;
		this.html = "<h2>Form HTML</h2>";
		if(params["formData"]) {
			this.loadObject(params);
		}
	}
	
	
	Form.prototype = fn;
	
	window.Form = Form;
});