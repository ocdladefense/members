<CFif #ParameterExists(new)# is "Yes">
  <CFset #new# = 0>
<CFelse>
  <CFset #new# = 1>
</CFif>

<CFSET CRLF = Chr(13) & Chr(10)>

<CFset #SpecialDate# = #ParseDateTime("April 17, 2001")#>
<CFif #DateCompare(SpecialDate, Now())# eq 1>
  <CFset #Special# = 1>
<CFelse>
  <CFset #Special# = 0>
</CFif>


<CFset #SeminarName# = "Technology: The New TrumpCard">


<CFparam Name="name" Default="">
<CFparam Name="phone" Default="">
<CFparam Name="address" Default="">
<CFparam Name="city" Default="">
<CFparam Name="state" Default="">
<CFparam Name="zip" Default="">
<CFparam Name="email" Default="">
<CFparam Name="barnumber" Default="">
<CFparam Name="ccnumber" Default="">
<CFparam Name="ccexpdate" Default="">
<CFparam Name="nameoncard" Default="">
<CFparam Name="attend" Default="">
<CFparam Name="ocdlamembership" Default="">
<CFparam Name="badgename" Default="">
<CFparam Name="OSBOBI" Default="">

<!--- parameters unique to this seminar--->
<CFparam Name="aquariumadults" Default="">
<CFparam Name="aquariumchildren" Default="">


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
<FONT SIZE=+1>A Seminar for Criminal Investigators and Lawyers</FONT><BR>
<FONT SIZE=+1>April 27-28, 2001</FONT><BR>
<FONT SIZE=+1>Holiday Inn, Newport</FONT><BR>
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
Bar ##<BR>
<input type="text" size="35" name="barnumber" value="#barnumber#">
</TD>
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
<FONT SIZE=+1>Tuition</FONT><br>
Registration fee includes:
admission and written material for the seminar, continental breakfast and lunch on Saturday,
and refreshments at the breaks.
<p>
<b>Note:</b> All registration is <b>$15 less</b> if sent by #DateFormat(SpecialDate, "mmmm d")#.
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
<input type="radio" name="attend" value="ocdlamember" <CFif (#attend# eq "ocdlamember") OR (#attend# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
$165 pre-registration (<b>$150</b> before #DateFormat(SpecialDate, "mmmm d")#) for OCDLA members.</TD></TR>
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
<input type="radio" name="attend" value="nonmember" <CFif #attend# eq "nonmember">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$205 (<b>$190</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonmembers.</TR>
</TABLE>


<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Oregon Coast Aquarium Friday Evening Reception</FONT><br>
Private admission to the Aquarium, dinner, dessert, and coffee. Children age four and under are free.
</TD>
</TR>

<TR>
<TD VALIGN=TOP width=10%>
<input type="text" name="aquariumadults" value="#aquariumadults#" size=2>
</TD>
<TD VALIGN=TOP  align=left>
$20 each adult</TR>

<TR>
<TD VALIGN=TOP>
<input type="text" name="aquariumchildren" value="#aquariumchildren#" size=2>
</TD>
<TD VALIGN=TOP align=left>
$8 each adult</TR>

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

<TR><TD valign=top><input type="radio" name="attend" value="writtenandtapescantattend" <CFif #attend# eq "writtenandtapescantattend">checked</CFif>></TD>
    <TD valign=top>$145 (members only) Please send me the written material and audiotapes.</TD></TR>

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
    <TD>$65 OCDLA lawyer membership through June, 2001.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="nonlawyer" <CFif #ocdlamembership# eq "nonlawyer">checked</CFif>></TD>
    <TD>$35 OCDLA allied, nonlawyer professional membership through June, 2001.</TD></TR>
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
    <TD valign=top>$10 voluntary donation to the OCDLA scholarship fund. This fund assists OCDLA members
	    who otherwise would be unable to attend the seminar.</TD></TR>
</TABLE>


<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Veggetarian Lunch</FONT>
</TD>
</TR>
<TR><TD valign=top><input type="checkbox" name="veggielunch" <CFif #ParameterExists(veggielunch)# is "Yes">checked</CFif>></TD>
    <TD valign=top>Make my lunch vegetarian.</TD></TR>
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

<CFset #URLbuf# = "&new=0&name=#URLEncodedFormat(name)#&phone=#URLEncodedFormat(phone)#&address=#URLEncodedFormat(address)#&city=#URLEncodedFormat(city)#&state=#URLEncodedFormat(state)#&zip=#URLEncodedFormat(zip)#&email=#URLEncodedFormat(email)#&barnumber=#URLEncodedFormat(barnumber)#&ccnumber=#URLEncodedFormat(ccnumber)#&ccexpdate=#URLEncodedFormat(ccexpdate)#&nameoncard=#URLEncodedFormat(nameoncard)#&attend=#URLEncodedFormat(attend)#&ocdlamembership=#URLEncodedFormat(ocdlamembership)#&badgename=#URLEncodedFormat(badgename)#&OSBOBI=#URLEncodedFormat(OSBOBI)#&aquariumadults=#URLEncodedFormat(Val(aquariumadults))#&aquariumchildren=#URLEncodedFormat(Val(aquariumchildren))#">
<CFif #ParameterExists(scholarship)# is "Yes">
  <CFset #URLbuf# = #URLbuf# & "&scholarship=#URLEncodedFormat(scholarship)#">
</CFif>
<CFif #ParameterExists(veggielunch)# is "Yes">
  <CFset #URLbuf# = #URLbuf# & "&veggielunch=#URLEncodedFormat(veggielunch)#">
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

<CFif #attend# eq "ocdlamember">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 165>
    <tr><td>Registration (member)</td><td align=right>$165</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $165">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 150>
    <tr><td>Registration (member)</td><td align=right>$150</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $150">
  </CFif>
<CFelseif #attend# eq "nonmember">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 205>
    <tr><td>Registration (nonmember)</td><td align=right>$205</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Lawyer $205">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 190>
    <tr><td>Registration (nonmember)</td><td align=right>$190</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Lawyer $190">
  </CFif>
<CFelseif #attend# eq "membercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 75>
  <tr><td>Written Materials (member)</td><td align=right>$75</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Written Materials $75">
<CFelseif #attend# eq "nonmembercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 100>
  <tr><td>Written Materials (nonmember)</td><td align=right>$100</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Written Materials $100">
<CFelseif #attend# eq "writtenandtapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 145>
  <tr><td>Audio Tapes and Written Materials(member)</td><td align=right>$145</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Tapes and Written Materials $145">
</CFif>

<CFif #ocdlamembership# eq "lawyer">
  <CFset #TotalAmount# = #TotalAmount# + 65>
  <tr><td>OCDLA Lawyer Membership</td><td align=right>$65</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Lawyer Membership $65">
<CFelseif #ocdlamembership# eq "nonlawyer">
  <CFset #TotalAmount# = #TotalAmount# + 35>
  <tr><td>OCDLA Nonlawyer Membership</td><td align=right>$35</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Nonlawyer Membership $35">
</CFif>

<CFif #ParameterExists(scholarship)# is "Yes">
  <CFset #TotalAmount# = #TotalAmount# + 10>
  <tr><td>Contribution to Scholarship Fund</td><td align=right>$10</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Scholarship: $10">
</CFif>

<CFif #ParameterExists(veggielunch)# is "Yes">
  <tr><td>Veggie Lunch</td><td align=right>$0</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Veggie Lunch: Yes">
</CFif>


<CFif #Val(aquariumadults)# neq 0>
  <CFset #ThisAmount# = #Val(aquariumadults)# * 20>
  <CFset #TotalAmount# = #TotalAmount# + #ThisAmount#>
  <tr><td>Aquarium Admission (#Val(aquariumadults)# adults)</td><td align=right>$#ThisAmount#</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Aquarium Admission (#Val(aquariumadults)# adults): $#ThisAmount#">
</CFIf>

<CFif #Val(aquariumchildren)# neq 0>
  <CFset #ThisAmount# = #Val(aquariumchildren)# * 8>
  <CFset #TotalAmount# = #TotalAmount# + #ThisAmount#>
  <tr><td>Aquarium Admission (#Val(aquariumchildren)# children)</td><td align=right>$#ThisAmount#</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Aquarium Admission (#Val(aquariumchildren)# children): $#ThisAmount#">
</CFIf>


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
