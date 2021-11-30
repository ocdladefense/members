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
			<h1><?php print $title ?></h1>
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