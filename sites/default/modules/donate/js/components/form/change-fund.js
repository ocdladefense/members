/**
 * Event when the customer selects a fund to process.
 */
define(["default/modules/donate/js/components/form/data"], function(modData){



	
	function changeFund(e){
		$pricebookEntryId = $(this).val();
		var fund, description, name;

		fund = modData.getFund($pricebookEntryId);
		name = fund.name;
		description = fund.description || '<span style="font-style:italic;">There is no description for this Fund.</span>';

		$('#fund-description').html('<span class="fund-name">'+name+'</span><span class="fund-description">'+description+'</span>').css({display:'block'});
	}
	
	return {
		changeFund: changeFund
	};
		
});