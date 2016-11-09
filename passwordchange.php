<?php
include "session.php";
include "connectdb.php";
echo "<html><head><title>Change Password</title>";
?>

    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   

<?php
echo "</head><body bgcolor=\"#d4d4d4\">";

//$OLDPASS = $_POST[oldpassword];
//$NEWPASS1 = $_POST[newpassword1];
//$NEWPASS2 = $_POST[newpassword2];

$OLDPASS = trim($_POST[oldpassword]);
$OLDPASS = md5($OLDPASS);
$NEWPASS1 = trim($_POST[newpassword1]);
$NEWPASS1 = md5($NEWPASS1);
$NEWPASS2 = trim($_POST[newpassword2]);
$NEWPASS2 = md5($NEWPASS2);



$sql = "SELECT LOGIN,PASSWORD FROM xray_user WHERE LOGIN='$userlogin'";
$result =mysql_query($sql);
while($row=mysql_fetch_array($result))
	{
		$PASSWORD1 = $row['PASSWORD'];
	}

if (!($OLDPASS == $PASSWORD1))
	{
		//echo $OLDPASS;
		//echo "<br>";
		echo "<font color=red><center>Wrong Old Password</center></font>";
		exit;
	}

if (!($NEWPASS1 == $NEWPASS2)){
	echo "Please check New Password";
	exit;
}

$sql = "UPDATE xray_user SET PASSWORD = '$NEWPASS1' WHERE LOGIN = '$userlogin'";
mysql_query($sql);
/////////////INSERT LOG/////////////
$URL=$_SERVER["HTTP_REFERER"];
mysql_query("insert into xray_log (USER,IP,EVENT,URL)VALUES ('$userlogin','$IP','CHANGEPASSWORD','$URL')");
echo "PASSWORD Changed";
echo "<br> Please LogOut and LogIN";
exit;



?>

<CENTER>
<FORM>
<INPUT type="button" value="Close Window" onClick="window.close()">
</FORM>
</CENTER>
</body>
</htmL>