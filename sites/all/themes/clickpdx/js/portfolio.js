
// Open a new ProjectManager to manage content and animations.
window.projects=new ProjectManager();

// Proxy selector-based operations to jQuery.
window.select=jQuery;

// Optionally pass Projects to a fixed-position Stage.
if(window.USE_BETA_STAGE){
	window.stage=new FixedPortalStage('stage');
}

if(DISPLAY_IS_PORTFOLIO_VIEW) {
	// Initialize the Projects.
	projects.add(["dte","ocdla","hsolc","sockeye","pc","jacobs"]);


	// Load the Projects.
	documentEvents = new EventDelegate();
	documentEvents.on('click',function(e){
		var action, projectId, FrameCollection;
		if('stage'!=(action=e.getData('action')||null)) return false;
		projectId=e.getData('project-id');
		try{
			FrameCollection=projects.getFrameCollection(projectId);
			//if(FrameCollection.off){
			// console.log((e.e.pageY+PROJECT_TOP_OFFSET));
			$('html, body').animate({
					scrollTop: e.e.pageY+PROJECT_TOP_OFFSET
			},1000);
			FrameCollection.toggleDisplay();
		} catch(e) {
			console.log(e.message);
		}
		return false;
	});
}

// Open external links in a new tab/win
jQuery('.external').each(function(){
	$(this).prop('target','_blank');
});