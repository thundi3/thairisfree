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
echo "<body bgcolor=\"#d4d4d4\">";
include "connectdb.php";
$code = $_GET['code'];

$result = mysql_query("SELECT * FROM xray_code WHERE XRAY_CODE='$code'");

while($row = mysql_fetch_array($result))
	{
			$CENTER = $row['CENTER'];
			$CODE =$row['XRAY_CODE'];
			$DESCRIPTION = $row['DESCRIPTION'];
			$XRAY_TYPE_CODE=$row['XRAY_TYPE_CODE'];
			$BODY_PART = $row['BODY_PART'];
			$CHARGE_TOTAL =$row['CHARGE_TOTAL'];
			$PORTABLE_CHARGE = $row['PORTABLE_CHARGE'];
			$DF = $row['DF'];
			$TIME_USE = $row['TIME_USE'];
			$BIRAD_FLAG = $row['BIRAD_FLAG'];
			$PREP_ID = $row['PREP_ID'];
			
	}
echo "<FORM method=\"post\"action=procedure-edit-up.php>";
echo "<b>Edit Procedure detail</b>";
echo "<table>";
echo "<tr><td>Center</td><td>".$CENTER."</td></tr>";
echo "<tr><td>Code</td><td><input type=hidden name=CODE value=$CODE>".$CODE."</td></tr>";
echo "<tr><td>Description</td><td><input type=\"text\" name=\"DESCRIPTION\"  size=50 value='".$DESCRIPTION."'/></td></tr>";
echo "<tr><td>TYPE</td><td><input type=\"text\" name=\"\"  size=50 value=".$XRAY_TYPE_CODE."></td></tr>";
echo "<tr><td>Body Part</td><td><input type=\"text\" name=\"\"  size=50 value=".$BODY_PART."></td></tr>";
echo "<tr><td>Charge</td><td><input type=\"text\" name=\"\"  size=50 value=".$CHARGE_TOTAL."></td></tr>";
echo "<tr><td>Portable Charge</td><td><input type=\"text\" name=\"\"  size=50 value=".$PORTABLE_CHARGE."></td></tr>";
echo "<tr><td>DF</td><td><input type=\"text\" name=\"\"  size=5 value=".$DF."></td></tr>";
echo "<tr><td>TIME</td><td><input type=\"text\" name=\"\"  size=50 value=".$TIME_USE."></td></tr>";
echo "<tr><td>BIRAD</td><td><input type=\"text\" name=\"\"  size=50 value=".$BIRAD_FLAG."></td></tr>";
echo "<tr><td>PREPARATION  FORM</td><td>";

$result = mysql_query("SELECT PREP_ID, NAME FROM xray_preparation");
echo "<select name=\"select\" id=\"select\">";
echo "<option value=\"\">-</option>";
while ($row =mysql_fetch_array($result))
	{
		echo "<option value='".$row['PREP_ID']."'>".$row['NAME']."</option>";
	}
echo"</select>";
echo "</table>";
echo "<input type=\"submit\" name=\"button\" id=\"button\" value=\"Update\" />";
echo "</FORM>";
?>