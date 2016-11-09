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
include "session.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   

</head>
<body bgcolor="#d4d4d4">
<br />

<br/>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Search Patient</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><center><img src="./images/icoSearch.png"></center><br />Search Patient</font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchpatient" method="post" action="search-all2.php" accept-charset="UTF-8">
          <p><font face="MS Sans Serif">MRN</font> 
            <input type="text" name="mrn" value="">
          <font face="MS Sans Serif">Accession </font> <input type="text" name="accession" value=""></p>
          <p><font face="MS Sans Serif">NAME</font><font face="MS Sans Serif">           
            <input type="text" name="fname" value="">
                LASTNAME </font>
            <input type="text" name="lname" value="">
            <input type="submit" name="Submit" value="Search">
          </p>
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
</table>

<br />
<br />
<script language=javascript>
document.searchpatient.mrn.focus();
</script>
</body>

</html>

