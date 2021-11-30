

document.addEventListener('load',function(){
var root = document.getElementById('ams-important-links');
var template = root.children[0];
return template.cloneNode(true);
});



var importantText = function(node,text){
	node.innerHtml = text;
	return node;
};








var newMessage = template.cloneNode(true);
newMessage = importantText(newMessage,'Hello World');
newMessage = root.appendChild(newMessage);
newMessage.innerText = 'foobar';

/*

// alert('hello world!');
var l=function(m){console.log(m);};
var foo = {};
function bar(){
	var i = 'I am private to the scope of this function.';
}
// Use of special prototype property
foo.prototype = {
	me: 'too',
	you: 2,
	followMe: function(){alert('follow me!');},
	constructor: bar
};

// Here, hasJobBehavior is a a factory function that applies the methods of 
// behaviorTemplate as methods of the passed-in obj.
var hasJobBehavior=function(obj,behaviorTemplate){
	var internalObj = {
		someConstant:'bar',
		anotherConstant:'pow!'
	}; // Out of scope
	internalObj.fn = fn;
	obj['foobar'] = fn.bind(internalObj);
	return obj;
};
hasJobBehavior(foo,function(){alert(this.anotherConstant);});
foo.foobar();
void 0;
l(foo);
l(foo.constructor);
l(foo.prototype);
// l(new foo);
l(typeof undefined);
l(typeof window);

*/