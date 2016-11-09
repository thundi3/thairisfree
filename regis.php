<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 05 OCT 2016
# File name: regis.php
# Description :  Insert data from registor.php to database
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
include "session.php";
mysql_select_db($dbname,$dbconnect);

error_reporting( error_reporting() & ~E_NOTICE );

$mrn = $_POST['mrn'];
$xn = $_POST['xn'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mname = $_POST['mname'];
$efname = $_POST['efname'];
$elname = $_POST['elname'];
$sex = $_POST['sex'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$road = $_POST['road'];
$tambon = $_POST['tambon'];
$ampher = $_POST['ampher'];
$province = $_POST['province'];
$country = $_POST['country'];
$telephone = $_POST['telephone'];
$fax = $_POST['fax'];
$email = $_POST['email'];

// Check Duplicat MRN
$result = mysql_query("SELECT MRN,NAME,LASTNAME FROM xray_patient_info WHERE (MRN = '$mrn') AND (CENTER_CODE ='$center_code')");
$numrows = (mysql_num_rows($result));
if($numrows !== 0)
	{
		echo "Found Duplicate MRN/ Similar";
		echo "<table border='0' cellspacing='1' width=30%>\n
		<tr bgcolor=#CCCCCC>\n
		<td><center>MRN</center></td>\n
		<td><center>Firstname</center></td>\n
		<td><center>Lastname</center></td>\n
		<td><center></center></td>\n
		</tr>";
		while($row = mysql_fetch_array($result))
			{
				echo "<tr>";
				echo "<td align=right>" . $row['MRN'] . "</td>";
				echo "<td>" . $row['NAME'] . "</td>";
				echo "<td>" . $row['LASTNAME'] . "</td>";
				echo "<td><form id=createorder  name=createorder method=post action=\"createorder.php\"> <input name=\"MRN\" type=\"hidden\" id=\"MRN\" value=". $row['MRN'] . "><input type=\"submit\" name=\"button\" id=\"button\" value=\"Create Order\" /></form>";
				echo "</tr>";
			}
		echo "</table>\n";
	exit;
	}
/////////////////////////
//echo "DataBase connection OK<br>";

if ($mrn=="") 
	{
		echo "<br /><font color=red>please input Medical Record Number (MRN)</font>";
		exit;
	}
if ($fname=="") 
	{
		echo "<br /><font color=red>please input name</font>";
		exit;
	}
if ($lname=="") 
	{
		echo "<br /><font color=red>Please input lastname</font>";
		exit;
	}
if ($sex=="") 
	{
		echo "<br /><font color=red>Please input sex</font>";
		exit;
	}
if ($dob=="")
	{
		echo "<br /><font color=red>Please input Date of Birth</font>";
		exit;
	}
$dob = date('Ydm', strtotime($dob)); 
$sql = "insert into xray_patient_info(CENTER_CODE,MRN,XN,NAME,LASTNAME,SEX,NAME_ENG,LASTNAME_ENG,BIRTH_DATE,TELEPHONE,EMAIL,CREATE_DATE,ADDRESS,ROAD,TAMBON_CODE,AMPHOE_CODE,PROVINCE_CODE,COUNTRY_CODE) values ('$center_code','$mrn','$xn','$fname','$lname','$sex','$efname','$elname','$dob','$telephone','$email',now(),'$address','$road','$tambon','$ampher','$province','$country')";
 

if (!mysql_query($sql,$dbconnect))
  {
	die('Error: ' . mysql_error()); 
  }

mysql_query("SET CHARACTER SET $charectorset");
mysql_close($dbconnect);

echo "Name : $fname  <br />Lastname : $lname <br />Sex : $sex<br />\n";
echo "<br /> DOB : ".$dob;
echo "Created on DB<br />";
echo "<form method=post action=createorder.php>";
echo "<input type=hidden name=MRN value='$mrn'>";
echo "<input type=submit value=CreateOrder>";
echo "</form>\n";


?>