/* A general function that associates an object instance with an event
   handler. The returned inner function is used as the event handler.
   The object instance is passed as the - obj - parameter and the name
   of the method that is to be called on that object is passed as the -
   methodName - (string) parameter.
*/
function associateObjWithEvent(obj, interf, methodName){
	interf = interf || window;
    /* The returned inner function is intended to act as an event
       handler for a DOM element:-
    */
    return (function(e){
        /* The event object that will have been parsed as the - e -
           parameter on DOM standard browsers is normalised to the IE
           event object if it has not been passed as an argument to the
           event handling inner function:-
        */
        e = e||window.event;// Wow!  This works in Internet Exporer
        /* The event handler calls a method of the object - obj - with
           the name held in the string - methodName - passing the now
           normalised event object and a reference to the element to
           which the event handler has been assigned using the - this -
           (which works because the inner function is executed as a
           method of that element because it has been assigned as an
           event handler):-
        */
        return obj[methodName](e, this);
    });
}



/* This constructor function creates objects that associates themselves
   with DOM elements whose IDs are passed to the constructor as a
   string. The object instances want to arrange than when the
   corresponding element triggers onclick, onmouseover and onmouseout
   events corresponding methods are called on their object instance.
*/
function DhtmlInterface(){
	this.interf = document;
	this.drawn = false;
	this.name = "Menu";
	this.statusMessage = "A status message for the Interface.";
    /* A function is called that retrieves a reference to the DOM
       element (or null if it cannot be found) with the ID of the
       required element passed as its argument. The returned value
       is assigned to the local variable - el -:-
    */
   // var el = getElementWithId();

        this.interf.onclick = associateObjWithEvent(new DhtmlObject('UI_item'), this.interf, "doOnClick");
       // this.el.onmouseover = associateObjWithEvent(new DhtmlObject('UI_item'), "doMouseOver");
       // this.el.onmouseout = associateObjWithEvent(new DhtmlObject('UI_item'), "doMouseOut");
}
DhtmlObject.prototype.doOnClick = function(event, element){
		// alert(element);
		var posx = 0;
		var posy = 0;
		if (event.pageX || event.pageY) 	{
			posx = event.pageX;
			posy = event.pageY;
		}
		else if (event.clientX || event.clientY) 	{
			posx = event.clientX + document.body.scrollLeft
				+ document.documentElement.scrollLeft;
			posy = event.clientY + document.body.scrollTop
				+ document.documentElement.scrollTop;
		}

    this.draw(posx,posy);
}

function DhtmlObject(elementId){
	var DEFAULT_WINDOW_INTERFACE = window;
	var NODE_NOT_DRAWN = false;
	
	
	this.interf = DEFAULT_WINDOW_INTERFACE;
	this.items = ['Menu Item 1','Menu Item 2','Menu Item 3','Menu Item 4'];
	this.id = elementId;
	this.drawn = NODE_NOT_DRAWN;
	this.name = "Menu";
	this.statusMessage = "A status message for "+elementId;
    /* A function is called that retrieves a reference to the DOM
       element (or null if it cannot be found) with the ID of the
       required element passed as its argument. The returned value
       is assigned to the local variable - el -:-
    */
   // var el = getElementWithId();
    this.el = document.getElementById(elementId);
    /* The value of - el - is internally type-converted to boolean for
       the - if - statement so that if it refers to an object the
       result will be true, and if it is null the result false. So that
       the following block is only executed if the - el - variable
       refers to a DOM element:-
    */
    if(this.el){
        /* To assign a function as the element's event handler this
           object calls the - associateObjWithEvent - function
           specifying itself (with the - this - keyword) as the object
           on which a method is to be called and providing the name of
           the method that is to be called. The - associateObjWithEvent
           - function will return a reference to an inner function that
           is assigned to the event handler of the DOM element. That
           inner function will call the required method on the
           javascript object when it is executed in response to
           events:-
        */
//       this.interf.onclick = associateObjWithEvent(this, this.interf, "doOnClick");
//       this.interf.onclick = associateObjWithEvent(new DhtmlObject('UI_item'), this.interf, "doOnClick");
       // this.el.onmouseover = associateObjWithEvent(this, "doMouseOver");
       // this.el.onmouseout = associateObjWithEvent(this, "doMouseOut");
    }
}

DhtmlObject.prototype.draw = function(x,y){
	if(!this.drawn) {
		//rclick = document.createElement('ul'));
		this.drawn = true;
		//rclick.setAttribute('id',this.elemtId);
		for(i=0; i<this.items.length; i++) {
			it = document.createElement('li');
			//it.setAttribute('style','width:100px; display:block;');
			a = document.createElement('a');
			a.setAttribute('href','#');
			a.onclick=function(){ return false; }
			a.appendChild(document.createTextNode(this.items[i]));
			it.appendChild(a);
			this.el.appendChild(it);
		}
		this.el.style.display="block";
	}

	try{
		this.el.style.left=x+"px";
		this.el.style.top=y+"px";
		this.el.style.zIndex=100;
	}catch(e){ }

}

DhtmlObject.prototype.toString = function(){ return "My First DhtmlObject: "+this.el }


DhtmlObject.prototype.doMouseOver = function(event, element){
    //... // doMouseOver method body.
}
DhtmlObject.prototype.doMouseOut = function(event, element){
    //... // doMouseOut method body.
}