<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: order-info-note.php
# Description :  Show Note from Order
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
$REQUEST_NO = $_GET['REQUEST_NO'];
$ACCESSION = $_GET['ACCESSION'];
$MRN = $_GET['MRN'];
include "connectdb.php";

$sql2 = "select   
			xray_request.NOTE
			from xray_request_detail 
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO)			
			WHERE xray_request_detail.ACCESSION='$ACCESSION'";
$result2= mysql_query($sql2);
while($row2 = mysql_fetch_array($result2))
		{
			$NOTE = $row2['NOTE'];
		}

echo "<table width=100 align=center><tr><td>";
echo "ORDER = ".$REQUEST_NO;
echo "<br />";
echo "ACCESSION = ".$ACCESSION;
echo "<br />";
echo "<form action=order-info-note-add.php>";
echo "<input type=hidden name=REQUEST_NO value=$REQUEST_NO>";
echo "<input type=hidden name=ACCESSION value=$ACCESSION>";
echo "<input type=hidden name=MRN value=$MRN>";
echo "<textarea name=examnote rows=\"15\" cols=\"20\">$NOTE</textarea>";
echo "<br />";
echo "<input type=submit value=Submit>";
echo "</form>";
echo "</td></tr></table>";
?>