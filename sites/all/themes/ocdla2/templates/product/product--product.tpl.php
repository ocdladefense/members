<?php

/*<cfset checkCustomerLoginForRedirect=True>
	<cfset redirectToLogin=False><!--- set to false, initially --->
	<cfset loginaction="do_nothing">
	

	
<!--
This routine searches for a given item ID #. It finds it in the database and displays
it on a screen with the price and asks for a quantity to put into the shopping cart.
-->
*/

/*
<!--- Make the query to find the ID number of the item --->
<CFQUERY NAME="store" DATASOURCE="#Application.dsn#">
	SELECT *,
	catalog.i AS parent_i,
	Description2,
	If(Locate('-',Item,1),Left(Item,Locate(' -',Item,1)),Item) AS ProdName,
	Truncate(Price,0) AS LittlePrice,
	Truncate(RegularPrice,0) AS LittleRegularPrice
	FROM catalog LEFT JOIN catalog_layouts ON (catalog.i=catalog_layouts.i)
	WHERE catalog.i = #i#
	AND disabled<>1
</CFQUERY>
*/
?>

<!-- run a program to check if the user needs to be logged-in to purchase this product or to initially prompt the user to login before continuing shopping -->
<?php 

/*<cfif checkCustomerLoginForRedirect>
	<CFMODULE template="forceLogin.cfm" mod_product_id=#store.i# mod_parent_i=#store.i#>
</cfif>*/
?>







<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/main-template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<title>Oregon Criminal Defense Lawyers Association - OCDLA - Member Profile</title>
<!-- InstanceBeginEditable name="Metatags" -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="Keywords go here" />
<meta name="Description" content="Description goes here" />

<script type="text/javascript" src="/includes/ocdla.js"></script>
<link href="/stylesheets/layout.css" rel="stylesheet" type="text/css" />
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



			<?php $top_include = file_get_contents('../includes/top-include.htm'); echo $top_include; ?>


	
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
<?php print $left_column ?>

			<!-- InstanceEndEditable -->

</div>

		</div><!-- end left wrapper -->
	
		<div id="center">
			  <div class="content"><!-- InstanceBeginEditable name="MainContent" --> 
 

						<?php 
						print $title;
						?>
						<h4><?php print $product_name ?></h4>
											
						<?php
						print $product_price;?>

<?php print $add_to_cart_form ?>


<?php print $debug ?>
 
<?php print $content ?>
<?php
/*<cfinclude template="../includes/storetoc.cfm">*/
?>






<?php /*
<!-- begin display of quantity and add-to-cart -->
<CFQUERY NAME="Fromcat" DATASOURCE="#Application.dsn#">
	SELECT *, t1.i AS parent_i,
	t2.i AS i,
	If(Locate('-',t2.Item,1),Left(t2.Item,Locate('-',t2.Item,1)),t2.Item) AS ProdName,
	If(Locate('- ',t2.Item,1),Right(t2.Item,Length(t2.Item)-Locate('- ',t2.Item,1)),t2.Item) AS SubName,
	Truncate(t2.Price,0) AS LittlePrice,
	Truncate(t2.RegularPrice,0) AS LittleRegularPrice
	FROM catalog AS t1, catalog AS t2
	WHERE t1.i=#i#
	AND t1.fm_parent_id=t2.fm_child_id AND t1.fm_parent_id IS NOT NULL
	AND t2.disabled<>1
	ORDER BY t2.OrderPriority
</CFQUERY>

<CFIF Fromcat.RecordCount lt 1 or Fromcat.RecordCount gt 18>
	<CFQUERY NAME="Fromcat" DATASOURCE="#Application.dsn#">
		SELECT *,
		i AS parent_i,
		Truncate(Price,0) AS LittlePrice,
		Truncate(RegularPrice,0) AS LittleRegularPrice
		FROM catalog
		WHERE i=#URL.i#
		AND disabled<>1
		ORDER BY OrderPriority
	</CFQUERY>
</CFIF>

*/
?>
		<h3><?php print $product_name ?></h3>
		<p><strong><?php print $edition ?></strong></p>
		

	  	
		<!--- only display the member/non-member prices if there are no options --->
<?php
/*<CFIF num_products eq 1>
if( $has_options ) {
*/
?>

<?php print $member_price ?>
<?php print $non_member_price ?>







<?php
/*
<CFOUTPUT QUERY="Store" GROUP="ID"> 
	
	<!-- ListImages is the name of the query that returns the filenames in the images directory
		and compares each to the image name for this item record retrieved in the store query -->
	<cfdirectory action="list" directory="#ExpandPath('../images/images-products')#" name="ListImages">
	<cfset ListOfImages = "">
	<cfloop query="ListImages">
		<cfset ListOfImages = ListAppend(ListOfImages,ListImages.Name)>
	</cfloop>
	<CFIF #Image# EQ '' or not ListOfImages contains Image>
		<CFSET #PicName#="NOART.jpg">
	<CFELSE>
		<CFSET #PicName#=#image#>
	</CFIF>
*/
?>



	<p><img class="imgRight" src="/images/images-products/<?php print $PicName ?>" />
<?php	
	/*<cfif PicName eq "NOART.jpg">width="200px" height="75px"<cfelse>width="150px" height="192px"</cfif> border="0" alt="Photo" />*/
?>	
	</p>
			  

							<!--- Edition was removed from the cfloop list --->
	<?php /*						<cfloop list="Author_Editor,Description2,Binding" index="thiscolumn"> */ ?>
							



<?php /* credit card icons??
<cfinclude template="footer.cfm"> */ ?>



			
			
			
     <!-- InstanceEndEditable --></div><!-- end content -->
    </div><!-- end center -->
    
    <div id="right">
      <div class="content"><!-- InstanceBeginEditable name="SidebarRight" -->

<?php /*			<cfinclude template="dispcart_mini_newocdla.cfm"> */ ?>


			  <!-- InstanceEndEditable --></div>
    </div>
    
    
  
  </div><!-- end column-wrapper -->
  



<?php print $footer_include ?>

</div><!-- end body wrapper -->
</body>




<?php if( $scripts_footer ) print $scripts_footer ?>


<!-- InstanceEnd --></html>
