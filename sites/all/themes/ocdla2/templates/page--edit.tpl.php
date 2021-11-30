<div id="wrapper">
<div id="toolbar" style="font-family:Arial; font-size:22px; position:fixed; top:0px; left:0px; width:100%; height:35px; padding:6px; background-color:#bbb; color:333;opacity:0.9;">
	<a style="text-transform:uppercase;" href="#" onclick="saveData();return false;">save</a>
<div id="status" class="message" style="width:10%;height:auto;font-size:inherit;display:none;float:right;margin-right:100px;">
	
</div>
</div>

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

</div><!-- end body wrapper -->