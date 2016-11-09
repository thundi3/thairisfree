<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: 
# Description :  
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
include "session.php";
header("Content-type: text/html;  charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->



<!--

body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: underline}
a:hover { color: #0099FF; text-decoration: underline}

-->

</style>

	<STYLE>
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation
			{
			background-color:#000000;
			text-align:center;
			vertical-align:center;
			text-decoration:none;
			color:#FFFFFF;
			font-weight:bold;
			}
	.TESTcpDayColumnHeader,
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation,
	.TESTcpCurrentMonthDate,
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDate,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDate,
	.TESTcpCurrentDateDisabled,
	.TESTcpTodayText,
	.TESTcpTodayTextDisabled,
	.TESTcpText
			{
			font-family:arial;
			font-size:8pt;
			}
	TD.TESTcpDayColumnHeader
			{
			text-align:right;
			border:solid thin #6677DD;
			border-width:0 0 1 0;
			}
	.TESTcpCurrentMonthDate,
	.TESTcpOtherMonthDate,
	.TESTcpCurrentDate
			{
			text-align:right;
			text-decoration:none;
			}
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDateDisabled
			{
			color:#D0D0D0;
			text-align:right;
			text-decoration:line-through;
			}
	.TESTcpCurrentMonthDate
			{
			color:#6677DD;
			font-weight:bold;
			}
	.TESTcpCurrentDate
			{
			color: #FFFFFF;
			font-weight:bold;
			}
	.TESTcpOtherMonthDate
			{
			color:#808080;
			}
	TD.TESTcpCurrentDate
			{
			color:#FFFFFF;
			background-color: #6677DD;
			border-width:1;
			border:solid thin #000000;
			}
	TD.TESTcpCurrentDateDisabled
			{
			border-width:1;
			border:solid thin #FFAAAA;
			}
	TD.TESTcpTodayText,
	TD.TESTcpTodayTextDisabled
			{
			border:solid thin #6677DD;
			border-width:1 0 0 0;
			}
	A.TESTcpTodayText,
	SPAN.TESTcpTodayTextDisabled
			{
			height:20px;
			}
	A.TESTcpTodayText
			{
			color:#6677DD;
			font-weight:bold;
			}
	SPAN.TESTcpTodayTextDisabled
			{
			color:#FFFFFF;
			}
	.TESTcpBorder
			{
			border:solid thin #000000;
			}
</STYLE>
<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  
		<script type="text/javascript" src='Scripts/jquery-1.4.4.js'></script>
		<script type="text/javascript" src="Scripts/jquery.jclock.js"></script>  

	<script type="text/javascript">
    $(function($) {
       var options = {
            timeNotation: '12h',
            am_pm: true,
            fontFamily: 'Verdana',
            fontSize: '16px',
            foreground: 'black'
          }; 
       $('.jclock').jclock(options);
    });
    </script>     

</head>


<body bgcolor="#d4d4d4">

<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Registration</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif">
            	<div class="jclock" style="float:left; margin:5px 10px;" ></div>
				</td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<br/>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Search Patient</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle">Find</font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchpatient" method="post" action="regis_search.php" accept-charset="UTF-8">
          <p><font face="MS Sans Serif">MRN   </font> <font face="MS Sans Serif">
            <input type="text" name="mrn">
          </font></p>
          <p><font face="MS Sans Serif">N</font><font face="MS Sans Serif">ame
              <input type="text" name="fname" value="">Lastname </font>
            <input type="text" name="lname"><br />
            <center><input type="submit" name="Submit" value="Search"></center>
          </p>
        </form></td>
      </tr>
    </table>
	
	</td>
  </tr>
</table>

<br />

<table width="794" border="0" cellpadding="0" cellspacing="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Create new patient</td></tr>
  <tr>
    <td width="561"><table width="100%" border="0" cellspacing="1" cellpadding="0">
      <form name="form2" method="post" action="regis.php">
        <tr>
          <td width="43%"><font face="MS Sans Serif"></font></td>
          <td width="57%"><font face="MS Sans Serif"></font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000">MRN</font></td>
          <td width="57%"><input type="text" name="mrn" maxlength="10"></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000">XN</font></td>
          <td width="57%"><input type="text" name="xn" maxlength="10"></td>
        </tr>
        
        
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000">Firstname</font></td>
          <td width="57%"><input type="text" name="fname" maxlength="100"></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000">Lastname</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="lname" maxlength="100">
          </font></td>
          </tr>
          <!--
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#000000">Middle  Name</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="mname" maxlength="100">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">Name (English)</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="efname" maxlength="100" >
          </font></td>
        </tr>
        
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">Lastname (English)</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="elname" maxlength="100" >
          </font></td>
        </tr>
        -->
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">SSN</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="ID" size="20" maxlength="13">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#FF0000">Sex</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="radio" name="sex" value="M">
            Male
            <input type="radio" name="sex" value="F">
            Female
            <input type="radio" name="sex" value="U">
            Unknow</font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="red">Date of birth</font></td>
          <td width="57%"><font face="MS Sans Serif">

<SCRIPT LANGUAGE="JavaScript" ID="js18">
var cal18 = new CalendarPopup("testdiv1");
cal18.setCssPrefix("TEST");
</SCRIPT>


<INPUT TYPE="text" NAME="dob" VALUE="" SIZE=10>
<a href='#'><img src=image/calandar.jpg border='0' onClick="cal18.select(document.forms[1].dob,'anchor18','dd/MM/yyyy'); return false;" TITLE="dd/MM/yyyy" NAME="anchor18" ID="anchor18"></a>


<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>

        </font></td>
        </tr>
        <tr>
          <td width="43%" valign="top" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#000000">Address</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <textarea name="address"></textarea>
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">Road</font></td>
          <td width="57%"><input type="text" name="road" maxlength="100"></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">City</font></td>
          <td width="57%"><input type="text" name="tambon2"></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font color="#000000" face="MS Sans Serif">State</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="ampher" maxlength="100">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font color="#000000" face="MS Sans Serif">Province</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="province" maxlength="100">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#000000">Post Code</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="postcode2" maxlength="100">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#000000">Country</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <select name="country" disabled readonly>
              <option>Other</option>
			  <option>Thailand</option>
              <option>England</option>
			  <option>Other</option>
            </select>
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#000000">Phone</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="telephone" maxlength="100">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#000000">Fax</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="fax" maxlength="100">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif" color="#000000">Email</font></td>
          <td width="57%"><font face="MS Sans Serif">
            <input type="text" name="email" maxlength="100">
          </font></td>
        </tr>
        <tr>
          <td width="43%" bgcolor="#F0F0F0"><font face="MS Sans Serif">Note</font></td>
          <td width="57%" valign="top"><textarea name="note" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
          <td colspan="2" bgcolor="#F0F0F0"><p>&nbsp;</p>
            <p align="center">
              <input type="reset" name="Submit4" value="Clear">
              <input type="submit" name="Submit4" value="OK">
            </p>
            <p>&nbsp;</p></td>
        </tr>
   
    </table></td>
	
	
	
	
	
    <td width="388" valign="top">
      <table width="325" border="0" cellpadding="0" cellspacing="1">
      <tr>
        <td width="105"  bgcolor="#F0F0F0">Creatinine</td>

        <td >
          <input type="text" name="textfield" id="textfield">
        </td>
      </tr>
      <tr>
        <td bgcolor="#F0F0F0">Lab Date</td>
		<td>
          <input type="text" name="textfield5" id="textfield5"></td>
      </tr>
      <tr>
        <td bgcolor="#F0F0F0">Medical alert</td>
        <td><input type="text" name="textfield2" id="textfield2"></td>
      </tr>
      <tr>
        <td bgcolor="#F0F0F0">Height</td>
        <td><input type="text" name="textfield3" id="textfield3"></td>
      </tr>
      <tr>
        <td bgcolor="#F0F0F0">Weight</td>
        <td><input type="text" name="textfield4" id="textfield4"></td>
      </tr>
    </table>
	
	
	<br/>
	
	

	<table border=0>
	<tr>	<td width="388" valign="top" bgcolor="#F0F0F0">Patient type</td></tr>
	<tr><td>
                    <input type="checkbox" name="walk" id="walk" disabled readonly>
                    W
            alk
<input type="checkbox" name="slide" id="slide" disabled readonly>
Slide
					<input type="checkbox" name="wheel" id="wheel" disabled readonly>
					Wheel chair<br/>
					<input type="checkbox" name="stretcher" id="stretcher" disabled readonly>Strecher
					<input type="checkbox" name="bed" id="bed" disabled readonly>Bed
					<input type="checkbox" name="o2" id="o2" disabled readonly>O2
					<input type="checkbox" name="portable" id="portable" disabled readonly>Portable
	</td></tr>
     <tr><td bgcolor="#F0F0F0">Medical alert</td></tr>
     <tr><td>        
                    <input type="checkbox" name="pregnancy" id="pregnancy" disabled readonly>Pregnancy
					<input type="checkbox" name="allergy" id="allergy" disabled readonly>Allergy
	                <label>
	                  <input type="text" name="allergy2" id="allergy2" disabled readonly/>
            </label></td></tr>
	<tr><td bgcolor="#F0F0F0">Type</td></tr>
     <tr>
       <td>
					
			<label>
			  <input type="radio" name="radio" id="ipd" value="ipd" disabled readonly/>
		    </label>
			OPD
			<label>
			  <input type="radio" name="radio" id="ipd2" value="ipd" disabled readonly/>
		    </label>
IPD
<label>
  <input type="radio" name="radio" id="emergency" value="emergency" disabled readonly/>
</label>
Emergency </td></tr>
    </table>
	
	
	
    <p>&nbsp;</p></td>
  </tr>
  
  </FORM>
</table>

<p>&nbsp; </p>
<script language=javascript>
document.searchpatient.mrn.focus();
  </script>
</body>

</html>

