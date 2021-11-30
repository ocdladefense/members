(function(window, $){
	var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1 ? true : false;

	var renderAgents = [jQuery.colorbox,window.alert];

	var templateAgents = [_,window.alert];

	var templates = {
		dialog: _.template("<div class='dialog-wrapper'><div class='message'>{{ msg }}</div><div class='dialog-button-wrapper'><input class='dialog-button' type='button' onclick='jQuery.colorbox.close();return false;' value='OK' /><!--<input class='dialog-button' type='button' value='Cancel' />--></div></div>"),
		
		quickview: _.template("<div class='quick-view-wrapper'><div class='quick-view-title'>{{ prod.title }}</div><div class='quick-view-body'><div class='quick-view-image'><img src='{{ prod.images.uc_product_list }}' /></div><div class='quick-view-description'>{{ prod.description }} <br /><span class='quick-view-read-more'><a target='_new' href='/node/{{ prod.nid }}'>More</a></span></div></div><div class='quick-view-button-wrapper'><input class='quick-view-button' type='button' onclick='jQuery.colorbox.close();return false;' value='Done' /></div></div>"),
	};

	var localEvents = {
		dialog: function(msg) {
			jQuery.colorbox({
				html: templates.dialog({msg: msg}),
				transition: "none",
				opacity: 0.25,
				close: '',
				overlayClose: false,
				escKey: false,
				closeButton: false,
			});
		},
		QuickView: function(prod) {
			jQuery.colorbox({
				html: templates.quickview({prod: prod}),
				transition: "none",
				opacity: 0.25,
				close: '',
				overlayClose: false,
				escKey: false,
				closeButton: false,
			});
		},
		router: function(type, action, data) {
			switch(type) {
				case 'cart':
					if(action == 'add') {
						var img = document.createElement('img');
						img.setAttribute('src','/sites/default/modules/lists/cart_list/cart-added.png');
						img.setAttribute('style','display:none; position:absolute; left:80px; bottom:10px;');
						img.setAttribute('width','75');
						data.container.append(img);
						$(img).fadeIn();
						console.log(data);
						cartWidget.update(data.response[1]);
					}
					break;
					
				case 'favorites':
					if(action == 'add' || action == 'remove') {
						var count = data[0].total_items;
						jQuery('.view-favorites-count').html(count);
						if( count == 0 ) {
							title = 'No products here.';
						}
						else if( count == 1 ) {
							title = 'One product here.';
						}
						else title = count+' products in your favorites list.';
						jQuery('.favorites-list-trigger').attr('title',title);
					}
					break;
			}
		},
	};
	window.localEvents = localEvents;
})(window, jQuery);