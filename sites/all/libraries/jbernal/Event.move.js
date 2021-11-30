var activeObj = {}	
activeObj.moving = false;
activeObj.obj = null;
activeObj.dx = 0;
activeObj.dy = 0;
activeObj.posx = 0;
activeObj.posy = 0;  


/* Notice that, while we are interested in e.target the event listener itself is added to the document/window and not the target itself.  We are able to capture the target through the Event bubbling phase. */



var myEvent = function()
	{
		function EventgetPosition(e) {
			//alert(parseInt(obj.style.top));
			_posx = 0;
			_posy = 0;
			if (e.pageX || e.pageY) {
				_posx = e.pageX;
				_posy = e.pageY;
			}
			else if (e.clientX || e.clientY) {
				_posx = e.clientX + document.body.scrollLeft
					+ document.documentElement.scrollLeft;
				_posy = e.clientY + document.body.scrollTop
					+ document.documentElement.scrollTop;
			}
			
			/* set the {x,y} coordinates to the -offset- (the difference) between the the event mouse coordinates m{x,y} and the object's original position o{x,y} */
			_x = _posx-activeObj.dx;//-(posx-parseInt(obj.style.left));
			_y = _posy-activeObj.dy;
		
			 return [_x,_y];
		}
		
		function getClickCoordinates(e) {
			activeObj.posx = 0;
			activeObj.posy = 0;
			if (e.pageX || e.pageY) {
				activeObj.posx = e.pageX;
				activeObj.posy = e.pageY;
			}
			else if (e.clientX || e.clientY) {
				activeObj.posx = e.clientX + document.body.scrollLeft
					+ document.documentElement.scrollLeft;
				activeObj.posy = e.clientY + document.body.scrollTop
					+ document.documentElement.scrollTop;
			}
			return [activeObj.posx,activeObj.posy];
		}
		
		function setDeltaCoordinates(e) {
			e.getTarget = function(){ tmp=this.target||this.srcElement;return tmp }
			m = getClickCoordinates(e);
			t = parseInt(e.getTarget().style.top);
			l = parseInt(e.getTarget().style.left);
			//alert(["div top: "+t+"px","\ndiv left: "+l+"px"]);
			activeObj.dx = m[0]-l;//subtract left position from mouse's xpos
			activeObj.dy = m[1]-t;//subtract top position from mouse's ypos
		}
		
		function eventTargeteventCoordinatesReset(obj) {
			activeObj.dx = 0;
			activeObj.dy = 0;
		}
		
		
		
		/**
		 * We've passed an event to the activate method
		 * store the Event target to the activeObj object
		 * define that the activeObj is "moving"
		 * set the delta coordinates of the event, that is the offeset from the top/left coordinates of the target object
		 * 
		**/
		function activate(e) {
			activeObj.obj=e.getTarget();
			activeObj.moving = true;
			activeObj.obj.style.zIndex = 100;
			setDeltaCoordinates(e);
			document.addEventListener('mousemove',function(e){if(e.preventDefault) e.preventDefault(); else e.returnValue=false;if(activeObj.moving){activeObj.obj.style.top=EventgetPosition(e)[1]+"px";activeObj.obj.style.left=EventgetPosition(e)[0]+"px";}},false);
		}
		
		function deactivateObj(obj) {
			activeObj.obj.style.zIndex = 0;
			activeObj.obj=null;
			activeObj.moving = false; 
			eventTargeteventCoordinatesReset(obj);
			document.onmousemove = function(e){return false}
		}
		
		var init = function(e) {
			e.getTarget = function(){ targ=this.target||this.srcElement; return targ }
			//alert(e.getTarget().id);			
			e.setDefault = function(val) {
				this.enableDefault=val;
				if(!this.enableDefault && this.preventDefault) e.preventDefault();
				else e.returnValue=this.enableDefault;
				return this.enableDefault;
			}			
			e.setDefault(false); //make sure the myEvent's default value is not executed
			if(e.getTarget().id.indexOf("moveme")!=-1 && activeObj.obj===null) activate(e); //ie6 doesn't support the getAttribute method...alert([e.getTarget(),e.setDefault(false)]);//activate(e);
		}
		
		return({
			getMousePos:EventgetPosition,
			getClickCoordinates:getClickCoordinates,
			setDeltaCoordinates:setDeltaCoordinates,
			init:init,
			deactivateObj:deactivateObj
			
		})
	}();




/**
 * @ Function getTarget
 * @ Global function to return an Event's target object.
 * @
 */
function getTarget(e) {
	if(window.attachEvent) return window.event.srcElement;
	else return e.target;
}







/**
 * @ Function doOnLoad -
 * @ Initiate the interface for this document which will listen for mousedown, mousemove and mouseup Events
 * @ 
 * @
 */
function doOnLoad() {
	document.addEventListener('mousedown',myEvent.init,true);
	//document.addEventListener('click',function(e){alert(e.srcElement.id)},true);
	document.addEventListener('mouseup',function(e){if(getTarget(e).id.indexOf("moveme")!=-1) myEvent.deactivateObj(getTarget(e))},false);
	//document.onclick = function(e){e.preventDefault();/*e.stopPropagation()*/}//can't remember if I had uncommented this or not??
	var moveme = document.getElementById('moveme');
}

if(window.event) window.event.hello = function(){ alert('Hello World!') }


/**
 * @ For implementations that ignore the addEventListener interface
 * @ create that interface at the document and window level so it can be invoked.
 * @
 */
if (!window.addEventListener) {
	
	function getEventObj(registeredObj){
		return function(type, listener, useCapture) {
			//registeredObj.attachEvent('on'+type,listener.call(registeredObj,window.event))
				registeredObj.attachEvent( 'on'+type,function() {
            listener.call(registeredObj, window.event);
          } );
			}
	}

	document.addEventListener = getEventObj(document);
	window.addEventListener = getEventObj(window);
}


window.addEventListener("load",doOnLoad,true);