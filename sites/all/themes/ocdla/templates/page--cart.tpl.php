<div id="wrapper">


	<?php print $top_include ?>

	<div id="column_wrapper"><!-- tag ends in this file -->

		<div id="left">
			<?php print $menu ?>
			<p>&nbsp;</p>

			<div class="content">
				<!-- InstanceBeginEditable name="SidebarLeft" -->
				<h3>&nbsp;</h3>
				<h3>&nbsp;</h3>
				<h3>&nbsp;</h3>
	
				<!-- InstanceEndEditable -->
				
			</div><!-- end content -->

		</div><!-- end left wrapper -->
	
	<div id="center">
		<div class="content"><!-- InstanceBeginEditable name="MainContent" --> 
			<?php if( $submenu ) { print $submenu; } ?>
			<h3><?php print $title ?></h3>
			<?php
			

			if( $breadcrumb ) { print $breadcrumb; }
			if( $messages ):
			?>
				<div class='msg'>
					<?php print $messages; ?>				
				</div>			
			<?php
				endif;
			?>
			<div class="node">
				<?php
					if( $content ) print $content;
					if( $page['content'] ) print $page['content'];
				?>
			</div>


			<a title="Continue Shopping" href="/cart/createmore.cfm">	
				<img src="/images/images-buttons/icon-continueshopping.jpg" alt="shop" width="118" height="30" style="border:none;" />
			</a>	

			
			
			<a title="View Cart" href="/cart/viewcart_newocdla.cfm">
				<img src="/images/images-buttons/icon-viewcart.jpg" alt="view" width="83" height="30" style="border:none;" />
			</a>


			
			<a title="Remove All Items and Start Again" href="/cart/emptycart.cfm" >
				<img src="/images/images-buttons/icon-emptycart.jpg" width="77" height="30" alt="Empty Cart" />
			</a>

			
			<a title="Begin Check Out" href="/cart/checkout/custinfo_newocdla.cfm">
				<img src="/images/images-buttons/icon-continuecheckout.jpg" width="104" height="20" alt="begin checkout" />
			</a>	

			<div style="text-align:center; margin:0px auto; margin-top:30px;">
				<img src="/images/images-icons/visa1.gif"  alt="VISA" width="40" height="26" /> 
			
				<img src="/images/images-icons/master1.gif"  alt="MasterCard" width="40" height="26" /> 
			
				<img src="/images/images-icons/amex1.gif"  alt="American Express" width="40" height="26" /> 
			
				<img src="/images/images-icons/discover1.gif"  alt="Discover" width="40" height="26" /> 
				
				<a href="/cart/checkout/privacy_statement.shtml">
					<img src="/images/images-icons/secure.gif" width="90" height="26" alt="Privacy Policy" />
				</a>
				
				<!--  GeoTrust QuickSSL [tm] Smart Icon tag. Do not edit. 
		
				<script type="text/javascript" src="//smarticon.geotrust.com/si.js"></script>
				-->
				<!-- end  GeoTrust Smart Icon tag --> 
			</div>

      <!-- InstanceEndEditable -->
    	</div><!-- end content -->
    </div><!-- end center -->
    
    <div id="right">
      	<div class="content"><!-- InstanceBeginEditable name="SidebarRight" -->
	
			<h4>Online Membership Directory</h4>
	
			<p>
			You may download a current membership directory  <a href="/membership/memberdirectory_newocdla.php" title="OCDLA Membership Directory">here</a>.
			</p>
			<p>Many sections are updated on a daily basis, including:</p>
			<p>&bull; members by last name<br />
				&bull; members by city<br />
				&bull; members areas of interest<br />
				&bull; Public Defense / Aggravated Murder Contracts
			</p>
			<p>You can also find these lists, updated every September, in the directory:<br />
				&bull; Public Defender Boards<br />
				&bull; Office of Public Defense Services Staff<br />
				&bull; Federal Public Defender Offices
			</p>
			<h4>&nbsp;</h4>
			<h5>&nbsp;</h5>
		  <!-- InstanceEndEditable -->
		</div>
	</div><!-- end #right -->
		
		
	</div><!-- end column-wrapper -->


<?php print $footer_include ?>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
  var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-31754445-1']);
_gaq.push(['_setDomainName', 'ocdla.org']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
//--><!]]>
</script>
</div><!-- end body wrapper -->