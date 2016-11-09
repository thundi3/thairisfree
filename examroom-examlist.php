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
header("Content-type: text/html;  charset=TIS-620");
$ID = $_GET['ID']; 
$TYPE = $_GET['TYPE'];
$ORDERID = isset($_GET['ORDERID']);
$ACCESSION = isset($_GET['ACCESSION']);
$MRN = $_GET['MRN'];

include "connectdb.php";

$sql = "SELECT 
			xray_request.MRN, 
			xray_request_detail.ACCESSION
			FROM xray_request
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
			WHERE xray_request_detail.ID='$ID'";

$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
	{
		$ACC = $row['ACCESSION'];
		$MRN = $row['MRN'];
	}	

if ($TYPE=='STARTED')
	{
		mysql_query("UPDATE xray_request_detail SET STATUS='STARTED',  START_TIME= NOW() WHERE ID=$ID");
		echo "<input type=button name=Start value=COMPLETE onclick=pt_arrive('".$ID."','QC')>";
		exit;
	}

if ($TYPE=='QC') 
			{		
				mysql_query("UPDATE xray_request_detail SET STATUS='QC',COMPLETE_TIME=NOW() WHERE ID=$ID");			
				echo "<td>";
				echo "<a class=\"fancybox fancybox.iframe\" href=qc.php?ACCESSION=".$ACC."&ORDERID=".$ID."&MRN=".$MRN.">";
				echo "<input id=\"demo_box_1\" type=\"checkbox\" /> <button type=button class=\"positive\" value=\"QC\"><img src=\"images/chart_bar_edit.png\" alt=\"\" border=0 /> QC </button></a>\n";
				echo "</td>";
			}			

if ($TYPE=='ENDEXAM') 
			{		
				mysql_query("UPDATE xray_request_detail SET STATUS='QC', COMPLETE_TIME=NOW() WHERE ID=$ID");			
				echo "<td>";
				echo "<a class=\"fancybox fancybox.iframe\" href=qc.php?ACCESSION=".$ACC."&ORDERID=".$ID." >";
				echo "<input id=\"demo_box_1\" type=\"checkbox\" /> <button type=button class=\"positive\" value=\"QC\"><img src=\"images/chart_bar_edit.png\" alt=\"\" border=0 /> QC </button></a>\n";
				echo "</td>";
			}		
			
//if ($TYPE=='ENDEXAM')
//	{
//		mysql_query("UPDATE xray_request_detail SET STATUS='ENDEXAM' WHERE ID=$ID");
//		$sql2 ="select * FROM xray_user WHERE USER_TYPE_CODE ='RADIOLOGIST' ORDER BY NAME";
//		$result2 = mysql_query($sql2);
//		echo "<select name=selectrad id=selectrad".$ID.">";
//		echo "<option value=''>Select Radiologist</option> ";
//		while ($row =mysql_fetch_array($result2))
//			{
//				echo "<option name=radid value=\"".$row[CODE]."\">".$row[NAME]."  ".$row[LASTNAME]."</option>";
//			}
//		echo "</select><input type=button name=Start value=ASSIGN onclick=assignrad('".$ID."','ASSIGN')> ENDEXAM";
//		exit;
//	}
	
if ($TYPE=='ASSIGN')
	{
		echo "ASSIGN TO RADIOLOGIST";
	}

?>