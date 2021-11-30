<CFSET CRLF = Chr(13) & Chr(10)>

<CFset #SeminarTitle# = "OCDLA - Succesfully Defending Drug Cases">
<CFset #SeminarWhen# = "Sunday and Monday, November 7-8, 1999">
<CFset #SeminarWhere# = "Puerto Vallarta, Mexico">

<CFif (#ParameterExists(name)# is "No") AND (#ParameterExists(phone)# is "No") AND (#ParameterExists(address)# is "No") AND (#ParameterExists(city)# is "No") AND (#ParameterExists(state)# is "No") AND (#ParameterExists(zip)# is "No") AND (#ParameterExists(email)# is "No") AND (#ParameterExists(barnumber)# is "No") AND (#ParameterExists(ccnumber)# is "No") AND (#ParameterExists(ccexpdate)# is "No") AND (#ParameterExists(nameoncard)# is "No") AND (#ParameterExists(attend)# is "No") AND (#ParameterExists(scholarship)# is "No") AND (#ParameterExists(ocdlamembership)# is "No")>
  <CFlocation URL="#CGI.SCRIPT_NAME#?UserID=#UserID#&name=&phone=&address=&city=&state=&zip=&email=&barnumber=&ccnumber=&ccexpdate=&nameoncard=&attend=&memberof=&memberother=&new=1">
</CFif>

<CFset #ErrorText# = "">
<CFif #Len(name)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your Full Name<br>">
</CFif>
<CFif #Len(phone)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your Phone Number<br>">
</CFif>
<CFif #Len(address)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your Address<br>">
</CFif>
<CFif #Len(city)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your City<br>">
</CFif>
<CFif #Len(state)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your State<br>">
</CFif>
<CFif #Len(zip)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your Zipcode<br>">
</CFif>
<CFif #Len(email)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your Email<br>">
</CFif>
<CFif #Len(barnumber)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your Bar Number<br>">
</CFif>
<CFif #Len(ccnumber)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your Credit Card Number<br>">
</CFif>
<CFif #Len(ccexpdate)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your Credit Card Expiration Date<br>">
</CFif>
<CFif #Len(nameoncard)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "The Name on Your Credit Card">
</CFif>


<html>
<head>
<title><CFoutput>#SeminarTitle#</CFoutput></title>
</head>

<BODY BGCOLOR=E1CFB9 TEXT="000000" LINK=326432 ALINK=600000 VLINK=600000>
<CENTER>
<TABLE width=400>
<TR>
<TD VALIGN=TOP HEIGHT=100>
<CENTER>
<FONT SIZE=+2><CFoutput>#SeminarTitle#</CFoutput></FONT><BR>
<FONT SIZE=+1><CFoutput>#SeminarWhen#</CFoutput></FONT><BR>
<FONT SIZE=+1><CFoutput>#SeminarWhere#</CFoutput></FONT><P>
</CENTER>
</TD>
</TR>
<TR>
<TD>


<CFif (#Len(ErrorText)# neq 0) or (#ParameterExists(Edit)# is "Yes") or (#ParameterExists(New)# is "Yes")>
If a field is not applicable, please place &quot;n/a&quot; in the box.</CENTER>

<CFoutput>

<form action="#CGI.SCRIPT_NAME#" method="POST">

<CFif #ParameterExists(New)# is "No">
  <b>The following required fields on the order form have been left blank:<P> #ErrorText#</B><p>
</CFif>




<input type="hidden" name="UserID" value="#UserID#">
<TABLE><TR>
<TD>
Name<BR>
<input type="text" size="35" name="name" value="#name#">
</TD>
<TD>
Phone<BR>
<input type="text" size="35" name="phone" value="#phone#">
</TD>
</TR>
</TABLE>

<TABLE><TR>

<TD>
Address<BR>
<input type="text" size="75" name="address" value="#address#">
</TD>
</TR>
</TABLE>

<TABLE><TR>
<TD>
City<BR>
<input type="text" size="35" name="city" value="#city#">
</TD>
<TD>
State<BR>
<input type="text" size="10" name="state" value="#state#">
</TD>
<TD>
Zip<BR>
<input type="text" size="20" name="zip" value="#zip#">
</TD>
</TR>
</TABLE>

<TABLE><TR>
<TD>
Email Address<BR>
<input type="text" size="35" name="email" value="#email#">
</TD>
</TR>
</TABLE>

<TABLE><TR>
<TD>
Bar ##<BR>
<input type="text" size="35" name="barnumber" value="#barnumber#">
</TD>
</TR>
</TABLE>

<TABLE><TR>
<TD>
Visa/MasterCard Number<BR>
<input type="text" size="35" name="ccnumber" value="#ccnumber#">
</TD>
<TD>
Exp. Date<BR>
<input type="text" size="10" name="ccexpdate" value="#ccexpdate#">
</TD>

</TR>
</TABLE>

<TABLE><TR>
<TD>
Name On Card<BR>
<input type="text" size="35" name="nameoncard" value="#nameoncard#">
</TD>
</TR>
</TABLE>

<P>
<TABLE>
<TR>
  <TD VALIGN=TOP>I am a member of:</TD>
  <TD VALIGN=TOP><input type="radio" name="memberof" value="OCDLA" <CFif (#memberof# eq "OCDLA") OR (#memberof# eq "")>checked</CFif>> OCDLA</TD>
  <TD VALIGN=TOP><input type="radio" name="memberof" value="WACDL" <CFif #memberof# eq "WACDL">checked</CFif>> WACDL</TD>
  <TD VALIGN=TOP><input type="radio" name="memberof" value="CACJ" <CFif #memberof# eq "CACJ">checked</CFif>> CACJ</TD>
  <TD></TD>
</TR>
<TR>
  <TD></TD>
  <TD VALIGN=TOP><input type="radio" name="memberof" value="WAACJ" <CFif #memberof# eq "WAACJ">checked</CFif>> WAACJ</TD>
  <TD VALIGN=TOP><input type="radio" name="memberof" value="IACJ" <CFif #memberof# eq "IACJ">checked</CFif>> IACJ</TD>
  <TD VALIGN=TOP><input type="radio" name="memberof" value="AACJ" <CFif #memberof# eq "AACJ">checked</CFif>> AACJ</TD>
  <TD></TD>
</TR>
<TR>
  <TD></TD>
  <TD VALIGN=TOP><input type="radio" name="memberof" value="NACJ" <CFif #memberof# eq "NACJ">checked</CFif>> NACJ</TD>
  <TD VALIGN=TOP><input type="radio" name="memberof" value="NACDL" <CFif #memberof# eq "NACDL">checked</CFif>> NACDL</TD>
  <TD VALIGN=TOP COLSPAN=2><input type="radio" name="memberof" value="Other" <CFif #memberof# eq "Other">checked</CFif>> Other <input type="text" name="memberother" value="#memberother#" size=20></TD>
<TR>
</TABLE>

<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Registration</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="attend" <CFif (#attend# eq "attend") OR (#attend# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
$275 Registration which includes admission to both days of the conference to be held at the
La Jolla De Mismaloya, writen course material, and continental breakfast. The conference
will take place on Sunday and Monday morning. Each speaker's presentation is scheduled
for about one hour.</TD></TR>

<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="cannotattend" <CFif #attend# eq "cannotattend">checked</CFif>>
</TD>
<TD VALIGN=TOP>
I cannot attend. Please send me information about written materials and audio tapes.</TD></TR>
</TABLE>



<P>
<br>

<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Refund</FONT>
</TD>
</TR>
<TR><TD>
If you register and then cannot attend, a refund of the registration fee, less $25 per person,
will be made if requested by Septermber 15, 1999. If you cancel after September 15, you will
receive the written materials and audiotapes. Substitutions may be made after September 15 with
no penalty.
</TD></TR>
</TABLE>

<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Questions about the Conference or Conference Registration?</FONT>
</TD>
</TR>
<TR><TD>
Call John Potter at the OCDLA office, (541)686-8716 or fax: (541)686-2319, or email:
jpotter@ocdla.org or info@ocdla.org.
</TD></TR>
</TABLE>

<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Questions about Travel or Travel Registration?</FONT>
</TD>
</TR>
<TR><TD>
Call Beatty Group Travel, (503)644-3340, or fax: (503)644-2219, or email: tomtravel@aol.com.
</TD></TR>
</TABLE>

<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Money a Problem?</FONT>
</TD>
</TR>
<TR><TD>
Call OCDLA by Wednesday, September 15 for partial tuition scholarships, reduced lodging options,
payment plans, or other creative financing.
</TD></TR>
</TABLE>


        <P>

<HR><P>


    <input type="submit" value=" Process My Registration ">
	<input type="reset" value=" Clear Form "><br>
    <br>
	<A HREF="http://www.ocdla.org/seminars.cfm?UserID=#UserID#">Return To Seminar Info</A>
</form>
</CFoutput>



<CFelse>
<!--- ok no errors, show summary --->




Please review the following information about<BR>
your registration for accuracy, then click the<BR>
submit button at the bottom of the page.<br>

<CFoutput>

<CFset #URLbuf# = "&name=#URLEncodedFormat(name)#&phone=#URLEncodedFormat(phone)#&address=#URLEncodedFormat(address)#&city=#URLEncodedFormat(city)#&state=#URLEncodedFormat(state)#&zip=#URLEncodedFormat(zip)#&email=#URLEncodedFormat(email)#&barnumber=#URLEncodedFormat(barnumber)#&ccnumber=#URLEncodedFormat(ccnumber)#&ccexpdate=#URLEncodedFormat(ccexpdate)#&nameoncard=#URLEncodedFormat(nameoncard)#&attend=#URLEncodedFormat(attend)#&memberof=#URLEncodedFormat(memberof)#&memberother=#URLEncodedFormat(memberother)#">
If you would like to make changes, please click <a href="#CGI.SCRIPT_NAME#?UserID=#UserID#&Edit=1&#URLbuf#">here</a>.<P>

<b>Full Name: </b>#name#<BR>
<b>Bar Number: </b>#barnumber#<BR>
<b>Address: </b>#address#<BR>
<b>City, State Zip: </b>#city#, #state# #zip#<P>

<b>Phone: </b>#phone#<BR>
<b>E-Mail: </b>#email#<P>

<b>Credit Card Number: </b>#ccnumber#<BR>
<b>Expiration Date: </b>#ccexpdate#<BR>
<b>Name Of Card Holder: </b>#nameoncard#<P>
<b>Member of: </b><CFif #memberof# eq "Other">#memberother#<CFelse>#memberof#</CFif>
<P>

<TABLE width=250>
<TR><TD VALIGN=BOTTOM COLSPAN=2 HEIGHT=35><HR NOSHADE></TD></TR>
<TR><TD COLSPAN=2><B>Itemized Invoice</B></TD></TR>
<TR><TD VALIGN=TOP COLSPAN=2 HEIGHT=15><HR NOSHADE></TD></TR>

<CFset #TotalAmount# = 0>


<!------------------ create message text ---------------------------->

<CFset #MessageText# = "">
<CFset #MessageText# = #MessageText# & #CRLF# & "UserNumber: #UserNumber#">
<CFset #MessageText# = #MessageText# & #CRLF# & "Name: #name#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "Bar Number: #barnumber#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "Address: #address#">
<CFset #MessageText# = #MessageText# & #CRLF# & "City: #city#">
<CFset #MessageText# = #MessageText# & #CRLF# & "State: #state#">
<CFset #MessageText# = #MessageText# & #CRLF# & "Zip: #zip#">
<CFset #MessageText# = #MessageText# & #CRLF# & "Phone: #phone#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "Email: #email#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "CCNumber: #ccnumber#">
<CFset #MessageText# = #MessageText# & #CRLF# & "CCExpDate: #ccexpdate#">
<CFset #MessageText# = #MessageText# & #CRLF# & "NameOnCard: #nameoncard#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "MemberOf: #memberof#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "MemberOther: #memberother#" & #CRLF#>

<CFset #MessageText# = #MessageText# & #CRLF# & "- Invoice -">

<CFif #attend# eq "attend">
    <CFset #TotalAmount# = #TotalAmount# + 275>
    <tr><td>Registration</td><td align=right>$275</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: $225">
<CFelseif #attend# eq "cannotattend">
    <tr><td>Registration: cannot attend</td><td align=right>$0</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: cannot attend $0">
</CFif>

















<tr><td colspan=2><hr></td></tr>
<tr><td>Total:</td><td align=right>#DollarFormat(TotalAmount)#</td></tr>
<CFset #MessageText# = #MessageText# & #CRLF# & #CRLF# & "Total: #DollarFormat(TotalAmount)#">

</table>
<Form ACTION="mailform2.cfm" METHOD=POST>

<!------------------ end create message text ---------------------------->

<input type="hidden" name="MessageText" value="#MessageText#">
<input type="hidden" name="to" value="info@ocdla.org">
<input type="hidden" name="from" value="ocdlaOnline-Seminar-Registration@ocdla.org">
<input type="hidden" name="subject" value="#SeminarTitle#">
<input type="hidden" name="sendto" value="thanks.cfm?UserID=#UserID#">



<input type="submit" value=" Process My Registration ">
</ForM>

</CFoutput>


</CFif>
</TD></TR></TABLE>



</body>
</html>
