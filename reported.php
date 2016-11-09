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
include "connectdb.php";
include "session.php";
include ("function.php");
$searchbox = $_POST['searchbox'];
$searchdate = $_POST['searchdate'];
$datestart = $_POST['date001'];
$dateend = $_POST['date002'];
$searchtoday = $_POST['today'];
$todaytype = $_POST['todaytype'];
$searchhn = $_POST['searchhn'];
$searchxn = $_POST['searchxn'];
$searchname = $_POST['searchname'];
$searchlast = $_POST['searchlast'];

?>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type="text/javascript"></script>  

<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
<STYLE>
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation
			{
			background-color:#000000;
			text-align:center;
			vertical-align:center;
			text-decoration:none;
			color:#FFFFFF;
			font-weight:bold;
			}
	.TESTcpDayColumnHeader,
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation,
	.TESTcpCurrentMonthDate,
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDate,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDate,
	.TESTcpCurrentDateDisabled,
	.TESTcpTodayText,
	.TESTcpTodayTextDisabled,
	.TESTcpText
			{
			font-family:arial;
			font-size:8pt;
			}
	TD.TESTcpDayColumnHeader
			{
			text-align:right;
			border:solid thin #6677DD;
			border-width:0 0 1 0;
			}
	.TESTcpCurrentMonthDate,
	.TESTcpOtherMonthDate,
	.TESTcpCurrentDate
			{
			text-align:right;
			text-decoration:none;
			}
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDateDisabled
			{
			color:#D0D0D0;
			text-align:right;
			text-decoration:line-through;
			}
	.TESTcpCurrentMonthDate
			{
			color:#6677DD;
			font-weight:bold;
			}
	.TESTcpCurrentDate
			{
			color: #FFFFFF;
			font-weight:bold;
			}
	.TESTcpOtherMonthDate
			{
			color:#808080;
			}
	TD.TESTcpCurrentDate
			{
			color:#FFFFFF;
			background-color: #6677DD;
			border-width:1;
			border:solid thin #000000;
			}
	TD.TESTcpCurrentDateDisabled
			{
			border-width:1;
			border:solid thin #FFAAAA;
			}
	TD.TESTcpTodayText,
	TD.TESTcpTodayTextDisabled
			{
			border:solid thin #6677DD;
			border-width:1 0 0 0;
			}
	A.TESTcpTodayText,
	SPAN.TESTcpTodayTextDisabled
			{
			height:20px;
			}
	A.TESTcpTodayText
			{
			color:#6677DD;
			font-weight:bold;
			}
	SPAN.TESTcpTodayTextDisabled
			{
			color:#FFFFFF;
			}
	.TESTcpBorder
			{
			border:solid thin #000000;
			}
</STYLE>

<body bgcolor="gray">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Show Reported</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />
<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: underline}
a:hover { color: #0099FF; text-decoration: underline}

-->

</style>
<script type="text/JavaScript" src="orderlist.js"></script>

<script type="text/javascript" language="javascript">
function doDelete(ORDERID) {
    if (confirm("Do you really want to delete?")) {
	var ORDERID;
	//      window.location.href ="main.php";	
	      window.location.href ="deleteorder.php?ORDERID="+ORDERID;
    }
  
}
</script>
<center>
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Search Patient</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><center><img src="./images/icoSearch.png"></center><br />Search Patient</font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchpatient" method="post" action="search-all2.php" accept-charset="UTF-8">
          <p><font face="MS Sans Serif">MRN</font> <font face="MS Sans Serif">
            <input type="text" name="mrn"><font face="MS Sans Serif">Acession</font> <font face="MS Sans Serif">
            <input type="text" name="acc">
          </font></p>
          <p><font face="MS Sans Serif">Name<input type="text" name="fname" value="">Lastname</font>
            <input type="text" name="lname"></p>
			<p><center>
            <input type="submit" name="Submit" value="Search">
			</center>
          </p>
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
</table>
</center>
<br />
<?php


$resultdate = mysql_query("select curdate()");
$rowdate=mysql_fetch_array($resultdate);
$today = $rowdate[0];


echo "<body bgcolor=gray>";
//echo "<p>Report Today ".$today."</p>";
$sql = "SELECT xray_patient_info.MRN, 
		xray_patient_info.CENTER_CODE, 
		xray_request_detail.ID  AS ORDERID,
		xray_request_detail.REQUEST_DATE AS REQ_DATE,
		xray_request_detail.REQUEST_TIME AS REQ_TIME, 
		xray_request_detail.REQUEST_NO AS REQNUMBER, 
		xray_request_detail.ACCESSION,xray_request_detail.STATUS, 
		xray_request_detail.URGENT, xray_patient_info.NAME AS PTNAME, 
		xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,
		xray_request.REQUEST_NO, 
		xray_patient_info.LASTNAME  AS PTLASTNAME, 
		xray_patient_info.NAME_ENG AS NAMEENG, 
		xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
		xray_patient_info.BIRTH_DATE, 
		xray_code.DESCRIPTION, 
		xray_report.APPROVE_BY,
		xray_report.APPROVE_DATE AS REPORT_DATE,
		xray_report.APPROVE_TIME AS REPORT_TIME,
		xray_referrer.NAME, 
		xray_referrer.LASTNAME, 
		xray_user.NAME AS REPORTBY
		FROM  xray_request 
		LEFT JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO) 
		LEFT JOIN xray_report ON (xray_report.ACCESSION = xray_request_detail.ACCESSION) 
		LEFT JOIN xray_patient_info ON (xray_patient_info.MRN = xray_request.MRN) 
		LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
		LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
		RIGHT JOIN xray_user ON (xray_user.ID = xray_report.APPROVE_BY)
		LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
		WHERE (xray_request_detail.STATUS = 'APPROVED') AND
		xray_request_detail.REQUEST_DATE = DATE(NOW()) AND
		(xray_patient_info.CENTER_CODE ='$center_code')order by REPORT_TIME ASC";

