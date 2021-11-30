<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main-template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<title>Oregon Criminal Defense Lawyers Association - OCDLA - Member Profile</title>
<!-- InstanceBeginEditable name="Metatags" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="Keywords go here" />
<meta name="Description" content="Description goes here" />

<script type="text/javascript" src="/includes/ocdla.js"></script>
<link href="/stylesheets/layout-2col.css" rel="stylesheet" type="text/css" />
<link href="/profiles/css/profiles.css" rel="stylesheet" type="text/css" />
<!--[if IE 5]>
<style>body {text-align: center;}#wrapper {text-align: left;}.menulist a {float: left; clear: both;}
#column_wrapper {height: 1%;}</style>
<![endif]-->
<!--[if lte IE 7]>
<style>#wrapper, #footer, #masthead, #column_wrapper {zoom: 1;}</style>
<![endif]-->
<link href="/scripts/p7pmm/p7PMMv08.css" rel="stylesheet" type="text/css" media="all" />
<!--<link href="/p7ssm/p7ssm_06.css" rel="stylesheet" type="text/css" media="all" />-->


<script type="text/javascript" src="/scripts/p7ssm/p7SSMscripts.js"></script>
<script type="text/javascript" src="/scripts/p7pmm/p7PMMscripts.js"></script>
<script type="text/javascript" src="/includes/ajax_globals.js"></script>
<script type="text/javascript" src="/includes/ocdla.js"></script>
</head>

<body id="p7bod">
	
	

	
	
	<div id="wrapper">



	<?php print $top_include ?>

	
	<div id="column_wrapper"><!-- tag ends in this file -->
    
    
	
		<div id="left">
	


<?php print $menu ?>


			<p>	
	
						<!--[if lte IE 7]>
						<style>.p7PMMv08, .p7PMMv08 a, .p7PMMv08 ul {height:1%;}.p7PMMv08 li{float:left;clear:both;width:100%;}</style>
						<![endif]-->
						
						<!--[if IE 5.500]>
						<style>.p7PMMv08 {position: relative; z-index: 9999999;}</style>
						<![endif]-->
						
						<!--[if IE 5]>
						<style>.p7PMMv08 a, .p7PMMv08 ul {height: 1%; overflow: visible !important;}</style>
						<![endif]-->
	
			</p>


			<div class="content"><!-- InstanceBeginEditable name="SidebarLeft" -->
			<h3>&nbsp;</h3>
			<h3>&nbsp;</h3>
			<h3>&nbsp;</h3>

			<!-- InstanceEndEditable -->
			
			</div><!-- end content -->




		</div><!-- end left wrapper -->
	
		<div id="center">

						<?php
						
						if( $submenu ) { print $submenu; }
						echo "<h3>$crumbtrail</h3>";//<p>&nbsp;</p>";
						echo $thismenu;

						?>
						
						<div id="errormsg" class="errormsg" >
						<?php if( $error ) print $error ?>
						
						</div>

						<?php 
						print $title;
						?>
						<h4><?php print $product_name ?></h4>
											
						<?php
						print $product_price;?>
						

			  <div class="content"><!-- InstanceBeginEditable name="MainContent" --> 

<?php print $debug ?>
 
<?php print $content ?>


      <!-- InstanceEndEditable --></div><!-- end content -->
    </div><!-- end center -->
    

    
    
  
  </div><!-- end column-wrapper -->
  



<?php print $footer_include ?>

</div><!-- end body wrapper -->
</body>




<?php if( $scripts_footer ) print $scripts_footer ?>


<!-- InstanceEnd --></html>