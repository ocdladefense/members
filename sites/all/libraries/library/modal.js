define(["libElement","libView"],function(libElement,view){

	var defaultHandlers = [];
	
	var customHandlers = [];
	
	var closeHandler = function(e){
		var target = e.target;
		if(target.dataset && target.dataset.action){
			e.preventDefault();
		} else {
			return false;
		}
		if(target.dataset && target.dataset.action == "close-modal"){
			this.hide();
		}
		
		return false;
	};
	
	
	
	var doHandlers = function(e){
		var target = e.target;
		var action = target.dataset && target.dataset.action ? target.dataset.action : null;

		for(var i = 0; i<customHandlers.length; i++){
			try {
				if(customHandlers[i].handleEvent){
					customHandlers[i].handleEvent(e);
				}
			} catch(e) {
				console.log("Modal handler threw an event:",e);
			}
		}
		for(var i = 0; i<defaultHandlers.length; i++){
			defaultHandlers[i](e);
		}
	};
	
	


	var renderElem = {
		mergeStyles: function(cssNew,cssOld){
			cssOld = cssOld || {};
			for(var prop in cssNew){
				cssOld[prop] = cssNew[prop];
			}
			return this.getAsInlineStyles(cssOld);
		},

		getAsInlineStyles: function(css){
			var styles = [];
			for(var prop in css){
				styles.push([prop,css[prop]].join(":"));
			}
			return styles.join(";")+";";
		},
	
		parseStyles: function(style){
			var css = {};
			var styles = style.split(";");
			for(var i = 0; i<styles.length; i++){
				var obj = styles[i].split(":");
				css[obj[0]] = obj[1];
			}
		
			return css;
		}
	};

	function mixin(target,source){
		for(var prop in source){
			target[prop] = source[prop];
		}
	}

	var modalPrototype = {
		root: document,
	
		backdrop: null,
		
		attached: false,
		
		actionscont: null,
		
		actions: [],
	
		defaultBackdropStyles: {
			"overflow":"hidden",
			"position":"fixed",
			"top":"0px",
			"left":"0px",
			"z-index":"101",
			"background-color":"rgba(0,0,0,0.6)",
			"width":"100%",
			"height":"100%"
		},
	
		defaultContainerStyles: {
			"overflow-x":"hidden",
			"overflow-y":"visible",
			"position":"absolute",
			"width":"700px",
			"height":"70vh",
			"top":"50%",
			"left":"50%",
			"margin-left":"-350px",
			"margin-top":"-35vh",
			"z-index":"101",
			"background-color":"#fff",
			"border":"1px solid #ccc",
			"box-shadow":"3px 3px 3px #ccc",
			"padding":"20px",
			"transition":"top 0.4s ease-out"
		},

		modalSetup:function() {
			this.document = libElement.newNode(this.root.body);
			this.backdrop = this.root.createElement("div");
			this.backdrop.setAttribute("class","clickpdx-modal-overlay");
			this.container = this.root.createElement("div");
			this.content = this.root.createElement("div");
			this.content.setAttribute("class","modal-content");
			var mframe = this.root.createElement("div");
			this.actionscont = document.createElement("div");
			
			mframe.setAttribute("class","modal-actions");
			mframe.setAttribute("style","position:absolute;top:0px;right:0px;padding:8px;");
			mframe.innerHTML = "<div><a href='#' data-action='close-modal' style='display:inline-block;padding:3px;'>X</a></div>";
			
			this.container.appendChild(mframe);
			this.container.appendChild(this.content);
			this.backdrop.appendChild(this.container);
		
			this.backdrop.setAttribute("style",this.getAsInlineStyles(this.defaultBackdropStyles));

			this.container.setAttribute("class", "clickpdx-modal");
			this.container.setAttribute("id", "myModal");
			this.container.setAttribute("tabindex", "-1");
			this.container.setAttribute("role", "dialog");
			this.container.setAttribute("aria-labelledby", "myModalLabel");
			this.container.setAttribute("aria-hidden", "false");
			this.container.setAttribute("style",this.getAsInlineStyles(this.defaultContainerStyles));
			
			// Event listener
			this.backdrop.addEventListener("click",doHandlers,true);
		},
	
		/**
		 * @method, addAction
		 *
		 * @description, add an event handler for the specific data-action value.
		 *
		 * @param, action - String, the value of the data-action attribute.
		 * @param, cb - Function, the callback function to be executed for the matching action.
		 */
		setHandler: function(handler){
			customHandlers = [handler];
		},
		
		append: function(elem){
			this.content.appendChild(elem);
		},
	
		attach:function() {  
			this.modalSetup(); 
			var body = this.root.body;
			body.appendChild(this.backdrop);
			this.attached = true;
		},

		css: function(target,css){
			var current = this.parseStyles(target.getAttribute("style"));
			console.log("Current css is: ",current);
			var merged = this.mergeStyles(css,current);
			target.setAttribute("style",merged);
		},
	
		show:function() {
			this.document.addClass("has-modal");
			this.renderActions();
		},

		hide:function(){
			customHandlers = []; // Clear all custom handlers for the modal.
			this.document.removeClass("has-modal");
			this.content.innerHTML = "";
			this.actionscont.innerHTML = "";
			this.actions = [];
		},
	
		html:function(html) {    
			this.content.innerHTML = html;
		},
		
		addActions: function(vnodes){
			vnodes = Array.isArray(vnodes) ? vnodes : [vnodes];
			for(var i = 0; i<vnodes.length; i++) {
				this.actions.push(vnodes[i]);
			}
		},
		
		renderActions: function() {
			var elems = this.actions.map(view.createElement);
			for(var i = 0; i< elems.length; i++){
				this.actionscont.appendChild(elems[i]);
			}
			this.content.appendChild(this.actionscont);
		},


		fetchHtml:function(url) {
			return fetch(url)
			.then(function(response){
				return response.text();
			});
		}
	};

	function Modal() {
		this.container = null;
		//this.modalSetup();
//		this.attach();
		defaultHandlers.push(closeHandler.bind(this));
	}

	mixin(modalPrototype,renderElem);

	Modal.prototype = modalPrototype;
	
	window.modal = new Modal();
});