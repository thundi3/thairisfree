<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Jan 2012
# File name: prepare-add.php
# Description :  Report editor for Radiologist
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

header("Content-type: text/html;  charset=TIS-620");
include "session.php";
include "connectdb.php";
include "function.php";
$sql = "select XRAY_TYPE_CODE from xray_type";
$result = mysql_query($sql);
$sql2 = "select BODY_PART from xray_body_part";
$result2 = mysql_query($sql2);

?>

<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body bgcolor="#d4d4d4">

Add New preparation form : <br />

<form id="form1" name="form1" method="post" action="prepare-ins.php">
<?php

echo "Modality Type : <SELECT id=\"modality\" name=\"MODALITY\" >";
echo "<OPTION></OPTION>";
while($row = mysql_fetch_array($result)){
	echo "<OPTION VALUE=".$row['XRAY_TYPE_CODE'].">".$row['XRAY_TYPE_CODE']."</OPTION>";
}
echo "</SELECT>";



?>
  
  
  <label>Form Name
    <input type="text" name="NAME" id="textfield2" />
  </label>
  
<?php
echo "Body part : <SELECT id=\"bodypart\" name=\"BODYPART\" >";
echo "<OPTION></OPTION>";
while($row = mysql_fetch_array($result2)){
	echo "<OPTION VALUE=".$row['BODY_PART'].">".$row['BODY_PART']."</OPTION>";
}
echo "</SELECT>";


?>


<br />
Thai<br />

<table bgcolor=white border="0" cellspacing="0" cellpadding="0">
<tr><td>
  <label>
    <textarea name="DESCRIPT1" id="textarea" cols="100" rows="20"></textarea>
  </label>
  </td></tr>
  </table>
  

English<br />
  <table bgcolor=white border="0" cellspacing="0" cellpadding="0">
<tr><td>
  <label>
    <textarea name="DESCRIPT2" id="textarea" cols="100" rows="20"></textarea>
  </label>
    </td></tr>
  </table>
   <input type="reset" name="Reset" id="button" value="Clear" />   <input type="submit" name="button2" id="button2" value="Submit" />
</form>
<script type="text/javascript" src="nicEdit.js"></script> 
<script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
 </script>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>