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
$id = trim($_POST['id']);

include "connectdb.php";

$sql_del_refer = "delete FROM xray_referrer where ID='$id'";
mysql_query($sql_del_refer);


?>