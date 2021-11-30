;
(function(window, _null) {
	var 
	
	applications = {},

	ns = undefined;

	var Application = function(appName,settings){
		// If the application already exists then just return it.
		var settings = settings||{};
		if(applications[appName]) {
			if(ns) {
				if(!window[ns]) throw 'The specified namespace '+ns+' doesn\'t exist.';
				if(!window[ns].applications) throw 'The settings key of the '+ns+' namespace doesn\'t exist.';
				return window[ns].applications[appName];
			}
			else return applications[appName];
		}
		// Otherwise create the new Application.
		applications[appName] = new Application.fn.init(appName,settings);
		if(ns) {
			if(!window[ns].applications) window[ns].applications={};
			window[ns].applications[appName] = applications[appName];
		}
		return applications[appName];
	};
	
	
	Application.fn = Application.prototype = {
		constructor: Application,
		appName: '',
		settings: {},
		data: {},
		controllers: {},
		views: {},
		templates: {},
		init: function(appName,settings){
			this.appName = appName;
			this.settings = settings||{};
			if(this.settings['appName']) delete this.settings.appName;
			for(var f in this.settings){
				this[f] = this.settings[f];
			}
			return this;
		},
		setData: function(data){
			this.data = data;
		},
		getData: function(){
			return this.data;
		},
		getSetting: function(key){
			return this[key] || undefined;
		},
		registerView: function(viewName,view){
			this.views[viewName] = view;
			return view;
		},
		getView: function(viewName){
			if(!this.views[viewName]) throw new Error (viewName+' is not a registered view.');
			return this.views[viewName];
		},
		registerController: function(cName,controller){
			this.controllers[cName] = controller;	
			return controller;	
		},
		getController: function(cName){
			if(!this.controllers[cName]) throw new Error (cName+' is not a registered controller.');
			return this.controllers[viewName];				
		},
		registerTemplates: function(templates){
			this.templates = templates;
			return this;
		},
		template: function(t,obj){
			return this.templates[t](obj);
		}
	};
	Application.fn.init.prototype = Application.fn;
	
	window.Application = Application;
	window.DTE = {};
})(window, null);