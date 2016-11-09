<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 19 JULY 2015
# File name: re-assign.php
# Description :  Show exam for re-assign
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
include ("session.php");
include "connectdb.php";
header("Content-type: text/html;  charset=TIS-620");
$searchmrn = $_POST['searchmrn'];
$MRN = $_POST['MRN'];

?>
 
<!DOCTYPE html>
<html>
<head>
<title>Re-assign</title>
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
<script type="text/JavaScript" src="reassign.js"></script>
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  
	<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>


<body bgcolor="gray" leftmargin="3">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Re-assign</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />
<?php

//$sql = "SELECT xray_patient_info.MRN, xray_request.REQUEST_NO, xray_request_detail.ACCESSION, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.HN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)WHERE xray_request_detail.XRAY_CODE = 'C0106'";
$sql = "SELECT xray_patient_info.MRN, 
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
			xray_user.NAME AS RADNAME,
			xray_user.LOGIN AS RAD 
			FROM  xray_request
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
			LEFT JOIN xray_user ON (xray_user.CODE = xray_request_detail.ASSIGN) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN)
			LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
			LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
			WHERE 
			(xray_request_detail.STATUS ='TOREPORT') 
			AND xray_request_detail.REQUEST_DATE = DATE(NOW())
			AND (xray_request_detail.PAGE = 'RADIOLOGIST') ORDER BY ORDERTIME desc";

if ($searchmrn =='1')
	{
		$sql = "SELECT xray_patient_info.MRN, 
			xray_request_detail.ID  AS ORDERID, 
			xray_request.REQUEST_NO, 
			xray_request_detail.ACCESSION,
			xray_request_detail.STATUS, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.MRN, 
			xray_code.DESCRIPTION, 
			xray_referrer.NAME, 
			xray_referrer.LASTNAME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_user.NAME AS RADNAME,
			xray_user.LOGIN AS RAD 
			FROM  xray_request
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
			LEFT JOIN xray_user ON (xray_user.CODE = xray_request_detail.ASSIGN) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN)
			LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
			LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
			WHERE 
			(xray_request_detail.STATUS ='TOREPORT') AND (xray_request_detail.PAGE = 'RADIOLOGIST') AND (xray_patient_info.MRN='$MRN') ORDER BY ORDERTIME desc";
		
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
?>
<table width="100%" border="0" cellspacing="0">

  <tr>
    <td width="29%" bgcolor="#CCCCCC"><img src=icons/reassign.png width=88 align=left> <p></p><br>Re-assign

	  </td>
	  
    <td width="36%" bgcolor="#E8E8E8">
	<p>
	<form method="post" action="re-assign.php">
	
	<INPUT TYPE=hidden NAME="searchmrn" value="1">
      <label>
        Search HN <input type="text" name="MRN" id="MRN">
      </label>
      <input type="submit" name="button2" id="button2" value="Search">
	 </form>
    </p>
</td>
    <td width="35%" bgcolor="#CCCCCC">Modality 
	<form>
  Enter a date before 1980-01-01:
  <input type="date" name="day1" max="1979-12-31"><br>
  Enter a date after 2000-01-01:
  <input type="date" name="day2" min="2000-01-02"><br>
</form>
	<br />
	</td>
  </tr>

</table>

<?php

echo "<table border='0' cellspacing='0' bgcolor=#79acf3 width=100%>

<tr>
<th><font color=black>ICON</font></th>
<th><font color=black>MRN</font></th>
<th><font color=black><b>Assign TO</b></font></th>
<th><font color=black>ACC</font></th>
<th><font color=black>Patient Name</font></th>
<th><font color=black>Procedure</font></th>
<th><font color=black>Physician</font></th>
<th><font color=black>Order Time</font></th>
<th><font color=black>Radiologist</font></th>


</tr>\n";

$bg ="#FFCCCC";
$count = 0;
while($row = mysql_fetch_array($result))
  {
	if ($bg == "#FFFFFF") 
		{ //
			$bg = "#C8C8C8";
		} 
	else 
		{
			$bg = "#FFFFFF";
		}
 $count = $count+1;
 echo "<tr bgcolor=$bg>";
 echo "<td></td>";
 echo "<td>".$row['MRN']."</td>";
 echo "<td>".$row['RADNAME']."</td>";
 echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?MRN=".$row['MRN']."&ACCESSION=".$row['ACCESSION']."','mywindow1','scrollbars=yes,resizable=yes,screenX=0,screenY=100,width=600,height=500')\"></a> ".$row['ACCESSION']."</td>";
 echo "<td><a href='#'><img border=0 src=./image/folder.png onClick=\"window.open('patient-info.php?MRN=".$row['MRN']."','mywindow2','scrollbars=yes,resizable=yes,width=750,height=600')\"></a> ".$row['PTNAME']."   ".$row['PTLASTNAME']."</td>";
 echo "<td>".$row['DESCRIPTION']."</td>";
 echo "<td>".$row['NAME']." ".$row['LASTNAME']."</td>";
 echo "<td>".$row['ORDERTIME']."</td>";
$status = $row['STATUS'];
$ORDERID = $row['ORDERID'];

echo "<td><input type=hidden name='ORDERID' value='".$ORDERID."'><img src=icons/xfn-friend.png>".$row['RADNAME'];

$sql2 ="select * FROM xray_user WHERE USER_TYPE_CODE ='RADIOLOGIST'order by NAME";
		$result2 = mysql_query($sql2);
			echo "<div id='".$row['ORDERID']."'>\n";
			echo "<select name=selectrad id=selectrad".$row['ORDERID']." style='background-color:#FFFACD'>";
			echo "<option value=''>Select Radiologist</option> ";
			//echo "<option value=0>Not Assign</option>";
			while ($row =mysql_fetch_array($result2))
				{
					echo "<option name=radid value=\"".$row['CODE']."\">".$row['NAME']."  ".$row['LASTNAME']."</option>";
				}
			echo "</select><input type=button name=Start value=RE-ASSIGN onclick=assignrad('".$ORDERID."','ASSIGN')></div></td>";
			echo "</td></tr>\n";	
 }
echo "</table>";
echo "All Study=".$count;
echo "<div id=test></div>";
echo "</br>";
echo "<center><font color=white>CopyRight(C)</font></center>";

?>

</body>
</html>



