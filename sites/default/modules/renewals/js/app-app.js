var Scope = function(){
	this.root = document.getElementById('ams-important-links');
	this.template = root.children[0];
};

Scope.prototype = {

	setInnerText: function(node,text){
		node.innerText = text;
		return node;
	},
	setInnerHtml: function(node,html){
		node.innerHtml = html;
		return node;
	},
};


