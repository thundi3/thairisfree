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
include ("session.php");
include ("connectdb.php");
include ("function.php");
echo "<div id=showsearch>";
$MRN = $_GET['MRN'];
echo $MRN."<br />";
echo "Select Order to edit Report";
$sql = "SELECT xray_request_detail.ACCESSION, xray_request_detail.XRAY_CODE, xray_request_detail.STATUS, xray_request_detail.ID  AS ORDERID, xray_request_detail.REQUEST_DATE AS REQ_DATE, xray_request_detail.REPORT_STATUS, xray_code.DESCRIPTION FROM xray_request_detail LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO AND xray_request.MRN = '$MRN')INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) where (xray_request_detail.STATUS = 'APPROVED')";
$result = mysql_query($sql);
$bg ="#FFCCCC";
echo "<center><table width=100%>";
while($row = mysql_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ // Switch colour of background
				$bg = "#FFCCCC";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		if ($row['REPORT_STATUS']=='1')
			{
				$report_icon ="<a href=showreport.php?ACCESSION=".$row['ACCESSION']." target=_blank><img src=./image/report.gif border=0></a> <a href=showreportpdf.php?ACCESSION=".$row['ACCESSION']." target=_blank><img src=./image/pdf.gif border=0></a>";
			}
		else 
			{
				$report_icon ="-";
			}
		$ORDERID = $row['ORDERID'];
		echo "<tr bgcolor=".$bg."><td width=45>".$report_icon."</td><td>".EngEachDate($row['REQ_DATE'])."</td><td>".$row['ACCESSION']."</td><td>".$row['XRAY_CODE']."</td><td>".$row['DESCRIPTION']."</td><td>";
		echo "<form action=addendum-dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'>ORDERID =".$ORDERID."<input type=submit value=Addendum></form></td></tr>";
	}
echo "</table></center>";
echo "</div>";
?>