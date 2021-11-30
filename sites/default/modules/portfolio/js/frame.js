function ProjectManager(){
	this.sliders={};
}

ProjectManager.prototype = {
	add:function(ids){
		if(typeof ids === 'string'){
			ids=[ids];
		}
		for(var i in ids){
			this.sliders[ids[i]]=new FrameCollection(ids[i]);
		}
	},
	remove:function(id){
	
	},
	getFrameCollection:function(id){
		return this.sliders[id];
	},
	stage:function(id,y){
		this.sliders[id].prepareStage(y);
	}
};



function Frame(node){
	this.root=node;
}

Frame.prototype = {
	activate: function(){
		this.setActiveClass();
	},
	setActiveClass: function(){
		$(this.root).addClass('active');
	},
	makeInactive: function(){
		$(this.root).removeClass('active');
	}
};