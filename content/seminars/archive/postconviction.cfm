<CFSET CRLF = Chr(13) & Chr(10)>

<CFset #SpecialDate# = #ParseDateTime("March 1, 2000")#>
<CFif #DateCompare(SpecialDate, Now())# eq 1>
  <CFset #Special# = 1>
<CFelse>
  <CFset #Special# = 0>
</CFif>

<CFif (#ParameterExists(name)# is "No") AND (#ParameterExists(phone)# is "No") AND (#ParameterExists(address)# is "No") AND (#ParameterExists(city)# is "No") AND (#ParameterExists(state)# is "No") AND (#ParameterExists(zip)# is "No") AND (#ParameterExists(email)# is "No") AND (#ParameterExists(barnumber)# is "No") AND (#ParameterExists(ccnumber)# is "No") AND (#ParameterExists(ccexpdate)# is "No") AND (#ParameterExists(nameoncard)# is "No") AND (#ParameterExists(attendc)# is "No") AND (#ParameterExists(attendj)# is "No") AND (#ParameterExists(scholarship)# is "No") AND (#ParameterExists(ocdlamembership)# is "No")>
  <CFlocation URL="#CGI.SCRIPT_NAME#?UserID=#UserID#&name=&phone=&address=&city=&state=&zip=&email=&barnumber=&ccnumber=&ccexpdate=&nameoncard=&attendc=&attendj=&ocdlamembership=&badgename=&new=1">
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
<title>OCDLA Seminar - Special Half Day Post Conviction Relief Seminar</title>
</head>

<BODY BGCOLOR=E1CFB9 TEXT="000000" LINK=326432 ALINK=600000 VLINK=600000>
<CENTER>
<TABLE width=400>
<TR>
<TD VALIGN=TOP HEIGHT=100>
<CENTER>
<FONT SIZE=+2>Special Half Day Post Conviction Relief Seminar</FONT><BR>
<FONT SIZE=+1>March 10, 2000</FONT><BR>
<FONT SIZE=+1><b>and <i>Forensics: Fact or Fiction?,</i></b> March 11, 2000</FONT>
<P>
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
Note: These programs are open only to OCDLA members, other defense lawyers and those
professionals and law students directly involved in the defense function.
</TD></TR></TABLE>

<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Attend Both Cross Post Conviction Relief and Forensics and save $15!</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<b>Subtract $15</b> from your <i>combined</i> registration fee if you attend both seminars.
For example, if you are an OCDLA lawyer member you pay $105 early registration for the
Forensics Seminar and $60 early registration for the Post Conviction Relief Seminar,
totalling $165. Subtract $15 from $165 for a total of $150.
</TD>
</TR></TABLE>

<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+2>Forensics, March 11</FONT><br>
<b>Registration</b>
<i>
(Registration fee includes: admission to the Forensics CLE, written course material, lunch on Saturday, and refreshments at the breaks.
There is a $15 early registration discount if your registration is postmarked by Monday, March 1.)

</i>
</TD>
</TR>

<TR>
<TD VALIGN=TOP>
<input type="radio" name="attendc" value="none" <CFif (#attendc# eq "none") OR (#attendc# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
I do not wish to attend this seminar

</TABLE>


<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Members</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attendc" value="ocdlalawyer" <CFif #attendc# eq "ocdlalawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$120 (<b>$105</b> before #DateFormat(SpecialDate, "mmmm d")#) pre-registration as a current OCDLA or WACDL lawyer member.</TD></TR>

<TR>
<TD VALIGN=TOP>
<input type="radio" name="attendc" value="ocdlanonlawyer" <CFif #attendc# eq "ocdlanonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$85 (<b>$70</b> before #DateFormat(SpecialDate, "mmmm d")#) pre-registration as a current nonlawyer professional OCDLA member.</TD></TR>
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
<input type="radio" name="attendc" value="nonmember-lawyer" <CFif #attendc# eq "nonmember-lawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$170 (<b>$155</b> before #DateFormat(SpecialDate, "mmmm d")#) pre-registration as a nonOCDLA member involved in the defnse function.</TR>


<TR>
<TD VALIGN=TOP>
<input type="radio" name="attendc" value="nonmember-nonlawyer" <CFif #attendc# eq "nonmember-nonlawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$135 (<b>$120</b> before #DateFormat(SpecialDate, "mmmm d")#) pre-registration as a nonlawyer nonOCDLA member.</TD></TR>
</TABLE>


<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Can't Attend Cross Examination?</FONT><br></TD></TR>

<TR><TD valign=top><input type="radio" name="attendc" value="membercantattend" <CFif #attendc# eq "membercantattend">checked</CFif>></TD>
    <TD valign=top>$60 (members) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attendc" value="nonmembercantattend" <CFif #attendc# eq "nonmembercantattend">checked</CFif>></TD>
    <TD valign=top>$85 (nonmembers) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attendc" value="tapescantattend" <CFif #attendc# eq "tapescantattend">checked</CFif>></TD>
    <TD valign=top>$60 (members) Please send me the audiotapes.</TD></TR>

<TR><TD valign=top><input type="radio" name="attendc" value="writtenandtapescantattend" <CFif #attendc# eq "writtenandtapescantattend">checked</CFif>></TD>
    <TD valign=top>$135 (members only) Please send me the written material and audiotapes so I can get CLE credit.</TD></TR>

</TABLE>


















<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+2>Post Conviction Relief - March 10, noon-5:00 p.m.</FONT><br>
<b>Registration</b>
<i>
(Registration fee includes: admission to the Post Conviction Reliefe CLE, written course material, and refreshments at the break.
There is a $15 early registration discount if your registration is postmarked by Monday, March 1.)
</i>
</TD>
</TR>

<TR>
<TD VALIGN=TOP>
<input type="radio" name="attendj" value="none" <CFif (#attendj# eq "none") OR (#attendj# eq "")>checked</CFif>>
</TD>
<TD VALIGN=TOP>
I do not wish to attend this seminar.
</TABLE>


<P>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Members</FONT>
</TD>
</TR>
<TR>
<TD VALIGN=TOP>
<input type="radio" name="attendj" value="ocdlalawyer" <CFif #attendj# eq "ocdlalawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$75 (<b>$60</b> before #DateFormat(SpecialDate, "mmmm d")#) pre-registration as a current OCDLA or WACDL lawyer member.</TD></TR>

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
<input type="radio" name="attendj" value="nonmember-lawyer" <CFif #attendj# eq "nonmember-lawyer">checked</CFif>>
</TD>
<TD VALIGN=TOP>
$95 (<b>$80</b> before #DateFormat(SpecialDate, "mmmm d")#) pre-registration as a nonOCDLA member involved in the defnse function.</TR>


</TABLE>


<P><br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>Can't Attend Juvenile Law?</FONT><br></TD></TR>

<TR><TD valign=top><input type="radio" name="attendj" value="membercantattend" <CFif #attendj# eq "membercantattend">checked</CFif>></TD>
    <TD valign=top>$40 (members) Send me the written materials.</TD></TR>

<TR><TD valign=top><input type="radio" name="attendj" value="tapescantattend" <CFif #attendj# eq "tapescantattend">checked</CFif>></TD>
    <TD valign=top>$40 (members) Please send me the audiotapes.</TD></TR>

<TR><TD valign=top><input type="radio" name="attendj" value="writtenandtapescantattend" <CFif #attendj# eq "writtenandtapescantattend">checked</CFif>></TD>
    <TD valign=top>$75 (members only) Please send me the written material and audiotapes so I can get CLE credit.</TD></TR>

</TABLE>



















<P>
<br>
<TABLE>
<TR>
<TD VALIGN=TOP COLSPAN=2>
<FONT SIZE=+1>OCDLA Membership</FONT>
</TD>
</TR>
<TR><TD><input type="radio" name="ocdlamembership" value="lawyer" <CFif #ocdlamembership# eq "lawyernew">checked</CFif>></TD>
    <TD>$60 New regular lawyer membership through June, 2000.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="lawyerrenew" <CFif #ocdlamembership# eq "lawyerrenew">checked</CFif>></TD>
    <TD>$125 Renewing regular lawyer membership through June, 2000.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="nonlawyer" <CFif #ocdlamembership# eq "nonlawyernew">checked</CFif>></TD>
    <TD>$20 New non-lawyer professional membership through June, 2000.</TD></TR>
<TR><TD><input type="radio" name="ocdlamembership" value="nonlawyerrenew" <CFif #ocdlamembership# eq "nonlawyerrenew">checked</CFif>></TD>
    <TD>$45 Renewing non-lawyer professional membership through June, 2000.</TD></TR>
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

<CFset #URLbuf# = "&name=#URLEncodedFormat(name)#&phone=#URLEncodedFormat(phone)#&address=#URLEncodedFormat(address)#&city=#URLEncodedFormat(city)#&state=#URLEncodedFormat(state)#&zip=#URLEncodedFormat(zip)#&email=#URLEncodedFormat(email)#&barnumber=#URLEncodedFormat(barnumber)#&ccnumber=#URLEncodedFormat(ccnumber)#&ccexpdate=#URLEncodedFormat(ccexpdate)#&nameoncard=#URLEncodedFormat(nameoncard)#&attendc=#URLEncodedFormat(attendc)#&attendj=#URLEncodedFormat(attendj)#&badgename=#URLEncodedFormat(badgename)#&ocdlamembership=#URLEncodedFormat(ocdlamembership)#">
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

<CFif #attendc# eq "ocdlalawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 120>
    <tr><td>Forensics Registration (member lawyer)</td><td align=right>$120</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Forensics Registration: Member Lawyer $120">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 105>
    <tr><td>Forensics Registration (member lawyer)</td><td align=right>$105</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Forensics Registration: Member Lawyer $105">
  </CFif>
<CFelseif #attendc# eq "ocdlanonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 85>
    <tr><td>Forensics Registration (member nonlawyer)</td><td align=right>$85</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Forensics Registration: Member Nonlawyer $85">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 70>
    <tr><td>Forensics Registration (member nonlawyer)</td><td align=right>$70</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Forensics Registration: Member Nonlawyer $70">
  </CFif>
<CFelseif #attendc# eq "nonmember-lawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 170>
    <tr><td>Forensics Registration (nonmember lawyer)</td><td align=right>$170</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Forensics Registration: Nonmember Lawyer $170">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 155>
    <tr><td>Forensics Registration (nonmember lawyer)</td><td align=right>$155</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Forensics Registration: Nonmember Lawyer $155">
  </CFif>
<CFelseif #attendc# eq "nonmember-nonlawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 135>
    <tr><td>Forensics Registration (nonmember nonlawyer)</td><td align=right>$135</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Forensics Registration: Nonmember Nonlawyer $135">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 120>
    <tr><td>Forensics Registration (nonmember nonlawyer)</td><td align=right>$120</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Forensics Registration: Nonmember Nonlawyer $120">
  </CFif>
<CFelseif #attendc# eq "membercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 60>
  <tr><td>Forensics Written Materials (member)</td><td align=right>$60</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend Forensics: Send Written Materials $60">
<CFelseif #attendc# eq "nonmembercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 85>
  <tr><td>Forensics Written Materials (nonmember)</td><td align=right>$85</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend Forensics: Send Written Materials $85">
<CFelseif #attendc# eq "tapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 60>
  <tr><td>Forensics Audio Tapes (member)</td><td align=right>$60</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend Forensics: Send Tapes $60">
<CFelseif #attendc# eq "writtenandtapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 135>
  <tr><td>Forensics Audio Tapes and Written Materials(member)</td><td align=right>$135</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend Forensics: Send Tapes and Written Materials $135">
</CFif>










<CFif #attendj# eq "ocdlalawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 75>
    <tr><td>Post Conviction Relief Registration (member lawyer)</td><td align=right>$75</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Post Conviction Relief Registration: Member Lawyer $75">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 60>
    <tr><td>Post Conviction Relief Registration (member lawyer)</td><td align=right>$60</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Post Conviction Relief Registration: Member Lawyer $60">
  </CFif>
<CFelseif #attendj# eq "nonmember-lawyer">
  <CFif #Special# neq 1>
    <CFset #TotalAmount# = #TotalAmount# + 95>
    <tr><td>Post Conviction Relief Registration (nonmember lawyer)</td><td align=right>$95</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Post Conviction Relief Registration: Nonmember Lawyer $95">
  <CFelse>
    <CFset #TotalAmount# = #TotalAmount# + 80>
    <tr><td>Post Conviction Relief Registration (nonmember lawyer)</td><td align=right>$80</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Post Conviction Relief Registration: Nonmember Lawyer $80">
  </CFif>
<CFelseif #attendj# eq "membercantattend">
  <CFset #TotalAmount# = #TotalAmount# + 40>
  <tr><td>Post Conviction Relief Written Materials (member)</td><td align=right>$40</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend Post Conviction Relief: Send Written Materials $40">
<CFelseif #attendj# eq "tapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 40>
  <tr><td>Post Conviction Relief Audio Tapes (member)</td><td align=right>$40</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend Post Conviction Relief: Send Tapes $40">
<CFelseif #attendj# eq "writtenandtapescantattend">
  <CFset #TotalAmount# = #TotalAmount# + 75>
  <tr><td>Post Conviction Relief Audio Tapes and Written Materials(member)</td><td align=right>$75</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "Member Cannot Attend Post Conviction Relief: Send Tapes and Written Materials $75">
</CFif>




<CFif #ocdlamembership# eq "lawyer">
  <CFset #TotalAmount# = #TotalAmount# + 60>
  <tr><td>OCDLA Lawyer Membership</td><td align=right>$60</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Lawyer Membership $60">
<CFelseif #ocdlamembership# eq "lawyerrenew">
  <CFset #TotalAmount# = #TotalAmount# + 125>
  <tr><td>OCDLA Lawyer Membership (Renew)</td><td align=right>$125</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Lawyer Membership (Renew) $125">
<CFelseif #ocdlamembership# eq "nonlawyer">
  <CFset #TotalAmount# = #TotalAmount# + 20>
  <tr><td>OCDLA Nonlawyer Membership</td><td align=right>$20</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Nonlawyer Membership $20">
<CFelseif #ocdlamembership# eq "nonlawyerrenew">
  <CFset #TotalAmount# = #TotalAmount# + 45>
  <tr><td>OCDLA Nonlawyer Membership (Renew)</td><td align=right>$45</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Nonlawyer Membership (Renew) $45">
</CFif>




<CFif #ParameterExists(Scholarship)# is "Yes">
  <CFset #TotalAmount# = #TotalAmount# + 10>
  <tr><td>OCDLA Scholarship Fund Donation </td><td align=right>$10</td></tr>
  <CFset #MessageText# = #MessageText# & #CRLF# & "OCDLA Scholarship Fund Donation $10">
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
<input type="hidden" name="subject" value="OCDLA Online Seminar Registration - Post Conviction Relief & Forensics: Fact or Fiction">
<input type="hidden" name="sendto" value="thanks.cfm?UserID=#UserID#">



<input type="submit" value=" Process My Registration ">
</ForM>

</CFoutput>


</CFif>
</TD></TR></TABLE>



</body>
</html>
