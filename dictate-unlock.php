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
include "connectdb.php";

$ORDERID = $_GET['ORDERID'];
$sql = "UPDATE xray_request_detail SET LOCKBY ='' WHERE xray_request_detail.ID = '$ORDERID'";
mysql_query($sql);
//echo "<form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'><input type=submit value=Start></form>";
echo "Unlock Done!";

?>