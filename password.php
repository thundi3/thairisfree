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
header("Content-type: text/html;  charset=TIS-620");
include ("session.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password</title>
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
</head>

<body bgcolor="#d4d4d4">
<p>&nbsp;</p>
<center>
  <p>Change Password User : <?php echo $username; ?></p></center>
<table width="37%" height="118" border="1" align="center">

<form id="form2" name="form2" method="post" action="passwordchange.php">
  <tr>
    <td width="56%" height="26" align="left" bgcolor="#0000FF"><strong><font color=white>Old Password</font></strong></td>
    <td width="44%">
      <input type="password" name="oldpassword" id="oldpassword" />
</td>
  </tr>
  <tr>
    <td height="26" align="left">New Password</td>
    <td>
      <input type="password" name="newpassword1" id="textfield2" />
</td>
  </tr>
  <tr>
    <td height="26" align="left">Re-type New Password </td>
    <td>
      <input type="password" name="newpassword2" id="textfield3" />
</td>
  </tr>
  <tr align="left">
    <td height="28" colspan="2" align="center">
      <input type="submit" name="button" id="button" value="Submit" />
    </td>
  </tr>
  </form>
</table>
<p>&nbsp;</p>
</body>
</html>
