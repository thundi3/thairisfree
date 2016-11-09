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

$TEXTREPORT = $_POST['TEXTREPORT'];
$sql = "Update xray_news SET NEWS='$TEXTREPORT'where CENTER_CODE='$center_code'";
mysql_query($sql);

?>
<script type="text/javascript">
	window.location="main.php";
</script>
