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
$MRN = $_GET['MRN'];
include ("session.php");
include ("connectdb.php");
include ("function.php");

echo "PATIENT MRN=".$MRN."<br />";

$sql = "select MRN, NAME, LASTNAME, NAME_ENG, LASTNAME_ENG, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);


echo "<body bgcolor=#E8E8E8>";	

echo "<form action=patient-edit-save.php?>";

echo "<input type=hidden name=MRN value=".$MRN.">";
echo "Name : <input type=text name=firstname value=".$row['NAME']."><br />";
echo "Lastname : <input type=text name=lastname value=".$row['LASTNAME']."><br />";
echo "Name (English) : <input type name=nameeng value=".$row['NAME_ENG']."><br />";
echo "Lastname (Englist) : <input type name=lastnameeng value=".$row['LASTNAME_ENG']."><br />";
if ($row['SEX'] =='M') {
echo "<input type=\"radio\" name=\"sex\" value=\"male\" checked/> Male ";
echo "<input type=\"radio\" name=\"sex\" value=\"female\" /> Female ";
echo "<input type=\"radio\" name=\"sex\" value=\"unknow\" /> Unknow <br />";
}
if ($row['SEX'] == 'F') {
echo "<input type=\"radio\" name=\"sex\" value=\"male\" />";
echo "<input type=\"radio\" name=\"sex\" value=\"female\" checked/> Female ";
echo "<input type=\"radio\" name=\"sex\" value=\"female\" /> Unknow <br />";
}
if ($row['SEX'] == 'U') {
echo "<input type=\"radio\" name=\"sex\" value=\"male\" />";
echo "<input type=\"radio\" name=\"sex\" value=\"female\" /> Female ";
echo "<input type=\"radio\" name=\"sex\" value=\"unknow\" /> Unknow <br />";
}


echo $row['SEX']."<br />";
echo "<input type=\"submit\" value=\"Submit\" />";

echo "</form>";


?>