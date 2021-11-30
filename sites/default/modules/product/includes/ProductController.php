<?php

use Clickpdx\Core\Controller\ControllerBase;
use Ocdla\Product;

class ProductController extends ControllerBase
{
	private static $daysBack = 10;
	
	public function __construct($settings)
	{
		$this->settings = $settings;
	}
	
	public function productDetails($productId)
	{
		$product = new \Ocdla\Product($productId);
		$this->addTemplateLocation(
			'sites/default/modules/product/templates'
		);

		return array(
			'#attached' => array(
				'js' => array('/sites/default/modules/product/js/add-to-cart.js'),
				'css' => array('/sites/default/modules/product/css/product.css')
			),
			'#markup' => $this->render('product-add-to-cart', array(
				'themePath'				=> '/sites/all/themes/ocdla2',
				'cartDomain'			=> 'https://www.ocdla.org',
				'productId'				=> $product->i,
				'productName'			=> $product->Item,
				'category'				=> $product->Category,
				'edition'					=> $product->Edition,
				'memberPrice'			=> $product->Price,
				'price'						=> $product->RegularPrice,
				'membersOnly'			=> $product->membersOnly(),
				'product'					=> $product,
				'options'					=> $product->getOptions()
			)),
		);
	}
	
	private function getPageLayout()
	{
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
	}
	
	private function showProductImage()
	{
	/*
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
	
	<p><img class="imgRight" src="/images/images-products/#PicName#" <cfif PicName eq "NOART.jpg">width="200px" height="75px"<cfelse>width="150px" height="192px"</cfif> border="0" alt="Photo" /></p>
	*/
	}
	
	private function showFields()
	{
	/*
		<cfloop list="Author_Editor,Description2,Binding" index="thiscolumn">
			<CFIF evaluate("store.#thiscolumn#") neq "">
				<CFIF #thiscolumn# eq "Author_Editor">
				<p><i>#replace(thiscolumn,'_','/')#:&nbsp;#evaluate("store.#thiscolumn#")#</i></p>
				<CFELSEIF #thiscolumn# eq "Description2">
				#evaluate("store.#thiscolumn#")#
				<CFELSE>
					#replace(thiscolumn,'_','/')#:&nbsp;#evaluate("store.#thiscolumn#")#
				</CFIF>
			</CFIF>
		</cfloop>
		*/
	}
	
	/**
<cfset available=1>
	<cfquery name="getNoNonMembers" datasource="#Application.dsn#">
		SELECT i FROM catalog WHERE NonMemberPurchase = 'no';
	</cfquery>
	<cfset NoNonMembers = "">
	<cfloop query="getNoNonMembers">
		<cfset NoNonMembers = ListAppend(NoNonMembers,"|#getNoNonMembers.i#|",",")>
	</cfloop>

	<CFIF #available# eq 1>
	  <CFSET output_price = RegularPrice>
	  <CFSET regular_price = Price>
	
	
<cfif isdefined('contact_id')>
	<cfset cid=#contact_id#>
<cfelse>
	<cfset cid=0>
</cfif>
	
<cfinclude template="detail_newocdla_controller.cfm">



<!--- run a program to check if the user needs to be logged-in to purchase this product or to initially prompt the user to login before continuing shopping 
Set redirectToLogin = True
<cfset Caller.redirectToLogin=True>
--->
<cfif checkCustomerLoginForRedirect>
	<CFMODULE template="forceLogin.cfm" sessionLookup=#sessionLookup# non_member_purchase=#store.NonMemberPurchase# mod_product_id=#store.i# mod_parent_i=#store.i#>
</cfif>
	
	*/
	
}