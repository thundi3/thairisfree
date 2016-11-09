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

$result = mysql_query("SELECT * FROM xray_code");

?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script type="text/javascript" src="frames_body_array.js" type=text/javascript></script>
<script type="text/javascript" src="mmenu.js" type=text/javascript></script>  
</head>

<body>

<p>Procedure </p>
<p>Code 
  <input type="text" name="textfield" id="textfield" />
Name 
<input type="text" name="textfield2" id="textfield2" />
Type 
<input type="text" name="textfield3" id="textfield3" />
<input type="submit" name="button" id="button" value="Search" />
</p>
<form id="form1" name="form1" method="post" action="">
</form>
<?php
echo "<table border='0'>

<tr>
<th>Code</th>
<th>รายการ</th>
<th>Type</th>
<th>ราคา</th>
<th>DF</th>
<th>เวลาตรวจ</th>
<th>Prep</th>
<th>E</th>
<th>V</th>
</tr>\n";

$bg = '';
while($row = mysql_fetch_array($result))
	{ 
		if($bg == "#FFFFFF") 
			{ 
				$bg = "#EBEBEB";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		echo "<tr bgcolor=$bg>";
		echo "<td>" . $row['XRAY_CODE'] . "</td>";
		echo "<td>" . $row['DESCRIPTION'] . "</td>";
		echo "<td>" . $row['XRAY_TYPE_CODE'] . "</td>";
		echo "<td align=right>" . $row['CHARGE_TOTAL'] . "</td>";
		echo "<td align=right>" . $row['DF'] . "</td>";
		echo "<td align=right>" . $row['TIME_USE'] . "</td>";
		echo "<td ></td>";
		echo "<td><a href=procedure-edit.php?code=".$row['XRAY_CODE'].">Edit</a></td>";
		echo "<td><a href=procedure-view.php?code=".$row['XRAY_CODE'].">View</a></td>";
		echo "</tr>\n";
	}

echo "</table>";
echo "<a href=# onclick=open_type()>MRI</a>";
echo "<a href=# onclick=open_procedure()>CT</a><br>";

echo "</body></html>";

?>
