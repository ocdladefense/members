define([], function(){

	function doSubmitForm(){
		$('#donation-form').submit();
	}



	/*

					<apex:actionFunction action="{!addToCart}" name="addToCart" rerender="errors" status="shoppingCartStatus"
															 oncomplete="ClickpdxCart.addToCartComplete({!responseData},request,event,data); return false;">
							<apex:param id="oppLineItemId" name="oppLineItemId" value="" />
							<apex:param id="clientId" name="clientId" value="" />
							<apex:param id="priceBookEntryId" name="priceBookEntryId" value="" />
							<apex:param id="quantity" name="quantity" value="1" />
							<apex:param id="firstName" name="firstName" value="" />
							<apex:param id="lastName" name="lastName" value="" />
							<apex:param id="email" name="email" value="" />
					</apex:actionFunction>

	*/
	var addToCart = function(oppLineItemId,clientId,priceBookEntryId,quantity,firstName,lastName,email,price,options){

		alert('Great! you added a donation to your cart.');

		return true;
	}
	
	
	
});