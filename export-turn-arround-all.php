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
$datestart = $_POST['date5'];
$dateend = $_POST['date6'];

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
xray_patient_info.MRN,
xray_patient_info.PREFIX AS PAT_PREFIX,
xray_patient_info.NAME AS PAT_NAME,
xray_patient_info.LASTNAME AS PAT_LASTNAME,
xray_patient_info.SEX AS PAT_SEX,
xray_request.DEPARTMENT_ID,
xray_request_detail.ACCESSION,
xray_request_detail.REQUEST_DATE,
xray_request_detail.REQUEST_TIME,
xray_request_detail.REQUEST_TIMESTAMP,
xray_request_detail.ARRIVAL_TIME, 
xray_request_detail.START_TIME, 
xray_request_detail.COMPLETE_TIME AS COMPLETE, 
xray_request_detail.ASSIGN_TIME, 
xray_request_detail.ASSIGN,
xray_request_detail.APPROVED_TIME, 
xray_request_detail.XRAY_CODE,
xray_request_detail.STATUS,
xray_code.DESCRIPTION,
xray_code.XRAY_TYPE_CODE,
xray_department.NAME_THAI AS DEP,
xray_user.CODE,	
xray_user.NAME AS DOCTOR_NAME,
xray_user.LASTNAME AS DOCTOR_LASTNAME
FROM
xray_request_detail
Left Join xray_request ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
Left Join xray_user ON xray_user.CODE = xray_request_detail.ASSIGN
Left Join xray_patient_info ON xray_patient_info.MRN = xray_request.MRN
Left Join xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE
LEFT Join xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
WHERE
(xray_request_detail.REQUEST_DATE BETWEEN '$datestart' AND '$dateend') 
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
<strong>Query Date <?php echo $datestart." To ".$dateend." Run Report date :".date("d/m/Y");?> Order <?php echo number_format($num);?> Studies</strong><br>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
<tr>
<td><strong>ACCESSION</strong></td>
<td><strong>MRN</strong></td>
<td><strong>NAME</strong></td>
<td><strong>SEX</strong></td>
<td><strong>XRAY CODE</strong></td>
<td><strong>XRAY TYPE</strong></td>
<td><strong>DESCRIPTION</strong></td>
<td><strong>Department</strong></td>
<td><strong>REQUEST TIME</strong></td>
<td><strong>ARRIVAL</strong></td>
<td><strong>Start</strong></td>
<td><strong>Complete time</strong></td>
<td><strong>QC time</strong></td>
<td><strong>Approve Time</strong></td>
<td><strong>Radiologist</strong></td>
<td><strong>Request To Arrived</strong></td>
<td><strong>Arrived To Start</strong></td>
<td><strong>Start To QC</strong></td>
<td><strong>QC To Approved</strong></td>
<td><strong>Arrived To QC</strong></td>
<td><strong>Arrived To Approved</strong></td>
<td><strong>Start To Approved</strong></td>
<td><strong>Status</strong></td>

