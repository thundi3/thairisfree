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
session_start(); 
$sessionID = session_id();
$username = $_POST['user']; 
$username = trim($username);
$userpassword = $_POST['password']; 
include ("connectdb.php");
$sql = "select LOGIN, PASSWORD FROM xray_user WHERE LOGIN='$username'and PASSWORD='$userpassword'";
$result = mysql_query($sql); 
$numrows = (mysql_num_rows($result));
if($numrows == 1)
	{
		$updatelogin = '';
		mysql_query("update xray_user SET SESSION ='$updatelogin' WHERE SESSION ='$sessionID'");
		mysql_query("update xray_user SET SESSION ='$sessionID'");
		//ถ้าถูกต้อง 
		$_SESSION['logged_in'] = 1; 
		$_SESSION['USER'] = $username;
		//echo $username;
		//echo "<br>".$userpassword;
		header("Location: index2.html");
		exit;
	} 
if ($numrows == 0) 
	{ 
		//ถ้าไม่ถูกต้องให้กลับไปหน้าแรก 
		//echo "xxxxx";
		header("Location: login.html"); 
		exit;
	} 
?>
