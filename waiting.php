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
$searchdate = $_POST['searchdate'];
$datestart = $_POST['date001'];
$dateend = $_POST['date002'];
$searchtoday = $_POST['today'];
$todaytype = $_POST['todaytype'];

?>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
    <script language=JavaScript src="frames_body_array.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  
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
function doDelete() {
    if (confirm("Do you really want to delete?")) {
        window.location.href ="main.php";
    }
  
}
</script>

<body>
<img src=image/wait3.png>
Waiting Room
<FORM method="post" action="order.php" name="searchpatient">
 <INPUT TYPE=hidden NAME="searchbox" value="1">
<table width="100%" border="0" cellspacing="0" cellpadding="0" height="105">
  <tr> 
    <td height="136" valign="top" width="39%" bgcolor="#DDDDDD"> 
      <p><b>Search Order Xray </b></p>
      <p> HN <input type="text" name="textfield3">
          XN <input type="text" name="textfield4">
        </p>
      <p> Name <input type="text" name="textfield">
          Lastname <input type="text" name="textfield2">
        <input type="submit" name="Submit4" value="Search">
      </p>
    </td>
    <td height="136" valign="top" width="29%" bgcolor="#F7F7F7"> 
	</FORM>
	
	
      <p><b>Option Search Today</b></p>
	
	  <FORM method="post" action="order.php" name="searchbyMo">
	  <INPUT TYPE=hidden NAME="today" value="1">
      <p>Select 
        <select name="todaytype">
          <option value="ALL">All Today</option>
          <option value="XRAY">General Today</option>
          <option value="SPECEIL">Spacial Today</option>
          <option value="CT">CT Today</option>
		  <option value="BMD">BMD Today</option>
          <option value="MRI">MRI Today</option>
		  <option value="MAMMO">Mammo Today</option>
		  <option value="US">U/S Today</option>
        </select>
        <input type="submit" name="Submit5" value="Query">
      </p>
</FORM>
	  <!--<input type=button value="refresh" onClick="window.open('order.php','main')">-->
	</td>
    <td height="136" valign="top" width="32%" bgcolor="#DDDDDD"> 


      <p>Select Date
<FORM method="post" action="order.php" name="searchbydate">
<INPUT TYPE=hidden NAME=searchdate value=1>

<SCRIPT LANGUAGE="JavaScript" ID="js18">
var cal18 = new CalendarPopup("testdiv1");
cal18.setCssPrefix("TEST");
</SCRIPT>
<SCRIPT LANGUAGE="JavaScript"></SCRIPT>
<INPUT TYPE="text" NAME="date001" VALUE="" SIZE=10>
<a href='#'><img src=image/calandar.jpg border='0' onClick="cal18.select(document.forms[2].date001,'anchor18','dd/MM/yyyy'); return false;" TITLE="dd/MM/yyyy" NAME="anchor18" ID="anchor18"></a>


<SCRIPT LANGUAGE="JavaScript" ID="js19">
var cal19 = new CalendarPopup("testdiv1");
cal18.setCssPrefix("TEST");
</SCRIPT>
<!-- The next line prints out the source in this example page. It should not be included when you actually use the calendar popup code -->
<INPUT TYPE="text" NAME="date002" VALUE="" SIZE=10>
<a href='#'><img src=image/calandar.jpg border='0' onClick="cal18.select(document.forms[2].date002,'anchor19','dd/MM/yyyy'); return false;" TITLE="dd/MM/yyyy" NAME="anchor19" ID="anchor19"></a>
<input type="submit" name="Submit6" value="Search">
</FORM>
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
      </p>
      </td>
  </tr>
</table>

<?php
echo "<body bgcolor=gray>";

// For Multi site
//$sql = "SELECT xray_patient_info.MRN, xray_request_detail.ID  AS ORDERID,xray_request_detail.REQUEST_DATE AS REQ_DATE,xray_request_detail.REQUEST_TIME AS REQ_TIME, xray_request.REQUEST_NO, xray_request_detail.ACCESSION,xray_request_detail.STATUS, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_request.CENTER_CODE = '$center_code') INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request_detail.PAGE = 'ORDER LIST') order by ORDERTIME desc";
$sql = "SELECT xray_patient_info.MRN, 
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.REQUEST_DATE AS REQ_DATE,
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request.REQUEST_NO, 
			xray_request_detail.ACCESSION,
			xray_request_detail.STATUS, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_code.DESCRIPTION, 
			xray_referrer.NAME, 
			xray_referrer.LASTNAME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME 
			FROM  xray_request
			LEFT JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO) 
			LEFT JOIN xray_user ON (xray_user.CODE = xray_request.USER) 
			LEFT JOIN xray_patient_info ON (xray_patient_info.MRN = xray_request.MRN) 
			LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
			LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
			WHERE 
			(xray_request_detail.STATUS = 'READY') order by ORDERTIME desc";