</tr>
<?php
if($num>0)
	{
		while($row=mysql_fetch_array($sql))
			{
				$time_arrival = $row['ARRIVAL_TIME'];
				$time_approve = $row['APPROVED_TIME'];
				$time_assign = $row['ASSIGN_TIME'];
				$time_request = $row['REQUEST_TIMESTAMP'];
				$time_start = $row['START_TIME'];
				
				//if ($time_arrival = '')
				//	{
				//		$time_arrival =
				//	}
				//if ($time_approve = '')
				//if ($time_assign = '')
				//Arrival to Assing
				$time_diff1 = timeDiff($time_arrival,$time_assign);
				// Convert to text
				$years1 = abs(floor($time_diff1 / 31536000));
				$days1 = abs(floor(($time_diff1-($years1 * 31536000))/86400));
				$hours1 = abs(floor(($time_diff1-($years1 * 31536000)-($days1 * 86400))/3600));
				$mins1 = abs(floor(($time_diff1-($years1 * 31536000)-($days1 * 86400)-($hours1 * 3600))/60));#floor($time_diff / 60);
				//$mins1 = abs(ceil(($time_diff1-($years1 * 31536000)-($days1 * 86400)-($hours1 * 3600))/60));#floor($time_diff / 60);
				
				$time_diff2 = timeDiff($time_assign,$time_approve);
				// Convert to text
				$years2 = abs(floor($time_diff2 / 31536000));
				$days2 = abs(floor(($time_diff2-($years2 * 31536000))/86400));
				$hours2 = abs(floor(($time_diff2-($years2 * 31536000)-($days2 * 86400))/3600));
				$mins2 = abs(floor(($time_diff2-($years2 * 31536000)-($days2 * 86400)-($hours2 * 3600))/60));#floor($time_diff / 60);
				//$mins2 = abs(ceil(($time_diff2-($years2 * 31536000)-($days2 * 86400)-($hours2 * 3600))/60));#floor($time_diff / 60);
				
				$time_diff3 = timeDiff($time_arrival,$time_approve);
				// Convert to text
				$years3 = abs(floor($time_diff3 / 31536000));
				$days3 = abs(floor(($time_diff3-($years3 * 31536000))/86400));
				$hours3 = abs(floor(($time_diff3-($years3 * 31536000)-($days3 * 86400))/3600));
				$mins3 = abs(floor(($time_diff3-($years3 * 31536000)-($days3 * 86400)-($hours3 * 3600))/60));#floor($time_diff / 60);			
				//$mins3 = abs(ceil(($time_diff3-($years3 * 31536000)-($days3 * 86400)-($hours3 * 3600))/60));#floor($time_diff / 60);	
				
				$time_diff4 = timeDiff($time_request,$time_arrival);
				$years4 = abs(floor($time_diff4 / 31536000));
				$days4 = abs(floor(($time_diff4-($years4 * 31536000))/86400));
				$hours4 = abs(floor(($time_diff4-($years4 * 31536000)-($days4 * 86400))/3600));
				$mins4 = abs(floor(($time_diff4-($years4 * 31536000)-($days4 * 86400)-($hours4 * 3600))/60));#floor($time_diff / 60);			
				//$mins4 = abs(ceil(($time_diff3-($years4 * 31536000)-($days4 * 86400)-($hours4 * 3600))/60));#floor($time_diff / 60);	

				$time_diff5 = timeDiff($time_arrival,$time_start);
				$years5 = abs(floor($time_diff5 / 31536000));
				$days5 = abs(floor(($time_diff5-($years5 * 31536000))/86400));
				$hours5 = abs(floor(($time_diff5-($years5 * 31536000)-($days5 * 86400))/3600));
				$mins5 = abs(floor(($time_diff5-($years5 * 31536000)-($days5 * 86400)-($hours5 * 3600))/60));#floor($time_diff / 60);			
				//$mins5 = abs(ceil(($time_diff5-($years4 * 31536000)-($days5 * 86400)-($hours5 * 3600))/60));#floor($time_diff / 60);					

				$time_diff6 = timeDiff($time_start,$time_assign);
				$years6 = abs(floor($time_diff6 / 31536000));
				$days6 = abs(floor(($time_diff6-($years6 * 31536000))/86400));
				$hours6 = abs(floor(($time_diff6-($years6 * 31536000)-($days6 * 86400))/3600));
				$mins6 = abs(floor(($time_diff6-($years6 * 31536000)-($days6 * 86400)-($hours6 * 3600))/60));#floor($time_diff / 60);			
				//$mins6 = abs(ceil(($time_diff6-($years6 * 31536000)-($days6 * 86400)-($hours6 * 3600))/60));#floor($time_diff / 60);	
				
				$time_diff7 = timeDiff($time_start,$time_approve);
				$years7 = abs(floor($time_diff7 / 31536000));
				$days7 = abs(floor(($time_diff7-($years7 * 31536000))/86400));
				$hours7 = abs(floor(($time_diff7-($years7 * 31536000)-($days7 * 86400))/3600));
				$mins7 = abs(floor(($time_diff7-($years7 * 31536000)-($days7 * 86400)-($hours7 * 3600))/60));#floor($time_diff / 60);			
				//$mins7 = abs(ceil(($time_diff7-($years7 * 31536000)-($days7 * 86400)-($hours6 * 3600))/60));#floor($time_diff / 60);					
				
				if ($days1 == '') 
					{
						$days1 ='0';
					}
				if ($days1 > 10000) 
					{
						$days1 ='x';
					}			
				if ($hours1 > 10000) 
					{
						$hours1 ='x';
					}
				if ($mins1 > 10000) 
					{
						$mins1 = 'x';
					}
				if ($days2 == '') 
					{
						$days2 ='0';
					}
				if ($days2 > 10000) 
					{
						$days2 ='x';
					}	
				if ($hours2 > 10000) 
					{
						$hours2 ='x';
					}
				if ($mins2 > 10000) 
					{
						$mins2 ='x';
					}					
				if ($days3 == '') 
					{
						$days3 ='0';
					}
				if ($days3 > 10000) 
					{
						$days3 ='x';
					}	
				if ($hours3 > 10000) 
					{
						$hours3 ='x';
					}
				if ($mins3 > 10000) 
					{
						$mins3 ='x';
					}
				if ($days4 == '') 
					{
						$days4 ='0';
					}
				if ($days4 > 10000) 
					{
						$days4 ='x';
					}	
				if ($hours4 > 10000) 
					{
						$hours4 ='x';
					}
				if ($mins4 > 10000) 
					{
						$mins4 ='x';
					}				
				if ($days5 == '') 
					{
						$days5 ='0';
					}
				if ($days5 > 10000) 
					{
						$days5 ='x';
					}	
				if ($hours5 > 10000) 
					{
						$hours5 ='x';
					}
				if ($mins5 > 10000) 
					{
						$mins5 ='x';
					}	
				if ($days6 == '') 
					{
						$days6 ='0';
					}
				if ($days6 > 10000) 
					{
						$days6 ='x';
					}	
				if ($hours6 > 10000) 
					{
						$hours6 ='x';
					}
				if ($mins6 > 10000) 
					{
						$mins6 ='x';
					}
				if ($days7 == '') 
					{
						$days7 ='0';
					}
				if ($days7 > 10000) 
					{
						$days7 ='x';
					}	
				if ($hours7 > 10000) 
					{
						$hours7 ='x';
					}
				if ($mins7 > 10000) 
					{
						$mins7 ='x';
					}					
?>
<tr>
<td><?php echo $row['ACCESSION'];?></td>
<td><?php echo $row['MRN'];?></td>
<td><?php echo $row['PAT_PREFIX']." ".$row['PAT_NAME']." ".$row['PAT_LASTNAME'];?></td>
<td><?php echo $row['PAT_SEX'];?></td>
<td><?php echo $row['XRAY_CODE'];?></td>
<td><?php echo $row['XRAY_TYPE_CODE'];?></td>
<td><?php echo $row['DESCRIPTION'];?></td>
<td><?php echo $row['DEP'];?></td>
<td><?php echo $row['REQUEST_DATE']." ".$row['REQUEST_TIME'] ;?></td>
<td><?php echo $row['ARRIVAL_TIME'];?></td>
<td><?php echo $row['START_TIME'];?></td>
<td><?php echo $row['COMPLETE'];?></td>
<td><?php echo $row['ASSIGN_TIME'];?></td>
<td><?php echo $row['APPROVED_TIME'];?></td>
<td><?php echo $row['DOCTOR_NAME']." ".$row['DOCTOR_LASTNAME'];?></td>
<td><?php echo $days4 . ":" . $hours4 . ":" . $mins4; //Request To Arrived   ?></td>
<td><?php echo $days5 . ":" . $hours5 . ":" . $mins5; //Arrived To Start     ?></td>
<td><?php echo $days6 . ":" . $hours6 . ":" . $mins6; //Start To QC          ?></td>
<td><?php echo $days2 . ":" . $hours2 . ":" . $mins2; //QC to Approved     ?></td>
<td><?php echo $days1 . ":" . $hours1 . ":" . $mins1; //Arrive to QC       ?></td>
<td><?php echo $days3 . ":" . $hours3 . ":" . $mins3; //Arrive to Approved ?></td>
<td><?php echo $days7 . ":" . $hours7 . ":" . $mins7; //Start To Approved    ?></td>
<td><?php echo $row['STATUS']; ?></td>
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