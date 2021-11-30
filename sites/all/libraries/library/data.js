define([],function(){

	function clone(obj) {
			var copy;

			// Handle the 3 simple types, and null or undefined
			if (null == obj || "object" != typeof obj) return obj;

			// Handle Date
			if (obj instanceof Date) {
					copy = new Date();
					copy.setTime(obj.getTime());
					return copy;
			}

			// Handle Array
			if (obj instanceof Array) {
					copy = [];
					for (var i = 0, len = obj.length; i < len; i++) {
							copy[i] = clone(obj[i]);
					}
					return copy;
			}

			// Handle Object
			if (obj instanceof Object) {
					copy = {};
					for (var attr in obj) {
							if (obj.hasOwnProperty(attr)) copy[attr] = clone(obj[attr]);
					}
					return copy;
			}

			throw new Error("Unable to copy obj! Its type isn't supported.");
	}
	
	var getAsJson = function(data){
		return JSON.stringify(data);
	};
	
	
	var getAsUrlEncoded = function(ccData){
		var data = [];
		for(var prop in ccData){
			data.push((prop + '=' + ccData[prop]));
		}
		return data.join('&');
	};
	
	

		
	var getFormData = function(form){
		var inputs = form.querySelectorAll("input");
		var selects = form.querySelectorAll("select");
		var data = {};
		
		for(var i = 0; i<inputs.length; i++){
			var prop = inputs[i].name;
			var val = getValue(inputs[i]);
			data[prop] = val;
		}
		
		for(var i = 0; i<selects.length; i++){
			var prop = selects[i].name;
			var val = getValue(selects[i]);
			data[prop] = val;
		}
		
		return data;
	};

	
	var getValue = function(elem){
		if(!elem) return '';
		try {
			switch(elem.nodeName) {
				case 'SELECT':
					return ((!elem.options || elem.options.length < 1) ? '' : elem.options[elem.selectedIndex].value);
					break;
				default:
					var type = elem.getAttribute("type");
					if("checkbox" === type){
						return !!elem.checked ? true : false;
					} else {
						return !!elem ? elem.value : '';
					}
					break;
			}
		} catch(e) {
			console.log('Error when getting value for form element: ',elem);
			throw e;
		}
	};
	
	
	var setValue = function(elem,val){
		if(!elem) throw new Error("Missing paramter: elem");
		try {
			switch(elem.nodeName) {
				case 'SELECT':
					// Loop through the options and remove any previous selected="selected" attributes.
					if(elem.options && elem.options.length > 0){
						if(elem.options[elem.selectedIndex].value == val) return elem;
						for(var i = 0; i<elem.options.length; i++){
							if(elem.options[i].value == val){
								elem.options[i].setAttribute("selected","selected");
							} else {
								elem.options[i].removeAttribute("selected");
							}
						}
					}
					break;
				default:
					var type = elem.getAttribute("type");
					if("checkbox" === type){
						if(!!val) {
							elem.setAttribute("checked","checked");
						} else {
							elem.removeAttribute("checked");
						}
					} else {
						elem.value = val;
					}
					break;
			}
		} catch(e) {
			console.log('Error when setting value for form element: ',elem);
			throw e;
		}
		return elem;
	};
	
	
	return {
		clone: clone,
		getAsJson: getAsJson,
		getAsUrlEncoded: getAsUrlEncoded,
		getValue: getValue,
		setValue: setValue,
		getFormData: getFormData
	};
	
});