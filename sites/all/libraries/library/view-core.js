define(["libFetch"],function(xhrFetch){

	DEBUG = false;
	
	var log = function(m){
		DEBUG && console.log(m);
	};
	
	var documents = {
		
	};
	
	var cache = {
		'order-card': null
	};
	
	var css = function(css){
		for(var prop in css){
			this.styles[prop] = css[prop];
		}
		this.root.setAttribute("style",getAsInlineStyles(this.styles));
	};
	
	var getAsInlineStyles = function(css){
		var styles = [];
		for(var prop in css){
			styles.push([prop,css[prop]].join(":"));
		}
		return styles.join(";")+";";
	};

	function register(documentId,url){
		cache[documentId] = url;
	}

		
	
	function loadDocument(uri){
		return xhrFetch.fetch(uri);
		// return fetch(uri).then(response => response.text());
	}
	
	
	function loadXml(uri){
		return loadDocument(uri);
		/*return fetch(uri)
		.then( response=>response.text())
		.then( (textHtml)=> {
			const parser = new DOMParser();
			const htmlDocument = parser.parseFromString(textHtml, "text/html");
			return htmlDocument;
		});
		*/
	}
	
	
	



	window.h = function h(type,props,children){
		return {
			type: type,
			props: props,
			children: typeof children == "string" ? [children] : children
		};
	};
	
	window.v = h;



	window.createElement = function createElement(vnode){
		if(typeof vnode === "string") {
			return document.createTextNode(vnode);
		}
		if(vnode.type == "text") {
			return document.createTextNode(vnode.children);
		}
	
		var $el = document.createElement(vnode.type);
		

		for(var prop in vnode.props) {
			var html5 = "className" == prop ? "class" : prop;
			$el.setAttribute(html5,vnode.props[prop]);
		}
		
		if(null != vnode.children) {
			vnode.children.map(createElement)
				.forEach($el.appendChild.bind($el));
		}
		
		return $el;
	};
	
	
	
	function loadTemplate(uri){
		return loadXml(uri)
		.then( function(doc) {
			return doc.body.innerHTML;
		})
	}
	
	
	var functions = {
		'if': function(t,exp,scope){
			return scope[exp] ? t : '';
		},
		'for': function(t,o,prop){
		
		}
	};
	
	var functionTokenRegex = function(fn,scope) {
		return functions[fn](scope);
	};
		
	/**
	 * subcapture 0 - the property to test for truthy
	 * subcapture 1 - operator, if present (optional)
	 * subcapture 2 - operand, if present (optional)
	 */
	var ifTokenRegex = function() {
		var reger = /\{\{if\(([\w]+)([=]+)([a-zA-Z0-9]+?)\)\}\}([\s\S]+?)(?:{{else}}([\s\S]*?))?\{\{fi\}\}/gi;
		return reger;
	};
	
	var doIf = function(tpl,alt,scope,prop,op,operand) {
		// console.log("Will test if ",prop," matches ",operand);
		if(op && operand){
			if(scope[prop]==operand){
				return tpl;
			} else if(!alt) {
				return "";
			} else {
				return alt;
			}
		}
		else if(!scope[prop]) {
			return "";
		} else if(typeof scope[prop] == "function" && scope[prop]() === false)  {
			return "";
		} else if(typeof scope[prop] == "function" && scope[prop]() === true)  {
			return tpl;
		} else if(scope[prop]) {
			return tpl;
		}
	};
	
	var forEachTokenRegex = function() {
		return new RegExp('\\{\\{foreach\\((.+?)\\)\\}\\}(.+?)\\{\\{endforeach\\}\\}','gim');		
	};
	
	var templateTokenRegex = function() {
		return new RegExp('\\{\\{template\\((.+?)\\)\\}\\}','gim');		
	};
	
	var propertyTokenRegex = function() {
		return new RegExp('\\{\\{\\s*(.+?)\\s*\\}\\}','gim');
	};
	
	var unusedTokenRegex = new RegExp('\\{\\{(.*?)\\}\\}','gi');
	/**
	 * @function parseString
	 *
	 * @description
	 *   Parse a given XML string using the renderable object's (o) render() method.
	 *
	 */
	function parse(t,scopes,opts) {
		var re, result;
		scopes = Array.isArray(scopes) ? scopes : [scopes];

		if(scopes) {
		

		
			for(var i = 0; i<scopes.length; i++){
			
				t = t.replace(templateTokenRegex(),function(exp,tplName){//,tpl,offset,string){
					return scopes[i][tplName]();//parse(doIf(tpl,scopes[i],prop),scopes);
				});
			
				t = t.replace(ifTokenRegex(),function(exp,prop,op,operand,tpl,alt,offset,string){
					return parse(doIf(tpl,alt,scopes[i],prop,op,operand),scopes);
				});
				
				
				t = t.replace(forEachTokenRegex(),function(exp,prop,tpl,offset,string){
					var prop = scopes[i][prop];
					var propRet = [];
					for(var idx = 0; idx<propRet.length; idx++){
						propRet.push(parse(tpl,obj));
					}
					
					return propRet.join('\n');
				});

				t = t.replace(propertyTokenRegex(),function(exp,prop){
					var hasNativeProp = scopes[i][prop];
					var hasRenderer = scopes[i]['render'];
					var val;
					if(hasNativeProp && hasRenderer) {
						val = scopes[i].render(prop);
					} else if(hasNativeProp) {
						val = scopes[i][prop];
						val == '' && log('WARNING: replaced ',prop,' with an empty value!');
					} else if(!hasNativeProp && hasRenderer) {
						var potential;
						try {
							potential = scopes[i].render(prop);
						} catch(e) {
							log(e);
							potential = null;
						}
						val = !potential ? '{{'+prop+'}}' : potential;
					} else {
						val = '{{'+prop+'}}';
					}
					return val;
				});
			}
		}

		return opts && opts['replaceAll'] ? t.replace(unusedTokenRegex,'') : t;
	}
	

	
	
	var doWhile = function(tpl,scope,prop){
		/*while((result = re.exec(t)) !== null) {
			var stmt = result[0];
			var ev = result[1];
			var tpl = result[2];

			log(result);
			parse(tpl,o);
		}
		*/
	};
	
	return {
		register: register,
		parse: parse,
		loadDocument: loadDocument,
		loadXml: loadXml,
		loadTemplate: loadTemplate,
		getAsInlineStyles: getAsInlineStyles,
		css: css,
		createElement: createElement
	};
		
});