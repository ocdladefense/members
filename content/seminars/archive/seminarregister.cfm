<cfif not cgi.SERVER_NAME contains "www">
	<cflocation url="https://www.#cgi.server_name##cgi.path_info#?#cgi.query_string#" addtoken="false"/>
</cfif>

<cfif Compare(cgi.SERVER_PORT,443)>
	<cflocation url="https://#cgi.server_name##cgi.path_info#?#cgi.query_string#" addtoken="false"/>
	<cfabort>
</cfif>


<cfparam name="MemberSeminarFeeFlag" default="">
<cfparam name="NonMemberSeminarFeeFlag" default="">
<cfif not isdefined("URL.ID")>
	<cflocation url="https://ocdla.org">
</cfif>
<cfquery name="getSeminar" datasource="OCDLA_Data">
	SELECT *
	FROM catalog
	WHERE ID = '#URL.ID#';
</cfquery>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><!-- DW6 -->
<head>
 
<title>Oregon Criminal Defense Lawyers Association</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function goForum(){
	popMenu = window.open('http://ocdla.org/PopUpLogin.cfm?page=FO', 'UserLogin', 'top=200,left=200,width=330,height=400,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no,status=no,resizable=yes');
	return true;
}

function submitIt(form) {

	// as per Tracye's request, following clauses are marked out
//	else if(form.OSB_OBI.value == ""){
//		alert("You must enter an OSB/OBI number.");
//		return false; }
	if(form.Badge.value == ""){
		alert("You must enter a name to put on your badge.");
		return false; }
	if(form.Material_1.checked && form.Material_2.checked){
		alert("Only one written-material-option should be selected.");
		return false; }		
	//make sure the registration type is selected.
	RegiOption = -1;
	for (i=0; i<form.seminarprice.length; i++){
	 if(form.seminarprice[i].checked)
	 	RegiOption = i;
	}
	if(RegiOption == -1){
		alert("You must select a registration type.");
		return false; }
}
//-->
</script>
<link rel="stylesheet" href="../css/law.css" type="text/css">
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('/images/mainmenu/mainnav_r1_c1_f2.gif','/images/mainmenu/mainnav_r2_c1_f2.gif','/images/mainmenu/mainnav_r3_c1_f2.gif','/images/mainmenu/mainnav_r4_c1_f2.gif','/images/mainmenu/mainnav_r5_c1_f2.gif','/images/mainmenu/mainnav_r6_c1_f2.gif','/images/mainmenu/mainnav_r7_c1_f2.gif','/images/mainmenu/mainnav_r8_c1_f2.gif','/images/mainmenu/mainnav_r9_c1_f2.gif','/images/topmenu/topmenu_r1_c7_f2.gif','/images/topmenu/topmenu_r1_c6_f2.gif','/images/topmenu/topmenu_r1_c3_f2.gif','/images/topmenu/topmenu_r1_c4_f2.gif','/images/topmenu/topmenu_r1_c5_f2.gif')" background="/images/bg.gif" link="557788" vlink="557788" alink="557788">
<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr> 
    <td rowspan="2" width="5%"><img src="/images/gav.gif" width="130" height="102"></td>
    <td width="100%" align="right"><img src="/images/topmenu/topmenu_r1_c2.gif" width="22" height="21"><a href="http://ocdla.org/contact.html" onMouseOver="MM_swapImage('Image1','','/images/topmenu/topmenu_r1_c7_f2.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="/images/topmenu/topmenu_r1_c7.gif" name="Image1" width="70" height="21" border="0" id="Image1"></a><a href="#" onClick="JavaScript:goForum()" onMouseOver="MM_swapImage('Image2','','/images/topmenu/topmenu_r1_c6_f2.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="/images/topmenu/topmenu_r1_c6.gif" name="Image2" width="99" height="21" border="0" id="Image2"></a><a href="../cart/index.cfm" onMouseOver="MM_swapImage('Image3','','/images/topmenu/topmenu_r1_c3_f2.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="/images/topmenu/topmenu_r1_c3.gif" name="Image3" width="98" height="21" border="0" id="Image3"></a><a href="http://ocdla.org/sitemap.html" onMouseOver="MM_swapImage('Image5','','/images/topmenu/topmenu_r1_c5_f2.gif',1)" onMouseOut="MM_swapImgRestore()"><img src="/images/topmenu/topmenu_r1_c5.gif" name="Image5" width="99" height="21" border="0" id="Image5"></a></td>
  </tr>
  <tr> 
    <td width="95%" align="left"><img src="/images/ocdla.gif" width="619" height="81" alt="Oregon Criminal Defense Lawyers Association"></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="130" valign="top" height="100"> 
