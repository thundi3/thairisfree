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
$ACCESSION = $_GET['ACCESSION'];

echo "Select Stock type";
echo "Contrast : Films : Needle : Cathetor : Others";


?>