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
$ORDERID = $_GET['ORDERID'];
include ("session.php");
include "connectdb.php";
header("Content-type: text/html;  charset=TIS-620");
echo $ORDERID;

//mysql_query("UPDATE xray_request_detail SET STATUS='CANCEL',USER_ID_CANCEL=$userid WHERE ID=$ORDERID");

echo "<br>\n Order Deleated";

echo "ใส่เหตุผล";


?>