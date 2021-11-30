define(["default/modules/donate/js/components/form/data",
"default/modules/donate/js/components/form/events",
"all/modules/cart/js/salesforce/visualforce-actions"],function(modData,modEvent,cart){

	window.cartActions = cart;
	
	
	var DONATE = {};
	
	var DONATION_FUNDS,

	MONTHLY_DONATION = "monthly",

	ONE_TIME_DONATION = "oneTime",

	DEFAULT_FUND_ID = 999;	
	
	

	function setup(){
		DONATE.DONATION_FUNDS = modData.getFunds();

		// Retrieve monthly donation amounts dynamically from Salesforce.
		DONATE.MONTHLY_DONATION_STEPS = modData.getMonthlyAmounts();

		// Retrieve one-time donation amounts dynamically from Salesforce.
		DONATE.ONE_TIME_DONATION_STEPS = modData.getOneTimeAmounts();

		// By default, present the Form with monthly donation amounts.
		paintDonationAmounts(DONATE.MONTHLY_DONATION_STEPS);	
		

		paintDonationFunds(DONATE.DONATION_FUNDS);
		

		function paintDonationAmounts(steps){
			var markup;
			for(var i = 0, markup = []; i< steps.length; i++){
				markup.push("<a data-amount='"+steps[i]+"' class='btn-input'>"+steps[i]+"</a>");
			}
			
			$(".gift-amount-group").html(markup.join("\n"));
		}

		
		function paintDonationFunds(funds){
			var markup;
			for(var i = 0, markup = []; i< funds.length; i++){
				markup.push("<option value='"+funds[i].value+"'>"+funds[i].name+"</option>");
			}
			
			$('#pricebookEntryId').html(markup.join("\n"));
		}


		// Display monthlies by default.
		$("#monthly").click();
		
		// Show date-picker.
		$("#chargeDate").datepicker();
		
		//
		$("#pricebookEntryId").on("change",modEvent.changeFund);
		
		var elems = document.querySelectorAll("input[name='donation-type']");
		console.log(elems);
		
		var elem = document.querySelector(".gift-amount-group");
		
		for(var idx = 0; idx<elems.length; idx++){
			var elem = elems[idx];

			elem.addEventListener("click", function(e) {
				console.log("hello");
				var target = e.target;
				if(!target.value) return false;
				if(["one-time","monthly"].indexOf(target.value) != -1){
					paintDonationAmounts(MONTHLY_DONATION == target.value ? DONATE.MONTHLY_DONATION_STEPS : DONATE.ONE_TIME_DONATION_STEPS);
				}
			},false);
		
		}
		
		var amounts = document.querySelector(".gift-amount-group");
		
		amounts.addEventListener("click",function(e){
			var target = e.target;
			var data = target.dataset;
			var amount = data ? data.amount : null;
			$("#otherAmount").val(amount);
		},false);
		
		$("#submit-donation-form").click(function(){
			modEvent.submit();
		});
		
		window.DONATE = DONATE;
	}
	
	
	
	
	return {
		setup: setup
	};
	
	
});