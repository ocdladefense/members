define([],function(){

	var vf = {};
	
	vf.funds = [ {
	"attributes" : {
		"type" : "PricebookEntry",
		"url" : "/services/data/v44.0/sobjects/PricebookEntry/01uQ000000CkourIAB"
	},
	"Id" : "01uQ000000CkourIAB",
	"UnitPrice" : 0.00,
	"Product2Id" : "01tQ0000004t5CbIAI",
	"Product2" : {
		"attributes" : {
			"type" : "Product2",
			"url" : "/services/data/v44.0/sobjects/Product2/01tQ0000004t5CbIAI"
		},
		"Id" : "01tQ0000004t5CbIAI",
		"Name" : "Building Fund"
	}
	}, {
	"attributes" : {
		"type" : "PricebookEntry",
		"url" : "/services/data/v44.0/sobjects/PricebookEntry/01uQ000000Ckp01IAB"
	},
	"Id" : "01uQ000000Ckp01IAB",
	"UnitPrice" : 0.00,
	"Product2Id" : "01tQ0000004t5FkIAI",
	"Product2" : {
		"attributes" : {
			"type" : "Product2",
			"url" : "/services/data/v44.0/sobjects/Product2/01tQ0000004t5FkIAI"
		},
		"Id" : "01tQ0000004t5FkIAI",
		"Name" : "Legislative Fund"
	}
	} ,{
	"attributes" : {
		"type" : "PricebookEntry",
		"url" : "/services/data/v44.0/sobjects/PricebookEntry/01uQ000000Ckp01IAB"
	},
	"Id" : "01uQ000000Ckp01IAB",
	"UnitPrice" : 0.00,
	"Product2Id" : "01tQ0000004t5FkIAI",
	"Product2" : {
		"attributes" : {
			"type" : "Product2",
			"url" : "/services/data/v44.0/sobjects/Product2/01tQ0000004t5FkIAI"
		},
		"Id" : "01tQ0000004t5FkIAI",
		"Name" : "OCDLA Party Fund"
	}
	} 

	];

	if(!window.vf) {
		window.vf = vf;
	}




	function getMonthlyAmounts(){
		var MONTHLY_DONATION_STEPS = [250,100,50,25];
		return MONTHLY_DONATION_STEPS;
	}
	
	function getOneTimeAmounts(){
		var ONE_TIME_DONATION_STEPS = [500,250,100,50];
		return ONE_TIME_DONATION_STEPS;
	}

	function getFunds(){
		var options = [];
		var funds = window.vf.funds;
		console.log(funds);
		for(var i = 0; i < funds.length; i++){
			var obj = {};
			obj.value = funds[i].Id;
			obj.name = funds[i].Product2.Name;
			obj.description = funds[i].Product2.Description;
			options.push(obj);
		}
	
		return options;
	}
	
	function getFund(pricebookEntryId){
		for(var i = 0; i < DONATE.DONATION_FUNDS.length; i++){
			if(DONATE.DONATION_FUNDS[i].value == pricebookEntryId){
				return DONATE.DONATION_FUNDS[i];
			}
		}
	
		throw new Error('There is no Donation Fund with PricebookEntryId: '+pricebookEntryId);
	}


	return {
		getMonthlyAmounts: getMonthlyAmounts,
		getOneTimeAmounts: getOneTimeAmounts,
		getFunds: getFunds,
		getFund: getFund
	};
	
	
});