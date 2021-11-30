<!---

key form fields are: 
    
	"to"        address to mailto
	"from"      address to mail from
	"subject"   mail subject
    "sendto"    web page to send user to after email is sent


--->

<!--- Initialize variables --->
<CFSET proceed = "Yes">
<CFSET error_message = "">
<CFSET CRLF = Chr(13) & Chr(10)>

<!--- Check that fieldnames exists --->
<CFIF IsDefined("FORM.fieldnames") IS "No">>
 <CFSET proceed = "No">
 <CFSET error_message = "No form fields present!">
</CFIF>


<!--- If okay to go, process it --->
<CFIF proceed>

 <!--- Create variable for message body --->
 <CFSET message_body = "">

 <!--- Create empty list of processed variables --->
 <CFSET fieldnames_processed = "">
 
 <!--- Loop through fieldnames --->
 <CFLOOP INDEX="form_element" LIST="#FORM.fieldnames#">
 
  <!--- Try to find current element in list --->
  <CFIF ListFind(fieldnames_processed, form_element) IS 0>
  
   <!--- Make fully qualified copy of it (to prevent acessing the wrong field type) --->
   <CFSET form_element_qualified = "FORM." & form_element>
   
  <cfif (#form_element_qualified# neq "FORM.to") AND (#form_element_qualified# neq "FORM.from") AND (#form_element_qualified# neq "FORM.subject") AND (#form_element_qualified# neq "FORM.sendto")>

   <!--- Append it to message body --->
   <CFSET message_body = message_body & form_element & ": " & Evaluate(form_element_qualified) & CRLF>
  </cfif>
   <!--- And add it to the processed list --->
   <CFSET fieldnames_processed = ListAppend(fieldnames_processed, form_element)>
     
  </CFIF>
  
 </CFLOOP> <!--- End of loop through fields --->
 
 <!--- Send mail message --->
<CFMAIL FROM="#FORM.from#" TO="#FORM.to#" SUBJECT="#FORM.subject#">
The following is the contents of a form submitted on #DateFormat(Now())# at #TimeFormat(Now())#:

#message_body#
</CFMAIL>
<cflocation url="#FORM.sendto#">
<CFELSE>

 <!--- Error occurred --->
 <CFOUTPUT><H1>#error_message#</H1></CFOUTPUT>
 <CFABORT>
 
</CFIF>
