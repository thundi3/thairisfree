<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 19 July 2015
# File name: examroom-assignrad.php
# Description :  
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
$ID = $_GET['ID']; //
$TYPE = $_GET['TYPE'];
$RADID = $_GET['RADID'];

//$TYPE ='START';

include "connectdb.php";
include "session.php";
  	mysql_query("UPDATE xray_request_detail SET STATUS='TOREPORT',PAGE='RADIOLOGIST',ASSIGN='$RADID' ,ASSIGN_BY='$userid' WHERE ID=$ID");
	$sql ="select * FROM xray_user WHERE CODE ='$RADID'";
	$result = mysql_query($sql);
		while($row = mysql_fetch_array($result))
		{
			$radname = $row[NAME];
		}

   //echo "RID=".$RADID."ID=".$ID;
   if ($RADID=='0')
	{
		echo "Not Assign";
		exit;
	}
   echo "<img src=icons/arrow-turn-000-left.png><font color=green><b>Assigned to : ".$radname."</b></font>";
   exit;




?>