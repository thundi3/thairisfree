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
$MOD = $_GET['MODALITY'];

include ("session.php");
include "connectdb.php";


$sql ="select BODY_PART from xray_body_part";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
echo "Body Part : <SELECT NAME=\"BODYPART\"><OPTION VALUE=\"\"></OPTION>\n";
while($row = mysql_fetch_array($result)){
	echo "<OPTION value='".$row['BODY_PART']."'>".$row['BODY_PART']."</OPTION>\n";
}
echo "</SELECT>";

$sql ="select XRAY_CODE, DESCRIPTION from xray_code where XRAY_TYPE_CODE = '$MOD'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
echo "OR : <SELECT NAME=\"PROCEDURE\"><OPTION VALUE=\"\"></OPTION>";
while($row = mysql_fetch_array($result)){
	echo "<OPTION value='".$row['XRAY_CODE']."'>".$row['DESCRIPTION']."</OPTION>";
}
echo "</SELECT>";
?>