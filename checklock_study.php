<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 19 Sep 2014
# File name: dictate-wokrlist.php
# Description :  Show Order worklist in examroom
# http://www.thairis.net
# Email : info.xraythai@gmail.com
###########################################
include "connectdb.php";
include ("session.php");
include ("function.php");
$searchbox = $_POST[searchbox];
$datestart = $_POST[date001];
$dateend = $_POST[date002];
$searchtoday = $_POST[today];
$todaytype = $_POST[todaytype];
$searchmrn = $_POST[mrn];
$searchacc = $_POST[acc];
$searchname = $_POST[searchname];
$searchlast = $_POST[searchlast];
$mod1 = $_POST[Mod_option1];
$mod2 = $_POST[Mod_option2];
$mod3 = $_POST[Mod_option3];
$mod4 = $_POST[Mod_option4];
$mod5 = $_POST[Mod_option5];
$mod6 = $_POST[Mod_option6];
$mod7 = $_POST[Mod_option7];
$mod8 = $_POST[Mod_option8];
$date1 = $_POST[date1];
$date2 = $_POST[date2];
$selectuserID = $_POST[selectuserID1];

if ($_POST['reset'] == 'reset')
	{
		$searchbox = '';
		$datestart = '';
		$dateend = '';
		$searchtoday = '';
		$todaytype = '';
		$searchmrn = '';
		$searchacc ='';
		$searchname = '';
		$searchlast = '';
		$mod1 = '';
		$mod2 = '';
		$mod3 = '';
		$mod4 = '';
		$mod5 = '';
		$mod6 = '';
		$mod7 = '';
		$mod8 = '';
		$date1 = '';
		$date2 = '';
		$selectuserID = '';
	}

if ($date1 =='')
	{
		$date1 = '2013-01-01';
	}

if ($date2 =='')
	{
		$date2 = date('Y-m-d');
		//$date2 = '2500-12-30';
	}
	
if ($selectuserID !='')
	{
		($usercodesearch = $selectuserID);
	}
	
else 
	{
		($usercodesearch = $usercode);
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>Reporting</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/button.css" />
<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}

a:link { color: #005CA2; text-decoration: none}

a:visited { color: #005CA2; text-decoration: none}

a:active { color: #0099FF; text-decoration: underline}

a:hover { color: #0099FF; text-decoration: underline}

-->

</style>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css">  
<style type="text/css">  
/* Overide css code กำหนดความกว้างของปฏิทินและอื่นๆ */  
.ui-datepicker{  
    width:170px;  
    font-family:tahoma;  
    font-size:11px;  
    text-align:center;  
}  
</style> 
<script type="text/JavaScript" src="reporting.js"></script>
<script type="text/javascript" src="unlockexam.js"></script>
<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="4:59"
if (document.images)
	{ 
		var parselimit=limit.split(":")
		parselimit=parselimit[0]*60+parselimit[1]*1
	}
function beginrefresh()
	{
		if (!document.images)
			return
		if (parselimit==1)
			window.location.reload()
		else
			{
				parselimit-=1
				curmin=Math.floor(parselimit/60)
				cursec=parselimit%60
				if (curmin!=0)
					curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
				else
					curtime=cursec+" seconds left until page refresh!"
					window.status=curtime
					//setTimeout("beginrefresh()",1000)
					setTimeout("beginrefresh()",500)
			}
	}

window.onload=beginrefresh
//-->
</script>
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  
	<link href="css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<!-- Add jQuery library -->
	<script type="text/javascript" src="./lib/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="./source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css" media="screen" />
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			$(".fancybox").fancybox({
				afterClose : function() {
					location.reload();
					return;
				}
			});
			

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

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

<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
			
<?php

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL-A".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL-B".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}
			?>	
			
			
		});
</script>
</head>


<body bgcolor="gray" leftmargin="3">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Show Locked Exam</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />
<img src=image/key_lock.png width=50> : : Show Locked study : :<br />

<?php

$sql1 = "UPDATE xray_request_detail SET LOCKBY ='' WHERE xray_request_detail.LOCKBY= '$userid'";
mysql_query($sql1);

// Default Display (No search)
$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
			xray_patient_info.BIRTH_DATE, 
			xray_request.REQUEST_NO AS req_no, 
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
			xray_request_detail.START_TIME AS START_TIME, 
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.ASSIGN AS ASSIGN,
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.READY_TIME AS TIMEREADY,
			xray_request_detail.LOCKBY,
			xray_request_detail.FLAG1,
			xray_request_detail.REPORT_BOOK,
			xray_code.XRAY_TYPE_CODE AS MODALITY,
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_department.NAME_THAI AS DEP,
			xray_referrer.NAME AS DOCTORNAME, 
			xray_referrer.LASTNAME AS DOCTORLASTNAME,
			xray_user.NAME AS RAD
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_request_detail.LOCKBY != '') 
			LEFT JOIN xray_user ON (xray_request_detail.ASSIGN = xray_user.CODE) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) 
			LEFT JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.PAGE = 'RADIOLOGIST') 
			AND (xray_request_detail.STATUS ='TOREPORT' OR xray_request_detail.STATUS = 'PRELIM') 
			AND (xray_patient_info.CENTER_CODE ='$center_code' AND xray_patient_info.MRN like '%$searchmrn%' AND xray_request_detail.ACCESSION like '%$searchacc%' 
			AND xray_patient_info.NAME like '%$searchname%' AND xray_patient_info.LASTNAME like '%$searchlast%')
			AND (xray_request_detail.REQUEST_DATE between '$date1' AND '$date2') 
			AND xray_code.DESCRIPTION like '%$mod8%'
			ORDER BY ORDERTIME ASC
			LIMIT 0 , 999 ";
			
