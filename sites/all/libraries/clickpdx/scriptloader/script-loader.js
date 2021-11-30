

(function(window,undefined,$){

	var attachNodes = function(data){
		// console.log(data[currentResourcePath]);
		// alert(data);
		if(!data[currentResourcePath]) return;
		var head = document.getElementsByTagName('head')[0];
		if(data[currentResourcePath]['css']) {
			data[currentResourcePath]['css'].forEach(function(item){
				head.appendChild(createCssNode(item));
			});
		}
		if(data[currentResourcePath]['js']) {
			data[currentResourcePath]['js'].forEach(function(item){
				head.appendChild(createJsNode(item));
			});
		}
	};

	var attachNodes = function(data){
		// console.log(data[currentResourcePath]);
		// alert(data);
		if(!data[currentResourcePath]) return;
		var head = document.getElementsByTagName('head')[0];
		if(data[currentResourcePath]['css']) {
			data[currentResourcePath]['css'].forEach(function(item){
				head.appendChild(createCssNode(item));
			});
		}
		if(data[currentResourcePath]['js']) {
			data[currentResourcePath]['js'].forEach(function(item){
				head.appendChild(createJsNode(item));
			});
		}
	};
	
	var createCssNode = function(url){
		// console.log('Creating css node for '+url);
		var cssNode = document.createElement('link');
		cssNode.type = 'text/css';
		cssNode.rel = 'stylesheet';
		cssNode.href = baseUrl + "/css/"+url;
		return cssNode;
	};
	
	var createJsNode = function(url){
		// console.log('Creating css node for '+url);
		var jsNode = document.createElement('script');
		jsNode.type = 'text/javascript';
		if(url.indexOf('http')===0) {
			jsNode.src = url;
		} else {
			jsNode.src = baseUrl + "/js/"+url;
		}
		return jsNode;
	};
	
	var Dom = {
		attachResourceNodesAsync: attachResourceNodesAsync,
		attachNodes: attachNodes
	};
    
})(window,undefined,jQuery);