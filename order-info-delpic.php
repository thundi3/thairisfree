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
$filename = $_GET['filename'];
$ACCESSION = $_GET['ACCESSION'];
$MRN = $_GET['MRN'];
$path = "document-uploads/uploads/".$ACCESSION."/";


echo "<body bgcolor=#E8E8E8>";	
echo "<center> Delete Image</center>";
echo "<center><table>";
echo "<tr><td>";
echo "<img src=$path/$filename width=350><br />";
echo "<center>Filename : $filename </center>";
echo "</td>";
echo "<td>";
echo "<form action=order-info-delpic2.php method=post>";
echo "<input type=hidden name=filename value=$filename>";
echo "<input type=hidden name=ACCESSION value=$ACCESSION>";
echo "<input type=hidden name=MRN value=$MRN>";
echo "<input type=submit>";
echo "Delete this images";
echo "</td></tr></table>";


?>