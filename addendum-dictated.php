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
require_once './htmlpurifier/library/HTMLPurifier.auto.php';
    $config = HTMLPurifier_Config::createDefault();
    $config->set('Core.Encoding', 'TIS-620'); // replace with your encoding
    $config->set('HTML.Doctype', 'HTML 4.01 Transitional'); // replace with your doctype
    $purifier = new HTMLPurifier($config);

include ("session.php");
include ("connectdb.php");
$ORDERID = $_POST['ORDERID'];
$RADID = $_POST['RADID'];
$TEXTREPORT = $_POST['TEXTREPORT'];
$OLDREPORT = $_POST['OLDREPORT'];
$ACCESSION = $_POST['ACCESSION'];
$BIRAD = $_POST['BIRAD'];
$COPYREPORT = $_POST['COPYREPORT'];

//HTMLPulrifier
$TEXTREPORT = "<b><u>Addendum</u></b> : <br />".$TEXTREPORT."<br /><center>---------------------------------------------------------------------------------</center><br /><b><u>Original Report</u></b><br />".$OLDREPORT;
$TEXTREPORT = $purifier->purify($TEXTREPORT);

if ($ACCESSION =="")
	{
		echo "Can't update something wrong";
		exit;
	}

if ($BIRAD !=='')
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
if ($CREATEHL7ORU==1)
	{

	}
////////////////////////////////////////

//$sql = "Update xray_request_detail SET STATUS='APPROVED',REPORT_STATUS='1', PAGE='END' where ID='$ORDERID'";
$sql = "UPDATE xray_request_detail SET STATUS='APPROVED', REPORT_STATUS='1', PAGE='END', APPROVED_TIME=now() where ID='$ORDERID'";
mysql_query($sql);
$TEXTREPORT = $BIRAD.$TEXTREPORT;
//$sql2 = "INSERT INTO xray_report(ACCESSION,REPORT,BIRAD,APPROVE_BY) values ('$ACCESSION','$TEXTREPORT','$BIRAD_LEVEL','$userid')";
$sql2 = "INSERT INTO xray_report 
					(ACCESSION, REPORT, BIRAD, DICTATE_BY, DICTATE_DATE, DICTATE_TIME, APPROVE_BY, APPROVE_DATE, APPROVE_TIME) 
					values 
					('$ACCESSION', '$TEXTREPORT', '$BIRAD_LEVEL', '$userid',  CURDATE(), NOW(), '$userid', CURDATE(), NOW())";
		
mysql_query($sql2);

//////////////////////////// For update in xray_request_detail
$last_id = (mysql_insert_id());
$sql = "UPDATE xray_request_detail SET LASTREPORT_ID='$last_id' WHERE ACCESSION='$ACCESSION'";
mysql_query($sql);

echo $TEXTREPORT."<br>";
echo $COPYREPORT[0]."<br>";
echo $COPYREPORT[1]."<br>";
echo "ORDERID=".$ORDERID."<br>";
echo "RADID=".$RADID;

echo(mysql_insert_id())."<br>";
echo "----".$last_id;

?>
<script type="text/javascript">
	window.location="dictate-worklist.php";
</script>