if ($searchdate =='1')
{
	$datestart = Date2MySQL($datestart);
	$dateend = Date2MySQL($dateend);
	$sql = "SELECT xray_patient_info.MRN, xray_request_detail.ID  AS ORDERID,xray_request_detail.REQUEST_DATE AS REQ_DATE,xray_request_detail.REQUEST_TIME AS REQ_TIME, xray_request.REQUEST_NO, xray_request_detail.ACCESSION,xray_request_detail.STATUS, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request_detail.STATUS = 'READY')AND (xray_request_detail.REQUEST_DATE between '$datestart' and '$dateend') order by ORDERTIME desc";
	
}
if ($searchtoday =='1')
{
	$sql = "SELECT xray_patient_info.MRN, xray_request_detail.ID  AS ORDERID,xray_request_detail.REQUEST_DATE AS REQ_DATE,xray_request_detail.REQUEST_TIME AS REQ_TIME, xray_request.REQUEST_NO, xray_request_detail.ACCESSION,xray_request_detail.STATUS, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.XRAY_TYPE_CODE, xray_code.DESCRIPTION, xray_referrer.NAME, xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request_detail.STATUS = 'READY')AND(xray_code.XRAY_TYPE_CODE = '$todaytype') order by ORDERTIME desc";
}
$result = mysql_query($sql);

// HN patient_info.MRN
// REQNUMBER xray_request.REQUEST_NO
// ACCESSION xray_request_detail.ACCESSION
// PATIENT NAME patient_info.NAME AS PTNAME
// REQUEST DATE xray_request_detail.REQUEST_DATE AS REQ_DATE
// REQUEST TIME xray_request_detail.REQUEST_TIME AS REQ_TIME
// PATIENT LASTNAME patient_info.LASTNAME  AS PTLASTNAME
// XRAY DESCRIPTION xray_code.DESCRIPTION AS DESCRIPTION
// PHYSICIAN NAME xray_referrer.NAME
// PHYSICIAN LASTNAME xray_referrer.LASTNAME
// DEPARTMENT xray_department.NAMETHAI
// XRAY CODE xray_code.XRAY_CODE

echo "<table border='0' cellspacing='2' bgcolor='#000000' width=100%>

<tr>
<th><font color=white>ICON</font></th>
<th><font color=white>MRN (HN)</font></th>
<!--<th>REQ</th>-->
<th><font color=white>ACC</font></th>
<th><font color=white>Patient</font></th>
<th><font color=white>Procedure</font></th>
<th><font color=white>Physician</font></th>
<th><font color=white>Order Time</font></th>
<th>-</th>
<th><font color=white>Wait</font></th>
</tr>\n";

$bg ="#FFCCCC";
$count = 0;
while($row = mysql_fetch_array($result))

  {

if($bg == "#FFFFFF") { //ส่วนของการ สลับสี 

$bg = "#FFCCCC";

} else {

$bg = "#FFFFFF";

}
 $count = $count+1;
 echo "<tr bgcolor=$bg>";
 echo "<td></td>";
 echo "<td>" .$row[MRN] . "</td>";
 //echo "<td>".$row[REQUEST_NO]."</td>";
 //echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ORDID=".$row[MRN]."','mywindow1','scrollbars=yes,resizable=yes,screenX=0,screenY=100,width=600,height=500')\"></a> ".$row[ACCESSION]."</td>";
 echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ORDID=".$row[MRN]."','mywindow1','scrollbars=yes,resizable=yes,width=750,height=600')\"></a> ".$row[ACCESSION]."</td>";
 echo "<td><a href='#'><img border=0 src=./image/folder.png onClick=\"window.open('patient-info.php?MRN=".$row[MRN]."','mywindow2','scrollbars=yes,resizable=yes,width=750,height=600')\"></a> ".$row[PTNAME]."   ".$row[PTLASTNAME]."</td>";
 echo "<td>".$row[DESCRIPTION]."</td>";
 echo "<td>".$row[NAME]." ".$row[LASTNAME]."</td>";
 //echo "<td>".$row[ORDERTIME].$row[STATUS]."</td>";
 echo "<td>".ThaiEachDate($row[REQ_DATE])." ".$row[REQ_TIME]."</td><td> <img src=./image/bin.png border=0 alt='Del' onclick=\"doDelete()\" /> <a href='#'><img src=./image/upload.png border=0 onClick=\"window.open('upload.php?MRN=".$row[MRN]."&ACCESSION=".$row[ACCESSION]."','mywindow3','scrollbars=yes,resizable=yes,width=750,height=600')\"></a>";
 echo "<a href='#'><img src=./image/needle.gif border=0 onClick=\"window.open('stockuse.php?MRN=".$row[MRN]."&ACCESSION=".$row[ACCESSION]."','mywindow3','scrollbars=yes,resizable=yes,width=750,height=600')\"></a>";
 echo "</td>";


	echo "<td>xxxx</td>";

  echo "</tr>\n";	

  }
echo "</table>";
echo "All Study=".$count;
echo "<div id=test></div>";
echo "</br>";

//echo $datestart.$dateend;
//echo "lllll=".$searchdate;

$resultdate = mysql_query("select curdate()");
$rowdate=mysql_fetch_array($resultdate);
$today = $rowdate[0];

echo "<br>Today : ".$today;
echo "<br>Todaysearch = ".$searchtoday.$todaytype;
echo "<center><font color=white>Copyright ThaiRIS.Net</font></center>";

?>
</body>