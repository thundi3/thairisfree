<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 02 SEP 2013
# File name: template-deit-save.php
# Description :  Save template edit
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
header("Content-type: text/html;  charset=TIS-620");
include ("session.php");
include "connectdb.php";
$owner = $_POST['owner'];
$modality = $_POST['modality'];
$bodypart = $_POST['BODYPART'];
$xraycode = $_POST['PROCEDURE'];
$templetename = $_POST['TEMPLATENAME'];
$template_id = $_POST['TEMPLATE_ID'];
$text = $_POST['TEXTREPORT'];
$all_user ='0';
?>
<script language=JavaScript src="frames_body_array.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<?php
//echo "<table>";
//echo "<tr><td>Owner : </td><td>".$owner."</td></tr>";
//echo "<tr><td>Modality Type : </td><td>".$modality."</td></tr>";
//echo "<tr><td>Body Part : </td><td>".$bodypart."</td></tr>";
//echo "<tr><td>Xray Code : </td><td>".$xraycode."</td></tr>";
//echo "<tr><td>Template : </td><td>".$templetename."</td></tr>";
//echo "<tr><td>ID :</td><td>".$template_id."</td></tr>";
//echo "<tr><td>Template Body : </td><td>".$text."</td></tr>";
//echo "<tr><td>UserCode : </td><td>".$usercode."</td></tr>";
//echo "</table>";
//exit;

if ($owner == 'ALL')
	{
		$owner = $usercode;
		$all_user = '1';
	}

if ($bodypart == '' && $xraycode =='')
	{
		echo "<font color=blue><b>Please select a modality type and body part</b></font> ";
		exit;
	}

//if ($templetename =='')
//	{
//		echo "Please Create Name Template";
//		exit;
//	}

if ($xraycode !='')
	{
		if ($bodypart == '')
			{

				$sql = "select BODY_PART from xray_code WHERE XRAY_CODE ='$xraycode'";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result))
					{ 
						$bodypart = $row['BODY_PART'];
					}
			}
	}

if ($bodypart =='')
	{
		echo "Please select Body Part Or Procedure";
		exit;
	}

$sql = "UPDATE xray_report_template SET XRAY_CODE ='$xraycode', 
			XRAY_TYPE_CODE = '$modality', 
			BODY_PART = '$bodypart', 
			REPORT_DETAIL = '$text'
			WHERE ID= '$template_id'";
			
mysql_query($sql);
echo "Complate";
?>
