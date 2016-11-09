<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 24 FEB 2015
# File name: patient-info.php
# Description :  Show Patient Information
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
header("Content-type: text/html;  charset=TIS-620");
$MRN = $_GET['MRN'];
include ("session.php");
include ("connectdb.php");
include ("function.php");
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<body bgcolor="#E6E6E6" leftmargin="3">
<?php
$sql = "select MRN, NAME, LASTNAME, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

// Check Permission for edit patient //

echo "<center>";
echo "<table bgcolor=#f8d290 width=90% border=0 cellspacing=5>";
echo "<tr><td colspan=2 bgcolor=#DF7401><font color=white><b>Patient Infomation</b></font> : <a href=patient-edit.php?MRN=".$MRN.">Edit Info</a></td></tr>";
echo "<tr>";
echo "<td valign=top width=3% bgcolor=white><img src=icons/man.png></td>";
echo "<td valign=top width=97%>";
echo "NAME : ".$row['NAME']." ".$row['LASTNAME']."<br />";
echo "AGE : ".$row['BIRTH_DATE']."<br />";
echo "SEX : ".$row['SEX']."<br />";
echo "HN : ".$MRN;
echo "</td></tr></table>";
echo "</center><p></p>";

// REQUEST DATE xray_request_detail.REQUEST_DATE AS REQ_DATE
// REQUEST TIME xray_request_detail.REQUEST_TIME AS REQ_TIME

$sql = "SELECT xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE,
			xray_request_detail.STATUS,
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REPORT_STATUS, 
			xray_code.DESCRIPTION 
			FROM 
			xray_request_detail 
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO AND xray_request.MRN = '$MRN')
			INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)
			INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN)";
			
$result = mysql_query($sql);
$bg ="#FFCCCC";
echo "<center><table width=90%>";
echo "<tr bgcolor=#005fbf><td><font color=white><b>Report</b></font></td><td><font color=white><b>Study Date</b></font></td><td><font color=white><b>Accession</b></font></td><td><font color=white><b>Code</b></font></td><td><font color=white><b>Procedure</b></font></td><td><font color=white><b>Status</b></font></td><td><font color=white><b>View Image</b></font></td></b></font></tr>";
while($row = mysql_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ 
				$bg = "#A9BCF5";
			}
		else 
			{
				$bg = "#FFFFFF";
			}
		if ($row['REPORT_STATUS']=='1')
			{
				$report_icon ="<a href=showreport.php?ACCESSION=".$row['ACCESSION']." target=_blank><img src=./image/report.gif border=0></a><a href=showreportpdfA5.php?ACCESSION=".$row['ACCESSION']." target=_blank><img src=./icons/document-pdf-text.png border=0></a><a href=showreportpdf.php?ACCESSION=".$row['ACCESSION']." target=_blank><img src=./image/pdf.gif border=0></a>";
			}
		else 
			{
				$report_icon ="-";
			}
		$ACCESSION = $row['ACCESSION'];
		echo "<tr bgcolor=".$bg."><td width=65>".$report_icon."</td><td>".EngEachDate($row['REQ_DATE'])."</td><td><a href=order-info.php?ACCESSION=".$row['ACCESSION']."&MRN=".$MRN."><font color=black>".$row['ACCESSION']."</font></a></td><td>".$row['XRAY_CODE']."</td><td>".$row['DESCRIPTION']."</td><td>".$row['STATUS']."</td>";
			if (($row['STATUS'] == 'COMPLETE') OR ($row['STATUS'] == 'PRELIM') OR ($row['STATUS'] == 'APPROVED') OR ($row['STATUS'] == 'QC') OR ($row['STATUS'] == 'TOREPORT'))
			{
				echo  "<td><a href=http://127.0.0.1:8080/?AccessionID=$ACCESSION&UserName=doctorstation target=pacsResult><button type=button class=positive value=OpenImage><img src=images/eye.png width=12 alt=\"\" />
				Open Image</button></a></td></tr>";  
			}
			else
			{
				echo "<td></td></tr>";
			}
	}

echo "</table></center>";

?>
<iframe name="pacsResult" frameborder="0" width="0" height="0"></iframe>
<CENTER>
<FORM>
<INPUT type="button" value="Close Window" onClick="window.close()">
</FORM>
</CENTER>
