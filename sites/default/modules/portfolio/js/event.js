function GenericEvent(e) {
	this.e = e || window.event;
	this.type = this.e.type;
	this.target = this.e.target || this.e.srcElement;
	this.keyCode = this.e.keyCode || this.e.which;
	this.data = {};
	
	this.preventDefault = function() {	
		if(this.e.preventDefault){
			this.e.preventDefault();
		} else {
			this.e.returnValue = false;
		}
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
	}
	this.getData=function(name){
		var ret,
			fix=name;
		name=name.split('-');
		name=name.length>1?toCamelCase(name):name;
		ret=(this.target.dataset||null)?this.target.dataset[name]:this.target.getAttribute('data-'+fix);
		return ret;
	}
}

function EventDelegate(selector) {
	if(!selector || selector === window || selector === window.document) {
		this._rootElements = [window.document];
	} else if(selector.charAt(0) === '.') {
		this._rootElements = window.getElementsByClassName(selector.substr(1));
	} else if(selector.charAt(0) === '#') {
		if(!document.getElementById(selector.substr(1))) throw "Cannot locate element with id "+selector;
		this._rootElements = [document.getElementById(selector.substr(1))];
	} else this._rootElements = [document.getElementById(selector)];

	console.log('Root elements are: '+this._rootElements);
	if(!this._rootElements.length>0){
		throw 'Cannot create a controller on element <'+selector+'>';
	}
	this.addListener = function(evtType,func,capture){
		for(i=0; i<this._rootElements.length; i++) {
			if(this._rootElements[i].attachEvent) {
				this._rootElements[i].attachEvent('on'+evtType, func);
			} else {
				this._rootElements[i].addEventListener(evtType,func,capture);
			}
		}
	};

	this.click = function(func){
		this.on('click',func);
	};
	
	this.keypress = function(func){
		this.on('keypress',func);
	};
	
	this.quickview = function(func){
		var runtimeCallback = function(e) {
			var args = Array.prototype.slice.call(arguments);
			var e = new GenericEvent(args[0]);
			var prod = localCache.getProduct(e.target.getAttribute('data-model')) || null;
			return func(e,prod);
		};
		this.addListener('click',runtimeCallback,true);
	};
	
	this.on = function(evtType,func,context,capture,data) {
		// Create a closure around the function passed
		// to this event handler.
		capture = capture || false;
		data = data || null;
		var self = context||this;
		var runtimeCallback = function(e) {
			var args = Array.prototype.slice.call(arguments);
			var evt = new GenericEvent(e);
			self.func = func;
			return self.func(evt);
		};
		this.addListener(evtType,runtimeCallback,capture);
	};
}