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
include "connectdb.php";

mysql_select_db($dbname,$dbconnect);

$CODE = $_POST['CODE'];
$DESCRIPTION = $_POST['DESCRIPTION'];
$XRAY_TYPE = $_PORT['x'];
$BODY_PART = $_PORT['x'];
$CHARGE_TOTLE = $_PORT['x'];
$PORTABEL_CHARGE = $_PORT['x'];
$DF = $_PORT['x'];
$TIME_USE = $_PORT['x'];
$BIRAD_FLAG = $_PORT['x'];


echo $DESCRIPTION;
?>
