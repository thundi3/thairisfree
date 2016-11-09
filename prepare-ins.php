<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 0.9
# File last modified: 8 Jan 2012
# File name: prepare-ins.php
# Description :  Insert preparation form to DB
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
include ("session.php");
include ("connectdb.php");

$MODALITY = $_POST['MODALITY'];
$NAME = $_POST['NAME'];
$BODYPART = $_POST['BODYPART'];
$DESCRIPT1 = $_POST['DESCRIPT1'];
$DESCRIPT2 = $_POST['DESCRIPT2'];

$sql2 = "INSERT INTO xray_preparation(NAME,MODALITY,BODY_PART,DESCRIPTION_THAI,DESCRIPTION_ENG) values ('$NAME','$MODALITY','$BODYPART','$DESCRIPT1','$DESCRIPT2')";
mysql_query($sql2);

echo "$MODALITY";
?>