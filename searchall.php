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
include "connectdb.php";

mysql_select_db($dbname,$dbconnect);

$hn = $_POST['hn'];
$xn = $_POST['xn'];
$request = $_POST['request'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];


?>

<html>

<head>

<title>Search</title>
	
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type="text/javascript"></script>  
</head>
<body>

<?php
if ($hn =="" && $xn =="" && $request =="" && $fname =="" && $lname =="") 
	{
		echo "<br><font color=red>กรุณาใส่ข้อมูลค้นหา</font>";
		exit;
	}


//$result = mysql_query("SELECT NAME,LASTNAME FROM 'patient_info' WHERE LIKE '%$fname%'");

$result = mysql_query("SELECT NAME,LASTNAME FROM xray_patient_info WHERE NAME LIKE '%$fname%' or LASTNAME LIKE '%lname%' LIMIT 0,99");

//$result = mysql_query("SELECT * FROM Persons");



echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";

//$row1 = mysql_fetch_array($result);
//if ($row1 < 0) {
//exit;
//}

while($row = mysql_fetch_array($result))

  {
	echo "<tr>";
	echo "<td>" . $row['NAME'] . "</td>";
	echo "<td>" . $row['LASTNAME'] . "</td>";
	echo "</tr>";
  }

echo "</table>";
echo "<br><b>First Name : $fname</b></br>";
echo "<br><b>Last Name : $lname</b></br>";

?>