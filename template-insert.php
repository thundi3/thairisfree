<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: template-insert.php
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

$templateid = $_GET['templateid'];
//$templateOwner = $_GET['templateOwner'];
include ("connectdb.php");

$sql = "select REPORT_DETAIL FROM xray_report_template where ID = '$templateid'";
$result = mysql_query($sql);

while($row = mysql_fetch_array($result)){
	echo $row['REPORT_DETAIL'];
	
}
   //eho "Template ID = ".$templateid;
?>