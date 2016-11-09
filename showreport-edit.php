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
include ("connectdb.php");
include ("function.php");
$ACCESSION = $_GET[ACCESSION];
$ID = $_GET[ID];
//include "session.php";


		$sql = "SELECT 
			xray_request_detail.ACCESSION, 
			xray_patient_info.NAME, 
			xray_patient_info.LASTNAME, 
			xray_patient_info.MRN, 
			xray_patient_info.SEX, 
			xray_patient_info.BIRTH_DATE, 
			xray_code.DESCRIPTION, 
			xray_department.NAME_THAI,
			xray_request_detail.ARRIVAL_TIME,
			xray_report.APPROVE_TIME AS APPROVED_TIME,
			xray_report.APPROVE_DATE AS APPROVED_DATE,
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


if ($ID !=='')
	{
		$sql = "SELECT 
			xray_request_detail.ACCESSION, 
			xray_patient_info.NAME, 
			xray_patient_info.LASTNAME, 
			xray_patient_info.MRN, 
			xray_patient_info.SEX, 
			xray_patient_info.BIRTH_DATE, 
			xray_code.DESCRIPTION, 
			xray_department.NAME_THAI,
			xray_request_detail.ARRIVAL_TIME,
			xray_report.APPROVE_TIME AS APPROVED_TIME,
			xray_report.APPROVE_DATE AS APPROVED_DATE,
			xray_report.REPORT,
			xray_user.NAME AS APPROVE_BY,
			xray_user.LASTNAME AS AP_LAST,
			xray_referrer.NAME AS RNAME,
			xray_referrer.LASTNAME AS RLAST
			FROM xray_report 
			INNER JOIN xray_request ON xray_report.ACCESSION = '$ACCESSION' AND xray_report.ID = '$ID'
			INNER JOIN xray_request_detail ON xray_report.ACCESSION=xray_request_detail.ACCESSION AND xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
			INNER JOIN xray_patient_info ON xray_request.MRN = xray_patient_info.MRN 
			INNER JOIN xray_code ON xray_request_detail.XRAY_CODE=xray_code.XRAY_CODE
			INNER JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID
			INNER JOIN xray_user ON xray_report.APPROVE_BY = xray_user.ID
			INNER JOIN xray_referrer on xray_request.REFERRER = xray_referrer.REFERRER_ID";
	}

$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
	{
		$acc = $row[ACCESSION];
		$ptname = $row[NAME];
		$ptlastname = $row[LASTNAME];
		$report =$row[REPORT];
		$MRN= $row[MRN];
		$procedure = $row[DESCRIPTION];
		$examtime =$row[ARRIVAL_TIME];
		$approvetime = $row[APPROVED_TIME];
		$approvedate = $row[APPROVED_DATE];
		$approveby = $row[APPROVE_BY];
		$approve_lastname = $row[AP_LAST];
		$department = $row[NAME_THAI];
		$referrer = $row[REFERRER];
		$AGE = $row[BIRTH_DATE];
		$sex = $row[SEX];
		$refer_name = $row[RNAME];
		$refer_last = $row[RLAST];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Radiology Report Police Hospital : HN <?php echo $MRN; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<script>
function printpage()
  {
  window.print()
  }
</script>

<?php
$approvetime = $approvetime." ".$approvedate;
echo "<body bgcolor=gray>";
echo "<center>";
echo "<table bgcolor=#FFFFFF width=800 >";
echo "<tr><td>";
echo "<center><img src=image/banner-report.jpg></center>";
echo "<center>";
echo "<table width=800>";
echo "<tr><td width=10%>Name</td><td width=30%>: ".$ptname."  ".$ptlastname."</td><td width=10%>Report Time</td><td width=50%>: ".DateThai02($approvetime)."</td></tr>";
echo "<tr><td width=10%>Age</td><td width=30%>: ".AgeCal($AGE)."  Sex : ".$sex."</td><td width=10%>Exam Time</td><td width=50%>: ".DateThai02($examtime)."</tr>";
echo "<tr><td width=10%>HN</td><td width=30%>: ".$MRN."</td><td width=10%>Order</td><td width=50%>: ".$procedure."</td></tr>";
echo "<tr><td width=10%>Accession</td><td width=30%> : ".$acc."</td><td width=10%>Department </td><td width=50%>: ".$department."</td></tr></table></center>";
echo "<center><table width=800><tr><td>";
echo "<hr><font size=+1>";
echo $report;
echo "</font><hr>";
echo "</td></tr></table></center>";
echo "<center><table width=800><tr><td width=50%>Report By : ".$approveby." ".$approve_lastname."</td><td width 50%>Physician : ".$refer_name." ".$refer_last."</td></tr><table></center>";
echo "</td></tr></table></center>";
//echo "<center><input type=\"button\" value=\"Print this Report\" onclick=\"printpage()\" /></center>";
echo "</body>";

?>
