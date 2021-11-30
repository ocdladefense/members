define([], function(){

	function getTabContent = function(contentId){
		if("donate-mail" == contentId){
			return "<p>Print the <a href='https://www.ocdla.org/pdfs/donate_form.pdf'>PDF version</a> of OCDLA's Donation Form.</p>";
		} else if("donate-phone" == contentId) {
			return "<p>Call Alene Sybrant at (541) 686-8716 for more information on donating to OCDLA.</p>";
		}
	}
	
	
	return {
		getContent: getTabContent
	};
	
});