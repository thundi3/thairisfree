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

$code = trim($_POST['code']);
$name = trim($_POST['name']);
$name_eng = trim($_POST['name_eng']);


echo "$code";
echo "$name";
echo "$name_eng";

if($code == '' or $name =='' or $name_eng =='')
	{
		echo "Please input Code , Name and English Name";
		exit;
	}

 $strSQL = ("SELECT CODE FROM xray_center WHERE CODE ='$code'");
 $objQuery = mysql_query($strSQL);
 $objResult = mysql_fetch_array($objQuery);
 if ($objResult)
 {
	echo  "<font color=red>Center already exit</font>";
	}
	

$code = strtoupper($code);

$sql_insert_center = "insert INTO xray_center (CODE,NAME,NAME_ENG)VALUES('$code','$name','$name_eng')";
mysql_query($sql_insert_center);

?>
<meta HTTP-EQUIV="REFRESH" content="0; url=center.php">