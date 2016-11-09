<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 17 AUG 2013
# File name: dictate-wokrlist.php
# Description :  Show Order worklist in examroom
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

//header("Content-type: text/html;  charset=TIS-620");
include "connectdb.php";
include ("session.php");
include ("function.php");
$searchbox = $_POST[searchbox];
$searchdate = $_POST[searchdate];
$datestart = $_POST[date001];
$dateend = $_POST[date002];
$searchtoday = $_POST[today];
$todaytype = $_POST[todaytype];
$mrn = $_POST[mrn];
$acc = $_POST[acc];
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

$selectuser = $_POST[selectuser];

//echo $selectuser.$usercode;

if ($selectuser =='')
	{
		$usercode = $usercode;
	}

else
	{
		$usercode = $selectuser;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<title>Reporting</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
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
<script type="text/JavaScript" src="reporting.js"></script>
<script type="text/javascript" src="unlockexam.js"></script>
<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="2:59"
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
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
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

<?php


$sql1 = "UPDATE xray_request_detail SET LOCKBY ='' WHERE xray_request_detail.LOCKBY= '$userid'";
mysql_query($sql1);

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
			LEFT JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_request_detail.ASSIGN= '$usercode') 
			LEFT JOIN xray_user ON (xray_request_detail.ASSIGN = xray_user.CODE) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) 
			LEFT JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_request_detail.STATUS ='TOREPORT') OR (xray_request_detail.STATUS = 'PRELIM') 
			AND (xray_request_detail.PAGE = 'RADIOLOGIST') 
			AND (xray_patient_info.MRN like '%$mrn%') 
			AND (xray_patient_info.CENTER_CODE ='$center_code')
			AND (xray_department.CENTER ='$center_code')
			AND (xray_code.XRAY_TYPE_CODE = '$mod1' 	
			OR xray_code.XRAY_TYPE_CODE = '$mod2'
			OR xray_code.XRAY_TYPE_CODE = '$mod3'
			OR xray_code.XRAY_TYPE_CODE = '$mod4'
			OR xray_code.XRAY_TYPE_CODE = '$mod5'
			OR xray_code.XRAY_TYPE_CODE = '$mod6'
			OR xray_code.XRAY_TYPE_CODE = '$mod7'
			OR xray_code.DESCRIPTION like  '%$mod8%')
			ORDER BY URGENT desc, FLAG1 ASC, ORDERTIME ASC
			LIMIT 0 , 1500 ";

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



echo "<table border='0' cellspacing='1' bgcolor='#79acf3' width=100%>";
echo "<tr><td colspan=2><center><b> Worklist </b></center></td></tr>";
echo "<tr>";
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
		$URGENT = $row['URGENT'];
		if ($URGENT == 1) 
			{
				$ALERT = "<img src=./icon/urgent.jpg> ";
			}
		$result1 = mysql_query("SELECT NOTE FROM xray_request WHERE REQUEST_NO ='$row[req_no]' ");
		$NOTE = mysql_result($result1, 0);
		if ($NOTE !=='')
			{
				echo "<img src=icons/notebook--exclamation.png><br />";
			}
		if ($URGENT == 0 ) 
			{
				$ALERT = "";
			}
		if ($row[STATUS] == 'PRELIM')
			{
				echo "<img src=icons/notebook--pencil.png><br />";
			}
		if ($row['FLAG1'] ==1)
			{
				echo "<img src=icons/award_star_bronze_1.png><br />";
			}
		echo $ALERT;
		echo "</td>";
		
		echo "<td><font size=-1><img src=arrow.gif>HN:".$row['MRN'];

		echo "<font color=green> ".$row['ACCESSION']."</font></a>";
		echo "<br /><a id='variousL-B".$count."' href=patient-info.php?MRN=".$row[MRN]."></a> <img src=arrow.gif>".$row['PTNAME']."   ".$row['PTLASTNAME']."<br />";
		echo "<img src=arrow.gif>".$row['MODALITY'].":".$row['DESCRIPTION'];
		if ($row['FLAG1'] ==1)
			{
				echo "<br /><img src=icons/award_star_bronze_1.png><font color=red>Urgent</font>";
			}
		if ($row['FLAG1'] ==2)
			{
				echo "<br /><font color=#61210B>One day</font>";
			}
		if ($row['FLAG1'] ==3)
			{
				echo "<br /><font color=#61210B>Two days</font>";
			}			
		if ($row['FLAG1'] ==4)
			{
				echo "<br /><font color=#61210B>One Week</font>";
			}		
		if ($row['FLAG1'] ==5)
			{
				echo "<br /><font color=#61210B>In date ".EngEachDate($row['REPORT_BOOK'])."</font>";
			}	
		echo "<br /><img src=arrow.gif>".EngEachDate($row['START_TIME']);
		echo "<div id=".$row['ORDERID'].">";
		$status = $row['STATUS'];
		$ORDERID = $row['ORDERID'];
		$LOCKBY = $row['LOCKBY'];
		$LOCKBY = trim($LOCKBY);
		if ($usertype =='RADIOLOGIST' OR $superadmin =='1' and $LOCKBY =='')
			{
				echo "<form action=dictate.php><input type=hidden name='ORDERID' value='".$ORDERID."'><button type=submit class=\"positive\" name=\"start\"> <img src=\"images/page_edit.png\" alt=\"\"/> Read</button></form>";
			}
		if ($usertype =='RADIOLOGIST' and $LOCKBY !=='')
			{
				//echo "<td><div id='".$row[ORDERID]."'><form action=dictate.php><input type=button value=Start></form></div></td>";
				echo "<center><img src=icon/lock.gif onClick=unlockexam2(".$row[ORDERID].")></center>";
			}
		if ($usertype !=='RADIOLOGIST' AND $superadmin =='0')
			{
				echo "Wait reporting";
			}
		echo "</font></td></tr>\n";	
	}

echo "</tr></table>";



//echo $mrn."---".$acc;
echo "<br />";
//echo $mod1.$mod2.$mod3.$mod4.$mod5.$mod6.$mod7.$mod8;
?>
<script language=javascript>
document.searchmrn.MRN.focus();
</script>
</body>
</html>