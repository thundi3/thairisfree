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

$ACCESSION = $_GET['ACCESSION'];
include ("connectdb.php");

function conv($string) {
        return iconv('UTF-8', 'TIS-620', $string);
    }


$sql = "SELECT * FROM xray_report INNER JOIN xray_request ON xray_report.ACCESSION = '$ACCESSION' 
INNER JOIN xray_request_detail ON xray_report.ACCESSION=xray_request_detail.ACCESSION 
AND xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
INNER JOIN xray_patient_info ON xray_request.MRN = xray_patient_info.MRN 
INNER JOIN xray_code ON xray_request_detail.XRAY_CODE=xray_code.XRAY_CODE";

$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	$acc = $row['ACCESSION'];
	$ptname = $row['NAME'];
	$ptlastname = $row['LASTNAME'];
	$report =$row['REPORT'];
	$MRN= $row['MRN'];
	$procedure = $row['DESCRIPTION'];

}


?>


