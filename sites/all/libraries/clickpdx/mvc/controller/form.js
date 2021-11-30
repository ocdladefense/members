;
(function(window, _null) {

	function ClickpdxForm(selector)
	{
		this.rows = null;
	
		this.currentEvtTableRow = null;
	
		// Initialize this object using the passed selector.
		this.init = function(selector){
			CLICKPDX.MVC.Controller.Base.prototype.init.call(this,selector);
			this.rows = this._rootElements[0].getElementsByTagName('tr');
		};
		
		this.init(selector);
	
		this.rowCount = function()
		{
			var hasHeaderRow = true;
			return hasHeaderRow?this.rows.length-1:this.rows.length;
		};
	
		this.onEnter = function(func){
			var f = function(evt) {
				if(evt.keyCode == 13)
				{
					this.setCurrentEvtTableRow(evt);
					var self = this;
					self.f = func;
					return self.f(evt);
				}
			};
			this.on('keypress',f);
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
					var evt = new CLICKPDX.Event.GenericEvent(e);
					self.func = func;
					return self.func(evt,evt.fieldName(),evt.rowId());
					// return self.func(evt);
				}
				catch(e)
				{
					console.log(e);
				}
			};
			this.addListener(evtType,runtimeCallback,capture);
		};
	
		this.getFieldRow = function(el){
			if(el.parentNode.nodeName=='TD'&&el.parentNode.parentNode.nodeName=='TR'){
				for(var i=0; i<this.rows.length;i++){
					if(el.parentNode.parentNode===this.rows[i]) return this.rows[i];
				}
			}
			console.log('Couldn\'t find a matching event node.');
			return null;
		};
	
		this.getRowFieldByName = function(el,name,tag){
			var childs = el.getElementsByTagName(tag||'input');
			for(var i=0; i<childs.length; i++){
				if(childs[i].getAttribute('name')==name) return childs[i];
			}
			return null;
		};

		this.setCurrentEvtTableRow = function(evt){
			this.currentEvtTableRow = this.getFieldRow(evt.target);
		};
	
		this.gotoFieldByName = function(fieldName,row){
			var r = row||this.currentEvtTableRow;
			var el = this.getRowFieldByName(r,fieldName);
			el.focus();
		};
	
		this.submitOnEnter = function(bool)
		{
			if(!bool)
			{ 
				this.keypress(function(e){
					if(e.keyCode == 13)
					{
						e.preventDefault();
						e.stopPropagation();
						return false;
					}
				});
			}
		};
	}

	try
	{
		ClickpdxForm.prototype = new CLICKPDX.MVC.Controller.Base;
		ClickpdxForm.prototype.constructor = ClickpdxForm;
	} catch(e)
	{
		console.log('The Form object is prototyped from the Controller object, but the Controller object could not be found.');
	}

	CLICKPDX.MVC.Controller['Form'] = ClickpdxForm;
})(window, null);