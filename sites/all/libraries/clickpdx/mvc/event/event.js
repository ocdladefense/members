;
(function(window,_null){
	function GenericEvent(e) {
		this.e = e || window.event;
		this.type = this.e.type;
		this.target = this.e.target || this.e.srcElement;
		this.keyCode = this.e.keyCode || this.e.which;
		this.modifiers = this.e.modifiers || null;
		this.data = {};
	
		this.preventDefault = function() {	
			if(this.e.preventDefault){
				this.e.preventDefault();
			} else {
				this.e.returnValue = false;
			}
		};
	
		this.rowId = function(){
			if(!(this.target&&this.target.parentNode&&this.target.parentNode.parentNode)) return null;
			if(this.target.parentNode.nodeName=='TD'
				&& this.target.parentNode.parentNode.nodeName=='TR') {
					return this.target.parentNode.parentNode.getAttribute('id');
			}
		};
	
		this.prop = function(p){
			if(this[p]) return this[p];
			else if(this.target&&this.target.getAttribute){
				return this.target.getAttribute(p)||'';
			}
			else return '';
		};
	
		this.fieldName = function()
		{
			switch(this.target.nodeName)
			{
				case 'INPUT':
				case 'SELECT':
				case 'TEXTAREA':
				case 'SUBMIT':
					return this.target.getAttribute('name');	
					break;		
				default:
					return '';
					throw new Error('Element isn\'t a valid form node.');
			}
		};
	
		this.nodeName = function()
		{
			return this.target.nodeName;
		};
	
		this.stopPropagation = function() {
			if(this.e.stopPropagation){
				this.e.stopPropagation();
			} else {
				this.e.cancelBubble = true;
			}
		};
	
		this.getLinkElem = function(){
			if(this.target.nodeName == 'IMG' && this.target.parentNode.nodeName == 'A') {
				return this.target.parentNode;
			}
			else if(this.target.nodeName == 'A' || this.target.nodeName == 'IMG') {
				return this.target;
			}
		};
	
		this.setData = function(key,val) {
			this.data[key] = val;
		};
	}
	window.CLICKPDX.MVC.Event = {
		GenericEvent: GenericEvent
	};
})(window,null);