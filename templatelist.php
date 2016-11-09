<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 0.9
# File last modified: 8 Nov 2016
# File name: templatelistt.php
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

include ("connectdb.php");
include ("session.php");
$templateMo = $_GET['templateMo'];
$templateOwner = $_GET['templateOwner'];
$templateBodyPart = $_GET['bodypart'];
$MOTYPE = $_GET['MOTYPE'];
$type = $_GET['type'];
$textsearch = $_GET['text'];
$procbodypart = $_GET['procbodypart'];

if (($templateMo =='ALL') and ($templateOwner !=''))
	{
		$sql = "select ID,NAME FROM xray_report_template where USER_ID='$userid'";
		$result = mysql_query($sql);
	}
if ($templateOwner =='')
	{
		$sql = "select ID,NAME FROM xray_report_template where XRAY_TYPE_CODE='$MOTYPE' and USER_ID='$userid'";
		$result = mysql_query($sql);
	}
if ($procbodypart !='')
	{
		$sql = "select ID,NAME FROM xray_report_template where XRAY_TYPE_CODE='$MOTYPE' and USER_ID='$userid' and BODY_PART='$procbodypart'";
		$result = mysql_query($sql);
	}
if ($templateOwner !='')
	{
		$sql = "select ID,NAME FROM xray_report_template where USER_ID='$templateOwner'";
		$result = mysql_query($sql);
	}
if (($templateOwner !='') and ($templateMo !=''))
	{
		$sql = "select ID,NAME FROM xray_report_template where USER_ID='$templateOwner' and XRAY_TYPE_CODE='$templateMo'";
		$result = mysql_query($sql);
	}
if (($templateOwner =='ALL') and ($templateMo !=''))
	{
		$sql = "select ID,NAME FROM xray_report_template where ALL_USER='1' and XRAY_TYPE_CODE='$templateMo'";//where USER_ID='$templateOwner'";
		$result = mysql_query($sql);
	}
if ($templateMo =='ALL')
	{
		$sql = "select ID,NAME FROM xray_report_template where USER_ID='$templateOwner' ";//where USER_ID='$templateOwner'";
		$result = mysql_query($sql);
	}
if (($templateBodyPart !='') and ($templateOwner !='') and ($templateMo !=''))
	{
		$sql = "select ID,NAME FROM xray_report_template where BODY_PART='$templateBodyPart' and USER_ID='$templateOwner' and XRAY_TYPE_CODE='$templateMo'";//where USER_ID='$templateOwner'";
		$result = mysql_query($sql);
	}
if ($type == 'search')
	{
		$sql = "select ID,NAME FROM xray_report_template WHERE NAME LIKE '%$textsearch%' and USER_ID='$userid'";
		//$sql = "select ID,NAME FROM xray_report_template";
		$result = mysql_query($sql);
	}
if (($type == 'search') and ($templateOwner =='ALLxx'))
	{
		$sql = "select ID,NAME FROM xray_report_template WHERE NAME LIKE '%$textsearch%'";
		//$sql = "select ID,NAME FROM xray_report_template";
		$result = mysql_query($sql);
	}
	
echo "<SELECT id=selectid SIZE=10 style=\"background-color:#FFFFDD;width:183px\" onChange=showtemplate2()>";

while($row = mysql_fetch_array($result))
	{
		//echo "<OPTION VALUE=\"".$row['ID']."\" >".$row['ID'].". ".$row['NAME']."</OPTION>\n";
		echo "<OPTION VALUE=\"".$row['ID']."\" >".$row['NAME']."</OPTION>\n";
	}
echo "<OPTION>-</OPTION>\n";
echo "</SELECT>\n";
echo "<div id=templateshow></div>\n";

////echo "<OPTION VALUE=\"".$row[ID]."\" onclick=\"doReplace(".$row[ID].")\">".$row[ID].". ".$row[NAME]."</OPTION>\n";
?>