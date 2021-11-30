(function(window){
	function Browser(){
		
	}
	function Environment(){
		this.userAgent=navigator.userAgent;
	}
	Browser.prototype=Environment.prototype = {
		mobile:function(browser){
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
				return true;
			}
			return false;
		},
		browser:this.userAgent,
		userAgent:function(agent){
			if(agent){this.userAgent=agent;}
			else return this.userAgent;
		},
		isLikePhone:function(){
		
		},
		isLikeTablet:function(){
		
		}
	};
	Browser.prototype.declareMobile=function(){
		document.body.setAttribute('class',document.body.getAttribute('class')+' device-phone');
	};
	window.Environment = Environment;
	window.Browser = Browser;
})(window);