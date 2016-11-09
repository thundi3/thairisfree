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
include ("session.php");
$result = mysql_query("SELECT CODE, NAME, NAME_ENG FROM xray_center");
?>

<html>
<head>
<title>CENTER</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
</head>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
$topbar = "Add New Procedure";
include "topbar.php";
?>
<body bgcolor="#d4d4d4">
Center : <br />
<?php


echo "<table border='1'>

<tr bgcolor=#8080ff>

<th>CODE</th>
<th>Name</th>
<th>English</th>
</tr>\n";

//$row1 = mysql_fetch_array($result);

//if ($row1 < 0) {

//exit;

//}

while($row = mysql_fetch_array($result))

  {

		if($bg == "#FFFFFF") 
			{ //
				$bg = "#FFCCCC";

			} else {

				$bg = "#FFFFFF";

					}
  echo "<tr bgcolor=$bg>";
  echo "<td>" . $row['CODE'] . "</td>";
  echo "<td>" . $row['NAME'] . "</td>";
  echo "<td>" . $row['NAME_ENG'] . "</td>";
  echo "</tr>\n";

  }

echo "</table>";

?>
<hr>

Add Center

<form id="form1" name="form1" method="post" action="center-add.php">
CODE <input type="text" name="code"/>
Name <input type="text" name="name"/>
English <input type="text" name="name_eng"/>
<input type="reset" /><input type="submit" />
</form>



</body>
</html>