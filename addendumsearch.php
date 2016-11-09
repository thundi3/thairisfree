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
$mrn = $_GET['HN'];

//echo "<div id=showsearch>";
$result = mysql_query("SELECT xray_patient_info.MRN,
						xray_patient_info.NAME,
						xray_patient_info.LASTNAME 
						FROM xray_patient_info 
						WHERE 
						(xray_patient_info.MRN LIKE '%$mrn%') 
						AND (xray_patient_info.NAME LIKE '%$fname%') 
						AND (xray_patient_info.LASTNAME LIKE '%$lname%') 
						AND (xray_patient_info.CENTER_CODE ='$center_code') LIMIT 0 , 999");

echo "<table border='0' cellspacing='1' width=100%>\n
<tr bgcolor=#CCCCCC>\n
<td><center>HN</center></td>\n
<td><center>Firstname</center></td>\n
<td><center>Lastname</center></td>\n
<td><center></center></td>\n
</tr>";
$count = 0;
while($row = mysql_fetch_array($result))
  {
	$count = $count+1;
	$MRN = $row['MRN'];
	echo "<tr>";
	echo "<td align=right>$MRN</td>";
	echo "<td>" . $row['NAME'] . "</td>";
	echo "<td>" . $row['LASTNAME'] . "</td>";
	echo "<td>";
	echo "<a href=addendumselect.php?MRN=$MRN>$MRN</a>";
  	echo "</td></tr>";
  }

echo "</table>";

if ($row = 0 )
	{
		echo "Patient not found </br> \n";
	}
	
//echo "</div>";
echo "Total : ".$count;
?>