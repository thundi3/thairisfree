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
$result = mysql_query("SELECT DEPARTMENT_ID,NAME_THAI,NAME_ENG FROM xray_department");

?>
<html>
<head>
<title>View Department</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body>

<?php
echo "<table border='1'>
<tr>
<th>Departmnet ID</th>
<th>NAME</th>
<th>English Name</th>
</tr>\n";

while($row = mysql_fetch_array($result))
	{
		if($bg == "#FFFFFF") 
			{ // Switch colour for background
				$bg = "#FFCCCC";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		echo "<tr bgcolor=$bg>";
		echo "<td>" . $row['DEPARTMENT_ID'] . "</td>";
		echo "<td>" . $row['NAME_THAI'] . "</td>";
		echo "<td>" . $row['NAME_ENG'] . "</td>";
		echo "</tr>\n";
	}
echo "</table>";
?>

</body>
</html>