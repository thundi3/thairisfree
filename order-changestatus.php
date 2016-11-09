<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 15 Sep 2013
# File name: order-changestatus.php
# Description :  Update db after change status in order-info.php
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

header("Content-type: text/html;  charset=TIS-620");
include "connectdb.php";
include "session.php";
include ("function.php");

$changestatus = $_POST['changestatus'];
$ACCESSION = $_POST['accession'];
$MRN = $_POST['MRN'];

$sql = "SELECT 
			xray_request_detail.ACCESSION, 
			xray_patient_info.NAME, 
			xray_patient_info.LASTNAME, 
			xray_patient_info.MRN AS MRN,
			xray_patient_info.SEX, 
			xray_patient_info.BIRTH_DATE, 
			xray_code.DESCRIPTION, 
			xray_department.NAME_THAI,
			xray_request_detail.ARRIVAL_TIME,
			xray_request_detail.APPROVED_TIME,
			xray_report.REPORT,
			xray_user.NAME AS APPROVE_BY,
			xray_user.LASTNAME AS AP_LAST,
			xray_referrer.NAME AS RNAME,
			xray_referrer.LASTNAME AS RLAST
			FROM xray_report 
			INNER JOIN xray_request ON xray_report.ACCESSION = '$ACCESSION' 
			INNER JOIN xray_request_detail ON xray_report.ACCESSION=xray_request_detail.ACCESSION AND xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
			INNER JOIN xray_patient_info ON xray_request.MRN = xray_patient_info.MRN 
			INNER JOIN xray_code ON xray_request_detail.XRAY_CODE=xray_code.XRAY_CODE
			INNER JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID
			INNER JOIN xray_user ON xray_report.APPROVE_BY = xray_user.ID
			INNER JOIN xray_referrer on xray_request.REFERRER = xray_referrer.REFERRER_ID";
			

$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
	{
		$ACCESSION = $row['ACCESSION'];
		$ptname = $row['NAME'];
		$ptlastname = $row['LASTNAME'];
		$report =$row['REPORT'];
		$MRN= $row['MRN'];
		$procedure = $row['DESCRIPTION'];
		$examtime =$row['ARRIVAL_TIME'];
		$approvetime = $row['APPROVED_TIME'];
		$approveby = $row['APPROVE_BY'];
		$approve_lastname = $row['AP_LAST'];
		$department = $row['NAME_THAI'];
		$referrer = $row['REFERRER'];
		$dob = $row['BIRTH_DATE'];
		$sex = $row['SEX'];
		$refer_name = $row['RNAME'];
		$refer_last = $row['RLAST'];
	}
	
		$IP=getenv(REMOTE_ADDR);
		$URL=$_SERVER["HTTP_REFERER"];
	
if ($changestatus == 'TOREPORT')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='TOREPORT', PAGE='RADIOLOGIST' WHERE ACCESSION='$ACCESSION'";
	}
if ($changestatus == 'QC')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='QC', PAGE='EXAM ROOM' WHERE ACCESSION='$ACCESSION'";
	}
elseif ($changestatus == '1EXAMROOM')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='TOREPORT', PAGE='RADIOLOGIST' WHERE ACCESSION='$ACCESSION'";
	}
elseif ($changestatus == '1ORDER')
	{
		$sql = "UPDATE xray_request_detail SET STATUS='TOREPORT', PAGE='RADIOLOGIST' WHERE ACCESSION='$ACCESSION'";
	}
elseif ($changestatus == 'CANCEL')
	{
		mysql_query("insert into xray_log (USER,IP,EVENT,URL, MRN, ACCESSION)VALUES ('$userlogin','$IP','CANCEL ORDER','$URL', '$MRN', '$ACCESSION')");
		$sql = "UPDATE xray_request_detail SET STATUS='CANCEL', USER_ID_CANCEL='$userid' WHERE ACCESSION='$ACCESSION'";
		
				if ($CREATEHL7==1)
					{
					
					}
	}
elseif ($changestatus =='') 
	{
		echo "<center>You did not selected</center>";
		exit;
	}

mysql_query($sql);
//echo "<body bgcolor=gray>";
echo "<center>Order Changed to ".$changestatus."</center>";
echo "<center>Accession No : ".$ACCESSION."</center>";

?>
