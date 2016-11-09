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
$TEMPLATE_ID = $_POST['TEMPLATE_ID'];
$URL=$_SERVER["HTTP_REFERER"];


include ("session.php");
include "connectdb.php";
header("Content-type: text/html;  charset=TIS-620");
echo $TEMPLATE_ID;
mysql_query("DELETE FROM  xray_report_template  WHERE ID=$TEMPLATE_ID");
echo "<br>\n Template Deleated";


?>