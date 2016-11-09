<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 15 Sep 2013
# File name: order-changestatus.php
# Description :  Update db after change status in order-info.php
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

header("Content-type: text/html;  charset=TIS-620");
include "connectdb.php";
include "session.php";
include ("function.php");

$changestatus = $_POST['changestatus'];
$accession = $_POST['accession'];

if ($changestatus == 'TOREPORT')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='TOREPORT', PAGE='RADIOLOGIST' WHERE ACCESSION='$accession'";
	}
if ($changestatus == 'QC')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='QC', PAGE='EXAM ROOM' WHERE ACCESSION='$accession'";
	}
elseif ($changestatus == '1EXAMROOM')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='TOREPORT', PAGE='RADIOLOGIST' WHERE ACCESSION='$accession'";
	}
elseif ($changestatus == '1ORDER')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='TOREPORT', PAGE='RADIOLOGIST' WHERE ACCESSION='$accession'";
	}
elseif ($changestatus == 'CANCEL')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='CANCEL', USER_ID_CANCEL='$userid' WHERE ACCESSION='$accession'";
	}
elseif ($changestatus =='') 
	{
		echo "<center>You did not selected</center>";
		exit;
	}

mysql_query($sql);
//echo "<body bgcolor=gray>";
echo "<center>Order Changed to ".$changestatus."</center>";
echo "<center>Accession No : ".$accession."</center>";

?>
