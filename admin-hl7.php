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
echo "<script language=JavaScript src=\"frames_body_array_english.js\" type=text/javascript></script>";
echo "<script language=JavaScript src=\"mmenu.js\" type=text/javascript></script>";  

if ($usertype !== 'ADMIN')
	{
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"4;URL=main.php\">";
		echo "<font color=red><img src=./icon/urgent.jpg> For Admin only</font>";
		exit;
	}
echo "Re-Send ORM<br>";
echo "Re-Send ORU<br>";
?>