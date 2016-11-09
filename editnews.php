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

//echo $usertype.$superadmin;
if (($usertype !== 'ADMIN') AND ($superadmin == 0) AND ($admin == 0))
	{
		echo "Admin area  you can't use this page";
		exit;
	}
?>
<!DOCTYPE html>
<meta charset="utf-8" />
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<form method=post action=editnews-edit.php enctype=\"multipart/form-data\">
<img src=./icon/news.jpg><u>Internal Infomation in Radiology</u><br>
<div id="reportspace">
<textarea cols="105" rows="20" id="area2" name="TEXTREPORT">
   <?php
   $sql = "select NEWS from xray_news WHERE CENTER_CODE='$center_code'";
   $result = mysql_query($sql);
   $row = mysql_fetch_array($result);
   echo $row['NEWS'];
   ?>
</textarea><br>
<input type="reset" value=Clear> <input type=submit value=SAVE> 
</div>

<script type="text/javascript" src="nicEdit.js"></script> 
<script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
 </script>
 
