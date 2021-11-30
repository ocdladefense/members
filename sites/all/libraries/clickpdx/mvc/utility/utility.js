;
(function(window){
	var Environment = {

	};
	
	var Utility = {
		GetType: function(obj){
			if(obj === window.document) return 'HTMLDocument';
			 return Object.prototype.toString.call(obj);
		},
	};
	
	var indexOf = [].indexOf || function(prop) {
			for (var i = 0; i < this.length; i++) {
					if (this[i] === prop) return i;
			}
			return -1;
	};
	var getElementsByClassName = function(className) {
			if (document.getElementsByClassName) return document.getElementsByClassName(className);
			if (document.querySelectorAll) {
			var elems = document.querySelectorAll("." + className);
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
	var Keyboard = {
	// http://stackoverflow.com/questions/13196945/keycode-values-for-numeric-keypad
		numberKeyCodes: [48,49,50,51,52,53,54,55,56,57],
		numericPadKeyCodes: [96,97,98,99,100,101,102,103,104,105],
		controlKeyCodes: [13,9,8,16,
			17,		// Ctrl
			18,		// Alt/Option
			91		// Command/Apple
		],
		alphabeticKeyCodes: [
			'Q',81,
			'W',87,
			'E',69,
			'R',82,
			'T',84,
			'Y',89,
			'U',85,
			'I',73,
			'O',79,
			'P',80,
			'A',65,
			'S',83,
			'D',68,
			'F',70,
			'G',71,
			'H',72,
			'J',74,
			'K',75,
			'L',76,
			'Z',90,
			'X',88,
			'C',67,
			'V',86,
			'B',66,
			'N',78,
			'M',77
		],
		isAlphaKeyCode: function(code)
		{
			var pos = Keyboard.alphabeticKeyCodes.indexOf(code);
			if(pos>0){
				return Keyboard.alphabeticKeyCodes[--pos];
			}
		},
		getAlphaKeyFromKeyCode: function(code)
		{
			var pos = Keyboard.alphabeticKeyCodes.indexOf(code);
			if(!pos>0) throw new Error('Not a valid alphabetical keyCode.');
			return Keyboard.alphabeticKeyCodes[--pos];
		},
		isNumericKeyCode: function(code)
		{
			//alert("Checking keycode <"+code+"> for isNumeric.");
			var n = Keyboard.numberKeyCodes;
			var kp = Keyboard.numericPadKeyCodes;
			return (
				(code >= n[0] && code <= n[n.length-1])
				||
				(code >= kp[0] && code <= kp[kp.length-1])
			);
			// first is Keyboard.numericPadKeyCodes.unshift()
			// last is Keyboard.numericPadKeyCodes.pop()
			// return (code>=first && code<=last)
			// return (code>=48 && code<=57);
		},
		isAlphaNumericKeyCode: function(code)
		{
			return Keyboard.isAlphaKeyCode(code)||Keyboard.isNumericKeyCode(code);
		},
	};
	window.getElementsByClassName = getElementsByClassName;
	window.Environment = Environment;
	window.Utility = Utility;
	window.Keyboard=Keyboard;	
})(window);