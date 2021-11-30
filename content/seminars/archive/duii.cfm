<CFif #ParameterExists(new)# is "Yes">
  <CFset #new# = 0>
<CFelse>
  <CFset #new# = 1>
</CFif>

<CFSET CRLF = Chr(13) & Chr(10)>

<CFset #SpecialDate# = #ParseDateTime("September, 4, 2001")#>
<CFif #DateCompare(SpecialDate, Now())# eq 1>
  <CFset #Special# = 1>
<CFelse>
  <CFset #Special# = 0>
</CFif>


<CFset #SeminarName# = "DUII and New Legislation Seminar">


<CFparam Name="name" Default="">
<CFparam Name="phone" Default="">
<CFparam Name="address" Default="">
<CFparam Name="city" Default="">
<CFparam Name="state" Default="">
<CFparam Name="zip" Default="">
<CFparam Name="email" Default="">
<CFparam Name="ccnumber" Default="">
<CFparam Name="ccexpdate" Default="">
<CFparam Name="nameoncard" Default="">
<CFparam Name="attend" Default="">
<CFparam Name="ocdlamembership" Default="">
<CFparam Name="badgename" Default="">
<CFparam Name="OSBOBI" Default="">


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
<CFif #Len(OSBOBI)# eq 0>
  <CFset #ErrorText# = #ErrorText# & "Your OSB/OBI Number<br>">
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
<title>OCDLA Seminar - <CFoutput>#SeminarName#</CFoutput></title>
</head>

<BODY BGCOLOR=E1CFB9 TEXT="000000" LINK=326432 ALINK=600000 VLINK=600000>
<CENTER>
<TABLE width=400>
<TR>
<TD VALIGN=TOP HEIGHT=100>
<CENTER>
<FONT SIZE=+2><CFoutput>#SeminarName#</CFoutput></FONT><BR>
<FONT SIZE=+1>September 14-15, 2001</FONT><BR>
<FONT SIZE=+1>Best Western Agate Beach Inn, Newport (formerly Holiday Inn)</FONT><BR>
</CENTER>
</TD>
</TR>
<TR>
<TD>