$result = mysql_query($sql);

// HN patient_info.MRN
// REQNUMBER xray_request.REQUEST_NO
// ACCESSION xray_request_detail.ACCESSION
// PATIENT NAME patient_info.NAME AS PTNAME
// REQUEST DATE xray_request_detail.REQUEST_DATE AS REQ_DATE
// REQUEST TIME xray_request_detail.REQUEST_TIME AS REQ_TIME
// PATIENT LASTNAME patient_info.LASTNAME  AS PTLASTNAME
// xray_patient_info.BIRTH_DATE	
// XRAY DESCRIPTION xray_code.DESCRIPTION AS DESCRIPTION
// PHYSICIAN NAME xray_referrer.NAME
// PHYSICIAN LASTNAME xray_referrer.LASTNAME
// DEPARTMENT xray_department.NAMETHAI
// XRAY CODE xray_code.XRAY_CODE
// ORDERID xray_request_detail.ID
// NAMEENG xray_request_info.NAME_ENG
// LASTNAMEENG  xray_request_info.LASTNAME_ENG

echo "<table border='0' cellspacing='1' bgcolor='#79acf3' width=100%>

<tr>
<th><font color=white>ICON</font></th>
<th><font color=white>MRN (HN)</font></th>
<!--<th>REQ</th>-->
<th><font color=white>ACC</font></th>
<th><font color=white>Patient</font></th>
<th><font color=white>Procedure</font></th>
<th><font color=white>Physician</font></th>
<th><font color=white>Report Time</font></th>
<th><font color=white>Report By</font></th>
</tr>\n";

$bg ="#FFCCCC";
$count = 0;
while($row = mysql_fetch_array($result))

  {


if($bg == "#FFFFFF") 
	{ //
		$bg = "#C8C8C8";
	} 
	else 
	{
		$bg = "#FFFFFF";
	}

 
 $count = $count+1;
 echo "<tr bgcolor=$bg>";
 echo "<td><center><a href=showreport.php?ACCESSION=".$row['ACCESSION']." target=_blank><img src=./image/report.gif border='0'></a></center></td>";
 echo "<td>" .$row['MRN'] . "</td>";
 //echo "<td>".$row[REQUEST_NO]."</td>";
 //echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ORDID=".$row[MRN]."','mywindow1','scrollbars=yes,resizable=yes,screenX=0,screenY=100,width=600,height=500')\"></a> ".$row[ACCESSION]."</td>";
 echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ORDID=".$row['MRN']."&ACCESSION=".$row['ACCESSION']."','mywindow1','scrollbars=yes,resizable=yes,width=750,height=600')\"></a> ".$row['ACCESSION']."</td>";
 echo "<td><a href='#'><img border=0 src=./image/folder.png onClick=\"window.open('patient-info.php?MRN=".$row['MRN']."','mywindow2','scrollbars=yes,resizable=yes,width=750,height=600')\"></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
//if ($row[NAMEENG] =='' or $row[LASTNAMEENG] ==''){
if ($row['NAMEENG'] == $row['MRN'] or $row['LASTNAMEENG'] == $row['MRN'] or $row['NAMEENG'] =='' or $row['LASTNAMEENG'] ==''){
	//echo "<font color=red> No Eng</font>";

 }
 $birthday = $row['BIRTH_DATE'];
 echo AgeCal($birthday);
 echo "</td>";
 echo "<td>".$row['DESCRIPTION']."</td>";
 echo "<td>".$row['NAME']." ".$row['LASTNAME'];
 echo "</td>";
 //echo "<td>".$row[ORDERTIME].$row[STATUS]."</td>";
 echo "<td>".EngEachDate($row['REPORT_DATE'])." ".$row['REPORT_TIME']."</td>";
 echo "<td>".$row['REPORTBY']."</td>";





//else {
//	echo "<td>Pleae check order status or contact administrator</td>";
//}
  echo "</tr>\n";	

  }
echo "</table>";
echo "All Study=".$count;
echo "<div id=test></div>";
//echo "</br>";

//echo $datestart.$dateend;
//echo "lllll=".$searchdate;



//echo "<br>Today : ".$today;
//echo "<br>Todaysearch = ".$searchtoday.$todaytype;
//echo "<br> Center Code".$center_code;
echo "<center><font color=white>ThaiRIS.net</font></center>";

?>
</body>