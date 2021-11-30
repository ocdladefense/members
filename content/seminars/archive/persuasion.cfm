<CFif #ParameterExists(new)# is "Yes">
  <CFset #new# = 0>
<CFelse>
  <CFset #new# = 1>
</CFif>

<CFSET CRLF = Chr(13) & Chr(10)>

<CFset #SpecialDate# = #ParseDateTime("November 28, 2000")#>
<CFif #DateCompare(SpecialDate, Now())# eq 1>
  <CFset #Special# = 1>
<CFelse>
  <CFset #Special# = 0>
</CFif>


<CFset #SeminarName# = "The Art of Persuasion and a Special Half Day Juvenile Law Seminar">


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
<CFparam Name="attend1" Default="">
<CFparam Name="attend2" Default="">
<CFparam Name="badgename" Default="">

<!--- parameters unique to this seminar--->
<CFparam Name="fridaydinner" Default="">


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
<FONT SIZE=+1>December 8-9, 2000 - The Benson Hotel, Portland</FONT><BR>
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
<FONT SIZE=+1>Save $15 - Attend Both &quot;Art of Persuasion&quot; and &quot;Juvenile Law&quot;</FONT><br>
Subtract $15 from combined registration fee if you attend both seminars. Example - if you are an OCDLA
lawyer member you pay $150 early registration for Art of Persuasion and $60 early registration for the Juvenile Law Seminar, totalling $210. $210 - $15 = $195.

</TD></TR></TABLE>


<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1><b>The Art of Persuasion, December 8-9</b></FONT><br>
Registration includes admission to Art of Persuasion, written material, continental breakfast and
lunch on Saturday, refreshments at the breaks.
</TD></TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend1" value="notattending" <CFif (#attend1# eq "notattending") OR (#attend1# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
I do not want to attend this seminar.</TD></TR>
</TABLE>

