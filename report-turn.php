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
header("Content-type: text/html;  charset=utf-8");
include "connectdb.php";
include "session.php";
include ("function.php");

$searchbox = $_POST['searchbox'];
$searchdate = $_POST['searchdate'];
$datestart = $_POST['date1'];
$dateend = $_POST['date2'];
$searchtoday = $_POST['today'];
$todaytype = $_POST['todaytype'];
$searchhn = $_POST['searchhn'];
$searchxn = $_POST['searchxn'];
$searchname = $_POST['searchname'];
$searchlast = $_POST['searchlast'];


$datestart1 = str_replace('-', '', $datestart);
$dateend1 = str_replace('-', '', $dateend);
$daySearch = $datestart1 - $dateend1;
//echo "<br>====".$daySearch;

if ($daySearch > 93)
	{
		echo "Please select day not more than 3 months";
		echo "</br><a href=report-turn.php> Back </a>";
		exit;
	}

?>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type="text/javascript"></script>  
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
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
$topbar = "Turn Arround ";
include "topbar.php";
?>
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

<center><form method="post" action="report-turn.php">
FROM : 
<input type="text" name="date1" id="dateInput1" value=''  size=8/> 
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> 
<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#dateInput1").datepicker({  
        dateFormat: 'yy-mm-dd',  
        showOn: 'button',  
        buttonImage: 'image/calandar.jpg',  
        buttonImageOnly: true,  
        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'Sa'],   
        monthNamesShort: ['January','February','March','April','May','June','July','August','September','October','November','December'],    
        changeMonth: true,  
        changeYear: true ,  
        beforeShow:function(){  
            if($(this).val()!=""){  
                var arrayDate=$(this).val().split("-");       
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])-543;  
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);  
  
        },  
        onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
        onClose:function(){  
            if($(this).val()!="" && $(this).val()==dateBefore){           
                var arrayDate=dateBefore.split("-");  
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])+543;  
			   $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }         
        },  
        onSelect: function(dateText, inst){   
            dateBefore=$(this).val();  
            var arrayDate=dateText.split("-");  
            arrayDate[2]=parseInt(arrayDate[2]);  
            //arrayDate[2]=parseInt(arrayDate[2])+543; 
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
        }  
  
    });  
      
});  
</script>			
		
TO : 
<input type="text" name="date2" id="dateInput2" value='' size=8/> 
<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#dateInput2").datepicker({  
        dateFormat: 'yy-mm-dd',  
        showOn: 'button',  
        buttonImage: 'image/calandar.jpg',  
        buttonImageOnly: true,  
        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'Sa'],   
        monthNamesShort: ['January','February','March','April','May','June','July','August','September','October','November','December'],   
        changeMonth: true,  
        changeYear: true ,  
        beforeShow:function(){  
            if($(this).val()!=""){  
                var arrayDate=$(this).val().split("-");       
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])-543;  
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);  
  
        },  
        onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
        onClose:function(){  
            if($(this).val()!="" && $(this).val()==dateBefore){           
                var arrayDate=dateBefore.split("-");  
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])+543;  
			   $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }         
        },  
        onSelect: function(dateText, inst){   
            dateBefore=$(this).val();  
            var arrayDate=dateText.split("-");  
            arrayDate[2]=parseInt(arrayDate[2]);  
            //arrayDate[2]=parseInt(arrayDate[2])+543; 
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
        }  
  
    });  
      
});  
</script>	

</center>
<center>
  <button type=submit class="positive" value="submit"><img src="icons/find.png" width=15 alt="Search" border=0 /> Search </button>
</center>
</form>
<?php


$resultdate = mysql_query("select curdate()");
$rowdate=mysql_fetch_array($resultdate);
$today = $rowdate[0];
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

echo "<body bgcolor=gray>";
//echo "<p>Report Today ".$today."</p>";
$sql = "SELECT xray_patient_info.MRN, 
		xray_patient_info.CENTER_CODE, 
		xray_request_detail.ID  AS ORDERID,
		xray_request_detail.REQUEST_DATE AS REQ_DATE,
		xray_request_detail.REQUEST_TIME AS REQ_TIME, 
		xray_request.REQUEST_NO, 
		xray_request_detail.REQUEST_NO AS REQNUMBER, 
		xray_request_detail.ACCESSION,xray_request_detail.STATUS, 
		xray_request_detail.URGENT, xray_patient_info.NAME AS PTNAME, 
		xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
		xray_request_detail.APPROVED_TIME AS APPROVE, 
		xray_patient_info.LASTNAME  AS PTLASTNAME, 
		xray_patient_info.NAME_ENG AS NAMEENG, 
		xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
		xray_patient_info.BIRTH_DATE, 
		xray_code.DESCRIPTION, 
		xray_referrer.NAME, 
		xray_referrer.LASTNAME, 
		xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,
		xray_user.NAME AS REPORTBY
		FROM  xray_request 
		LEFT JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO) 
		LEFT JOIN xray_user ON (xray_user.CODE = xray_request.USER)
		LEFT JOIN xray_patient_info ON (xray_patient_info.MRN = xray_request.MRN) 
		LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
		LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
		LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
		WHERE (xray_request_detail.STATUS = 'APPROVED') AND
		(xray_request_detail.REQUEST_DATE BETWEEN '$datestart' AND '$dateend') AND
		(xray_patient_info.CENTER_CODE ='$center_code')order by ORDERTIME ASC
		LIMIT 0 , 20000 ";

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
<th><font color=white>Arrival Time</font></th>
<th><font color=white>Report Time</font></th>
<th><font color=white>TIME </font></th>
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
	if ($row['NAMEENG'] == $row['MRN'] or $row['LASTNAMEENG'] == $row['MRN'] or $row['NAMEENG'] =='' or $row['LASTNAMEENG'] =='')
		{
			//echo "<font color=red> No Eng</font>";
		}
	$birthday = $row['BIRTH_DATE'];
	$time_arrival = $row['ARRIVAL'];
	$time_approve = $row['APPROVE'];
	echo AgeCal($birthday);
	echo "</td>";
	echo "<td>".$row['DESCRIPTION']."</td>";
	//echo "<td>".$row[NAME]." ".$row[LASTNAME]."</td>";
	//echo "<td>".$row[ORDERTIME].$row[STATUS]."</td>";
	echo "<td>".$row['ARRIVAL']."</td>";
	echo "<td>".$row['APPROVE']."</td>";
	//echo "<td>".ThaiEachDate($row[REQ_DATE])." ".$row[REQ_TIME]."</td>";


	//Usage :
	$time_diff = timeDiff($time_arrival,$time_approve);
	echo "<td>";//.$time_diff;
	
$years = abs(floor($time_diff / 31536000));
$days = abs(floor(($time_diff-($years * 31536000))/86400));
$hours = abs(floor(($time_diff-($years * 31536000)-($days * 86400))/3600));
$mins = abs(floor(($time_diff-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($time_diff / 60);
//echo "<p>Time Passed: " . $years . " Years, " . $days . " Days, " . $hours . " Hours, " . $mins . " Minutes.</p></td>";
echo $days . " Days, " . $hours . " Hours, " . $mins . " Minutes.</p></td>";

	//echo $time_arrival.$time_approve;
	//echo "<td>".$row[REPORTBY]."</td>";
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