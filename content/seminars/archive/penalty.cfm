<CFSET CRLF = Chr(13) & Chr(10)>

<CFif #DateCompare(ParseDateTime("October 12, 1999"), Now())# eq 1>
  <CFset #Special# = 1>
<CFelse>
  <CFset #Special# = 0>
</CFif>

<CFif (#ParameterExists(name)# is "No") AND (#ParameterExists(phone)# is "No") AND (#ParameterExists(address)# is "No") AND (#ParameterExists(city)# is "No") AND (#ParameterExists(state)# is "No") AND (#ParameterExists(zip)# is "No") AND (#ParameterExists(email)# is "No") AND (#ParameterExists(barnumber)# is "No") AND (#ParameterExists(ccnumber)# is "No") AND (#ParameterExists(ccexpdate)# is "No") AND (#ParameterExists(nameoncard)# is "No") AND (#ParameterExists(attend)# is "No") AND (#ParameterExists(scholarship)# is "No") AND (#ParameterExists(ocdlamembership)# is "No")>
  <CFlocation URL="#CGI.SCRIPT_NAME#?UserID=#UserID#&name=&phone=&address=&city=&state=&zip=&email=&barnumber=&ccnumber=&ccexpdate=&nameoncard=&attend=&ocdlamembership=&badgename=&capitaldefender=&new=1">
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
<title>OCDLA Seminar - How to Try the Penalty Phase</title>
</head>

<BODY BGCOLOR=E1CFB9 TEXT="000000" LINK=326432 ALINK=600000 VLINK=600000>
<CENTER>
<TABLE width=400>
<TR>
<TD VALIGN=TOP HEIGHT=100>
<CENTER>
<FONT SIZE=+2>How to Try the Penalty Phase</FONT><BR>
<FONT SIZE=+1>October 22-23, 1999</FONT><BR>
<FONT SIZE=+1>Inn at Otter Crest on the Oregon Coast, North of Newport</FONT><P>
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
<TD VALIGN=TOP COLSPAN=2>
Note: This program is open only to OCDLA members, other defense lawyers and those professionals
and law students directly involved in the defense function.
<p>
<FONT SIZE=+1>Pre-Registration</FONT><BR>
The registration fee includes admission to both days of the seminar, a copy of the
written material, a Friday reception, continental breakfast on Saturday, lunch on
Saturday, and refreshments at the breaks.
</TD></TR></TABLE>

<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Members</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="ocdlalawyer" <CFif (#attend# eq "ocdlalawyer") OR (#attend# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
$150 (<b>$135</b> before October 12) pre-registration for lawyers.</TD></TR>

<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="ocdlanonlawyer" <CFif #attend# eq "ocdlanonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$110 (<b>$95</b> before October 12) pre-registration for law students or professional, nonlawyers.</TD></TR>
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
<input type="radio" name="attend" value="nonmember-lawyer" <CFif #attend# eq "nonmember-lawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$200 (<b>$185</b> before October 12) pre-registration for nonmember lawyers.</TR>


<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="nonmember-nonlawyer" <CFif #attend# eq "nonmember-nonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$140 (<b>$135</b> before October 4) pre-registration nonmember nonlawyers.</TD></TR>
</TABLE>


<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Can't Attend?</FONT><br></TD></TR>

<TR><TD valign=top><input type="radio" name="attend" value="membercantattend" <CFif #attend# eq "membercantattend">checked</CFif>></TD>
    <TD valign=top>$75 (members) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend" value="nonmembercantattend" <CFif #attend# eq "nonmembercantattend">checked</CFif>></TD>
    <TD valign=top>$100 (nonmembers) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend" value="tapescantattend" <CFif #attend# eq "tapescantattend">checked</CFif>></TD>
    <TD valign=top>$75 (members) Please send me the audiotapes.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend" value="writtenandtapescantattend" <CFif #attend# eq "writtenandtapescantattend">checked</CFif>></TD>
    <TD valign=top>$145 (members only) Please send me the written material and audiotapes so I can get CLE credit.</TD></TR>

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
    <TD>$125 OCDLA lawyer membership through June, 2000.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="nonlawyer" <CFif #ocdlamembership# eq "nonlawyer">checked</CFif>></TD>
    <TD>$45 OCDLA allied, nonlawyer/professional membership through June, 2000.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="nonlawyer" <CFif #ocdlamembership# eq "nonlawyer">checked</CFif>></TD>
    <TD>$10 OCDLA law student membership through June, 2000.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="none" <CFif (#ocdlamembership# eq "none") or (#ocdlamembership# eq "")>checked</CFif>></TD>
    <TD>none</TD></TR>
</TABLE>


<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Capital Defender Membership</FONT> (must be an OCDLA member to join)<br>
</TD>
</TR>
<TR><TD valign=top><input type="radio" name="capitaldefender" value="lawyer" <CFif #capitaldefender# eq "lawyer">checked</CFif>></TD>
    <TD valign=top>$25 OCDLA lawyer member prorated through December, 1999.</TD></TR>
<TR><TD valign=top><input type="radio" name="capitaldefender" value="nonlawyer" <CFif #capitaldefender# eq "nonlawyer">checked</CFif>></TD>
    <TD valign=top>$12.50 OCDLA nonlawyer professional member prorated through December, 1999.</TD></TR>
<TR><TD valign=top><input type="radio" name="capitaldefender" value="none" <CFif (#capitaldefender# eq "none") OR (#capitaldefender# eq "")>checked</CFif>></TD>
    <TD valign=top>none</TD></TR>
</TABLE>



<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Scholarship Fund Donation</FONT>
</TD>
</TR>
<TR><TD valign=top><input type="checkbox" name="scholarship" <CFif #ParameterExists(scholarship)# is "Yes">checked</CFif>></TD>
    <TD valign=top>$10 voluntary donation to the OCDLA scholarship fund. This fund assists OCDLA members
	    who otherwise would be unable to attend the seminar.</TD></TR>
</TABLE>


<P>
<br>

<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Location</FONT>
</TD>
</TR>
<TR><TD>
This seminar will be held at the Inn of Otter Crest on the Oregon Coast. Room rates for seminar
attendees start at $80 per night for one bedroom, single or double occupancy. Studios and
suites are also available. To reserve, call 1-800-452-2101. To guarantee a room, make your room
reservations by September 22 and identify yourself as an OCDLA member.
</TD></TR>
</TABLE>

<p><br>
<TABLE>
<TR><TD>
<b>
All registration is $15 more if postmarked after October 12 and at the door. If you register
and then cannot attend, you must call the OCDLA office by Thursday, October 12 to receive
a refund, less $15. If you register and do not show up at the conference, we will send you the
written materials and the tapes.
</b>
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

<CFset #URLbuf# = "&name=#URLEncodedFormat(name)#&phone=#URLEncodedFormat(phone)#&address=#URLEncodedFormat(address)#&city=#URLEncodedFormat(city)#&state=#URLEncodedFormat(state)#&zip=#URLEncodedFormat(zip)#&email=#URLEncodedFormat(email)#&barnumber=#URLEncodedFormat(barnumber)#&ccnumber=#URLEncodedFormat(ccnumber)#&ccexpdate=#URLEncodedFormat(ccexpdate)#&nameoncard=#URLEncodedFormat(nameoncard)#&attend=#URLEncodedFormat(attend)#&badgename=#URLEncodedFormat(badgename)#&capitaldefender=#URLEncodedFormat(capitaldefender)#&ocdlamembership=#URLEncodedFormat(ocdlamembership)#">
<CFif #ParameterExists(scholarship)# is "Yes">
  <CFset #URLbuf# = #URLbuf# & "&scholarship=#URLEncodedFormat(scholarship)#">
</CFif>

If you would like to make changes, please click <a href="#CGI.SCRIPT_NAME#?UserID=#UserID#&Edit=1&#URLbuf#">here</a>.<P>

<b>Full Name: </b>#name#<BR>
<b>Name on Badge: </b>#badgename#<BR>
<b>Bar Number: </b>#barnumber#<BR>
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

<CFset #MessageText# = #MessageText# & #CRLF# & "- Invoice -">

<CFif #attend# eq "ocdlalawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 150>
    <tr><td>Registration (member lawyer)</td><td align=right>$150</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $150">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 135>
    <tr><td>Registration (member lawyer)</td><td align=right>$135</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $135">
  </CFif>
<CFelseif #attend# eq "ocdlanonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 110>
    <tr><td>Registration (member nonlawyer)</td><td align=right>$110</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Nonlawyer $110">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 95>
    <tr><td>Registration (member nonlawyer)</td><td align=right>$95</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Nonlawyer $95">
  </CFif>
<CFelseif #attend# eq "nonmember-lawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 200>
    <tr><td>Registration (nonmember lawyer)</td><td align=right>$200</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Lawyer $200">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 185>
    <tr><td>Registration (nonmember lawyer)</td><td align=right>$185</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Lawyer $185">
  </CFif>
<CFelseif #attend# eq "nonmember-nonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 140>
    <tr><td>Registration (nonmember nonlawyer)</td><td align=right>$140</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Nonlawyer $140">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 135>
    <tr><td>Registration (nonmember nonlawyer)</td><td align=right>$135</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Nonlawyer $135">
  </CFif>
<CFelseif #attend# eq "membercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 75>
  <tr><td>Written Materials (member)</td><td align=right>$75</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Written Materials $75">
<CFelseif #attend# eq "nonmembercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 100>
  <tr><td>Written Materials (nonmember)</td><td align=right>$100</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Written Materials $100">
<CFelseif #attend# eq "tapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 75>
  <tr><td>Audio Tapes (member)</td><td align=right>$75</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Tapes $75">
<CFelseif #attend# eq "writtenandtapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 145>
  <tr><td>Audio Tapes and Written Materials(member)</td><td align=right>$145</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Tapes and Written Materials $145">
</CFif>


<CFif #capitaldefender# eq "lawyer">
    <CFset #TotalAmount# = #TotalAmount# + 25>
    <tr><td>Capital Defender Membership (member lawyer)</td><td align=right>$25</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $25">
<CFelseif #capitaldefender# eq "nonlawyer">
    <CFset #TotalAmount# = #TotalAmount# + 12.5>
    <tr><td>Capital Defender Membership (member nonlawyer)</td><td align=right>$12.50</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $12.50">
</CFif>

<CFif #ParameterExists(scholarship)# is "Yes">
  <CFset #TotalAmount# = #TotalAmount# + 10>
  <tr><td>Contribution to Scholarship Fund</td><td align=right>$10</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Scholarship: $10">
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
<input type="hidden" name="subject" value="OCDLA Online Seminar Registration - How to Try the Penalty Phase">
<input type="hidden" name="sendto" value="thanks.cfm?UserID=#UserID#">



<input type="submit" value=" Process My Registration ">
</ForM>

</CFoutput>


</CFif>
</TD></TR></TABLE>



</body>
</html>
