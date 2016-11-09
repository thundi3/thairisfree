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
include ("session.php");
include "connectdb.php";
$owner = $_POST['owner'];
$modality = $_POST['modality'];
$bodypart = $_POST['BODYPART'];
$xraycode = $_POST['PROCEDURE'];
$templetename = $_POST['TEMPLATENAME'];
$text = $_POST['TEXTREPORT'];
$all_user ='0';
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   
<?php
echo "Owner :".$owner;
echo $modality;
echo $bodypart;
echo $xraycode;
echo $templetename;
echo "<br> Template Body :".$text;
echo "<br>UserCode =".$usercode;

if ($owner == 'ALL')
	{
		$owner = $usercode;
		$all_user = '1';
	}

if ($bodypart == '' && $xraycode =='')
	{
		echo "Please Select Body Part OR Select Xray Code";
		exit;
	}

if ($templetename =='')
	{
		echo "Please Create Name Template";
		exit;
	}

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
$sql ="insert INTO xray_report_template 
		(NAME, XRAY_CODE, XRAY_TYPE_CODE, BODY_PART, USER_ID, REPORT_DETAIL,ALL_USER)
		VALUES 
		('$templetename', '$xraycode', '$modality', '$bodypart', '$userid','$text','$all_user')";

mysql_query($sql);
echo "Complate";
?>
