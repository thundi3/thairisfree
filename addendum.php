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
include "connectdb.php";
include ("function.php");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
	<script language=JavaScript src="addendum.js" type=text/javascript></script>
</head>
<body bgcolor="#d4d4d4">
<center>
<table border=0 widht=70%>
<tr bgcolor="#79acf3"> <td> Search Patient order for Addendum </td></tr>
<tr bgcolor=#f8d290><td><form name="form1"accept-charset="UTF-8">
          <p><font face="MS Sans Serif">Search 
		  <br />MRN </font>
		  <font face="MS Sans Serif">
            <input type="text" name="mrn">
          </font></p>
          <p><font face="MS Sans Serif">Name
            <input type="text" name="fname" value="">  Lastname</font>
            <input type="text" name="lname">
            <input type="button" value="Search" onclick="searchedit()">
          </p>
        </form></td>
</tr>
<tr><td>
<div id=showsearch></div>
</td></tr>
</table>
</center>