<CFif (#Len(ErrorText)# neq 0) or (#ParameterExists(Edit)# is "Yes") or (#New# eq 1)>
If a field is not applicable, please place &quot;n/a&quot; in the box.</CENTER>

<CFoutput>

<form action="#CGI.SCRIPT_NAME#?new=#new#" method="POST">

<CFif #New# eq 0>
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
<TR><TD colspan=2>First name as you would like it to appear on your badge<br>
<input type="text" size="35" name="badgename" value="#badgename#">

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
OSB/OBI ##<BR>
<input type="text" size="35" name="OSBOBI" value="#OSBOBI#">
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
<TD align=right valign=bottom>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.verisign.com"><img src="verisign.gif" border=0></a>
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
<TD VALIGN=TOP COLSPAN=2>
Note: This program is open only to OCDLA members, other defense lawyers and those professionals
and law students directly involved in the defense function.
<p>
<FONT SIZE=+1>Registration</FONT><br>
Registration fee includes:
admission to both days of the seminar, seminar written material which includes the
<i>2001 Legislative Analysis of Criminal and Juvenile Laws</i>, admission to the Friday evening
Reception and BAC Test, continental breakfast and lunch on Saturday, and refreshments at
the breaks.
<p>
<b>Note:</b> All registration is <b>$15 less</b> if sent by #DateFormat(SpecialDate, "mmmm d")#.
</TD></TR></TABLE>



<P>
<br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1><b>All Inclusive Seminar Package</b></FONT><br>
(includes seminar registration and the <i>2001 DUII Trial Notebook</i>)
<P><br>
</TABLE>

<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Members</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="ocdlamemberlawyer" <CFif (#attend# eq "ocdlamemberlawyer") OR (#attend# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
$310 pre-registration (<b>$295</b> before #DateFormat(SpecialDate, "mmmm d")#) for lawyers.</TD></TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="ocdlamembernonlawyer" <CFif #attend# eq "ocdlamembernonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$255 pre-registration (<b>$240</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonlawyers.</TD></TR>
</TABLE>

<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Nonmembers</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="nonmemberlawyer" <CFif #attend# eq "nonmemberlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$410 (<b>$395</b> before #DateFormat(SpecialDate, "mmmm d")#) for lawyers.</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="nonmembernonlawyer" <CFif #attend# eq "nonmembernonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$345 (<b>$330</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonlawyers.</TR>


</TABLE>



<P>

<br><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1><b>Basic Seminar Package</b></FONT><br>
(includes seminar registration but does not include the <i>2001 DUII Trial Notebook</i>)
<P><br>
</TABLE>

<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Members</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="basicocdlamemberlawyer" <CFif #attend# eq "basicocdlamemberlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$190 pre-registration (<b>$175</b> before #DateFormat(SpecialDate, "mmmm d")#) for lawyers.</TD></TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="basicocdlamembernonlawyer" <CFif #attend# eq "basicocdlamembernonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$135 pre-registration (<b>$120</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonlawyers.</TD></TR>
</TABLE>

<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Nonmembers</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="basicnonmemberlawyer" <CFif #attend# eq "basicnonmemberlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$240 (<b>$225</b> before #DateFormat(SpecialDate, "mmmm d")#) for lawyers.</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="basicnonmembernonlawyer" <CFif #attend# eq "basicnonmembernonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$175 (<b>$160</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonlawyers.</TR>


</TABLE>


<P>
<br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Membership</FONT>
</TD>
</TR>
<TR><TD><input type="radio" name="ocdlamembership" value="lawyer" <CFif #ocdlamembership# eq "lawyer">checked</CFif>></TD>
    <TD>$125 OCDLA lawyer membership through June, 2002.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="nonlawyer" <CFif #ocdlamembership# eq "nonlawyer">checked</CFif>></TD>
    <TD>$65 OCDLA allied, nonlawyer professional membership through June, 2002.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="none" <CFif (#ocdlamembership# eq "none") or (#ocdlamembership# eq "")>checked</CFif>></TD>
    <TD>none</TD></TR>
</TABLE>


<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Scholarship Fund Donation</FONT>
</TD>
</TR>
<TR><TD valign=top><input type="checkbox" name="scholarship" <CFif #ParameterExists(scholarship)# is "Yes">checked</CFif>></TD>
    <TD valign=top>$15 voluntary donation to the OCDLA scholarship fund. This fund assists OCDLA members
	    who otherwise would be unable to attend the seminar.</TD></TR>
</TABLE>




<P>
<br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Host Hotel</FONT>
</TD>
</TR>
<TR><TD>
<b>Best Western Agate Beach Inn, Newport<b><br>
Rooms begin at $92 per night, single or double occupancy for ocean view, $80 per night, single
or double occupancy for hillside view. Room reservations must be made by August 13, 2001.
After that time, rooms are space available only. For room reservations call the Best Western
Agate Beach Inn at 1-800-547-3310 and mention that you are with the OCDLA seminar.
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

<CFset #URLbuf# = "&new=0&name=#URLEncodedFormat(name)#&phone=#URLEncodedFormat(phone)#&address=#URLEncodedFormat(address)#&city=#URLEncodedFormat(city)#&state=#URLEncodedFormat(state)#&zip=#URLEncodedFormat(zip)#&email=#URLEncodedFormat(email)#&ccnumber=#URLEncodedFormat(ccnumber)#&ccexpdate=#URLEncodedFormat(ccexpdate)#&nameoncard=#URLEncodedFormat(nameoncard)#&attend=#URLEncodedFormat(attend)#&badgename=#URLEncodedFormat(badgename)#&ocdlamembership=#URLEncodedFormat(ocdlamembership)#&OSBOBI=#URLEncodedFormat(OSBOBI)#">
<CFif #ParameterExists(scholarship)# is "Yes">
  <CFset #URLbuf# = #URLbuf# & "&scholarship=#URLEncodedFormat(scholarship)#">
</CFif>

If you would like to make changes, please click <a href="#CGI.SCRIPT_NAME#?UserID=#UserID#&Edit=1&#URLbuf#">here</a>.<P>

<b>Full Name: </b>#name#<BR>
<b>Name on Badge: </b>#badgename#<BR>
<b>Address: </b>#address#<BR>
<b>City, State Zip: </b>#city#, #state# #zip#<P>

<b>Phone: </b>#phone#<BR>
<b>E-Mail: </b>#email#<P>

<b>Credit Card Number: </b>#ccnumber#<BR>
<b>Expiration Date: </b>#ccexpdate#<BR>
<b>Name Of Card Holder: </b>#nameoncard#<P>
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
<CFset #MessageText# = #MessageText# & #CRLF# & "Badge Name: #badgename#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "OSB/OBI: #OSBOBI#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "Address: #address#">
<CFset #MessageText# = #MessageText# & #CRLF# & "City: #city#">
<CFset #MessageText# = #MessageText# & #CRLF# & "State: #state#">
<CFset #MessageText# = #MessageText# & #CRLF# & "Zip: #zip#">
<CFset #MessageText# = #MessageText# & #CRLF# & "Phone: #phone#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "Email: #email#" & #CRLF#>
<CFset #MessageText# = #MessageText# & #CRLF# & "CCNumber: #ccnumber#">
<CFset #MessageText# = #MessageText# & #CRLF# & "CCExpDate: #ccexpdate#">
<CFset #MessageText# = #MessageText# & #CRLF# & "NameOnCard: #nameoncard#" & #CRLF#>

<CFset #MessageText# = #MessageText# & #CRLF# & "- Invoice -">

<CFif #attend# eq "ocdlamemberlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 310>
    <tr><td>All Inclusive Package (member lawyer)</td><td align=right>$310</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "All Inclusive Package: Member Lawyer $310">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 295>
    <tr><td>All Inclusive Package (member lawyer)</td><td align=right>$295</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "All Inclusive Package: Member Lawyer $295">
  </CFif>
<CFelseif #attend# eq "ocdlamembernonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 255>
    <tr><td>All Inclusive Package (member nonlawyer)</td><td align=right>$255</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "All Inclusive Package: Member Nonlawyer $255">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 240>
    <tr><td>All Inclusive Package (member nonlawyer)</td><td align=right>$240</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "All Inclusive Package: Member Nonlawyer $240">
  </CFif>
<CFelseif #attend# eq "nonmemberlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 410>
    <tr><td>All Inclusive Package (nonmember lawyer)</td><td align=right>$410</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "All Inclusive Package: Nonmember Lawyer $410">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 395>
    <tr><td>All Inclusive Package (nonmember lawyer)</td><td align=right>$395</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "All Inclusive Package: Nonmember Lawyer $395">
  </CFif>
<CFelseif #attend# eq "nonmembernonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 345>
    <tr><td>All Inclusive Package (nonmember nonlawyer)</td><td align=right>$345</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "All Inclusive Package: Nonmember Lawyer $345">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 330>
    <tr><td>All Inclusive Package (nonmember nonlawyer)</td><td align=right>$330</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "All Inclusive Package: Nonmember Lawyer $330">
  </CFif>


<CFelseif #attend# eq "basicocdlamemberlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 190>
    <tr><td>Basic Package (member lawyer)</td><td align=right>$190</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Basic Package: Member Lawyer $190">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 175>
    <tr><td>Basic Package (member lawyer)</td><td align=right>$175</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Basic Package: Member Lawyer $175">
  </CFif>
<CFelseif #attend# eq "basicocdlamembernonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 135>
    <tr><td>Basic Package (member nonlawyer)</td><td align=right>$135</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Basic Package: Member Nonlawyer $135">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 120>
    <tr><td>Basic Package (member nonlawyer)</td><td align=right>$120</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Basic Package: Member Nonlawyer $120">
  </CFif>
<CFelseif #attend# eq "basicnonmemberlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 240>
    <tr><td>Basic Package (nonmember lawyer)</td><td align=right>$240</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Basic Package: Nonmember Lawyer $240">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 225>
    <tr><td>Basic Package (nonmember lawyer)</td><td align=right>$225</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Basic Package: Nonmember Lawyer $225">
  </CFif>
<CFelseif #attend# eq "basicnonmembernonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 175>
    <tr><td>Basic Package (nonmember nonlawyer)</td><td align=right>$175</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Basic Package: Nonmember Lawyer $175">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 160>
    <tr><td>Basic Package (nonmember nonlawyer)</td><td align=right>$160</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Basic Package: Nonmember Lawyer $160">
  </CFif>


</CFif>


<CFif #ocdlamembership# eq "lawyer">
  <CFset #TotalAmount# = #TotalAmount# + 125>
  <tr><td>OCDLA Lawyer Membership</td><td align=right>$125</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Lawyer Membership $125">
<CFelseif #ocdlamembership# eq "nonlawyer">
  <CFset #TotalAmount# = #TotalAmount# + 65>
  <tr><td>OCDLA Nonlawyer Membership</td><td align=right>$65</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Nonlawyer Membership $65">
</CFif>

<CFif #ParameterExists(scholarship)# is "Yes">
  <CFset #TotalAmount# = #TotalAmount# + 15>
  <tr><td>Contribution to Scholarship Fund</td><td align=right>$15</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Scholarship: $15">
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
<input type="hidden" name="subject" value="OCDLA Online Seminar Registration - #SeminarName#">
<input type="hidden" name="sendto" value="thanks.cfm?UserID=#UserID#">



<input type="submit" value=" Process My Registration ">
</ForM>

</CFoutput>


</CFif>
</TD></TR></TABLE>



</body>
</html>
