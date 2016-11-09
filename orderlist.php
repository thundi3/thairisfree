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

$ID = $_GET['ID']; 
$TYPE = $_GET['TYPE'];

include "connectdb.php";

if ($TYPE=='ARRIVAL')
	{
		mysql_query("UPDATE xray_request_detail SET STATUS='ARRIVAL', ARRIVAL_TIME =now() WHERE ID=$ID");
		mysql_query("UPDATE xray_request_detail SET STATUS='READY', PAGE = 'EXAM ROOM' WHERE ID=$ID"); // For no ready step
		mysql_query("UPDATE xray_request_detail SET READY_TIME=now() WHERE ID=$ID"); // For no ready step
		echo "<font color=red>Waiting</font>";		 // For no ready step
		//echo "<input type=button name=Start value=READY onclick=pt_arrive('".$ID."','READY')>"; // For ready step
		exit;
	}

if ($TYPE=='READY')
	{
		mysql_query("UPDATE xray_request_detail SET STATUS='READY', PAGE = 'EXAM ROOM' WHERE ID=$ID");
		mysql_query("UPDATE xray_request_detail SET READY_TIME=now() WHERE ID=$ID");
		echo "<font color=red>Waiting</font>";
		exit;

	}
?>