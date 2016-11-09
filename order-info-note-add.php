<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: order-info-not-add.php
# Description :  Add note in order
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
include "connectdb.php";
$EXAMNOTE =$_GET['examnote'];
$REQUEST_NO = $_GET['REQUEST_NO'];
$ACCESSION =  $_GET['ACCESSION'];
$MRN = $_GET['MRN'];
mysql_query("UPDATE xray_request SET NOTE ='$EXAMNOTE' WHERE  REQUEST_NO ='$REQUEST_NO'");

echo "Done<br />";
echo "MRN = ".$MRN;
echo "<br /> Order ID = ".$REQUEST_NO;
echo "<br />";
echo $EXAMNOTE;

echo "<script type=\"text/javascript\">";
echo "	window.location=\"order-info.php?ACCESSION=$ACCESSION&MRN=$MRN\" ";
echo "</script>";


?>