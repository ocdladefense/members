(function(window){
	var Utility = {
		GetType: function(obj){
			if(obj === window.document) return 'HTMLDocument';
			 return Object.prototype.toString.call(obj);
		}
	};
	
	var indexOf = [].indexOf || function(prop) {
			for (var i = 0; i < this.length; i++) {
					if (this[i] === prop) return i;
			}
			return -1;
	};
	var getElementsByClassName = function(className) {
			context=this==window?document:this;
			if(!context.getElementsByTagName){
				console.log('getElementsByClassName called with non-standard object.');
				if(!context.root){
					console.log('Context missing .root property');
					return [];
				}
				context=context.root;
			}
			if (context.getElementsByTagName&&context.getElementsByClassName) return context.getElementsByClassName(className);
			if (context.getElementsByTagName&&context.querySelectorAll) {
			var elems = context.querySelectorAll("." + className);
			} else {
				var elems = (function() {
						var all = context.getElementsByTagName("*"),
							 elements = [],
							 i = 0;
						for (; i < all.length; i++) {
							 if (all[i].className && (" " + all[i].className + " ").indexOf(" " + className + " ") > -1 && indexOf.call(elements,all[i]) === -1) elements.push(all[i]);
						}
						return elements;
					})();      
			}
			return elems;
	};
  var addCssStylesheet=function(href){
		var style=document.createElement('link');
		style.setAttribute('type','text/css');
		style.setAttribute('rel','stylesheet');
		style.setAttribute('href',href);
		var head=document.getElementsByTagName('head')[0];
		head.appendChild(style);
		return style;
  };
  var toTitleCase=function(str){
    return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
	};
  var toCamelCase=function(arr){
		var ret='',
			first=arr[0];
		if(arr.length===1) return first;
		for(var i=1; i<arr.length;i++){
			ret+=toTitleCase(arr[i]);
		}
		return first+ret;
  };
	var console=window.console||{"log":function(){}};
	
	window.toCamelCase=toCamelCase;
	window.console=console;
  window.document.addCssStylesheet=addCssStylesheet;
	window.getElementsByClassName = getElementsByClassName;
	window.Utility = Utility;
})(window);


if (!Function.prototype.bind) {
  Function.prototype.bind = function(oThis) {
    if (typeof this !== 'function') {
      // closest thing possible to the ECMAScript 5
      // internal IsCallable function
      throw new TypeError('Function.prototype.bind - what is trying to be bound is not callable');
    }

    var aArgs   = Array.prototype.slice.call(arguments, 1),
        fToBind = this,
        fNOP    = function() {},
        fBound  = function() {
          return fToBind.apply(this instanceof fNOP && oThis
                 ? this
                 : oThis,
                 aArgs.concat(Array.prototype.slice.call(arguments)));
        };

    fNOP.prototype = this.prototype;
    fBound.prototype = new fNOP();

    return fBound;
  };
}