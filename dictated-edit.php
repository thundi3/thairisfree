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
include ("connectdb.php");
require_once './htmlpurifier/library/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
//$config->set('Core.Encoding', 'TIS-620'); // replace with your encoding
$config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
$purifier = new HTMLPurifier($config);
//header('Content-type: text/html; charset=utf-8');

$ORDERID = $_POST['ORDERID'];
$MRN = $_POST['hn'];
$RADID = $_POST['RADID'];
$TEXTREPORT = $_POST['TEXTREPORT'];
$ACCESSION = $_POST['ACCESSION'];
$BIRAD = $_POST['BIRAD'];
$DICTATE_TYPE = $_POST['dictate_type'];
$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.PREFIX, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG AS NAMEENG, 
			xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 	
			xray_patient_info.BIRTH_DATE AS DOB,	
			xray_patient_info.SEX,
			xray_request.REQUEST_NO, 					
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.REQUEST_DATE AS REQ_DATE,
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE,
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,	
			xray_request_detail.APPROVED_TIME,
			xray_code.XRAY_TYPE_CODE,
			xray_department.DEPARTMENT_ID,
			xray_department.NAME_THAI AS DEP,	
			xray_code.XRAY_CODE,
			xray_code.DESCRIPTION, 
			xray_referrer.REFERRER_ID AS RE_ID,
			xray_referrer.NAME AS REF_NAME,
			xray_referrer.LASTNAME AS REF_LASTNAME
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
			LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
			LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
			LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
			LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_patient_info.MRN = '$MRN') 
			AND (xray_request_detail.ACCESSION ='$ACCESSION')
			AND (xray_request_detail.STATUS != 'CANCEL') 
			AND (xray_patient_info.CENTER_CODE ='$center_code')
			AND (xray_department.CENTER ='$center_code')			
			ORDER BY URGENT desc, ORDERTIME ASC ";

$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
	{
			$MRN             = $row['MRN'];
			$PREFIX	= $row['PREFIX'];
			$PATIENTNAME     = $row['PTNAME'];
			$PATIENTLASTNAME = $row['PTLASTNAME'];
			$PATIENTENGNAME	 = $row['NAMEENG'];
			$PATIENTENGLAST	 = $row['LASTNAMEENG'];
			$SEX = $row['SEX'];
			$DOB = $row['DOB'];
			$REQUEST_NO 	 = $row['REQUEST_NO'];
			$REQ_DATE = $row['REQ_DATE'];
			$REQ_TIME = $row['REQ_TIME'];
			$ORDERDATE	     = $row['ORDERTIME'];
			$PRO_CODE	= $row['XRAY_CODE'];
			$PROCEDURE		 = $row['DESCRIPTION'];
			$DEP_ID		= $row['DEPARTNENT_ID'];
			$DEP      = $row['DEP'];
			$REF_ID	= $row['RE_ID'];
			$REF_NAME 		= $row['REF_NAME'];
			$REF_LASTNAME	= $row['REF_LASTNAME'];
			$BIRADFLAG = $row['BIRAD_FLAG'];
	}
	
