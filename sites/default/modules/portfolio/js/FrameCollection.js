function FrameCollection(projectId,data){
	this.id=projectId;
	this.projectStageId='project-'+projectId;
	this.domId=projectId;
	this.root=document.getElementById(this.domId);	
	this.frames=[];
	this.controller=new EventDelegate(this.domId);
	this.controller.on('click',this.click,this);
	this.content=this.getElementsByClassName('stage-content')[0];
	this.init();
}

FrameCollection.prototype = {
	data:null,
	display:'DISPLAY_CLOSED',
	state:'NOT_LOADED',
	displayProxy:null,// a jQuery promise?
	getElementsByClassName:getElementsByClassName,
	init:function(){
		if(this.state=="NOT_LOADED"){return;}
		for(i=0;i<this.content.childNodes.length;i++){
			var node=this.content.childNodes[i];
			if(!node.getAttribute||null==node.getAttribute('class')){continue;}
			console.log(node.getAttribute('class'));
			if(node.getAttribute('class').indexOf('slide')!==-1){
				this.addFrame(node);
			}
		}
		try {
			this.frames[0].activate();
		} catch(e) {
			console.log('No frames found. DOM is not ready.');
		}
		this.captions=this.getElementsByClassName('caption');
	},
	getHtml:function(){
		return this.data;
	},
	render:function(){
		if(this.state!="DATA_LOADED"){
			this.displayProxy=this.load();
		}
		this.displayProxy.done($.proxy(this.showCollection,this));
		this.displayProxy.done($.proxy(this.startLoading,this));
	},
	load:function(){
		var projectId=this.id;
		var opts = {
			data:{
				project:projectId
			}
		};
		var proxy=select.ajax(PORTFOLIO_SRC,opts);
		proxy.done($.proxy(this.attachDom,this));
		proxy.done($.proxy(this.init,this));
		return proxy;
	},
	attachDom:function(data){
		this.setData(data);
		var portfolioId=this.id;
		var $stageSelector='#'+this.id+'-stage';
		var $stageContentId=this.id+'-stage-content';
		var $stageContent=$stageSelector+' .stage-content';
		var buttonSelector='button-'+this.id;
		console.log('Attach data to:' + $stageContentId);
		// console.log('Preparing to attach data: '+data);
		var stageContent=document.getElementById($stageContentId);
		console.log(stageContent);
		try{
			stageContent.innerHTML=this.data;
		}catch(e){
			console.log('InnerHTML failed with: '+e.message);
			select('#'+$stageContentId).html(data);
		}

		if(window.USE_BETA_STAGE){
			stage.attachHtml(this);
		}
		this.status('DATA_LOADED');
	},
	status:function(status){
		if(status){this.state=status;}
		else return this.state;
	},
	setData:function(data){
		if(data){
			this.data=data;
			this.status('DATA_LOADED');
		}else{
		
		}
	},
	prepareStage:function(y){
		jQuery('#'+this.projectStageId).css('top',y+'px');
	},
	toString:function(){
		return 'I am a FrameCollection.';
	},
	click:function(e){
		var action=e.getData('action')||null;
		if(action=='getSlide'&&e.getData('index')){
			this.activate(e.getData('index'));
			e.stopPropagation();
		}
		return false;
	},
	find:function(index){
		for(i=0;i<this.frames.length;i++){
			if(i==index){return this.frames[i];}
		}
	},
	toggleDisplay:function(){
		if(this.display=='DISPLAY_CLOSED'){this.render();}
		else if(this.display=='DISPLAY_OPEN'){this.hide();}
	},
	showCollection:function(){
		var $stageSelector='#'+this.id+'-stage';
		var $stageContent=$stageSelector+' .stage-content';
		var buttonSelector='button-'+this.id;
		select($stageSelector).removeClass('closed');	
		try {
			document.getElementById(buttonSelector).value='hide';
		} catch(e) {
			throw 'Could not locate element with id '+buttonSelector;
		}
		$y=jQuery(window).scrollTop();
		select(document.body).addClass('staged');
		this.display='DISPLAY_OPEN';
	},
	startLoading:function(){
		var $stageSelector='#'+this.id+'-stage';
		$img=jQuery($stageSelector+' .active img');
		console.log('Will find '+$stageSelector);
		//@jbernal
		// jQuery('#caption p').addClass('load');
		$img.one("load",function(e){	
			select($stageSelector).removeClass('not-loaded');	
		}).each(function(){
			if(this.complete) $(this).load();
		});
	},
	hide:function(){
		jQuery('#'+this.id+'-stage').addClass('closed');
		jQuery(document.body).removeClass('staged');
		document.getElementById('button-'+this.id).value='view';
		this.display='DISPLAY_CLOSED';
	},
	addFrame:function(node){
		var frame=new Frame(node);
		this.frames.push(frame);
	},
	removeFrame: function(){
	
	},
	getFrameById:function(domId){
		for(i=0;i<this.frames.length;i++){
			if(frames[i].getId()==domId){
				return frames[i];
			}
		}
		throw 'Slide '+domId+' not found.';
	},
	getFrame:function(index){
		return this.frames[index];
	},
	aCapt:function(node){
		jQuery(node).addClass('caption-active');
	},
	dCapt:function(node){
		jQuery(node).removeClass('caption-active');
	},
	activate:function(index){
		if(index<0||index>=this.frames.length){
			throw 'SlideArrayIndexOutOfBoundsException for index '+index;
		}
		for(i=0;i<this.frames.length;i++){
			if(i==index){
				this.frames[i].activate();
			} else {
				this.frames[i].makeInactive();
			}
		}
		for(i=0;i<this.captions.length;i++){
			if(i==index){
				this.aCapt(this.captions[i]);
			} else {
				this.dCapt(this.captions[i]);
			}
		}
	},
	toString:function(){
		return this.id;
	}
};