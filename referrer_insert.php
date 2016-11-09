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
$code = trim($_POST[code]);
$name = trim($_POST[name]);
$lastname = trim($_POST[lastname]);
$name_eng = trim($_POST[name_eng]);
$lastname_eng = trim($_POST[lastname_eng]);
include "connectdb.php";

echo "$code";
echo "$name";
echo "$lastname";
echo "$name_eng";
echo "$lastname_eng";

$sql_insert_refer = "insert INTO xray_referrer (REFERRER_ID,NAME,LASTNAME,NAME_ENG,LASTNAME_ENG)VALUES('$code','$name','$lastname','$name_eng','$lastname_eng')";
mysql_query($sql_insert_refer);

?>
