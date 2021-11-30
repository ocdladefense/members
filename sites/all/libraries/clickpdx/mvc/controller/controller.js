;
(function(window, _null) {	
	function Controller(selector) {	
		this._rootElements = [];
		// Create a set of input validators
		this.inputValidators = [];
	
		this.init(selector);
	
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
	
		this.restrictToNumeric = function(fieldName)
		{
			var fn = function(e)
			{
				// alert(e.keyCode);
				if(e.target.name != fieldName) return true;
				if(Keyboard.controlKeyCodes.indexOf(e.keyCode)>=0)
				{
					// alert(e.keyCode);
					return true;
				}
				if(!Keyboard.isNumericKeyCode(e.keyCode))
				{
					// alert('incorrect key code is pressed.');
					e.preventDefault();
					e.stopPropagation();
					return false;
				}
			};
			this.inputValidators.push(fn);
		};
	
		this.restrictToAlphaNumeric = function(fieldName)
		{
			var fn = function(e){
				if(e.target.name != fieldName) return true;
				if(Keyboard.controlKeyCodes.indexOf(e.keyCode)>=0) return true;
				if(!Keyboard.isAlphaNumericKeyCode(e.keyCode)){
					e.preventDefault();
					e.stopPropagation();
					return false;
				}
			};
			this.inputValidators.push(fn);
		};
	
		this.preValidate = function(e)
		{
			// Loop through several types of validation functions
			//	+ functions should check for the appropriate element names and
			//	+ keyCodes and return true or false depending on if 
			//	+ they meet the validation requirements
			for(var fn in this.inputValidators){
				if(!this.inputValidators[fn](e)) return false;
			}
			return true;
		};
		
		this.keypress = function(func){
			this.on('keypress',func);
		};

		this.quickview = function(func){
			var runtimeCallback = function(e) {
				var args = Array.prototype.slice.call(arguments);
				var e = new CLICKPDX.Event.GenericEvent(args[0]);
				var prod = localCache.getProduct(e.target.getAttribute('data-model')) || null;
				return func(e,prod);
			};
			this.addListener('click',runtimeCallback,true);
		};
	
		this.on = function(evtType,func,capture,data) {
			// Create a closure around the function passed
			// to this event handler.
			capture = capture || false;
			data = data || null;
			var self = this;
			var runtimeCallback = function(e) {
				try
				{
					var args = Array.prototype.slice.call(arguments);
					var evt = new CLICKPDX.MVC.Event.GenericEvent(e);
					self.func = func;
					return self.func(evt);
				}
				catch(e)
				{
					console.log(e);
				}
			};
			this.addListener(evtType,runtimeCallback,capture);
		};
	
		this.on('keydown',this.preValidate);
	}
	
	Controller.prototype.init = function(selector)
	{
		if(!selector || selector === window || selector === window.document) {
			this._rootElements = [window.document];
		} else if(selector.charAt(0) === '.') {
			this._rootElements = window.getElementsByClassName(selector.substr(1));
		} else if(selector.charAt(0) === '#') {
			this._rootElements = [document.getElementById(selector.substr(1))];
		} else this._rootElements = [document.getElementById(selector)];
	};
	
	var CLICKPDX = {
		MVC: {
			Model: {},
			View: {},
			Event: {},
			Controller: {
				Base: Controller
			}
		}
	};
	window.CLICKPDX = CLICKPDX;
})(window, null);