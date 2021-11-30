<?php
/**
 *
 * @variables
 * $title
 * $page_title
 * $content
 * $email_footer
 *
 */
?>
<HTML>
<head>
<title><?php print $title ?></title>
</head>
<body>
<table width="560px" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td COLSPAN="2">
	<A href="http://www.ocdla.org"><IMG SRC="http://www.hsolc.org/themes/nptieducation/images/masthead-logo.png"></a>
	</TD>
</TR>
<TR>
	<TD ALIGN="left"> 
	</TD>
</TR>
<TR><TD COLSPAN="2"><IMG SRC="http://www.ocdla.org/images/vspacer.gif"></TD></TR>
<TR>
	<TD VALIGN="center" COLSPAN="2">
		<font face="Trebuchet MS, Arial, sans-serif" color="#666666">
		<font size="5"><B><?php print $page_title ?></B></font><br />
		<br /><br />
	</TD>
</TR>
<TR><TD COLSPAN="2">&nbsp;</TD></TR>
</table>
<!--Introductory Announcement-->
<table width="560px" border="0" cellspacing="0" cellpadding="0" align="center">
<TR>
	<TD COLSPAN="3" VALIGN="top">
	<hr></TD>
</TR>
<!-- ANNOUNCEMENT-->
<TR><TD COLSPAN="3"><IMG SRC="http://www.ocdla.org/images/vspacer.gif"></TD></TR>
<TR>
	<TD><IMG SRC="http://www.ocdla.org/images/spacer.gif"></TD>
	<TD WIDTH="125px" ALIGN="left" VALIGN="top"></TD>
	<TD>
			
			<?php print $content ?>

	</TD>
</font></TR>
<TR><TD COLSPAN="3"><IMG SRC="http://www.ocdla.org/images/vspacer.gif"></TD></TR>
<TR><TD COLSPAN="3"><HR></TD></TR></TABLE>
<!--FOOTER-->
<table width="560px" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td align="left">
	
	</TD>
	<TD ALIGN="right"><IMG SRC="http://www.ocdla.org/images/blockspace.jpg" WIDTH="100px"><TD>
	<TD>
	<font color="#666666"><DIV STYLE="font-size:10pt;"><?php print $email_footer ?></font></DIV></TD>
	</tr>
</table>
</body>
</html>