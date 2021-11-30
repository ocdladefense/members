$.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^]*)').exec(window.location.href);
    if (results==null){
       return null;
    }
    else{
       return results[1] || 0;
    }
};


var mods = [
	"require",
	"libs",
	"default/modules/paidoffice/js/event"
];

globalScripts(mods,function(require,libs,pdEvents) {

	$(function(){
		pdEvents.setup();
	});
	
	
	
	$(function(){
	
		var selectedTickets = document.getElementsByClassName('pricebookEntryId');
		for(var i = 0; i<selectedTickets.length; i++){
			var selectedPbEntry = selectedTickets[i].dataset.selectedId;
			var options = selectedTickets[i].options;
			for(var idx = 0; idx < options.length; idx++){
			 if(options[idx].value == selectedPbEntry){
				options[idx].selected = true;
				break;
			 }
			}
		}

	});
	
	

});