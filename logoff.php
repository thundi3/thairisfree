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
include ("connectdb.php");
mysql_query("update xray_user SET SESSION ='' WHERE SESSION ='$sessionID'");
$URL=$_SERVER["HTTP_REFERER"];
mysql_query("insert into xray_log (USER,IP,EVENT,URL)VALUES ('$userlogin','$IP','LOGOUT','$URL')");
header("Location: index.html"); 
?>