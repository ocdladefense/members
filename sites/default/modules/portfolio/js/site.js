(function(a){var b=[].indexOf||function(a){for(var b=0;b<this.length;b++)if(this[b]===a)return b;return-1},c=function(a){return a.replace(/\w\S*/g,function(a){return a.charAt(0).toUpperCase()+a.substr(1).toLowerCase()})},d=a.console||{log:function(){}};a.toCamelCase=function(a){var b="",d=a[0];if(1===a.length)return d;for(var e=1;e<a.length;e++)b+=c(a[e]);return d+b};a.console=d;a.document.addCssStylesheet=function(a){var b=document.createElement("link");b.setAttribute("type","text/css");b.setAttribute("rel",
"stylesheet");b.setAttribute("href",a);document.getElementsByTagName("head")[0].appendChild(b);return b};a.getElementsByClassName=function(c){context=this==a?document:this;if(!context.getElementsByTagName){d.log("getElementsByClassName called with non-standard object.");if(!context.root)return d.log("Context missing .root property"),[];context=context.root}if(context.getElementsByTagName&&context.getElementsByClassName)return context.getElementsByClassName(c);if(context.getElementsByTagName&&context.querySelectorAll)c=
context.querySelectorAll("."+c);else{for(var g=context.getElementsByTagName("*"),f=[],e=0;e<g.length;e++)g[e].className&&-1<(" "+g[e].className+" ").indexOf(" "+c+" ")&&-1===b.call(f,g[e])&&f.push(g[e]);c=f}return c};a.Utility={GetType:function(b){return b===a.document?"HTMLDocument":Object.prototype.toString.call(b)}}})(window);
Function.prototype.bind||(Function.prototype.bind=function(a){if("function"!==typeof this)throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");var b=Array.prototype.slice.call(arguments,1),c=this,d=function(){},h=function(){return c.apply(this instanceof d&&a?this:a,b.concat(Array.prototype.slice.call(arguments)))};d.prototype=this.prototype;h.prototype=new d;return h});(function(a){function b(){}function c(){this.userAgent=navigator.userAgent}b.prototype=c.prototype={mobile:function(a){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)?!0:!1},browser:this.userAgent,userAgent:function(a){if(a)this.userAgent=a;else return this.userAgent},isLikePhone:function(){},isLikeTablet:function(){}};b.prototype.declareMobile=function(){document.body.setAttribute("class",document.body.getAttribute("class")+" device-phone")};a.Environment=
c;a.Browser=b})(window);function GenericEvent(a){this.e=a||window.event;this.type=this.e.type;this.target=this.e.target||this.e.srcElement;this.keyCode=this.e.keyCode||this.e.which;this.data={};this.preventDefault=function(){this.e.preventDefault?this.e.preventDefault():this.e.returnValue=!1};this.stopPropagation=function(){this.e.stopPropagation?this.e.stopPropagation():this.e.cancelBubble=!0};this.getLinkElem=function(){if("IMG"==this.target.nodeName&&"A"==this.target.parentNode.nodeName)return this.target.parentNode;
if("A"==this.target.nodeName||"IMG"==this.target.nodeName)return this.target};this.setData=function(a,c){this.data[a]=c};this.getData=function(a){var c=a;a=a.split("-");a=1<a.length?toCamelCase(a):a;return this.target.dataset?this.target.dataset[a]:this.target.getAttribute("data-"+c)}}
function EventDelegate(a){if(a&&a!==window&&a!==window.document)if("."===a.charAt(0))this._rootElements=window.getElementsByClassName(a.substr(1));else if("#"===a.charAt(0)){if(!document.getElementById(a.substr(1)))throw"Cannot locate element with id "+a;this._rootElements=[document.getElementById(a.substr(1))]}else this._rootElements=[document.getElementById(a)];else this._rootElements=[window.document];console.log("Root elements are: "+this._rootElements);if(0< !this._rootElements.length)throw"Cannot create a controller on element <"+
a+">";this.addListener=function(a,c,d){for(i=0;i<this._rootElements.length;i++)this._rootElements[i].attachEvent?this._rootElements[i].attachEvent("on"+a,c):this._rootElements[i].addEventListener(a,c,d)};this.click=function(a){this.on("click",a)};this.keypress=function(a){this.on("keypress",a)};this.quickview=function(a){this.addListener("click",function(c){var d=Array.prototype.slice.call(arguments);c=new GenericEvent(d[0]);d=localCache.getProduct(c.target.getAttribute("data-model"))||null;return a(c,
d)},!0)};this.on=function(a,c,d,h,g){var f=d||this;this.addListener(a,function(a){Array.prototype.slice.call(arguments);var b=new GenericEvent(a);f.func=c;return f.func(b)},h||!1)}};function EventDelegate(a){if(a&&a!==window&&a!==window.document)if("."===a.charAt(0))this._rootElements=window.getElementsByClassName(a.substr(1));else if("#"===a.charAt(0)){if(!document.getElementById(a.substr(1)))throw"Cannot locate element with id "+a;this._rootElements=[document.getElementById(a.substr(1))]}else this._rootElements=[document.getElementById(a)];else this._rootElements=[window.document];console.log(this._rootElements);if(0< !this._rootElements.length)throw"Cannot create a controller on element <"+
a+">";this.addListener=function(a,c,d){for(i=0;i<this._rootElements.length;i++)this._rootElements[i].attachEvent?this._rootElements[i].attachEvent("on"+a,c):this._rootElements[i].addEventListener(a,c,d)};this.click=function(a){this.on("click",a)};this.keypress=function(a){this.on("keypress",a)};this.quickview=function(a){this.addListener("click",function(c){var d=Array.prototype.slice.call(arguments);c=new GenericEvent(d[0]);d=localCache.getProduct(c.target.getAttribute("data-model"))||null;return a(c,
d)},!0)};this.on=function(a,c,d,h,g){var f=d||this;this.addListener(a,function(a){Array.prototype.slice.call(arguments);var b=new GenericEvent(a);f.func=c;return f.func(b)},h||!1)}};function ProjectManager(){this.sliders={}}ProjectManager.prototype={add:function(a){"string"===typeof a&&(a=[a]);for(var b in a)this.sliders[a[b]]=new FrameCollection(a[b])},remove:function(a){},getFrameCollection:function(a){return this.sliders[a]},stage:function(a,b){this.sliders[a].prepareStage(b)}};function Frame(a){this.root=a}Frame.prototype={activate:function(){this.setActiveClass()},setActiveClass:function(){$(this.root).addClass("active")},makeInactive:function(){$(this.root).removeClass("active")}};function FrameCollection(a,b){this.id=a;this.projectStageId="project-"+a;this.domId=a;this.root=document.getElementById(this.domId);this.frames=[];this.controller=new EventDelegate(this.domId);this.controller.on("click",this.click,this);this.content=this.getElementsByClassName("stage-content")[0];this.init()}
FrameCollection.prototype={data:null,display:"DISPLAY_CLOSED",state:"NOT_LOADED",displayProxy:null,getElementsByClassName:getElementsByClassName,init:function(){if("NOT_LOADED"!=this.state){for(i=0;i<this.content.childNodes.length;i++){var a=this.content.childNodes[i];a.getAttribute&&null!=a.getAttribute("class")&&(console.log(a.getAttribute("class")),-1!==a.getAttribute("class").indexOf("slide")&&this.addFrame(a))}try{this.frames[0].activate()}catch(b){console.log("No frames found. DOM is not ready.")}this.captions=
this.getElementsByClassName("caption")}},getHtml:function(){return this.data},render:function(){"DATA_LOADED"!=this.state&&(this.displayProxy=this.load());this.displayProxy.done($.proxy(this.showCollection,this));this.displayProxy.done($.proxy(this.startLoading,this))},load:function(){var a=select.ajax(PORTFOLIO_SRC,{data:{project:this.id}});a.done($.proxy(this.attachDom,this));a.done($.proxy(this.init,this));return a},attachDom:function(a){this.setData(a);var b=this.id+"-stage-content";console.log("Attach data to:"+
b);var c=document.getElementById(b);console.log(c);try{c.innerHTML=this.data}catch(d){console.log("InnerHTML failed with: "+d.message),select("#"+b).html(a)}window.USE_BETA_STAGE&&stage.attachHtml(this);this.status("DATA_LOADED")},status:function(a){if(a)this.state=a;else return this.state},setData:function(a){a&&(this.data=a,this.status("DATA_LOADED"))},prepareStage:function(a){jQuery("#"+this.projectStageId).css("top",a+"px")},toString:function(){return"I am a FrameCollection."},click:function(a){"getSlide"==
(a.getData("action")||null)&&a.getData("index")&&(this.activate(a.getData("index")),a.stopPropagation());return!1},find:function(a){for(i=0;i<this.frames.length;i++)if(i==a)return this.frames[i]},toggleDisplay:function(){"DISPLAY_CLOSED"==this.display?this.render():"DISPLAY_OPEN"==this.display&&this.hide()},showCollection:function(){var a="button-"+this.id;select("#"+this.id+"-stage").removeClass("closed");try{document.getElementById(a).value="hide"}catch(b){throw"Could not locate element with id "+
a;}$y=jQuery(window).scrollTop();select(document.body).addClass("staged");this.display="DISPLAY_OPEN"},startLoading:function(){var a="#"+this.id+"-stage";$img=jQuery(a+" .active img");console.log("Will find "+a);$img.one("load",function(b){select(a).removeClass("not-loaded")}).each(function(){this.complete&&$(this).load()})},hide:function(){jQuery("#"+this.id+"-stage").addClass("closed");jQuery(document.body).removeClass("staged");document.getElementById("button-"+this.id).value="view";this.display=
"DISPLAY_CLOSED"},addFrame:function(a){a=new Frame(a);this.frames.push(a)},removeFrame:function(){},getFrameById:function(a){for(i=0;i<this.frames.length;i++)if(frames[i].getId()==a)return frames[i];throw"Slide "+a+" not found.";},getFrame:function(a){return this.frames[a]},aCapt:function(a){jQuery(a).addClass("caption-active")},dCapt:function(a){jQuery(a).removeClass("caption-active")},activate:function(a){if(0>a||a>=this.frames.length)throw"SlideArrayIndexOutOfBoundsException for index "+a;for(i=
0;i<this.frames.length;i++)i==a?this.frames[i].activate():this.frames[i].makeInactive();for(i=0;i<this.captions.length;i++)i==a?this.aCapt(this.captions[i]):this.dCapt(this.captions[i])},toString:function(){return this.id}};