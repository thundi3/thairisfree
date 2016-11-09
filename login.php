<?php
session_start(); 
$sessionID = session_id();
$userlogin = $_POST['userlogin']; 
$userlogin = trim($userlogin);
$userpassword = $_POST['password'];
$userpassword = md5($userpassword);
$_SESSION[ID] = $sessionID;


include ("connectdb.php");
$sql = "select LOGIN, PASSWORD, USER_TYPE_CODE, ENABLE FROM xray_user WHERE LOGIN='$userlogin'and PASSWORD='$userpassword'";
$result = mysql_query($sql); // 


while($row = mysql_fetch_array($result))
	{
		$ENABLE = $row['ENABLE'];
		$usertype = $row['USER_TYPE_CODE'];
		if ($ENABLE == 0) 
			{
				header("Location: login.html");
				exit;
			}
	}
$numrows = (mysql_num_rows($result));
if($numrows == 1)
	{ 
		$updatelogin = ''; //Clear Session previous login
		mysql_query("update xray_user SET SESSION ='' WHERE SESSION ='$sessionID'");
		mysql_query("update xray_user SET SESSION ='$sessionID', LOGINTIME=NOW() WHERE LOGIN='$userlogin'");

		$_SESSION['userlogin']= $userlogin; 
		$IP=getenv(REMOTE_ADDR);
		$URL=$_SERVER["HTTP_REFERER"];
		mysql_query("insert into xray_log (USER,IP,EVENT,URL)VALUES ('$userlogin','$IP','LOGIN','$URL')");
		//if ($usertype == 'RADIOLOGIST')
		//	{
		//		header("Location: main2.php");
		//		exit;
		//	}
		header("Location: main.html");
		//echo $_SESSION['ID'];
		exit;
	} 
if ($numrows == 0) 
	{ 
		header("Location: index.html"); 
		exit;
	} 
?>
