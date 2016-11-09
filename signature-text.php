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
$sql = "Update xray_user SET TEXT_SIGNATURE='$SIGN' where ID='$userid'";
mysql_query($sql);

?>


<script type="text/javascript">
	window.location="main.php";
</script>
