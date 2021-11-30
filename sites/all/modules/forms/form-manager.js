define(["all/modules/forms/form"],function(form){


	// https://jsdoc.app/about-block-inline-tags.html
	function handleRequireErrors(pricebookEntryId){
		return function(err){
			console.log(err);
			var modal = modal || new Modal();
			modal.html("There was an error performing the requested action.");
			modal.show();
			// cartUIReset(pricebookEntryId);
		}
	}
	
	var getUpdateFunc = function(opportunityLineItemId){
		return function(data){
			cart.updateCartItemData(opportunityLineItemId,data);
		};
	};
	
	var parseAffectedItems = function(response){
		var items = {};
		var affected = response.affectedItems;
		if(!affected.length) return;
		
		for(var i =0; i<affected.length;i++){
			var key = affected[i].opportunityLineItemId || i;
			items[key] = [];
			if(affected[i].entry.Product2.Forms__c&&affected[i].entry.Product2.Forms__c.length){
				items[key] = {
					pricebookEntryId: affected[i].entry.Id,
					line: affected[i],
					forms: affected[i].entry.Product2.Forms__c.split(","),
					data: parseData(affected[i].data)
				};
			}
		}
		
		return items;
	};
	
	
	var parseData = function(data){
		return "" !=  data ? JSON.parse(data) : {};
	};

	
	var newFromCartResponse = function(response){
		var items = parseAffectedItems(response);
		
		var manager = new FormManager();

		var loading = [];
		
		for(var id in items){
			if(!items[id].forms) continue;
			var pricebookEntryId = items[id].pricebookEntryId;
			var forms = items[id].forms;
			
			for(var i = 0; i<forms.length; i++){
				var form = new Form(forms[i]);
				form.setData(items[id].line);
				form.pricebookEntryId = pricebookEntryId;
				manager.loadForm(form);
			}
		}
		
		return manager;
	};



	var fn = {
		getFirst: function(){
			var key = Object.keys(this.forms)[0];
			return this.forms[key];
		},
		getForms: function(){
			return this.forms;
		},
		hasForms: function(){
			return !!Object.keys(this['forms']).length;
		},
		numForms: function(){
			return Object.keys(this.forms).length;
		},
		
		getObjectPath: function(fName){
			return "sites/all/modules/forms/objects/"+fName+".js";
		},
		
		loaded: function(){
			return Promise.all(this.loading);
		},
		
		loadForm: function(form){
			var fName = form.getName();
			this.forms[fName] = form;
			var self = this;
			var path = "//"+OCDLA.domain+"/"+this.getObjectPath(fName);

			$network = new Promise(function(resolve,reject){
				return require([path],resolve,reject);
			})
			.then(function(fObject){
				form.loadObject(fObject);
				self.forms[fName].loaded = true;
			});
			
			this.loading.push($network);
			
			return $network;
		},

		
		setHandler: function(fn){
			this.handler = fn;
		},
		
		handleEvent: function(e){
			var target = e.target;
			var formId = target.Id;
			var data = this.formData[formId].formData();
			this.handler(data);
		}
	};


	/**
		* 
		* @constructor
		*/
	function FormManager(){
		this.handler = function(e){ console.log(e); };
		this.forms = {};
		this.loading = [];
	}
	
	FormManager.prototype = fn;
	
	window.FormManager = FormManager;	
	
	FormManager.newFromCartResponse = newFromCartResponse;


	return {
		newFromCartResponse: newFromCartResponse
	};
	
});