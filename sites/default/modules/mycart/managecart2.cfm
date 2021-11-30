










<CFHEADER NAME="Expires" VALUE="Sun, 06 Nov 1994 08:49:37 GMT">

<CFHEADER NAME="Pragma" VALUE="no-cache">

<CFHEADER NAME="cache-control" VALUE="no-cache, no-store, must-revalidate">







<!--- 

This routine is essentially the same as cleancart.

--->







<!--- 

Get rid of everything out of the cart. This is being done after the items

have been transferred to the orders database.

--->


<CFIF IsDefined("actionvalue") and actionvalue eq "delbutton">

	<CFQUERY NAME="cleancart" DATASOURCE="#Application.dsn#">
	
		DELETE FROM cart
		
		WHERE Customer_Id = '#SessionID#' AND 
	
		ItemNumber = '#i#'
	
		
		AND cart.colors = '#colors#'
		AND cart.otherfields = '#otherfields#'
		AND cart.dimensions = '#dimensions#'
		AND cart.totalitemprice = #totalitemprice#
	
	</cfquery>
  
	<CFQUERY NAME="checkcart" DATASOURCE="#Application.dsn#">
	  SELECT * 
	  FROM cart
	  WHERE Customer_ID = '#SessionID#';
	 </cfquery>

</CFIF>



<CFIF IsDefined("actionvalue") and actionvalue eq "upbutton">

<CFSET newquantity = #quantity#>

 <CFIF #newquantity# lte 0>

  <center>

   <font face="#config.standardfontname#" size="+2">

    You've entered a negative or zero quantity. To remove this item or items click 'Remove'.

   </font>

   <form method="POST" action="javascript:history.back()">

    <input type="submit" Name="button" Value="  << Try Again  ">

   </form>

  </center>

 <CFELSE>

  <CFQUERY NAME="updatecart" DATASOURCE="#Application.dsn#">

   UPDATE cart

   SET ItemQuantity = #newquantity#

   WHERE Customer_ID = '#SessionID#' AND 

         ItemNumber = '#i#'

  
		<!---AND cart.colors = '#colors#'
		
		AND cart.dimensions = '#dimensions#'
		
		AND cart.otherfields = '#otherfields#'
		
		AND cart.totalitemprice = #totalitemprice#--->
   </cfquery>

   <!---<CFINCLUDE TEMPLATE="managecart1.cfm">--->

  </cfif>

</CFIF>


		<cfset session.lastpage = "viewcart_newocdla.cfm">
		<cflocation url="viewcart_newocdla.cfm">