<link rel="stylesheet" href="../css/law.css" type="text/css">
<table width="58" border="0" cellspacing="0" cellpadding="0">
        <tr>     
    <td valign="top" align="left" width="138" height="172"> <a href="/index.html" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r1_c11','','/images/mainmenu/mainnav_r1_c1_f2.gif',1)" ><img name="mainnav_r1_c11" src="/images/mainmenu/mainnav_r1_c1.gif" width="130" height="20" border="0" alt="Home"></a><a href="../seminars.html" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r2_c11','','/images/mainmenu/mainnav_r2_c1_f2.gif',1)" ><img name="mainnav_r2_c11" src="/images/mainmenu/mainnav_r2_c1.gif" width="130" height="20" border="0" alt="Seminars"></a><a href="../publications.cfm" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r3_c11','','/images/mainmenu/mainnav_r3_c1_f2.gif',1)" ><img name="mainnav_r3_c11" src="/images/mainmenu/mainnav_r3_c1.gif" width="130" height="20" border="0" alt="Publications"></a><a href="../membership/membership.html" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r4_c11','','/images/mainmenu/mainnav_r4_c1_f2.gif',1)" ><img name="mainnav_r4_c11" src="/images/mainmenu/mainnav_r4_c1.gif" width="130" height="20" border="0" alt="Membership Info"></a><a href="../capdef.html" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r5_c11','','/images/mainmenu/mainnav_r5_c1_f2.gif',1)" ><img name="mainnav_r5_c11" src="/images/mainmenu/mainnav_r5_c1.gif" width="130" height="20" border="0" alt="Capital Defenders"></a><a href="../membership/memberdirectory.lasso" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r6_c11','','/images/mainmenu/mainnav_r6_c1_f2.gif',1)" ><img name="mainnav_r6_c11" src="/images/mainmenu/mainnav_r6_c1.gif" width="130" height="20" border="0" alt="Membership Directory"></a><a href="../links.html" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r7_c11','','/images/mainmenu/mainnav_r7_c1_f2.gif',1)" ><img name="mainnav_r7_c11" src="/images/mainmenu/mainnav_r7_c1.gif" width="130" height="20" border="0" alt="Links"></a><a href="../calendar.html" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r8_c11','','/images/mainmenu/mainnav_r8_c1_f2.gif',1)" ><img name="mainnav_r8_c11" src="/images/mainmenu/mainnav_r8_c1.gif" width="130" height="20" border="0" alt="Calendar"></a><a href="http://ocdla.org/indigentd.html" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('Image22','','/images/mainmenu/public_defense_on.gif',1)" ><img name="Image22" src="/images/mainmenu/public_defense_off.gif" width="130" height="20" border="0" alt="public defense" /></a><a href="http://ocdla.org/jobs.cfm" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('Image33','','/images/mainmenu/job_listings_on.gif',1)" ><img name="Image33" src="/images/mainmenu/job_listings_off.gif" width="130" height="20" border="0" alt="Job Listings" /></a><a href="http://ocdla.org/resumes.cfm" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('Image4','','/images/mainmenu/resume_postings_on.gif',1)" ><img name="Image4" src="/images/mainmenu/resume_postings_off.gif" width="130" height="20" border="0" alt="Resume Postings" /></a><a href="/indigentd.html" onMouseOut="MM_swapImgRestore()"  onMouseOver="MM_swapImage('mainnav_r9_c11','','/images/mainmenu/mainnav_r9_c1_f2.gif',1)" ></a>  
    </td>
        </tr>
<tr>	<!--- member's only button --->
	<td>&nbsp;</td>
</tr>
<tr>
	<td>
		<a href="#" onClick="JavaScript:window.open('http://ocdla.org/PopUpLogin.cfm?page=CAT', 'UserLogin', 'top=200,left=200,width=330,height=400,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no,status=no,resizable=yes');" 
		onmouseover="document.MemOnly.src='/images/mainnav_membersonly1.gif'" onMouseOut="document.MemOnly.src='/images/mainnav_membersonly2.gif'">
		<img src="/images/mainnav_membersonly2.gif" width=130 height=20 border=0 alt="" name="MemOnly"></a><br>
		<a href="#" onClick="JavaScript:window.open('http://ocdla.org/PopUpLogin.cfm?page=LD', 'UserLogin', 'top=200,left=200,width=330,height=400,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no,status=no,resizable=yes');" 
		onmouseover="document.legal.src='/images/mainnav_legal1.gif'" onMouseOut="document.legal.src='/images/mainnav_legal3.gif'">
		<img src="/images/mainnav_legal3.gif" width=130 height=20 border=0 alt="" name="legal"></a><br>
		<a href="#" onClick="JavaScript:window.open('http://ocdla.org/PopUpLogin.cfm?page=DP', 'UserLogin', 'top=200,left=200,width=330,height=400,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no,status=no,resizable=yes');" 
		onmouseover="document.death.src='/images/mainnav_death1.gif'" onMouseOut="document.death.src='/images/mainnav_death3.gif'">
		<img src="/images/mainnav_death3.gif" width=130 height=20 border=0 alt="" name="death"></a><br>
		<a href="#" onClick="JavaScript:window.open('http://ocdla.org/PopUpLogin.cfm?page=FO', 'UserLogin', 'top=200,left=200,width=330,height=400,toolbar=no,menubar=no,scrollbars=no,location=no,directories=no,status=no,resizable=yes');" 
		onmouseover="document.forum.src='/images/mainnav_forum1.gif'" onMouseOut="document.forum.src='/images/mainnav_forum3.gif'">
		<img src="/images/mainnav_forum3.gif" width=130 height=20 border=0 alt="" name="forum"></a><br>
	</td>
</tr>
<tr>
	<td class="textsmall" align="right">
	&nbsp;<br>&nbsp;<br>&nbsp;<br><a href=".http://ocdla.org/RequestUP.cfm"><img src="/images/mainnav_request2.gif" width=130 height=20 border=0 alt=""></a>
	</td>
