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

	
////////////////////////////////
	
$strExcelFileName="Export-template-ThaiRIS_".time().".xls";
header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
header("Pragma:no-cache");

$sql_select = "

SELECT 
xray_report_template.ID,
xray_report_template.NAME AS TEMP_NAME,
xray_report_template.BODY_PART,
xray_report_template.XRAY_TYPE_CODE,
xray_report_template.USER_ID,
xray_report_template.REPORT_DETAIL,
xray_user.ID,
xray_user.CODE,
xray_user.NAME,
xray_user.LASTNAME
FROM xray_report_template
LEFT JOIN xray_user ON xray_user.ID = xray_report_template.USER_ID
WHERE
xray_user.CENTER_CODE = '$center_code'";



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
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<strong>รายงาน วันที่ <?php echo date("d/m/Y");?> ทั้งหมด <?php echo number_format($num);?> รายการ</strong><br>
<br>
<div id="SiXhEaD_Excel" align=center x:publishsource="Excel">
<table x:str border=1 cellpadding=0 cellspacing=1 width=100% style="border-collapse:collapse">
<tr>
<td><strong>User Code</strong></td>
<td><strong>User Name</strong></td>
<td><strong>Modality Type</strong></td>
<td><strong>Template Name</strong></td>
<td><strong>Body Part</strong></td>
<td><strong>Template</strong></td>

</tr>
<?php
if($num>0)
	{
		while($row=mysql_fetch_array($sql))
			{
				$time_arrival = $row['ARRIVAL'];
				$time_approve = $row['APPROVE'];
				$time_diff = timeDiff($time_arrival,$time_approve);
				// Convert to text
				$years = abs(floor($time_diff / 31536000));
				$days = abs(floor(($time_diff-($years * 31536000))/86400));
				$hours = abs(floor(($time_diff-($years * 31536000)-($days * 86400))/3600));
				$mins = abs(floor(($time_diff-($years * 31536000)-($days * 86400)-($hours * 3600))/60));#floor($time_diff / 60);
$TEXTREPORT =  $row['REPORT_DETAIL'];


			
$allow = '<br />,<br>,<br/>,<div>,</p>';
$result= strip_tags($TEXTREPORT,$allow);
$result1 = trim(preg_replace('/\s+/', ' ', $result));
$result1= preg_replace('#<div\s*/?>#i', '', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#<p\s*/?>#i', '', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#</p\s*/?>#i', '\.br\\', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#<br\s*/?>#i', '\.br\\', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#</div\s*/?>#i', '\.br\\', $result1);  // Replace <br > with new line \n
$result1= preg_replace('/[\n\r\t]/', '\.br\\', $result1);
$result1= preg_replace('/<[^>]*>/', '', $result1);
$result1 = str_replace("&nbsp;", " ", $result1);
$result1 = str_replace("&amp;", "&", $result1);
$result1 = str_replace("&lt;", "<", $result1);
$result1 = str_replace("&gt;", ">", $result1);

$TEMPLATE = $result1;
			
?>
<tr>
<td><?php echo $row['CODE'];?></td>
<td><?php echo $row['NAME']." ".$row['LASTNAME'];?></td>
<td><?php echo $row['XRAY_TYPE_CODE'];?></td>
<td><?php echo $row['TEMP_NAME'];?></td>
<td><?php echo $row['BODY_PART'];?></td>
<td><?php echo $TEMPLATE;?></td>


</tr>
<?php
			}
		$IP=getenv(REMOTE_ADDR);
		$URL=$_SERVER["HTTP_REFERER"];
		mysql_query("insert into xray_log (USER,IP,EVENT,URL)VALUES ('$userlogin','$IP','Export Template','$URL')");
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