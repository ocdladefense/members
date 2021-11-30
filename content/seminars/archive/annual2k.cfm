<CFif #ParameterExists(new)# is "Yes">
  <CFset #new# = 0>
<CFelse>
  <CFset #new# = 1>
</CFif>

<CFSET CRLF = Chr(13) & Chr(10)>

<CFset #SpecialDate# = #ParseDateTime("June 2, 2000")#>
<CFif #DateCompare(SpecialDate, Now())# eq 1>
  <CFset #Special# = 1>
<CFelse>
  <CFset #Special# = 0>
</CFif>


<CFset #SeminarName# = "Annual Conference 2000">


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

<!--- parameters unique to this seminar--->
<CFparam Name="golftournament" Default="">
<CFparam Name="fridaynightparty" Default="">
<CFparam Name="kidsnightout" Default="">
<CFparam Name="dpseminar" Default="">
<CFparam Name="y2kbook" Default="">


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
<title>OCDLA Seminar - <CFoutput>#SeminarName#</CFoutput></title>
</head>

<BODY BGCOLOR=E1CFB9 TEXT="000000" LINK=326432 ALINK=600000 VLINK=600000>
<CENTER>
<TABLE width=400>
<TR>
<TD VALIGN=TOP HEIGHT=100>
<CENTER>
<FONT SIZE=+2><CFoutput>#SeminarName#</CFoutput></FONT><BR>
<FONT SIZE=+1>June 15-17, 2000</FONT><BR>
<FONT SIZE=+1>The Inn of the Seventh Mountain, Bend</FONT><P>
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
<FONT SIZE=+1>Pre-Registration</FONT><br>
Registration fee includes:
<ul>
  <li> Three days of CLE
  <li> Written course material
  <li> Two continental breakfasts
  <li> Refreshments at the breaks
  <li> Thursday evening barbecue -- open to all family and friends
  <li> Friday's lunch
  <li> Friday Night Party -- food, music, silent auction
