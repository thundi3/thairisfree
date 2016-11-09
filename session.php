<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified:  12 OCT 2016
# File name: session.php
# Description :  Session file
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
session_start();
$sessionID = session_id();
include ('connectdb.php');
$IP=getenv('REMOTE_ADDR');
// IF Incorrect SESSION go to Login 
$sql ="select SESSION FROM xray_user WHERE SESSION = '$sessionID'";
$result = mysql_query($sql);
$numrows = (mysql_num_rows($result));
if ($numrows == 0)
	{
		echo "<center>Session Expried or duplicate login</center>";
		echo "<script type=\"text/javascript\">top.location.href = 'index.html';</script>";
		exit;
	}

$userlogin = $_SESSION['userlogin']; 
$sql2 = "select ID,CODE,DF_CODE, LOGIN,NAME,LASTNAME,USER_TYPE_CODE,CENTER_CODE, LOGINTIME, PACS_LOGIN  FROM xray_user WHERE LOGIN ='$userlogin'";
$userlogin =strtoupper($userlogin);
$result2 = mysql_query($sql2);
$numrows = (mysql_num_rows($result2));
if($numrows == 0)
	{
		echo "<center>Session Expried or duplicate login</center>";
		echo "<script type=\"text/javascript\">top.location.href = 'index.html';</script>";
		exit;
	}
while($row = mysql_fetch_array($result2)) 
	{
		$userid = $row['ID'];
		$usercode = $row['CODE'];
		$df_code = $row['DF_CODE'];
		$username = $row['NAME'];
		$userlastname = $row['LASTNAME'];
		$usertype = $row['USER_TYPE_CODE'];
		$usercenter = $row['CENTER_CODE'];
		$logintime = $row['LOGINTIME'];
		$pacs_login = $row['PACS_LOGIN'];
	}
	
$sql = "SELECT CODE, NAME, NAME_ENG FROM xray_center WHERE CODE = '$usercenter'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result))
	{
		$center_code = $row['CODE'];
		$center_name = $row['NAME'];
		$center_name_eng = $row['NAME_ENG'];
	}

$sql = "SELECT * FROM xray_user_right WHERE USER_ID ='$userid'";
$result = mysql_query($sql);
while ($row = mysql_fetch_array($result))
	{
		$superadmin = $row['SUPER_ADMIN'];
		$admin = $row['ADMIN'];
		$delete_order = $row['DELETE_ORDER'];
		$change_status = $row['CHANGE_STATUS'];
		$edit_patient = $row['EDIT_PATIENT'];
	}

/////////////////////////// User For Desktop Integration PACS /////////////////////////	
	
if ($pacs_login =='')
		{
			$pacs_login = "doctorstation";
		}

?>