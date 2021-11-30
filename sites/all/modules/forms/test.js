define(["//"+OCDLA.domain+"/sites/all/libraries/library/test.js"],function(system){

	var clickpdxCartItemMock = {
		opportunityLineItemId: "ABC123",
		entry: {
			Product2: {
				Forms__c: "myForm"	
			}
		}
	};
	
	
	
	/**
		* 	    public HTTPResponse respond(HTTPRequest req) {
	        HttpResponse resp = new HttpResponse();
			resp.setStatusCode(code);
			resp.setStatus(status);
			if (bodyAsBlob != null) {
				resp.setBodyAsBlob(bodyAsBlob);
			} else {
				resp.setBody(bodyAsString);
			}

			if (responseHeaders != null) {
			     for (String key : responseHeaders.keySet()) {
				resp.setHeader(key, responseHeaders.get(key));
			     }
			}
			return resp;
	    }
	    */
	var formObjectMock = {
		title: "Form Title",
		templateFile: "/barn-dance.html",
		message: "A FREE ticket to the Barn Dance and dinner is included with your AC 2019 ticket purchase.  Choose your meal preference for the Barn Dance dinner:",
		load: function(data){
			alert("will check appropriate option");
			if(data && data.meal == "veggie"){
				document.getElementById("veggie-option").checked = true;
			}
		},
		formData: function(){
			$meal = $("input[name='meal']:checked").val();
			return {meal: $meal};
		}
	};

	var tests = {
		mockResponse: formObjectMock,
		
		
		
		formConstructor: function(){
			var form = new Form(formObjectMock);
			form.setData({meal:"meat"});
			
			system.assertEquals("Form Title",form.title);
			
			var data = form.getData();
			system.assertEquals("meat",data.meal);
		},
		
		
		
		loadFormManager: function(){
			var resp = {
				affectedItems: [clickpdxCartItemMock]
			};
			
			// Load manager with 1 form
			var manager = FormManager.newFromCartResponse(resp);
			console.log(manager);
			
			manager.loaded.then(function(){
			system.assert(manager.hasForms(),"The manager should have forms.");
			system.assert(1,manager.numForms(),"There should be 1 form.");
			});
		}
	
	};
	
	
	
	
	
	
	
	window.runTests = function(){
		system.runTests(tests);
	};
	
});