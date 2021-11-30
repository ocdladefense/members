<CFif #ParameterExists(new)# is "Yes">
  <CFset #new# = 0>
<CFelse>
  <CFset #new# = 1>
</CFif>

<CFSET CRLF = Chr(13) & Chr(10)>


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

<CFparam Name="raffletickets" Default="">


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
<title>OCDLA - Purchase Miata Raffle Tickets</title>
</head>

<BODY BGCOLOR=E1CFB9 TEXT="000000" LINK=326432 ALINK=600000 VLINK=600000>
<CENTER>
<TABLE width=400>
<TR>
<TD VALIGN=TOP HEIGHT=100>
<CENTER>
<FONT SIZE=+2>OCDLA - Purchase Miata Raffle Tickets</FONT><BR>
<FONT SIZE=+1>Tickets - $30 each or 4 for $100</FONT><BR>
<FONT SIZE=+1>Only 700 tickets to be sold.</FONT><BR>


</CENTER>
</TD>
</TR>
<TR>
<TD>

</CENTER>

<CFif (#Len(ErrorText)# neq 0) or (#ParameterExists(Edit)# is "Yes") or (#New# eq 1)>

<CFoutput>

<form action="#CGI.SCRIPT_NAME#?new=#new#" method="POST">

<CFif #New# eq 0>
  <b>The following required fields on the order form have been left blank:<P> #ErrorText#</B><p>
</CFif>




<input type="hidden" name="UserID" value="#UserID#">
<TABLE>

<tr><td colspan=2>




<p><font size="5">The Miata is the world&##146;s best-selling convertible sports
   car. OCDLA has acquired an excellent example of this fun-to-drive car&##151;a
   1995 vehicle with less than 29,000 miles.</font></p>
<p><big><font size="4">Raffle sponsored by the <b>Oregon Criminal
Defense Lawyers
   Association,</b> a nonprofit, educational organization committed to enhancing
   the quality of legal defense provided to accused citizens,
improving the criminal
   justice system and defending our constitutional protections.</font></big></p>

</td></tr>

<tr><td colspan=2>&nbsp;</td></tr>
<tr><td>

<p><font size="4"><b>Features of the 1995 Mazda Miata:</b></font></p>
<ul>
   <li> 5 speed transmission</li>
   <li><font size="4">Air Conditioning</font></li>
   <li><font size="4">Dual Air Bags </font></li>
   <li><font size="4">AM/FM Stereo</font></li>
   <li><font size="4">Alloy Wheels</font></li>
   <li><font size="4">Cruise Control</font></li>
   <li><font size="4">Cassette Player</font></li>
   <li><font size="4">Power windows and mirrors</font></li>
</ul>





</td><td>
<img src="miata1.gif"><br>The Miata OCDLA is raffling is white with a black interior.

</td></tr>

<tr><td colspan=2>&nbsp;</td></tr>

<tr><td colspan=2><hr><br>
If a field is not applicable, please place &quot;n/a&quot; in the box.
</td></tr>

<tr><td colspan=2>&nbsp;</td></tr>


<TR><TD>
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
<b>Raffle Drawing Date and Location:</b> Drawing will take place Saturday, June 23, 2001 at the Oregon
Criminal Defense Lawyers Association's Annual Conference at the Inn of the Seventh Mountain in Bend, Oregon.
</TD></TR></TABLE>

<P>
<TABLE>
<TR>
<TD VALIGN=TOP>
<input type="text" name="raffletickets" size=2 value="#raffletickets#">
</TD>
<TD VALIGN=TOP>
No. of Tickets</TD></TR>
</TABLE>
<br>

<HR><P>


    <input type="submit" value=" Process Order ">
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

<CFset #URLbuf# = "&new=0&name=#URLEncodedFormat(name)#&phone=#URLEncodedFormat(phone)#&address=#URLEncodedFormat(address)#&city=#URLEncodedFormat(city)#&state=#URLEncodedFormat(state)#&zip=#URLEncodedFormat(zip)#&email=#URLEncodedFormat(email)#&ccnumber=#URLEncodedFormat(ccnumber)#&ccexpdate=#URLEncodedFormat(ccexpdate)#&nameoncard=#URLEncodedFormat(nameoncard)#&raffletickets=#URLEncodedFormat(raffletickets)#">

If you would like to make changes, please click <a href="#CGI.SCRIPT_NAME#?UserID=#UserID#&Edit=1&#URLbuf#">here</a>.<P>

<b>Full Name: </b>#name#<BR>
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


<CFif #Val(raffletickets)# neq 0>
  <CFset #raffletickets# = #Val(raffletickets)#>

  <CFif #raffletickets# / 4 gte 1>
    <CFset #cheapraffletickets# = (#raffletickets# \ 4) * 4>

    <CFset #TotalAmount# = #TotalAmount# + (#cheapraffletickets# * 25)>
    <tr><td>#cheapraffletickets# Raffle Tickets @ $25 each</td><td align=right>#DollarFormat(cheapraffletickets * 25)#</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Raffle Tickets @ $25/each: #cheapraffletickets#">

    <CFset #raffletickets# = #raffletickets# - #cheapraffletickets#>
  </CFif>

  <CFif #raffletickets# neq 0>
    <CFset #TotalAmount# = #TotalAmount# + (#raffletickets# * 30)>
    <tr><td>#raffletickets# Raffle Tickets @ $30 each</td><td align=right>#DollarFormat(raffletickets * 30)#</td></tr>
    <CFset #MessageText# = #MessageText# & #CRLF# & "Raffle Tickets @ $30/each: #raffletickets#">
  </CFif>
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
<input type="hidden" name="subject" value="OCDLA Online Seminar Registration - Raffle Tickets">
<input type="hidden" name="sendto" value="thanks.cfm?UserID=#UserID#">



<input type="submit" value=" Process Order ">
</ForM>

</CFoutput>


</CFif>
</TD></TR></TABLE>



</body>
</html>
