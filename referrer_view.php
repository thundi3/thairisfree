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


$result = mysql_query("SELECT * FROM xray_referrer");

?>
<html>
<head>
<title>View Referrer</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>

<body>
<?php
echo "<table border='1'>

<tr>

<th>CODE</th>
<th>DEGREE</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>English Name</th>
<th>English LASTNAME</th>
</tr>\n";

//$row1 = mysql_fetch_array($result);

//if ($row1 < 0) {

//exit;

//}

while($row = mysql_fetch_array($result))

  {

if($bg == "#FFFFFF") { 

$bg = "#FFCCCC";

} else {

$bg = "#FFFFFF";

}



  echo "<tr bgcolor=$bg>";

  echo "<td>" . $row['REFERRER_ID'] . "</td>";
  echo "<td>" . $row['DEGREE'] . "</td>";
  echo "<td>" . $row['NAME'] . "</td>";
  echo "<td>" . $row['LASTNAME'] . "</td>";
  echo "<td>" . $row['NAME_ENG'] . "</td>";
  echo "<td>" . $row['LASTNAME_ENG'] . "</td>";
  echo "</tr>\n";

  }

echo "</table>";

?>

</body>
</html>
