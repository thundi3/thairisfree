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

$ID = $_POST['ID'];
$PREP_THAI = $_POST['PREP_THAI'];
$PREP_ENG = $_POST['PREP_ENG'];
$sql = "UPDATE xray_preparation SET DESCRIPTION_THAI='$PREP_THAI', DESCRIPTION_ENG='$PREP_ENG' WHERE PREP_ID='$ID'";
mysql_query($sql);
 
 
 
 echo $ID."<hr>";
 echo $PREP_THAI;
 echo "<br />";
echo $PREP_ENG;
 
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   