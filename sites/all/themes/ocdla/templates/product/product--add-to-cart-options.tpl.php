<?php


?>

		<form action="/cart/product_add.cfm" method="post" onsubmit="return checkForm();">
		
		
		
		<input type="hidden" name="parent_i" value="<?php print $parent_i ?>" />
		
					
					
	<!-- otherwise, display product options -->

		<table width="500" border="0" cellspacing="4px" cellpadding="0">
			<tr>
				<td align="left" valign="top"><strong>QTY</strong></td>
				<td align="left" valign="top"><strong>MEDIA</strong></td>
				<td valign="top"><strong>Member</strong></td>
				<td valign="top"><strong>Non-member</strong></td>
			</tr>
		<?php $counter=1; ?>

	<?php foreach( $vars->db_product AS $option ) { ?>

			<tr>
					<?php /*	<CFIF LittlePrice neq LittleRegularPrice>*/ ?>
								<td>
									<input name="itemid" type="hidden" value="<?php print $i ?>" /><input name="quantity" type="text" size="2"/>
								</td>
								<td valign="middle">
									<?php print $option["Item"] ?>
								</td>
								<td valign="middle" align="center">
									$<?php print $option["Price"] ?></td><td valign="middle" align="center"><?php /*<cfif NoNonMembers contains "|#i#|"> N/A<cfelse>*/?> $<?php print $option["RegularPrice"] ?>
								</td>
					<?php /*	<CFELSE>
								<td>
									<input name="itemid" type="hidden" value="<?php print $i ?>" />
									<input name="quantity" type="text" size="2"/>
								</td>
								<td valign="middle">
									#SubName#
								</td>
								<td valign="middle" align="center">
									$#LittlePrice#
									</td>
								<td valign="middle" align="center">
									<cfif NoNonMembers contains "|#i#|"> N/A<cfelse>$#LittleRegularPrice#</cfif>
								</td>
						</CFIF>*/ ?>
			</tr>
						<?php $counter++; ?>
<?php } ?>
		</table>

	
				<input type="image" src="/images/images-buttons/icon-addtocart.gif" style="margin:0px; padding:0px; vertical-align:bottom;" width="79" height="20" />

				<a href="/cart/createmore.cfm" style="margin:0px; padding:0px; border:0px; vertical-align:bottom;">
					<img src="/images/images-buttons/icon-continueshopping.gif" alt="Continue Shopping" style="vertical-align:bottom; border:none;padding:0px;margin:0px;" width="111" height="20" />
				</a>
				<a href="/cart/viewcart_newocdla.cfm" style="margin:0px; padding:0px; border:0px; vertical-align:bottom;">
					<img src="/images/images-buttons/icon-viewcart.gif" alt="View Cart" style="vertical-align:bottom; border:none;" width="85" height="20" />
				</a>
				
				
				



</form>