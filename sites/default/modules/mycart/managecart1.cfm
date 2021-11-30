










<CFHEADER NAME="Expires" VALUE="Sun, 06 Nov 1994 08:49:37 GMT">

<CFHEADER NAME="Pragma" VALUE="no-cache">

<CFHEADER NAME="cache-control" VALUE="no-cache, no-store, must-revalidate">


















<!--- 

Clear everything from the cart that matches this persons session ID. No harm done,

nothing added to the orders DB yet.

--->



<CFSET quantity = 0>

<CFSET itemprice = 0>

<CFSET totalprice = 0>

<CFSET runningtotal = 0>



<!--- Show the shopping cart and ask if you want to go on. --->



<CFQUERY NAME="cartlist" DATASOURCE="#config.datasource#">

	SELECT *

	FROM cart, catalog

	WHERE ( cart.ItemNumber = catalog.ID)

	

	AND cart.Customer_Id = '#SessionID#'

	ORDER BY ItemNumber

</cfquery>



<CFINCLUDE TEMPLATE="cartform.cfm">



<CENTER>


<cfoutput>

 <cfif not IsDefined("AfID")>



</cfif>  

  &nbsp;&nbsp;

 

  &nbsp;&nbsp;



</cfoutput> 

</center>


	<cfinclude template="#adminmapping#pl_cart_footer.cfm">