<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Members</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend1" value="ocdlamemberlawyer" <CFif #attend1# eq "ocdlamemberlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$165 pre-registration (<b>$150</b> before #DateFormat(SpecialDate, "mmmm d")#) for lawyers.</TD></TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend1" value="ocdlamembernonlawyer" <CFif #attend1# eq "ocdlamembernonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$110 pre-registration (<b>$95</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonlawyers.</TD></TR>
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
<input type="radio" name="attend1" value="nonocdlamemberlawyer" <CFif #attend1# eq "nonocdlamemberlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$215 pre-registration (<b>$200</b> before #DateFormat(SpecialDate, "mmmm d")#) for lawyers.</TD></TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend1" value="nonocdlamembernonlawyer" <CFif #attend1# eq "nonocdlamembernonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$265 pre-registration (<b>$250</b> before #DateFormat(SpecialDate, "mmmm d")#) for nonlawyers.</TD></TR>
</TABLE>


<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Can't Attend Art of Persuasion</FONT><br></TD></TR>

<TR><TD valign=top><input type="radio" name="attend1" value="membercantattend" <CFif #attend1# eq "membercantattend">checked</CFif>></TD>
    <TD valign=top>$75 (members) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend1" value="nonmembercantattend" <CFif #attend1# eq "nonmembercantattend">checked</CFif>></TD>
    <TD valign=top>$100 (nonmembers) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend1" value="tapescantattend" <CFif #attend1# eq "tapescantattend">checked</CFif>></TD>
    <TD valign=top>$75 (members) Please send me the audiotapes.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend1" value="writtenandtapescantattend" <CFif #attend1# eq "writtenandtapescantattend">checked</CFif>></TD>
    <TD valign=top>$145 (members only) Please send me the written material and audiotapes so I can get CLE credit.</TD></TR>

</TABLE>

<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Veggie Lunch</FONT>
</TD>
</TR>
<TR><TD valign=top><input type="checkbox" name="veggielunch" <CFif #ParameterExists(veggielunch)# is "Yes">checked</CFif>></TD>
    <TD valign=top>Make my lunch vegetarian (Art of Persuasion only).</TD></TR>
</TABLE>


<P>
<br>
<TABLE>
<TR><TD valign=top colspan=3><b>&nbsp;&nbsp;Friday Evening Dinner/Auction/Tribute to Ken Morrow</b><br>
&nbsp;&nbsp;(seminar attendance not required)

<TR><TD valign=top>$45 x</TD><TD valign=top><input type="text" name="fridaydinner" value="#fridaydinner#" size=2></TD>
    <TD valign=top width="75%">tickets. 6:00pm to 9:30pm, Benson Hotel.</TD></TR>
</TABLE>



<br><br>

<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1><b>Juvenile Law Seminar, December 8</b></FONT><br>
Registration includes admission to Juvenile Law, written material, and refreshments at the breaks.
</TD></TR>

<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend2" value="notattending" <CFif (#attend2# eq "notattending") OR (#attend2# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
I do not want to attend this seminar.</TD></TR>
</TABLE>

<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Members</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attend2" value="ocdlamember" <CFif #attend2# eq "ocdlamember">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$75 pre-registration (<b>$60</b> before #DateFormat(SpecialDate, "mmmm d")#)</TD></TR>
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
<input type="radio" name="attend2" value="nonocdlamember" <CFif #attend2# eq "nonocdlamember">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$95 pre-registration (<b>$80</b> before #DateFormat(SpecialDate, "mmmm d")#)</TD></TR>
</TABLE>


<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Can't Attend Juvenile Law</FONT><br></TD></TR>

<TR><TD valign=top><input type="radio" name="attend2" value="membercantattend" <CFif #attend2# eq "membercantattend">checked</CFif>></TD>
    <TD valign=top>$35 (members) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend2" value="nonmembercantattend" <CFif #attend2# eq "nonmembercantattend">checked</CFif>></TD>
    <TD valign=top>$50 (nonmembers) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend2" value="tapescantattend" <CFif #attend2# eq "tapescantattend">checked</CFif>></TD>
    <TD valign=top>$35 (members) Please send me the audiotapes.</TD></TR>

<TR><TD valign=top><input type="radio" name="attend2" value="writtenandtapescantattend" <CFif #attend2# eq "writtenandtapescantattend">checked</CFif>></TD>
    <TD valign=top>$65 (members only) Please send me the written material and audiotapes so I can get CLE credit.</TD></TR>

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
The Benson Hotel, Portland. Rooms begin at $101 per night. Room reservations must be made by November 7.
After that time, rooms are space available only. For room reservations, call the Benson at (503) 228-2000.
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

<CFset #URLbuf# = "&new=0&name=#URLEncodedFormat(name)#&phone=#URLEncodedFormat(phone)#&address=#URLEncodedFormat(address)#&city=#URLEncodedFormat(city)#&state=#URLEncodedFormat(state)#&zip=#URLEncodedFormat(zip)#&email=#URLEncodedFormat(email)#&barnumber=#URLEncodedFormat(barnumber)#&ccnumber=#URLEncodedFormat(ccnumber)#&ccexpdate=#URLEncodedFormat(ccexpdate)#&nameoncard=#URLEncodedFormat(nameoncard)#&attend1=#URLEncodedFormat(attend1)#&attend2=#URLEncodedFormat(attend2)#&badgename=#URLEncodedFormat(badgename)#&fridaydinner=#URLEncodedFormat(fridaydinner)#">
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

<CFif #attend1# eq "ocdlamemberlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 165>
    <tr><td>Art of Persuasion Registration (member lawyer)</td><td align=right>$165</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Art of Persuasion Registration: Member Lawyer $165">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 150>
    <tr><td>Art of Persuasion Registration (member lawyer)</td><td align=right>$150</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Art of Persuasion Registration: Member Lawyer $150">
  </CFif>
<CFelseif #attend1# eq "ocdlamembernonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 110>
    <tr><td>Art of Persuasion Registration (member nonlawyer)</td><td align=right>$110</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Art of Persuasion Registration: Member Nonlawyer $110">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 95>
    <tr><td>Art of Persuasion Registration (member nonlawyer)</td><td align=right>$95</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Art of Persuasion Registration: Member Nonlawyer $95">
  </CFif>

<CFelseif #attend1# eq "nonocdlamemberlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 215>
    <tr><td>Art of Persuasion Registration (nonmember lawyer)</td><td align=right>$215</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Art of Persuasion Registration: Nonmember Lawyer $215">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 200>
    <tr><td>Art of Persuasion Registration (nonmember lawyer)</td><td align=right>$200</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Art of Persuasion Registration: Nonmember Lawyer $200">
  </CFif>
<CFelseif #attend1# eq "nonocdlamembernonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 265>
    <tr><td>Art of Persuasion Registration (nonmember nonlawyer)</td><td align=right>$265</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Art of Persuasion Registration: Nonmember Nonlawyer $265">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 250>
    <tr><td>Art of Persuasion Registration (nonmember nonlawyer)</td><td align=right>$250</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Art of Persuasion Registration: Nonmember Nonlawyer $250">
  </CFif>
</CFif>

<CFif #Val(fridaydinner)# neq 0>
  <CFset #subprice# = #Val(fridaydinner)# * 45>
  <CFset #TotalAmount# = #TotalAmount# + #subprice#>
  <tr><td>Friday Dinner - #Val(fridaydinner)# tickets</td><td align=right>$#subprice#</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Friday Dinner - #Val(fridaydinner)# tickets: $#subprice#">
</CFif>

<CFif #ParameterExists(veggielunch)# is "Yes">
  <tr><td>Veggie Lunch</td><td align=right>$0</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Veggie Lunch: Yes">
</CFif>

<CFif #attend2# eq "ocdlamember">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 75>
    <tr><td>Juvenile Law Registration (member)</td><td align=right>$75</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Juvenile Law Registration: Member $75">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 60>
    <tr><td>Juvenile Law Registration (member)</td><td align=right>$60</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Juvenile Law Registration: Member $60">
  </CFif>
<CFelseif #attend2# eq "nonocdlamember">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 95>
    <tr><td>Juvenile Law Registration (nonmember)</td><td align=right>$95</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Juvenile Law Registration: Nonmember $95">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 80>
    <tr><td>Juvenile Law Registration (nonmember)</td><td align=right>$80</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Juvenile Law Registration: Nonmember $80">
  </CFif>
</CFif>

<CFif (#attend1# neq "notattending") AND (#attend2# neq "notattending")>
  <CFset #TotalAmount# = #TotalAmount# - 15>
  <tr><td>Attending Both Seminars</td><td align=right>-$15</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Attending Both Seminars: -$15">
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
