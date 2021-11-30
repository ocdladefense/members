<!---

key form fields are: 
    
	"to"        address to mailto
	"from"      address to mail from
	"subject"   mail subject
    "sendto"    web page to send user to after email is sent
    "messagetext" text to send

--->

 <!--- Send mail message --->
<CFMAIL FROM="#FORM.from#" TO="#FORM.to#" SUBJECT="#FORM.subject#">
The following is the contents of a form submitted on #DateFormat(Now())# at #TimeFormat(Now())#:

#messagetext#
</CFMAIL>
<cflocation url="#FORM.sendto#">
