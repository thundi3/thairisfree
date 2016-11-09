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
include "session.php";
$MRN = $_GET['MRN'];
$ACCESSION = $_GET['ACCESSION'];
$XRAYCODE = $_GET['XRAYCODE'];


echo "<body bgcolor=#E8E8E8>";	
echo "MRN : ".$MRN;
echo "<br />";
echo "CODE : ".$XRAYCODE."<br />";
echo "ภาษาไทย ภาษาอังกฤษ";
?>