// Remove Temp Report (From Auto Save) 
$allow = '<br />,<br>,<br/>,<div>,<p>';
$result= strip_tags($TEXTREPORT,$allow);
$result1 = trim(preg_replace('/\s+/', ' ', $result));
$result1= preg_replace('#<div\s*/?>#i', '', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#<p\s*/?>#i', '\.br\\', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#</p\s*/?>#i', '', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#<br\s*/?>#i', '\.br\\', $result1);  // Replace <br > with new line \n
$result1= preg_replace('#</div\s*/?>#i', '\.br\\', $result1);  // Replace <br > with new line \n
$result1= preg_replace('/[\n\r\t]/', '\.br\\', $result1);
$result1= preg_replace('/<[^>]*>/', '', $result1);
$result1 = str_replace("&nbsp;", " ", $result1);
$result1 = str_replace("&amp;", "&", $result1);
$result1 = str_replace("&lt;", "<", $result1);
$result1 = str_replace("&gt;", ">", $result1);

$result2 = trim(preg_replace('/\s+/', ' ', $result));
$result2= preg_replace('#<div\s*/?>#i', '', $result2);  // Replace <br > with new line \n
$result2= preg_replace('#<p\s*/?>#i', '\.br\\', $result2);  // Replace <br > with new line \n
$result2= preg_replace('#</p\s*/?>#i', '', $result2);  // Replace <br > with new line \n
$result2= preg_replace('#<br\s*/?>#i', '\.br\\', $result2);  // Replace <br > with new line \n
$result2= preg_replace('#</div\s*/?>#i', '\.br\\', $result2);  // Replace <br > with new line \n
$result2= preg_replace('/<[^>]*>/', '', $result2);
$result2 = str_replace("&nbsp;", " ", $result2);
$result2 = str_replace("&amp;", "&", $result2);
$result2 = str_replace("&lt;", "<", $result2);
$result2 = str_replace("&gt;", ">", $result2);

$result1=$result1."\.br\ -------------------------------------------------------------------------------------- \.br\ Reported By : ".$username." ".$userlastname;
$result1=$result1."\.br\ Report time (Updated) : ".date("d-m-Y H:i:s");

$TEXTREPORT_HL7 = $result1;
$TEXTREPORT_HL7_2 = $result2;
//Clean the inside of the tags
function clean_inside_tags($txt,$tags)
	{
        preg_match_all("/<([^>]+)>/i",$tags,$allTags,PREG_PATTERN_ORDER);
		foreach ($allTags[1] as $tag)
			{
				$txt = preg_replace("/<".$tag."[^>]*>/i","<".$tag.">",$txt);
			}
		return $txt;
	}
///////////////////
if ($ACCESSION =="")
	{
		echo "Can't update something wrong<br />";
		echo "Report have reported or You have Log out the system";
		exit;
	}
if ($BIRAD !=="")
	{
		$sql ="select LEVEL,DESCRIPTION FROM xray_birad WHERE BIRAD='$BIRAD'";
		$result = mysql_query($sql);
		while ($row =mysql_fetch_array($result))
			{
				$BIRAD = $row['DESCRIPTION']."<br />";
				$BIRAD_LEVEL = $row['LEVEL'];
			}
	}
////////////////Create HL7///////////////

////////////////////////////////////////
$TEXTREPORT = mysql_real_escape_string($TEXTREPORT);


if ($DICTATE_TYPE == 'Approve')
	{
		$sql1 = "UPDATE xray_request_detail SET STATUS='APPROVED', REPORT_STATUS='1', PAGE='END', APPROVED_TIME=now() where ID='$ORDERID'";
		
		$sql2 = "INSERT INTO xray_report 
					(ACCESSION, REPORT, BIRAD, DICTATE_BY, DICTATE_DATE, DICTATE_TIME, APPROVE_BY, APPROVE_DATE, APPROVE_TIME) 
					values 
					('$ACCESSION', '$TEXTREPORT', '$BIRAD_LEVEL', '$userid',  CURDATE(), NOW(), '$userid', CURDATE(), NOW())";
			
		//$sql3 = "UPDATE xray_request_detail SET LASTREPORT_ID='$last_id' WHERE ACCESSION='$ACCESSION'";
		$sql4 = "UPDATE xray_request_detail SET TEMP_REPORT='$TEXTREPORT' WHERE ID='$ORDERID'";
		mysql_query($sql1);
		mysql_query($sql2);
		mysql_query($sql4);
		$last_id = (mysql_insert_id());		
		//mysql_query($sql3);

		$IP=getenv(REMOTE_ADDR);
		$URL=$_SERVER["HTTP_REFERER"];
		mysql_query("insert into xray_log (USER,IP,EVENT,URL, MRN, ACCESSION)VALUES ('$userlogin','$IP','EDIT REPORT','$URL', '$MRN', '$ACCESSION')");
	}

if ($DICTATE_TYPE == 'Save')
	{
		$sql1 = "UPDATE xray_request_detail SET STATUS='PRELIM', REPORT_STATUS='1', PAGE='RADIOLOGIST', APPROVED_TIME=now() where ID='$ORDERID'";
		
		//$sql2 = "INSERT INTO xray_report 
		//			(ACCESSION, REPORT, BIRAD, DICTATE_BY, DICTATE_DATE, DICTATE_TIME, APPROVE_BY, APPROVE_DATE, APPROVE_TIME) 
		//			values 
		//			('$ACCESSION', '$TEXTREPORT', '$BIRAD_LEVEL', '$userid',  CURDATE(), NOW(), '$userid', CURDATE(), NOW())";
			
		//$sql3 = "UPDATE xray_request_detail SET LASTREPORT_ID='$last_id' WHERE ACCESSION='$ACCESSION'";
		$sql4 = "UPDATE xray_request_detail SET TEMP_REPORT='$TEXTREPORT' WHERE ID='$ORDERID'";
		mysql_query($sql1);
		//mysql_query($sql2);
		mysql_query($sql4);
		//$last_id = (mysql_insert_id());		
		//mysql_query($sql3);

		$IP=getenv('REMOTE_ADDR');
		$URL=$_SERVER["HTTP_REFERER"];
		mysql_query("insert into xray_log (USER,IP,EVENT,URL, MRN, ACCESSION)VALUES ('$userlogin','$IP','EDIT REPORT SAVE','$URL', '$MRN', '$ACCESSION')");
	}
	
$TEXTREPORT = $BIRAD.$TEXTREPORT;

?>

<script type="text/javascript">
	window.location="dictate-worklist.php";
</script>
