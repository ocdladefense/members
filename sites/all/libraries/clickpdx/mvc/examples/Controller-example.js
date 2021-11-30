/**
 * Functionality to add items to an order.
 *
 **/
(function(window,_null){
	
	var dteOrderController = Application("orderForm").registerController('orderController',new CLICKPDX.MVC.Controller.Form("#orders-order-form"));
	
	dteOrderController.quickview(function(e,prod){
		if(e.prop('data-action') == 'quickview') {
			e.preventDefault();
			try {
				console.log(prod);
				localEvents.QuickView(prod);
			} catch(e) {
				console.log(e);
				document.location.href='/node/'+prod.nid;
			}
			return false;
		}
	});

	dteOrderController.restrictToNumeric('qty[]');
	
	dteOrderController.restrictToAlphaNumeric('itemcode[]');

	dteOrderController.submitOnEnter(false);

	// on submit function that checks the order total
	dteOrderController.on('submit',function(e){
		var app = Application("orderForm");
		var orderView = app.getView('orderView');
		if(orderView.getTotal()<app.minOrder){
			e.preventDefault();
			alert(app.minOrderMsg(orderView.getTotal()));
			return false;
		}
	});

	dteOrderController.on('click',function(e,fieldName,rowId){
		var oData = Application("orderForm").getData();
		switch(e.prop('data-action')){
			case 'remove':
				oData.remove({cid:rowId});
				e.preventDefault();
				return false;
				break;
			case 'add-item':
				oData.add({});
				e.preventDefault();
				return false;
				break;
		}
	});

	dteOrderController.on('change',function(e,fieldName,rowId){
		var oData = Application("orderForm").getData();
		switch(fieldName) {
			case 'price[]':
				oData.updateByCid(rowId, {price: e.target.options[e.target.selectedIndex].value});
				break;
			case 'qty[]':
				oData.updateByCid(rowId, {qty: e.target.value});			
				break;
			case 'itemcode[]':
				oData.updateByCid(rowId, {index_value: e.target.value});					
				break;
		}
		return false;
	});

	dteOrderController.onEnter(function(e){
		if(e.fieldName()=='itemcode[]'){
			this.gotoFieldByName('qty[]');
		}
	});
})(window,null);