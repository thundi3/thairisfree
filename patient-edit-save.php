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
include ("function.php");

$MRN = $_GET['MRN'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$firstnameeng = $_GET['firstnameeng'];
$lastnameeng = $_GET['lastnameeng'];

echo $firstname.$lastname;
echo "MRN= ".$MRN;

$sql = "UPDATE xray_patient_info SET NAME='$firstname' where MRN='$MRN'";
mysql_query($sql);


//$sql = "select MRN, NAME, LASTNAME, NAME_ENG, LASTNAME_ENG, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
//$result = mysql_query($sql);
//$row = mysql_fetch_array($result);

?>