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
$timenow = time();
$datestart = $_POST['date1'];
$dateend = $_POST['date2'];

///// Check total search days /////	
if ($datestart == '' OR $dateend == '')
	{
		echo "Please input date";
		exit;
	}

$daterange1 = strtotime($datestart);
$daterange2 = strtotime($dateend);
$daterange1 = date('Ymd',$daterange1);
$daterange2 = date('Ymd',$daterange2);
$daterange = $daterange2 - $daterange1;	
echo "Total date search : ".$daterange." days<br >";

if ($daterange > 180)
	{
		echo "Don't serch date more than 6 months </br>";
		echo "System will slow down </br>";
		echo "<a href=query.php>Back to Query </a>";
		exit;
	}
	
////////////////////////////////
	
$strExcelFileName="Workload-ThaiRIS_".time().".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$sql_select = "
SELECT
xray_request_detail.ACCESSION,
xray_patient_info.MRN,
xray_patient_info.PREFIX AS PAT_PREFIX,
xray_patient_info.NAME AS PAT_NAME,
xray_patient_info.LASTNAME AS PAT_LASTNAME,
xray_patient_info.SEX AS PAT_SEX,
xray_request_detail.REQUEST_DATE,
xray_request_detail.REQUEST_TIME,
xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
xray_request_detail.APPROVED_TIME AS APPROVE, 
xray_request_detail.XRAY_CODE,
xray_code.DESCRIPTION,
xray_code.XRAY_TYPE_CODE,
xray_department.NAME_THAI AS DEP,	
xray_report.APPROVE_DATE,
xray_report.APPROVE_TIME,
xray_user.NAME AS DOCTOR_NAME,
xray_user.LASTNAME AS DOCTOR_LASTNAME
FROM
xray_report
Left Join xray_user ON xray_user.ID = xray_report.APPROVE_BY
Left Join xray_request ON xray_request.REQUEST_NO = xray_report.ACCESSION
Left Join xray_request_detail ON xray_request_detail.ACCESSION = xray_report.ACCESSION
Left Join xray_patient_info ON xray_patient_info.MRN = xray_request.MRN
Left Join xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE
LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
WHERE
(xray_report.APPROVE_DATE BETWEEN  '$datestart' AND '$dateend') 
";

$sql = mysql_query($sql_select);
$num = mysql_num_rows($sql);


function timeDiff($firstTime,$lastTime)
		{
			// convert to unix timestamps
			$firstTime=strtotime($firstTime);
			$lastTime=strtotime($lastTime);
			// perform subtraction to get the difference (in seconds) between times
			$timeDiff=$lastTime-$firstTime;
			// return the difference
			return $timeDiff;
		}
		
?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"xmlns="http://www.w3.org/TR/REC-html40">
 
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<strong>Report Query Date <?php echo date("d/m/Y");?> Order <?php echo number_format($num);?> Studies</strong><br>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
<tr>
<td><strong>ACCESSION</strong></td>
<td><strong>MRN</strong></td>
<td><strong>NAME</strong></td>
<td><strong>SEX</strong></td>
<td><strong>REQUEST DATE</strong></td>
<td><strong>REQUEST TIME</strong></td>
<td><strong>XRAY CODE</strong></td>
<td><strong>XRAY TYPE</strong></td>
<td><strong>DESCRIPTION</strong></td>
<td><strong>Department</strong></td>
<td><strong>APPROVE DATE</strong></td>
<td><strong>APPROVE TIME</strong></td>
<td><strong>Radiologist</strong></td>
<td><strong>Turn arround Time (Arrived To Approved)</strong></td>
</tr>
<?php
if($num>0)
	{
		while($row=mysql_fetch_array($sql))
			{
				$time_arrival = $row['ARRIVAL'];
				$time_approve = $row['APPROVE'];
				$time_diff = timeDiff($time_arrival,$time_approve);
				// Convert to text
				$years = abs(floor($time_diff / 31536000));
				$days = abs(floor(($time_diff-($years * 31536000))/86400));
				$hours = abs(floor(($time_diff-($years * 31536000)-($days * 86400))/3600));
				$mins = abs(floor(($time_diff-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($time_diff / 60);
?>
<tr>
<td><?php echo $row['ACCESSION'];?></td>
<td><?php echo $row['MRN'];?></td>
<td><?php echo $row['PAT_PREFIX']." ".$row['PAT_NAME']." ".$row['PAT_LASTNAME'];?></td>
<td><?php echo $row['PAT_SEX'];?></td>
<td><?php echo $row['REQUEST_DATE'];?></td>
<td><?php echo $row['REQUEST_TIME'];?></td>
<td><?php echo $row['XRAY_CODE'];?></td>
<td><?php echo $row['XRAY_TYPE_CODE'];?></td>
<td><?php echo $row['DESCRIPTION'];?></td>
<td><?php echo $row['DEP'];?></td>
<td><?php echo $row['APPROVE_DATE'];?></td>
<td><?php echo $row['APPROVE_TIME'];?></td>
<td><?php echo $row['DOCTOR_NAME']." ".$row['DOCTOR_LASTNAME'];?></td>
<td><?php echo $days . " Days, " . $hours . " Hours, " . $mins; ?>Minutes</td>
</tr>
<?php
			}
		$IP=getenv(REMOTE_ADDR);
		$URL=$_SERVER["HTTP_REFERER"];
		mysql_query("insert into xray_log (USER,IP,EVENT,URL)VALUES ('$userlogin','$IP','Export Report','$URL')");
	}
?>
</table>
</div>
<script>
window.onbeforeunload = function(){return false;};
setTimeout(function(){window.close();}, 10000);
</script>
</body>
</html>