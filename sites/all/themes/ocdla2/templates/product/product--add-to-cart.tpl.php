<form action="/cart/product_add.cfm" method="post" onsubmit="return checkForm();">
		
		
		
		<input type="hidden" name="parent_i" value="<?php print $parent_i ?>" />
		
		
					<input type="hidden" name="itemid" value="<?php print $i ?>" />
					

							Quantity:&nbsp;<input type="text" name="quantity" value="1" size="2" />

		
						
				<input type="image" src="/images/images-buttons/icon-addtocart.gif" style="margin:0px; padding:0px; vertical-align:bottom;" width="79" height="20" />

				<a href="/cart/createmore.cfm" style="margin:0px; padding:0px; border:0px; vertical-align:bottom;">
					<img src="/images/images-buttons/icon-continueshopping.gif" alt="Continue Shopping" style="vertical-align:bottom; border:none;padding:0px;margin:0px;" width="111" height="20"/>
				</a>
				<a href="/cart/viewcart_newocdla.cfm" style="margin:0px; padding:0px; border:0px; vertical-align:bottom;">
					<img src="/images/images-buttons/icon-viewcart.gif" alt="View Cart" style="vertical-align:bottom; border:none;" width="85" height="20"/>
				</a>
				
				
				



</form>
  
