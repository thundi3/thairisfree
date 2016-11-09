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
$result = mysql_query("SELECT * FROM xray_user");

?>
<html>
<head>
<title>View Referrer</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body bgcolor=#d4d4d4 >
Radiology User<br>
<?php
echo "<center><table border='0' bgcolor='#79acf3' >

<tr>
<th>ID</th>
<th>CODE</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>User Login</th>
<th>English Name</th>
<th>English LASTNAME</th>
<th>User TYPE</th>
<th>User RIS</th>
<th>PACS Login</th>
</tr>\n";

//$row1 = mysql_fetch_array($result);

//if ($row1 < 0) {

//exit;

//}
$bg ="#FFCCCC";
while($row = mysql_fetch_array($result))

  {

if($bg == "#FFFFFF") 
	{ //ส่วนของการ สลับสี 
		$bg = "#C8C8C8";
	} 
else 
	{
		$bg = "#FFFFFF";
	}



  echo "<tr bgcolor=$bg>";
  echo "<td>" .$row['ID'] ."</td>";
  echo "<td>" . $row['CODE'] . "</td>";
  echo "<td>" . $row['NAME'] . "</td>";
  echo "<td>" . $row['LASTNAME'] . "</td>";
  echo "<td>" .$row['LOGIN']. "</td>";
  echo "<td>" . $row['NAME_ENG'] . "</td>";
  echo "<td>" . $row['LASTNAME_ENG'] . "</td>";
  echo "<td>" . $row['USER_TYPE_CODE'] ."</td>";
  echo "<td>" . $row['LOGIN']. "</td>";  
  echo "<td>" . $row['PACS_LOGIN']. "</td>";
  echo "</tr>\n";

  }

echo "</table></center>";

?>

</body>
</html>
