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
$ACCESSION = $_GET['ACCESSION'];

include ("session.php");
include ("connectdb.php");
include ("function.php");

echo "PATIENT MRN=".$MRN."<br />";

$sql = "select MRN, NAME, LASTNAME, NAME_ENG, LASTNAME_ENG, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
echo "Best Fit for Schedule<br />";
echo "<br />";
echo "Select Room<br />";
echo "Select date <br />";

echo "======test=======> Addvance <a href=scheduler/php-examples/calendar.php?ACCESSION=".$ACCESSION."> ACCESSION ".$ACCESSION;
?>