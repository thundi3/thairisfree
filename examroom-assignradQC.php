<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 1 Feb 2013
# File name: examroom-assignrad.php
# Description :  
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
header("Content-type: text/html;  charset=TIS-620");

$ID = $_GET['ORDERID']; //
$TYPE = $_GET['TYPE'];
$RADID = $_GET['selectrad'];
$TECH1 = $_GET['tech1'];
$TECH2 = $_GET['tech2'];
$TECH3 = $_GET['tech3'];
$FLAG1 =$_GET['readtime'];
$FLAG2 = $_GET['flag02']; // special
$EXAMNOTE =$_GET['examnote'];
$READ_BOOK = $_GET['dateInput'];

$READ_BOOK = date('Y-m-d', strtotime($READ_BOOK));

if ($READ_BOOK == '1970-01-01') 
	{
		$READ_BOOK ='';
	}

//echo $READ_BOOK;
//exit;
//$TYPE ='START';

include "connectdb.php";
include "session.php";
$result = mysql_query("SELECT REQUEST_NO FROM xray_request_detail WHERE ID='$ID'");
$REQ_NO = mysql_result($result, 0);

echo "<body bgcolor=#E8E8E8 >";
  	mysql_query("UPDATE xray_request_detail SET STATUS='TOREPORT',PAGE='RADIOLOGIST',ASSIGN_TIME = NOW(), ASSIGN='$RADID', ASSIGN_BY='$userid',TECH1='$TECH1', TECH2='$TECH2', TECH3='$TECH3', FLAG1='$FLAG1', FLAG2='$FLAG2', REPORT_BOOK='$READ_BOOK' WHERE ID=$ID");
	mysql_query("UPDATE xray_request SET NOTE ='$EXAMNOTE' WHERE  REQUEST_NO ='$REQ_NO'");
	
echo "<center><table><tr><td>";
//echo "ID=".$ID;
//echo "Type=".$TYPE;
//echo "RADID=".$RADID;
//echo "<br>Read TIME =".$READTIME;

$result1 = mysql_query("SELECT NAME, LASTNAME FROM xray_user WHERE ID='$TECH1'");
$TECH1 = mysql_result($result1, 0);

if ($TECH2 !== '')
	{
		$result2 = mysql_query("SELECT NAME, LASTNAME FROM xray_user WHERE ID='$TECH2'");
		$TECH2 = mysql_result($result2, 0);
	}
	
if ($TECH3 !== '')
	{
		$result3 = mysql_query("SELECT NAME, LASTNAME FROM xray_user WHERE ID='$TECH3'");
		$TECH3 = mysql_result($result3, 0);
	}
//$result2 = mysql_query("SELECT NAME, LASTNAME FROM xray_user WHERE ID='$TECH2'");
//$TECH2 = mysql_result($result2, 0);
//$result3 = mysql_query("SELECT NAME, LASTNAME FROM xray_user WHERE ID='$TECH3'");
//$TECH3 = mysql_result($result3, 0);
echo "<center><b><font color=green>QC Infomation</font></b></center>";
echo "<br> Technician1 : ".$TECH1;
echo "<br> Technician2 : ".$TECH2;
echo "<br> Technician3 : ".$TECH3;
echo "<br> kadee :  ".$FLAG01;
echo "<br> Rad id : ".$RADID;
echo "<br> Exam note : ".$EXAMNOTE;
echo "</td></tr></table></center>";

?>

<center><a href="javascript:parent.jQuery.fancybox.close();"><input type=button value=Close></a></center>
</body>