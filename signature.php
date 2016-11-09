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

if ($usertype !== 'RADIOLOGIST'){
	echo "<script language=JavaScript src=\"frames_body_array.js\" type=text/javascript></script>";
	echo "<script language=JavaScript src=\"mmenu.js\" type=text/javascript></script>";  
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"4;URL=main.php\">";
	echo "<font color=red><img src=./icon/urgent.jpg> For Radiologist only</font>";
	exit;
}

?>
<html>
<head>
<title>Main</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}

a:link { color: #005CA2; text-decoration: none}

a:visited { color: #005CA2; text-decoration: none}

a:active { color: #0099FF; text-decoration: underline}

a:hover { color: #0099FF; text-decoration: underline}

-->

</style>

    <script language=JavaScript src="frames_body_array.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  


</head>
<body bgcolor="#FFFFFF"><p />
<br><p />
<center>
<table width =500 border=1>
<tr><td>
<form enctype="multipart/form-data" action="signatureupload.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
<center>Choose a file to upload: <input name="uploadedfile" type="file" /></center><br />
<center><input type="submit" value="Upload File" /></center>
</form>

</td></tr>

<tr bgcolor=black><td bgcolor=#FFFFFF>

<?php


if ($signaturename == ''){
	echo "<br><center>No Image Signature</center><br>";
}
?>
</td>
</tr>
</table>
</center>
</body>
</html>