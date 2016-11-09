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
header("Content-type: text/html;  charset=TIS-620");

$usercode_worklist = $_POST['selectuser'];
$usercode_worklist2 = $_GET['selectuser'];

if ($usercode_worklist !=='')
	{
		$usercode_worklist = $usercode_worklist;
	}
if ($usercode_worklist =='')
	{
		$usercode_worklist = $usercode_worklist2;
	}

?>

<!DOCTYPE HTML>
<html>
<head>

<title>Reporting</title>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}

a:link { color: #005CA2; text-decoration: none}

a:visited { color: #005CA2; text-decoration: none}

a:active { color: #0099FF; text-decoration: underline}

a:hover { color: #0099FF; text-decoration: underline}

-->

</style>
<script type="text/JavaScript" src="reporting.js"></script>

<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="3:60"

if (document.images){
var parselimit=limit.split(":")
parselimit=parselimit[0]*60+parselimit[1]*1
}
function beginrefresh(){
if (!document.images)
return
if (parselimit==1)
//window.location.reload()
window.location.href='reporting2.php?selectuser=ALL';
else{ 
parselimit-=1
curmin=Math.floor(parselimit/60)
cursec=parselimit%60
if (curmin!=0)
curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
else
curtime=cursec+" seconds left until page refresh!"
window.status=curtime
setTimeout("beginrefresh()",100)
}
}

window.onload=beginrefresh
//-->

</script>
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
</head>



<body bgcolor="gray" leftmargin="3">


<?php
include "connectdb.php";

$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_request_detail.ID  AS ORDERID, 
			xray_request.REQUEST_NO, 
			xray_request_detail.ACCESSION,
			xray_request_detail.STATUS, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_code.DESCRIPTION, 
			xray_referrer.NAME, 
			xray_referrer.LASTNAME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_user.LOGIN AS RAD 
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO AND xray_request_detail.ASSIGN= '$usercode_worklist') 
			LEFT JOIN xray_user ON (xray_user.CODE = xray_request_detail.ASSIGN) 
			LEFT JOIN xray_patient_info ON (xray_patient_info.MRN = xray_request.MRN) 
			LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
			LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
			WHERE 
			(xray_request_detail.STATUS ='TOREPORT') 
			AND (xray_request_detail.PAGE = 'RADIOLOGIST') ORDER BY ORDERTIME desc";

if ($usercode_worklist == 'ALL')
{
	$sql = "SELECT 
				xray_patient_info.MRN, 
				xray_request_detail.ID  AS ORDERID, 
				xray_request.REQUEST_NO, 
				xray_request_detail.ACCESSION,
				xray_request_detail.STATUS, 
				xray_patient_info.NAME AS PTNAME, 
				xray_patient_info.LASTNAME  AS PTLASTNAME, 
				xray_code.DESCRIPTION, xray_referrer.NAME, 
				xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
				xray_user.LOGIN AS RAD FROM  xray_request 
				LEFT JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO) 
				LEFT JOIN xray_user ON (xray_user.CODE = xray_request_detail.ASSIGN) 
				LEFT JOIN xray_patient_info ON (xray_patient_info.MRN = xray_request.MRN) 
				LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
				LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
				LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
				WHERE 
				(xray_request_detail.STATUS ='TOREPORT') 
				AND (xray_request_detail.PAGE = 'RADIOLOGIST') ORDER BY ORDERTIME desc";
}


$result = mysql_query($sql);

// HN xray_patient_info.MRN
// REQNUMBER xray_request.REQUEST_NO
// ACCESSION xray_request_detail.ACCESSION
// PATIENT NAME xray_patient_info.NAME AS PTNAME
// PATIENT LASTNAME xray_patient_info.LASTNAME  AS PTLASTNAME
// XRAY DESCRIPTION xray_code.DESCRIPTION AS DESCRIPTION
// PHYSICIAN NAME xray_referrer.NAME
// PHYSICIAN LASTNAME xray_referrer.LASTNAME
// DEPARTMENT xray_department.NAMETHAI
// XRAY CODE xray_code.XRAY_CODE
echo "<font color=white>Reporting WorkList</font>";
?>
<table width="100%" border="0" cellspacing="1">
<form method="post" action="reporting2.php"
  <tr>
    <td width="29%" bgcolor="#CCCCCC">Select Worklist 
      <select name="selectuser" id="selectuser">
        <option selected value="<?php echo $usercode ?>">My Worklist</option>
        <option value="ALL">All Worklost</option>
		<option value="0">Not Assign</option>
      </select>
      <label>
        <input type="submit" name="button" id="button" value="Submit">
      </label></td>
    <td width="36%" bgcolor="#E8E8E8"><p>Search MRN 
	<form method="post" action="reporting-search.php">
      <label>
        <input type="text" name="MRN" id="MRN">
      </label>
      <input type="submit" name="button2" id="button2" value="Submit">
	 </form>
    </p>
    <p>Seach Date </p></td>
    <td width="35%" bgcolor="#CCCCCC">Modality </td>
  </tr>
  </form>
</table>


<?php

echo "<table border='0' cellspacing='2' bgcolor='#000000' width=100%>

<tr>
<th><font color=white>ICON</font></th>
<th><font color=white>MRN</font></th>
<th><font color=white><b>Assign TO</b></font></th>
<th><font color=white>ACC</font></th>
<th><font color=white>Patient</font></th>
<th><font color=white>Procedure</font></th>
<th><font color=white>Physician</font></th>
<th><font color=white>Order Time</font></th>
<th></th>


</tr>\n";

$bg ="#FFCCCC";
$count = 0;
while($row = mysql_fetch_array($result))

  {

if($bg == "#FFFFFF") { //

$bg = "#FFCCCC";

} else {

$bg = "#FFFFFF";

}
 $count = $count+1;
 echo "<tr bgcolor=$bg>";
 echo "<td></td>";
 echo "<td>".$row[MRN]."</td>";
 echo "<td>".$row[RAD]."</td>";
 echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ACCESSION=".$row[ACCESSION]."','mywindow1','scrollbars=yes,resizable=yes,screenX=0,screenY=100,width=600,height=500')\"></a> ".$row[ACCESSION]."</td>";
 echo "<td><a href='#'><img border=0 src=./image/folder.png onClick=\"window.open('patient-info.php?MRN=".$row[MRN]."','mywindow2','scrollbars=yes,resizable=yes,width=750,height=600')\"></a> ".$row[PTNAME]."   ".$row[PTLASTNAME]."</td>";
 echo "<td>".$row[DESCRIPTION]."</td>";
 echo "<td>".$row[NAME]." ".$row[LASTNAME]."</td>";
 echo "<td>".$row[ORDERTIME]."</td>";
$status = $row[STATUS];
$ORDERID = $row[ORDERID];
		if ($usertype =='RADIOLOGIST'){
		//echo "<td><div id='".$row[ORDERID]."'><form action=dictate.php><input type=button value=Start></form></div></td>";
 		//echo "<td><form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'><input type=submit value=Start></form></td>";
		}
		if ($usertype !=='RADIOLOGIST'){
		echo "<td>Wait reporting</td>";
		}
  echo "</td></tr>\n";	
 }
echo "</table>";
echo "All Study=".$count;
//echo "<br>WL1 :".$usercode_worklist2;
//echo "<br>WL2 :".$usercode_worklist2;
//echo "<div id=test></div>";
echo "</br>";
echo "<center><font color=white>Power By ThaiRIS.net</font></center>";
?>

</body>
</html>