//			WHERE xray_code.XRAY_TYPE_CODE IN ('$mod1','$mod2','$mod3','$mod4','$mod5','$mod6','$mod7')
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

<br />
<?php

echo "<table border='0' cellspacing='1' bgcolor='#79acf3' width=100%>
<tr>
<th><font color=#000000>ICON</font></th>
<th><font color=#000000> HN / ACC</font></th>
<th><font color=#000000>Assign To</font></th>
<th><font color=#000000>Patient</font></th>
<th><font color=#000000>Mod</font></th>
<th><font color=#000000>Procedure</font></th>
<th><font color=#000000>Physician</font></th>
<th><font color=#000000>Report Date</font></th>
<th><font color=#000000>Exam Time</font></th>
<th>-</th>
</tr>\n";
$bg ="#FFCCCC";
$count = 0;
while($row = mysql_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ //Chang Color
				$bg = "#C8C8C8";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		$count = $count+1;
		echo "<tr bgcolor=$bg onMouseOver=this.bgColor='gold'; onMouseOut=this.bgColor='".$bg."';>";
		echo "<td>";
		$URGENT = $row[URGENT];
		if ($URGENT == 1) 
			{
				$ALERT = "<img src=./icons/exclamation-red-frame.png> ";
			}
		$result1 = mysql_query("SELECT NOTE FROM xray_request WHERE REQUEST_NO ='$row[req_no]' ");
		$NOTE = mysql_result($result1, 0);
		if ($NOTE !=='')
			{
				echo "<img src=icons/notebook--exclamation.png>";
			}
		if ($URGENT == 0 ) 
			{
				$ALERT = "";
			}
		if ($row[STATUS] == 'PRELIM')
			{
				echo "<img src=icons/notebook--pencil.png>";
			}
		if ($row[FLAG1] ==1)
			{
				echo "<img src=icons/award_star_bronze_1.png>";
			}
		echo $ALERT;
		echo "</td>";
		echo "<td>".$row[MRN]."<br />";
		echo "<img src=arrow.gif> <a id='variousL-A".$count."' href=order-info.php?MRN=".$row[MRN]."&ACCESSION=".$row[ACCESSION].">";
		echo "<font size=-2 color=green>".$row[ACCESSION]."</font></a></td>";
		echo "<td>".$row[RAD]."</td>";
		//echo "<td><a href='#'><img border=0 src=./folder-icon.gif onClick=\"window.open('order-info.php?ACCESSION=".$row[ACCESSION]."','mywindow1','scrollbars=yes,resizable=yes,screenX=0,screenY=100,width=600,height=500')\"></a><font size=-1>".$row[ACCESSION]."</font></td>";
		echo "<td><a id='variousL-B".$count."' href=patient-info.php?MRN=".$row[MRN]."><img border=0 src=./image/folder.png></a> ".$row[PTNAME]."   ".$row[PTLASTNAME]."</td>";
		echo "<td>".$row[MODALITY]." </td>";
		echo "<td>".$row[DESCRIPTION]."</td>";
		echo "<td>".$row[DOCTORNAME]." ".$row[DOCTORLASTNAME]."<br /><font size=-1 color=green>".$row[DEP]."</font></td>";
		echo "<td>";
		if ($row[FLAG1] ==1)
			{
				echo "<br /><img src=icons/award_star_bronze_1.png><font color=red>อ่านผลทันที</font>";
			}
		if ($row[FLAG1] ==2)
			{
				echo "<br /><font color=#61210B>หนึ่งวันทำการ</font>";
			}		
		if ($row[FLAG1] ==3)
			{
				echo "<br /><font color=#61210B>ระบุวัน ".ThaiEachDate2($row[REPORT_BOOK])."</font>";
			}	
		echo "</td>";
		echo "<td>".DateThai02($row[START_TIME]);
		echo "</td><td><div id=".$row[ORDERID].">";
		echo "<center><img src=icon/lock.gif onClick=unlockexam(".$row[ORDERID].")></center>";
		echo "</div></td></tr>\n";	
	}
echo "<tr><th colspan=9 align=right>";
echo "Total =".$count;
echo "</th></tr></table>";
echo "</br>";
echo "<center><font color=white>CopyRight(C)</font></center>";

//echo "Select User:".$selectuserID."<br />";
//echo "MRN:".$mrn."<br />";
//echo "ACC".$acc."<br />";
//echo $searchname."<br />";
//echo $searchlast."<br />";
//echo $mod1."<br />";
//echo $mod2."<br />";
//echo $mod3."<br />";
//echo $mod4."<br />";
//echo $mod5."<br />";
//echo $mod6."<br />";
//echo $mod7."<br />";
//echo $mod8."<br />";
//echo $date1."<br />";
//echo $date2."<br />";
//echo "userSearch ".$usercodesearch."<br />";
//echo "userCode :".$usercode;
//echo $sql;
?>
<script language=javascript>
document.searchmrn.MRN.focus();
</script>
</body>
</html>