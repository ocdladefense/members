
var toggler = new CLICKPDX.MVC.Controller.Base('#page-wrapper');
var Z_INDEX_LIMIT = 10;

/**
 * 
 	Add a function here that determines the min-height of the content box relative to the static content that is originally inserted into it.
 	
 	
 
 */



toggler.on('click',function(e) {
	// var oData = Application("orderForm").getData();
	var
	data,
	
	project,
	
	duties,
	
	projects,
	
	elem,
	
	parent;
	
	data = e.prop('id').split('-');
	
	var promote = '#' + e.prop('data-toggle');
	var promoteLabel = '#toggle-' + e.prop('data-toggle');

	this.container = this.getParent(e);
	// alert($parent.prop('class'));
	
	this.project = project = data[data.length-1];
	
	var thisToggler = this;

	// And demote anyone else.
	$allPanes = this.container.children().each(function(key,val){
		thisToggler.demote($(this));
	});
	
	// alert("height for element, "+this.container.prop('class')+", is: "+this.getHeight());
	
	this.setContainerHeight();
	
	this.demoteAllLabels(e);
	
	// Always promote the intended element.
	this.promote(promote);
	this.promoteLabel(promoteLabel);
});

toggler.getHeight = function()
{
	var maxHeight = 400;
	var minHeight = 250;
	var retHeight = 0;
	this.container.children('.content-box').each(function(){
		retHeight = $(this).height()>minHeight?$(this).height():minHeight;
	});
	return retHeight;
};

toggler.setContainerHeight = function()
{
	$height = (this.getHeight()+25)+"px";
	this.container.css({'height':$height});
};

toggler.demoteAllLabels = function(e) {
	var self = this;
	var selector = '#'+this.project+' .toggle';
	$(selector).each(function(key,val){
		self.demoteLabel($(this));
	});
};

toggler.demoteLabel = function($elem){
	$elem.removeClass('toggle-active');
};

toggler.getParent = function(e) {
	return $('#'+e.prop('data-toggle')).parent();
};

toggler.getStaticPaneId = function(id){};

toggler.demote = function(elem){
	elem.css({'z-index':'1','display':'none'});
};



toggler.promote = function(elem){
	var uLimit = Z_INDEX_LIMIT - 1;
	$(elem).css({'z-index':uLimit});
	$(elem).css({'display':'block'});
	$(elem).css({'position':'absolute'});
};

toggler.promoteLabel = function(elem){
	$(elem).addClass('toggle-active');
};