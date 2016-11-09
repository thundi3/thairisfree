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
include "connectdb.php";
mysql_query("delete FROM xray_request");
mysql_query("delete FROM xray_request_detail");
mysql_query("delete FROM xray_report");
echo "Deleated All Order";
?>