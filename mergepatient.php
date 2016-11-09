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
include "connectdb.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Merge Patient</title>
<style type="text/css">
<!--
body {
	background-color: #d4d4d4;
}
-->
</style>
</head>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 

<link href="css/main.css" rel="stylesheet" type="text/css" />
<body>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Merge Patient</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<br/>
<table width="90%" border="0" align="center">
  <tr>
    <td colspan="2" align="center" bgcolor="#79acf3"><strong>Merge Patient</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#f8d290"><img src="icons/tick-red.png" width="16" height="16" /><strong> Correct Patient </strong>(Right)</td>
    <td align="center" bgcolor="#f8d290"><img src="icons/cross-script.png" width="16" height="16" /><strong> InCorrect Patient </strong>(Wrong)</td>
  </tr>
  <tr>
    <td valign="top" bgcolor="#FFFFFF"><form id="form1" name="form1" method="post" action="">
      <p>
        <label>
          MRN
          <input name="MRN" type="text" id="MRN" size="10" maxlength="20" />
          NAME
          <input name="textfield" type="text" id="textfield" size="20" maxlength="50" />
        </label>
      </p>
      <p>LASTNAME
        <label>
          <input name="textfield2" type="text" id="textfield2" size="20" />
        </label>
      DOB
      <label>
        <input name="textfield3" type="text" id="textfield3" size="10" />
      </label>
      <label>
        <input type="submit" name="Search" id="Search" value="Search" />
      </label>
      </p>
    </form>
      <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td valign="top" bgcolor="#FFFFFF"><form id="form2" name="form1" method="post" action="">
      <p>
        <label>MRN
          <input name="MRN2" type="text" id="MRN2" size="10" maxlength="20" />
          NAME
          <input name="textfield4" type="text" id="textfield4" size="20" maxlength="50" />
        </label>
      </p>
      <p>LASTNAME
        <label>
          <input name="textfield4" type="text" id="textfield5" size="20" />
        </label>
        DOB
        <label>
          <input name="textfield4" type="text" id="textfield6" size="10" />
        </label>
        <label>
          <input type="submit" name="Search2" id="Search2" value="Search" />
        </label>
      </p>
    </form>
    <p></p></td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top" bgcolor="#f8d290"><input type="submit" name="button" id="button" value="Merge" /></td>
  </tr>
</table>
<form id="form3" name="form3" method="post" action="">
</form>
<p>&nbsp;</p>
</body>
</html>
