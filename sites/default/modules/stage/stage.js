function FixedPortalStage(domId){
	this.styleSheet=document.addCssStylesheet('/modules/stage/stage.css');
	this.root=document.getElementById(domId);
	var c=this.root.getAttribute('class')||'';
	this.root.setAttribute('class',(c+' stage'));
	this.root.setAttribute('style','z-index:4;position:fixed;top:0px;left:0px;');
	this.init();
	this.root.appendChild(this.menuPane);
	this.root.appendChild(this.loading);
	this.root.appendChild(this.content);
}

FixedPortalStage.prototype = {
	init:function(){
		this.menuPane=this.elements.menuPane();
		this.content=this.elements.contentPane();
		this.loading=this.elements.loading();
	},
	attach:function(node){
		this.root.appendChild(node);
	},
	attachHtml:function(obj){
		this.content.innerHTML=obj.getHtml();
	},
	open:function(){
		jQuery(document.body).addClass('staged');
	},
	close:function(){
		jQuery(document.body).removeClass('staged');
	},
	destroy:function(){
		document.removeCssStyleet(this.styleSheet);
	},
	elements:{
		menuPane:function(){
			var menuPane=document.createElement('div');
			menuPane.setAttribute('class','menuPane');
			menuPane.appendChild(this.closeButton());
			return menuPane;
		},
		contentPane:function(){
			var content=document.createElement('div');
			content.setAttribute('class','stage-content');
			return content;
		},
		loading:function(){
			var nodeLoading=document.createElement('img');
			nodeLoading.setAttribute('src','/modules/stage/loading.gif');
			nodeLoading.setAttribute('class','loading');
			return nodeLoading;
		},
		closeButton:function(){
			var button=document.createElement('img');
			button.setAttribute('src','/modules/stage/closeButton.png');
			var link=document.createElement('a');
			link.appendChild(button);
			link.setAttribute('href','javascript:');
			link.onclick=function(){stage.close();return false;};
			return link;
		},
	},
};