</ul>
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
<input type="radio" name="attend" value="ocdlamemberlawyer" <CFif (#attend# eq "ocdlamemberlawyer") OR (#attend# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
$250 pre-registration (<b>$235</b> before #DateFormat(SpecialDate, "mmmm d")#) for current OCDLA or WACDL lawyer member.</TD></TR><TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="ocdlamemberlawyer19992000" <CFif #attend# eq "ocdlamemberlawyer19992000">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$230 pre-registration (<b>$215</b> before #DateFormat(SpecialDate, "mmmm d")#) for current OCDLA or WACDL lawyer member who are 1999 or 2000 bar admittees.</TD></TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="ocdlamembernonlawyer" <CFif #attend# eq "ocdlamembernonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$175 pre-registration (<b>$160</b> before #DateFormat(SpecialDate, "mmmm d")#) for OCDLA law student or professional, nonlawyer member.</TD></TR>
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
$325 (<b>$310</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonOCDLA lawyer member.</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend" value="nonmembernonlawyer" <CFif #attend# eq "nonmembernonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$200 (<b>$185</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonlawyer, nonOCDLA member involved in the defense function.</TR>


</TABLE>




<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Can't Attend?</FONT><br></TD></TR>

<TR><TD valign=top><input type="radio" name="attend" value="membercantattend" <CFif #attend# eq "membercantattend">checked</CFif>></TD>
    <TD valign=top>$85 (members) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend" value="nonmembercantattend" <CFif #attend# eq "nonmembercantattend">checked</CFif>></TD>
    <TD valign=top>$125 (nonmembers) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend" value="tapescantattend" <CFif #attend# eq "tapescantattend">checked</CFif>></TD>
    <TD valign=top>$85 (members) Please send me the audiotapes.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend" value="writtenandtapescantattend" <CFif #attend# eq "writtenandtapescantattend">checked</CFif>></TD>
    <TD valign=top>$165 (members only) Please send me the written material and audiotapes so I can get CLE credit.</TD></TR>

</TABLE>



<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Thursday Morning Death Penalty Seminar</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="dpseminar" value="yes" <CFif #dpseminar# eq "yes">checked</CFif>>
</TD>
<TD VALIGN=TOP>
FREE. I am attending the Annual Conference. I also want to attend the Thursday morning Death Penalty seminar.</TD></TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="dpseminar" value="no" <CFif (#dpseminar# eq "no") OR (#dpseminar# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
I do not want to attend this seminar.</TD></TR>
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
    <TD>$125 new OCDLA lawyer membership through June, 2001.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="nonlawyer" <CFif #ocdlamembership# eq "nonlawyer">checked</CFif>></TD>
    <TD>$45 new OCDLA nonlawyer professional membership through June, 2001.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="none" <CFif (#ocdlamembership# eq "none") or (#ocdlamembership# eq "")>checked</CFif>></TD>
    <TD>none</TD></TR>
</TABLE>


<P>
<br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>The New 2000 Trial Notebook</FONT><br>
<i>(release date: June 15, 2000)</i>
</TD>
</TR>
<TR><TD><input type="radio" name="y2kbook" value="member" <CFif #y2kbook# eq "member">checked</CFif>></TD>
    <TD>$100 for OCDLA members attending the Conference (a $20 discount).</TD></TR>
<TR><TD><input type="radio" name="y2kbook" value="nonmember" <CFif #y2kbook# eq "nonmember">checked</CFif>></TD>
    <TD>$125 for Nonmembers attending the Conference (a $20 discount).</TD></TR>
<TR><TD><input type="radio" name="y2kbook" value="none" <CFif (#y2kbook# eq "none") or (#y2kbook# eq "")>checked</CFif>></TD>
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
<br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Activities</FONT>
</TD>
</TR>
<TR><TD valign=top colspan=3><b>&nbsp;&nbsp;Golf Tournament</b></TD></TR>
<TR><TD valign=top>$45 x</TD><TD valign=top><input type="text" name="golftournament" value="#golftournament#" size=2></TD>
    <TD valign=top>guest(s). Wednesday June 14 at 2:30 pm. Register by May 15!!</TD></TR>
<TR><TD valign=top colspan=3><b>&nbsp;&nbsp;Friday Night Party</b></TD></TR>
<TR><TD valign=top valign=top>$20 x</TD><TD valign=top><input type="text" name="fridaynightparty" value="#fridaynightparty#" size=2></TD>
    <TD valign=top>guest(s) for the Friday Night Party -- food, music, silent auction.</TD></TR>
<TR><TD valign=top colspan=3><b>&nbsp;&nbsp;Kids Night Out</b></TD></TR>
<TR><TD valign=top valign=top>$15 x</TD><TD valign=top><input type="text" name="kidsnightout" value="#fridaynightparty#" size=2></TD>
    <TD valign=top>child(ren). This event, for kids ages 4-12, is Friday night, 7:00 - 10:00 pm. Let OCDLA
        know by June 9 if your child(ren) will be attending. Parents pay at the door.</TD></TR>

</TABLE>


<P>
<br>

<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Lodging - note earlier room reservation deadline</FONT>
</TD>
</TR>
<TR><TD>
Now is the time to make lodging arrangements at the Inn of the Seventh Mountain. A standard bedroom
can be had for as little as $63, and a fireside studio including living room, private deck,
kitchenette, and fireplace is available for only $82. Other configurations are also available.
For the best selection, contact the Inn of the Seventh Mountain, 1-800-452-6810.<br>
<b><i>
Note: Rooms will be released to the general public on May 1st. This is earlier than usual. Don't
wait! Make your reservation now.
</i></b>
<p>
Other housing options include: Hawthorn Suites, 4.5 miles from Seventh Mountain. Suites are $89,
standard room is $69. Call 1-888-388-5006.
<p>
Mt. Bachelor Village, 3.5 miles from Seventh Mountain. River Ridge one bedroom suite is $195,
Ski House one bedroom is $120. These rates are good until May 15, 2000. Call 1-800-452-9846.
<p>
Best Western Entrada Lodge, two miles from Seventh Mountain, has rooms beginning at $69 for one
queen bed, including continental breakfast. $5 for dogs. Call (541) 382-4080.
</TD></TR>
</TABLE>

<p><br>
<TABLE>
<TR><TD>
<b>
All registration is $15 more if postmarked after #DateFormat(SpecialDate, "mmmm d")# and at the door. If you register
and then cannot attend, you must call the OCDLA office by Tuesday, June 13 to receive
a refund, less $15. Members who do not show up at the conference will be sent the
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

<CFset #URLbuf# = "&new=0&name=#URLEncodedFormat(name)#&phone=#URLEncodedFormat(phone)#&address=#URLEncodedFormat(address)#&city=#URLEncodedFormat(city)#&state=#URLEncodedFormat(state)#&zip=#URLEncodedFormat(zip)#&email=#URLEncodedFormat(email)#&barnumber=#URLEncodedFormat(barnumber)#&ccnumber=#URLEncodedFormat(ccnumber)#&ccexpdate=#URLEncodedFormat(ccexpdate)#&nameoncard=#URLEncodedFormat(nameoncard)#&attend=#URLEncodedFormat(attend)#&badgename=#URLEncodedFormat(badgename)#&ocdlamembership=#URLEncodedFormat(ocdlamembership)#">
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

<CFif #attend# eq "ocdlamemberlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 250>
    <tr><td>Registration (member)</td><td align=right>$250</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $250">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 235>
    <tr><td>Registration (member)</td><td align=right>$235</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $235">
  </CFif>
<CFelseif #attend# eq "ocdlamemberlawyer19992000">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 230>
    <tr><td>Registration (member)</td><td align=right>$230</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer $230">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 215>
    <tr><td>Registration (member) (1999 or 2000 bar admittee)</td><td align=right>$215</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Lawyer (1999 or 2000 bar admittee) $215">
  </CFif>
<CFelseif #attend# eq "ocdlamembernonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 175>
    <tr><td>Registration (member)</td><td align=right>$175</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Nonlawyer $175">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 160>
    <tr><td>Registration (member)</td><td align=right>$160</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Member Nonlawyer $160">
  </CFif>
<CFelseif #attend# eq "nonmemberlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 325>
    <tr><td>Registration (nonmember)</td><td align=right>$325</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Lawyer $325">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 310>
    <tr><td>Registration (nonmember)</td><td align=right>$310</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Lawyer $310">
  </CFif>
<CFelseif #attend# eq "nonmembernonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 200>
    <tr><td>Registration (nonmember)</td><td align=right>$200</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Lawyer $200">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 185>
    <tr><td>Registration (nonmember)</td><td align=right>$185</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Registration: Nonmember Lawyer $185">
  </CFif>
<CFelseif #attend# eq "membercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 85>
  <tr><td>Written Materials (member)</td><td align=right>$85</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Written Materials $85">
<CFelseif #attend# eq "nonmembercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 125>
  <tr><td>Written Materials (nonmember)</td><td align=right>$125</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Written Materials $125">
<CFelseif #attend# eq "tapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 85>
  <tr><td>Audio Tapes (member)</td><td align=right>$85</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Tapes $85">
<CFelseif #attend# eq "writtenandtapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 165>
  <tr><td>Audio Tapes and Written Materials(member)</td><td align=right>$165</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend: Send Tapes and Written Materials $165">
</CFif>


<CFif #ocdlamembership# eq "lawyer">
  <CFset #TotalAmount# = #TotalAmount# + 125>
  <tr><td>OCDLA Lawyer Membership</td><td align=right>$125</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Lawyer Membership $125">
<CFelseif #ocdlamembership# eq "nonlawyer">
  <CFset #TotalAmount# = #TotalAmount# + 45>
  <tr><td>OCDLA Nonlawyer Membership</td><td align=right>$45</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Nonlawyer Membership $45">
</CFif>

<CFif #y2kbook# eq "member">
  <CFset #TotalAmount# = #TotalAmount# + 100>
  <tr><td>New 2000 Trial Notebook</td><td align=right>$100</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "2000 Trial Notebook (member) $100">
<CFelseif #y2kbook# eq "nonmember">
  <CFset #TotalAmount# = #TotalAmount# + 125>
  <tr><td>New 2000 Trial Notebook</td><td align=right>$125</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "2000 Trial Notebook (member) $125">
</CFif>

<CFif #ParameterExists(scholarship)# is "Yes">
  <CFset #TotalAmount# = #TotalAmount# + 10>
  <tr><td>Contribution to Scholarship Fund</td><td align=right>$10</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Scholarship: $10">
</CFif>


<CFif #Val(golftournament)# neq 0>
  <CFset #subprice# = #Val(golftournament)# * 45>
  <CFset #TotalAmount# = #TotalAmount# + #subprice#>
  <tr><td>Golf Tournament - #Val(golftournament)# guest(s)</td><td align=right>$#subprice#</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Golf Tournament - #Val(golftournament)# guest(s): $subprice">
</CFif>

<CFif #Val(fridaynightparty)# neq 0>
  <CFset #subprice# = #Val(fridaynightparty)# * 20>
  <CFset #TotalAmount# = #TotalAmount# + #subprice#>
  <tr><td>Friday Night Party - #Val(fridaynightparty)# guest(s)</td><td align=right>$#subprice#</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Friday Night Party - #Val(fridaynightparty)# guest(s): $subprice">
</CFif>

<CFif #Val(kidsnightout)# neq 0>
  <CFset #subprice# = #Val(kidsnightout)# * 0>
  <CFset #TotalAmount# = #TotalAmount# + #subprice#>
  <tr><td>Kids Night Out - #Val(kidsnightout)# guest(s)</td><td align=right>$#subprice#</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Kids Night Out - #Val(kidsnightout)# guest(s): $subprice">
</CFif>

<CFif #dpseminar# eq "yes">
  <tr><td>Thursday Morning Death Penalty Seminar </td><td align=right>$0</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Thursday Morning Death Penalty Seminar: $0">
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
