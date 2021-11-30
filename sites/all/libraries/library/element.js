define([],function(){

	var fn = {
		parseFromAttribute: function(){
			return this.elem.getAttribute("class").split(" ");
		},
	
		getAsAttribute: function(classes){
			return this.classes.join(" ");
		},
	
		addClass: function(className){
			this.removeClass(className);
			this.classes.push(className);
			return this.setClasses();
		},
	
		removeClass: function(className){
			for( var i = 0; i < this.classes.length; i++){ 
				 if ( this.classes[i] === className) {
					 this.classes.splice(i, 1); 
				 }
			}
			return this.setClasses();
		},
		
		setClasses: function(){
			var classes = this.getAsAttribute(this.classes);
			this.elem.setAttribute("class",classes);
			return this;
		},
		
		equals: function(compare){
			return compare === this.elem;
		}
	
	};
	
	
	function Element(elem){
		this.elem = elem;
		this.classes = this.parseFromAttribute();
	};
	
	Element.prototype = fn;
	
	
	
	return {
		newNode: function(elem){ return new Element(elem); }
	};
	
});