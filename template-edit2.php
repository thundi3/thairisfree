<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: template-edit2.php
# Description : Show Template after select from template-edit.php
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

header("Content-type: text/html;  charset=TIS-620");
$MOD = $_GET['MODALITY'];

include ("session.php");
include "connectdb.php";

$sql = "SELECT ID, NAME, XRAY_TYPE_CODE from xray_report_template WHERE  XRAY_TYPE_CODE = '$MOD' AND USER_ID = '$userid'";
//$sql ="select XRAY_CODE, DESCRIPTION from xray_code where XRAY_TYPE_CODE = '$MOD'";
$result = mysql_query($sql);

//$row = mysql_fetch_array($result);

echo "<table>";
while($row = mysql_fetch_array($result))
	{
		echo "<tr><td>".$row['NAME']."</td><td>".$row['XRAY_TYPE_CODE']."</td>";
		echo "<td><a class=\"fancybox fancybox.iframe\" href=template-view.php?TEMPLATE_ID=".$row['ID']."><button type=button class=\"positive\" value=\"View\"><img src=\"images/magnifier.png\" alt=\"\"/> View</button></a></td>";
		echo "<td><a class=\"fancybox fancybox.iframe\" href=template-delete.php?TEMPLATE_ID=".$row['ID']."><button type=button class=\"positive\" value=\"Delete\"><img src=\"images/magnifier.png\" alt=\"\"/> Delete</button></a></td>";
		echo "<td><a class=\"fancybox fancybox.iframe\" href=template-edit-show.php?TEMPLATE_ID=".$row['ID']."><button type=button class=\"positive\" value=\"edit\"><img src=\"images/magnifier.png\" alt=\"\"/> Edit </button></a></td>";
		echo "</tr>";
	}

echo "</table>";



?>
