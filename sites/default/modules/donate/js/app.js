var donation_scripts = [
	"libs",
	"default/modules/donate/js/ui",
	"default/modules/donate/js/components/form/form"
];


globalScripts(donation_scripts,function(libs, uiMod, formMod){
	
	
	var event = libs.getModule("event");
	
	console.log("Donation app loaded.");

	event.domReady(formMod.setup);
});