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

$RADID = $_POST[RADID];

$sql = "INSERT INTO xray_report(ACCESSION,REPORT) values ('$ACCESSION','$TEXTREPORT')";
//mysql_query($sql);

exit;

?>

<script type="text/javascript">
	window.location="reporting.php";
</script>
