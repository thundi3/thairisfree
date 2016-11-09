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
$URL=$_SERVER["HTTP_REFERER"];


$filename = $_POST['filename'];
$ACCESSION = $_POST['ACCESSION'];
$MRN = $_POST['MRN'];
$path = "document-uploads/uploads/".$ACCESSION."/".$filename;
echo $filename;

unlink($path);

echo "<br />File Deleted";

mysql_query("insert into xray_log (USER,IP,EVENT,URL,MRN,ACCESSION)VALUES ('$username','$IP','DELPICSCAN','$URL','$MRN','$ACCESSION')");

//order-info.php?ACCESSION=$ACCESSION
?>