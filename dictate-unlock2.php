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
include ("session.php");
include ("connectdb.php");
$ORDERID = $_GET['ORDERID'];
$USERID = $_GET['USERID'];
$sql ="select LOCKBY FROM xray_request_detail WHERE ID='$ORDERID'";
$result = mysql_query($sql);
while ($row =mysql_fetch_array($result))
	{
		$USERLOCKID = $row['LOCKBY'];
	}

if ($USERLOCKID == '')
	{
		echo "<form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'><input type=submit value=Start></form>";
	}

if (($USERLOCKID !== '')and ($USERLOCKID !== $userid)) 
	{
		echo "<center><img src=icon/lock.gif onClick=unlockexam2(".$row['ORDERID'].")></center>";
	}

if ($USERLOCKID == $userid)
	{
		$sql = "UPDATE xray_request_detail SET LOCKBY ='' WHERE xray_request_detail.ID = '$ORDERID'";
		mysql_query($sql);
		echo "<form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'><input type=submit value=Start></form>";
	}

?>