</tr>      </table></td>
    <td width="450" valign="top" height="100"><img src="/images/pics/columns.jpg" width="450" height="68" border="0"><!-- #BeginEditable "main" --> 
      <table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr> 
          <td class="largertextheader" height="2"><b><a href="../seminars.html">Seminars</a> 
            : <cfoutput><a href="#getSeminar.StaticPageLink#">#getSeminar.Item#</a></cfoutput></b></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="1">
        <tr> 
          <td background="/images/dash.gif" width="100%" height="1"><img src="/images/spacer.gif" width="200" height="1"></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr> 
          <td valign="top" height="364">
<form name="seminarform" method="post" action="../cart/seminaradd.cfm" onSubmit="return submitIt(this)">
	<cfoutput><input type="hidden" name="ID" value="#getSeminar.i#"></cfoutput>
              <table width="100%" border="0" cellspacing="1" cellpadding="6" class="text">
                <tr bgcolor="5A7882" class="text"> 
                  <td colspan="2" class="text"><b><font color="#FFFFFF">Registration Form</font></b></td>
                </tr>
                <tr bgcolor="EEEEEE"> 
                  <td class="text">OSB / DPSST #:<br>
                    <input type="text" name="OSB_OBI">
                  </td>
                  <td class="text" height="62">Name on Badge:<br>
                    <input type="text" name="Badge">
                  </td>
                </tr>
                <tr> 
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table>
              <table width="100%" border="0" cellspacing="1" cellpadding="4" class="text">
                <tr bgcolor="5A7882"> 
                  <td colspan="3" height="2" class="text"><b><font color="FFFFFF">Seminar 
                    Registration</font></b></td>
                </tr>
		<cfif getSeminar.NonMemberLawyerEarly neq getSeminar.NonMemberLawyerStandard and getSeminar.NonMemberNonLawyerEarly neq getSeminar.NonMemberNonLawyerStandard>
			<tr bgcolor="#EEEEEE" valign="top"> 
			  <td width="42%" class="text"><b><i><cfoutput>#getSeminar.Item#</cfoutput></i></b></td>
			  <td width="29%" align="center" class="text"><b>Early Bird<br>(by <cfoutput>#DateFormat(DateAdd('d',-10,getSeminar.StartDate),"MM/DD")#</cfoutput>)</b></td>
			  <td width="29%" align="center" class="text"><b>Standard<br>(after <cfoutput>#DateFormat(DateAdd('d',-10,getSeminar.StartDate),"MM/DD")#</cfoutput>)</b></td>
			</tr>
		<cfelse>
			<tr bgcolor="#EEEEEE" valign="top"> 
			  <td colspan="3" width="100%" class="text"><b><i><cfoutput>#getSeminar.Item#</cfoutput></i></b></td>
			</tr>

		</cfif>
		<cfset SPIndex = 0>
		<!--- New add on 6/20/06 : All the fee are equal --->
		<cfif (getSeminar.MemberLawyerEarly EQ getSeminar.MemberNonLawyerStandard) AND (getSeminar.MemberNonLawyerEarly EQ getSeminar.MemberLawyerStandard)>
			<cfset MemberSeminarFeeFlag = "ON">
		</cfif>
		<cfif (getSeminar.NonMemberLawyerEarly EQ getSeminar.NonMemberNonLawyerStandard) AND (getSeminar.NonMemberNonLawyerEarly EQ getSeminar.NonMemberLawyerStandard)>
			<cfset NonMemberSeminarFeeFlag = "ON">
		</cfif>
		<cfif (getSeminar.MemberStudentEarly EQ getSeminar.MemberStudentStandard) AND (getSeminar.NonMemberStudentEarly EQ getSeminar.NonMemberStudentStandard)>
			<cfset StudentSeminarFeeFlag = "ON">
		</cfif>

		<cfif getSeminar.MemberLawyerStandard neq 0 and getSeminar.NonMemberLawyerStandard neq 0>
			<cfoutput>
			<tr> 
			  <td width="42%" class="text"><b>OCDLA Members</b></td>
			  <cfif MemberSeminarFeeFlag EQ "ON">
			  	<td width="29%" align="center" bgcolor="EEEEEE" class="text">
					<input type="radio" name="seminarprice" value="#getSeminar.MemberLawyerEarly#">
					<cfset SPIndex = SPIndex +1>
			  	  	#DollarFormat(getSeminar.MemberLawyerEarly)#
				</td>
			  <cfelse>
			  		<td width="29%" align="center" class="text">&nbsp;</td>
			  </cfif>
			  <td width="29%" align="center" class="text">&nbsp;</td>	  
			</tr>
			<cfif isdefined("session.MBID") and (session.MBID neq "") AND (MemberSeminarFeeFlag NEQ "ON")>
				<tr> 
			 	 <td width="42%" bgcolor="EEEEEE" class="text">Lawyer</td>
				 <cfif getSeminar.MemberLawyerEarly EQ getSeminar.MemberLawyerStandard>
				 	<td colspan="2" align="center" bgcolor="EEEEEE" class="text">
						<input type="radio" name="seminarprice" value="#getSeminar.MemberLawyerEarly#">
						<cfset SPIndex = SPIndex +1>
			  	  		#DollarFormat(getSeminar.MemberLawyerEarly)#
					</td>
				 <cfelse>
				 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				 	  <input type="radio" name="seminarprice" value="#getSeminar.MemberLawyerEarly#"><cfset SPIndex = SPIndex +1>
			  	 	 #DollarFormat(getSeminar.MemberLawyerEarly)#</td>
			 	 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			 	 	  <input type="radio" name="seminarprice" value="#getSeminar.MemberLawyerStandard#"><cfset SPIndex = SPIndex +1>
			 	 	  #DollarFormat(getSeminar.MemberLawyerStandard)#</td>
				 </cfif>
				</tr>
				<tr> 
			  	<td width="42%" bgcolor="EEEEEE" class="text">Nonlawyer</td>
				 <cfif getSeminar.MemberNonLawyerEarly EQ getSeminar.MemberNonLawyerStandard>
				 	<td colspan="2" align="center" bgcolor="EEEEEE" class="text">
						<input type="radio" name="seminarprice" value="#getSeminar.MemberNonLawyerEarly#">
						<cfset SPIndex = SPIndex +1>
			  	  		#DollarFormat(getSeminar.MemberNonLawyerEarly)#
					</td>
				 <cfelse>
				 	 <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				    	<input type="radio" name="seminarprice" value="#getSeminar.MemberNonLawyerEarly#"><cfset SPIndex = SPIndex +1>
					   	 #DollarFormat(getSeminar.MemberNonLawyerEarly)#</td>
				 	 <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				    	<input type="radio" name="seminarprice" value="#getSeminar.MemberNonLawyerStandard#"><cfset SPIndex = SPIndex +1>
				    	#DollarFormat(getSeminar.MemberNonLawyerStandard)#</td>
				</cfif>
				</tr>
                <cfif getSeminar.StudentPurchase EQ "yes">
				<tr> 
			 	 <td width="42%" bgcolor="EEEEEE" class="text"><strong>Law Student</strong></td>
				 <cfif getSeminar.MemberStudentEarly EQ getSeminar.MemberStudentStandard>
				 	<td colspan="2" align="center" bgcolor="EEEEEE" class="text">
						<input type="radio" name="seminarprice" value="#getSeminar.MemberStudentEarly#">
						<cfset SPIndex = SPIndex +1>
			  	  		#DollarFormat(getSeminar.MemberStudentEarly)#					</td>
				 <cfelse>
				 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				 	  <input type="radio" name="seminarprice" value="#getSeminar.MemberStudentEarly#"><cfset SPIndex = SPIndex +1>
			  	 	 #DollarFormat(getSeminar.MemberStudentEarly)#</td>
			 	 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			 	 	  <input type="radio" name="seminarprice" value="#getSeminar.MemberStudentStandard#"><cfset SPIndex = SPIndex +1>
			 	 	  #DollarFormat(getSeminar.MemberStudentStandard)#</td>
				 </cfif>
				</tr>
              </cfif>

			<cfelseif MemberSeminarFeeFlag NEQ "ON"> <!--- Not logged in, and different fees --->
				<tr> 
			 	 <td width="42%" bgcolor="EEEEEE" class="text">Lawyer</td>
				 <cfif getSeminar.MemberLawyerEarly EQ getSeminar.MemberLawyerStandard>
				 	<td colspan="2" align="center" bgcolor="EEEEEE" class="text"> 
			 	   <input type="radio" name="seminarprice" value="#getSeminar.MemberLawyerEarly#">
				  	  #DollarFormat(getSeminar.MemberLawyerEarly)#</td>
				 <cfelse>
					<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
<!---			 	   <input onMouseOver="alert('If you are an OCDLA member, log-in at left \nto take advantage of member discounts. \n\nIf you are not a member, JOIN NOW.');document.forms.seminarform.seminarprice[#SPIndex#].blur();" type="radio" name="seminarprice" value="#getSeminar.MemberLawyerEarly#"><cfset SPIndex = SPIndex +1> --->
			 	   	<input type="radio" name="seminarprice" value="#getSeminar.MemberLawyerEarly#">
			  	  	#DollarFormat(getSeminar.MemberLawyerEarly)#</td>
			 	 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
<!---			 	   <input onMouseOver="alert('If you are an OCDLA member, log-in at left \nto take advantage of member discounts. \n\nIf you are not a member, JOIN NOW.');document.forms.seminarform.seminarprice[#SPIndex#].blur();" type="radio" name="seminarprice" value="#getSeminar.MemberLawyerStandard#"><cfset SPIndex = SPIndex +1> --->
			 	   	<input type="radio" name="seminarprice" value="#getSeminar.MemberLawyerStandard#">
			 	   	#DollarFormat(getSeminar.MemberLawyerStandard)#</td>
				 </cfif>
				</tr>
				<tr> 
			  	<td width="42%" bgcolor="EEEEEE" class="text">Nonlawyer</td>
				<cfif getSeminar.MemberNonLawyerEarly EQ getSeminar.MemberNonLawyerStandard>
					<td colspan="2" align="center" bgcolor="EEEEEE" class="text"> 
				    	<input type="radio" name="seminarprice" value="#getSeminar.MemberNonLawyerEarly#">
				   	 #DollarFormat(getSeminar.MemberNonLawyerEarly)#</td>
				<cfelse>			
			 		 <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
<!---			    	<input onMouseOver="alert('If you are an OCDLA member, log-in at left \nto take advantage of member discounts. \n\nIf you are not a member, JOIN NOW.');document.forms.seminarform.seminarprice[#SPIndex#].blur();" type="radio" name="seminarprice" value="#getSeminar.MemberNonLawyerEarly#"><cfset SPIndex = SPIndex +1> --->
			    		<input type="radio" name="seminarprice" value="#getSeminar.MemberNonLawyerEarly#">
			   		 #DollarFormat(getSeminar.MemberNonLawyerEarly)#</td>
			 		 <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
<!---			    	<input onMouseOver="alert('If you are an OCDLA member, log-in at left \nto take advantage of member discounts. \n\nIf you are not a member, JOIN NOW.');document.forms.seminarform.seminarprice[#SPIndex#].blur();" type="radio" name="seminarprice" value="#getSeminar.MemberNonLawyerStandard#"><cfset SPIndex = SPIndex +1> --->
			    	<input type="radio" name="seminarprice" value="#getSeminar.MemberNonLawyerStandard#">
			    	#DollarFormat(getSeminar.MemberNonLawyerStandard)#</td>				
				</cfif>
				</tr>
                <cfif getSeminar.StudentPurchase EQ "yes">
				<tr> 
			 	 <td width="42%" bgcolor="EEEEEE" class="text"><strong>Law Student</strong></td>
				 <cfif getSeminar.MemberStudentEarly EQ getSeminar.MemberStudentStandard>
				 	<td colspan="2" align="center" bgcolor="EEEEEE" class="text">
						<input type="radio" name="seminarprice" value="#getSeminar.MemberStudentEarly#">
						<cfset SPIndex = SPIndex +1>
			  	  		#DollarFormat(getSeminar.MemberStudentEarly)#					</td>
				 <cfelse>
				 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				 	  <input type="radio" name="seminarprice" value="#getSeminar.MemberStudentEarly#"><cfset SPIndex = SPIndex +1>
			  	 	 #DollarFormat(getSeminar.MemberStudentEarly)#</td>
			 	 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			 	 	  <input type="radio" name="seminarprice" value="#getSeminar.MemberStudentStandard#"><cfset SPIndex = SPIndex +1>
			 	 	  #DollarFormat(getSeminar.MemberStudentStandard)#</td>
				 </cfif>
				</tr>
              </cfif>
			</cfif>
			<tr> 
			  <td width="42%" class="text"><b>Nonmembers</b></td>
			  <cfif NonMemberSeminarFeeFlag EQ "ON">	<!--- all fees are same. --->
			  	<td width="29%" align="center" bgcolor="EEEEEE" class="text">
					<input type="radio" name="seminarprice" value="#getSeminar.NonMemberLawyerEarly#">
					<cfset SPIndex = SPIndex +1>
			  	  	#DollarFormat(getSeminar.NonMemberLawyerEarly)#
				</td>
			  <cfelse>
			  		<td width="29%" align="center" class="text">&nbsp;</td>
			  </cfif>
  			  <td width="29%" align="center" class="text">&nbsp;</td>
			</tr>
			<cfif getSeminar.StudentPurchase EQ "yes">
			<tr> 
			  <td width="42%" class="text"><b>Law Students</b></td>
              <cfif StudentSeminarFeeFlag EQ "ON">	<!--- all fees are same. --->
			  	<td width="29%" align="center" bgcolor="EEEEEE" class="text">
					<input type="radio" name="seminarprice" value="#getSeminar.MemberStudentEarly#">
					<cfset SPIndex = SPIndex +1>
			  	  	#DollarFormat(getSeminar.MemberStudentEarly)#
				</td>
			  <cfelse>
			  		<td width="29%" align="center" class="text">&nbsp;</td>
			  </cfif>
  			  <td width="29%" align="center" class="text">&nbsp;</td>
			</tr>
			</cfif>
			</cfoutput>
		<cfelse>
			<tr> 
			  <td width="42%" class="text"><b>Members or Nonmembers</b></td>
			  <td width="29%" align="center" class="text">&nbsp;</td>
			  <td width="29%" align="center" class="text">&nbsp;</td>
			</tr>
		</cfif>
		<cfoutput>
		<cfif getSeminar.NonMemberLawyerEarly neq getSeminar.NonMemberLawyerStandard and getSeminar.NonMemberNonLawyerEarly neq getSeminar.NonMemberNonLawyerStandard AND NonMemberSeminarFeeFlag NEQ "ON">
			<tr> 
			  <td width="42%" bgcolor="EEEEEE" class="text">Lawyer</td>
			  <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			    <input type="radio" name="seminarprice" value="#getSeminar.NonMemberLawyerEarly#"><cfset SPIndex = SPIndex +1>
			    #DollarFormat(getSeminar.NonMemberLawyerEarly)#</td>
			  <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			    <input type="radio" name="seminarprice" value="#getSeminar.NonMemberLawyerStandard#"><cfset SPIndex = SPIndex +1>
			    #DollarFormat(getSeminar.NonMemberLawyerStandard)#</td>
			</tr>
			<tr> 
			  <td width="42%" bgcolor="EEEEEE" class="text">Nonlawyer</td>
			  <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			    <input type="radio" name="seminarprice" value="#getSeminar.NonMemberNonLawyerEarly#"><cfset SPIndex = SPIndex +1>
			    #DollarFormat(getSeminar.NonMemberNonLawyerEarly)#</td>
			  <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			    <input type="radio" name="seminarprice" value="#getSeminar.NonMemberNonLawyerStandard#"><cfset SPIndex = SPIndex +1>
			    #DollarFormat(getSeminar.NonMemberNonLawyerStandard)#</td>
			</tr>
            <cfif getSeminar.StudentPurchase EQ "yes">
				<tr> 
			 	 <td width="42%" bgcolor="EEEEEE" class="text"><strong>Law Student</strong></td>
				 <cfif getSeminar.NonMemberStudentEarly EQ getSeminar.NonMemberStudentStandard>
				 	<td colspan="2" align="center" bgcolor="EEEEEE" class="text">
						<input type="radio" name="seminarprice" value="#getSeminar.NonMemberStudentEarly#">
						<cfset SPIndex = SPIndex +1>
			  	  		#DollarFormat(getSeminar.NonMemberStudentEarly)#					</td>
				 <cfelse>
				 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				 	  <input type="radio" name="seminarprice" value="#getSeminar.NonMemberStudentEarly#"><cfset SPIndex = SPIndex +1>
			  	 	 #DollarFormat(getSeminar.NonMemberStudentEarly)#</td>
			 	 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			 	 	  <input type="radio" name="seminarprice" value="#getSeminar.NonMemberStudentStandard#"><cfset SPIndex = SPIndex +1>
			 	 	  #DollarFormat(getSeminar.NonMemberStudentStandard)#</td>
				 </cfif>
				</tr>
             </cfif>
		<cfelseif getSeminar.NonMemberLawyerEarly neq getSeminar.NonMemberNonLawyerEarly>	<!--- Added on 6/5/07; if Early-Bird price is same as Standard Price, --->
			<tr> 
			  <td width="42%" bgcolor="EEEEEE" class="text">Lawyer</td>
			  <td align="center" bgcolor="EEEEEE" class="text" colspan="2"> 
			    <input type="radio" name="seminarprice" value="#getSeminar.NonMemberLawyerEarly#"><cfset SPIndex = SPIndex +1>
			    #DollarFormat(getSeminar.NonMemberLawyerEarly)#</td>
			</tr>
			<tr> 
			  <td width="42%" bgcolor="EEEEEE" class="text">Nonlawyer</td>
			  <td align="center" bgcolor="EEEEEE" class="text" colspan="2"> 
			    <input type="radio" name="seminarprice" value="#getSeminar.NonMemberNonLawyerEarly#"><cfset SPIndex = SPIndex +1>
			    #DollarFormat(getSeminar.NonMemberNonLawyerEarly)#</td>
			</tr>
            <cfif getSeminar.StudentPurchase EQ "yes">
				<tr> 
			 	 <td width="42%" bgcolor="EEEEEE" class="text"><strong>Law Student</strong></td>
				 <cfif getSeminar.NonMemberStudentEarly EQ getSeminar.NonMemberStudentStandard>
				 	<td colspan="2" align="center" bgcolor="EEEEEE" class="text">
						<input type="radio" name="seminarprice" value="#getSeminar.NonMemberStudentEarly#">
						<cfset SPIndex = SPIndex +1>
			  	  		#DollarFormat(getSeminar.NonMemberStudentEarly)#					</td>
				 <cfelse>
				 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				 	  <input type="radio" name="seminarprice" value="#getSeminar.NonMemberStudentEarly#"><cfset SPIndex = SPIndex +1>
			  	 	 #DollarFormat(getSeminar.NonMemberStudentEarly)#</td>
			 	 	<td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
			 	 	  <input type="radio" name="seminarprice" value="#getSeminar.NonMemberStudentStandard#"><cfset SPIndex = SPIndex +1>
			 	 	  #DollarFormat(getSeminar.NonMemberStudentStandard)#</td>
				 </cfif>
				</tr>
            </cfif>
		<!--- modification on 6/20/06
		<cfelse>
			<tr> 
			  <td width="42%" bgcolor="EEEEEE" class="text">Registration</td>
			  <td width="58%" align="center" bgcolor="EEEEEE" class="text" colspan="2"> 
			    <input type="radio" name="seminarprice" value="#getSeminar.NonMemberNonLawyerStandard#"><cfset SPIndex = SPIndex +1>
			    #DollarFormat(getSeminar.NonMemberNonLawyerStandard)#</td>
			</tr>
		---->
		</cfif>
		</cfoutput>
                <tr> 
                  <td width="42%" class="text">&nbsp;</td>
                  <td width="29%" class="text">&nbsp;</td>
                  <td width="29%" class="text">&nbsp;</td>
                </tr>
		<cfquery name="getNoNonMembers" datasource="OCDLA_Data">
			SELECT ID
			FROM catalog
			WHERE NonMemberPurchase = 'no';
		</cfquery>
		<cfset NoNonMembers = "">
		<cfloop query="getNoNonMembers">
			<cfset NoNonMembers = ListAppend(NoNonMembers,"|#getNoNonMembers.ID#|",",")>
		</cfloop>
		<!--- following cfif for MaterialID added as new on 3/29/05 ; this applys only to 2005 conference --->
		<cfif getSeminar.MaterialIDList neq '' AND getSeminar.OptionDesc5 EQ 'temp'>
			<tr> 
			  <td colspan="3" class="text" bgcolor="#5A7882"><b><font color="#FFFFFF"> 
			    Written Material Options</font></b></td>
			</tr>
			
			<cfquery name="getMaterials" datasource="OCDLA_Data">
				SELECT *
				FROM catalog
				WHERE Category = 'Events'
				AND ID IN(#PreserveSingleQuotes(getSeminar.MaterialIDList)#)
				ORDER BY OrderPriority ASC;
			</cfquery>
			
			<cfset MaterialIndex = 0>
			<cfoutput query="getMaterials">
				<cfset MaterialIndex = MaterialIndex + 1>
				<tr> 
				  <td colspan="3" height="2" bgcolor="EEEEEE" class="text"> 
				    <input type="radio" name="MaterialOption" value="#getMaterials.ID#">
				    #getMaterials.Description#&nbsp;
				    </td>
				</tr>
			</cfoutput>
			<tr><td colspan="3">&nbsp;</td></tr>
		</cfif>
		
		<cfif getSeminar.EventIDList neq ''>
			<tr> 
			  <td colspan="3" class="text" bgcolor="#5A7882"><b><font color="#FFFFFF">Event 
			    Registration </font></b></td>
			</tr>
			<!--- The "Note" area is removed per Tracye's request on 2/14/2005
			<tr>
				<td colspan="3" class="text" height="2">Note: The Saturday Night Party (live music, food, dancing, auction) is included for conference registrants. Guest tickets are $25 each.
				</td>
			</tr>
			--->
			<cfquery name="getEvents" datasource="OCDLA_Data">
				SELECT *
				FROM catalog
				WHERE Category = 'Events'
				AND i IN(#getSeminar.EventIDList#)
				ORDER BY OrderPriority ASC;
			</cfquery>
			<cfset EventIndex = 0>
			<cfoutput query="getEvents">
				<cfset EventIndex = EventIndex + 1>
				<tr> 
				  <td colspan="3" class="text" height="2"> 
				    <input type="checkbox" name="Event_#EventIndex#" value="#getEvents.i#">
				    #getEvents.Description#for&nbsp;
				    <input type="text" name="Guests_#EventIndex#" size="3">&nbsp;guest(s).
					<cfif #getEvents.ID# is "72">(Registrant's ticket is included in registration fee.)</cfif>
					</td>
				</tr>
			</cfoutput>
		</cfif>
                <tr bgcolor="#5a7882" class="text"> 
                  <td colspan="3" class="text"><b><font color="#FFFFFF">OCDLA 
                    Membership through <cfoutput>June <cfif DatePart('m',Now()) gte 4>#DateFormat(DateAdd('m',12,Now()),'YYYY')#<cfelse>#DateFormat(Now(),'YYYY')#</cfif></cfoutput></font></b></td>
                </tr>
		<cfquery name="getMemberships" datasource="OCDLA_Data">
			SELECT *
			FROM catalog
			WHERE Category = 'Membership'
			AND ID IN(13, 1102, 1101, 14, 12, 15)
			Order By Weight;
		</cfquery>
		<cfoutput query="getMemberships">
			<tr> 
			  <td colspan="3" height="31" bgcolor="EEEEEE" class="text"> 
			    <input type="radio" name="membership" value="#getMemberships.i#">
			    #DollarFormat(getMemberships.RegularPrice)#&nbsp;#getMemberships.Item#</td>
			</tr>
		</cfoutput>
		<tr> 
		  <td colspan="3" height="31" bgcolor="EEEEEE" class="text"> 
		    <input type="radio" name="membership" value="NONE">
		    None</td>
		</tr>
		<!---  "AND getSeminar.OptionDesc5 EQ 'temp'" is added to hide from above Material description; this can be removed later --->
		<cfif getSeminar.MaterialIDList neq '' AND getSeminar.OptionDesc5 NEQ 'temp'>
			<tr> 
			  <td colspan="3" class="text">&nbsp;</td>
			</tr>
			<tr bgcolor="#5A7882"> 
			  <td colspan="3" class="text"><b><font color="#FFFFFF">Written Material Option</font></b></td>
			</tr>
			<tr bgcolor="#EEEEEE"> 
			  <td width="42%" class="text">&nbsp;</td>
			  <td width="29%" align="center" class="text"><b>OCDLA Members</b></td>
			  <td width="29%" align="center" class="text"><b>Nonmembers</b></td>
			</tr>
			<cfquery name="getMaterials" datasource="OCDLA_Data">	<!--- I created same name above and possibly cause some problem in the future --->
				SELECT *
				FROM catalog
				WHERE Category = 'Materials'
				AND i IN(#getSeminar.MaterialIDList#);
			</cfquery>
			<cfset MaterialIndex = 0>
			<cfoutput query="getMaterials">
				<cfset MPIndex = 0>
				<cfset MaterialIndex = MaterialIndex+1>
				<tr> 
				  <td width="42%" bgcolor="EEEEEE" class="text">#getMaterials.Description# </td>
				  <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				    <cfif (isdefined("session.MBID") and session.MBID neq "" and NoNonMembers contains "|#ID#|") or not NoNonMembers contains "|#ID#|">
					    <cfif isdefined("session.MBID") and session.MBID neq "">
							<input type="checkbox" name="Material_#MaterialIndex#" value="#getMaterials.i#"><cfset MPIndex = MPIndex +1>
							<cfif #getMaterials.RegularPrice# LT 0> Subtract </cfif>
					    	#DollarFormat(getMaterials.RegularPrice)#
						<cfelse>
<!---						<input onMouseOver="alert('If you are an OCDLA member, log-in at left \nto take advantage of member discounts. \n\nIf you are not a member, JOIN NOW.');document.forms.seminarform.Material_#MaterialIndex#[#MPIndex#].blur();" type="radio" name="Material_#MaterialIndex#" value="#getMaterials.i#"><cfset MPIndex = MPIndex +1> --->
							<input type="checkbox" name="Material_#MaterialIndex#" value="#getMaterials.i#">
							<cfif #getMaterials.RegularPrice# LT 0> Subtract </cfif>
					    	#DollarFormat(getMaterials.RegularPrice)# 
						</cfif>
				    <cfelse>
<!---				    <input onMouseOver="alert('If you are an OCDLA member, log-in at left \nto take advantage of member discounts. \n\nIf you are not a member, JOIN NOW.');document.forms.seminarform.Material_#MaterialIndex#.blur();" type="checkbox" name="Material_#MaterialIndex#" value="#getMaterials.i#"> --->
					    <input type="checkbox" name="Material_#MaterialIndex#" value="#getMaterials.i#">
						<cfif #getMaterials.RegularPrice# LT 0> Subtract </cfif>
					    #DollarFormat(getMaterials.RegularPrice)# 
				    </cfif>
				  </td>
				  <cfset MaterialIndex = MaterialIndex+1>
				  <td width="29%" align="center" bgcolor="EEEEEE" class="text"> 
				    <cfif getMaterials.Price neq 0><input type="checkbox" name="Material_#MaterialIndex#" value="#getMaterials.i#"><cfset MPIndex = MPIndex +1>
				    <cfif #getMaterials.RegularPrice# LT 0> Subtract </cfif>
					#DollarFormat(getMaterials.Price)#<cfelse>N/A</cfif></td>
				</tr>
				<!---
				<tr><td colspan="2" align="center" bgcolor="EEEEEE" class="text">
					<input type="radio" name="Material_#MaterialIndex#">No Option</td></tr>
					--->
			</cfoutput>
		</cfif>
                <tr> 
                  <td colspan="3" class="text">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3" class="text" bgcolor="#5a7882"><b><font color="#FFFFFF">Cancellations</font></b></td>
                </tr>
                <tr> 
                  <td colspan="3" class="text"><cfoutput>#getSeminar.Cancellations#</cfoutput></td>
                </tr>
                <tr> 
                  <td colspan="3" class="text">&nbsp;</td>
                </tr>
                <tr> 
                  <td colspan="3" align="center" class="text" height="52"> 
                    <input type="submit" value="Add to Cart">
                    &nbsp;&nbsp; 
                    <input type="reset" value="Reset">
                  </td>
                </tr>
                <tr> 
                  <td colspan="3" class="text"><b>Note: </b><cfoutput>#getSeminar.FootNote#</cfoutput></td>
                </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
       
      <div align="center"><!-- #BeginEditable "bottomlinks" -->
        <p>
<div class="basemenu">
  <div align="center"><a href="/index.html" class="basemenu">Home</a> | <a href="../seminars.html" class="basemenu">Seminars</a> 
    | <a href="../publications.cfm" class="basemenu">Publications</a> | <a href="../membership/membership.html" class="basemenu">Membership 
    Info</a> | <a href="../capdef.html" class="basemenu">Capital Defenders</a><br>
    <a href="../membership/memberdirectory.lasso" class="basemenu">Membership Directory</a> 
    | <a href="../links.html" class="basemenu">Links</a> | <a href="../calendar.html" class="basemenu">Calendar</a> 
    | <a href="/indigentd.html" class="basemenu">Indigent Defense</a><br>
    <a href="http://ocdla.org/contact.html" class="basemenu">Contact</a> | <a href="../cart/index.cfm">Store</a> | 
    <a href="http://ocdla.org/sitemap.html" class="basemenu">Site Map</a><br>
    <br>
    OCDLA &#8226; 96 E. Broadway, Suite 5&nbsp;&#8226; Eugene, OR 97401<br>
    (541) 686-8716 &#8226; Fax: (541) 686-2319 &#8226; <a href="mailto:info@ocdla.org">info@ocdla.org</a><br>
  </div>
</div>
      <p></p>
        <p>&nbsp;</p>
        </div>
    </td>
    <td width="100%" valign="top" height="100"> 
      <table width="170" border="0" cellspacing="0" cellpadding="3" align="right">
        <tr> 
          <td width="1" bgcolor="#557788"><img src="/images/spacer.gif" width="1" height="62"></td>
          <td width="143" valign="top" bgcolor="#557788"> 
            <p><a href="../cart/browse.cfm/category.Membership"><img src="/images/join.gif" width="51" height="18" vspace="5" border="0" alt="Join"></a><br>
              <span class="textwhite"><b>Life Member</b> $5,000<br>
              <b>Sustaining Member</b> $300/yr</span></p>
          </td>
        </tr>
        <tr> 
          <td colspan="2"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
