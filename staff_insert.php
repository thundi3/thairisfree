<?php
include "session.php";
include "connectdb.php";
$center_code = trim($_POST[center_code]);
$user_type = trim($_POST[user_type]);
$loginname = trim($_POST[loginname]);
$code = trim($_POST[code]);
$dfcode = trim($_PORT[dfcode]);
$name = trim($_POST[name]);
$lastname = trim($_POST[lastname]);
$name_eng = trim($_POST[name_eng]);
$lastname_eng = trim($_POST[lastname_eng]);
$password = trim($_POST[password]);
$password = md5($password);
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<body bgcolor="#d4d4d4">

<?php

echo "<strong><a href=staff_new.php>Add New Start</a> </strong><br />";
$sql = "insert INTO xray_user (CODE, DF_CODE, LOGIN, NAME,LASTNAME,NAME_ENG,LASTNAME_ENG, USER_TYPE_CODE, PASSWORD, CENTER_CODE) 
			VALUES
			('$code','$dfcode','$loginname','$name','$lastname','$name_eng','$lastname_eng','$user_type','$password','$center_code')";
mysql_query($sql);

$sql = "insert INTO xray_user_right (SUPER_ADMIN) VALUES ('0')";
mysql_query($sql);
//echo $sql;

?>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Add New Staff</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle"><br />New Staff Insert</font></td>
	
    <td width="587" bgcolor="#f8d290">

	<?php
echo "<br />";

echo "Add username : $username $lastname <br />";
echo "Login : $loginname <br />";
echo "Center : $center_code <br /> User Type : $user_type <br />";
?>





</td></tr>
</table>
<?php
/*

ID
CODE
DF_CODE
LOGIN
NAME
LASTNAME
NAME_ENG
LASTNAME_ENG
USER_TYPE_CODE
PREFIX
PASSWORD
CENTER_CODE
CREATED_TIME
SESSION
ENABLE
ALL_CENTER
LOGINTIME
TEXT_SIGNATURE
*/

?>