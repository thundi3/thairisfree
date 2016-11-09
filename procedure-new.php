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
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add New Procedure</title>
</head>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 

<body bgcolor="#d4d4d4">

<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
$topbar = "Add New Procedure";
include "topbar.php";

echo "<b>Add New Procedure </b><br />";
//echo "<table><tr><td>";




//echo "Center</td><td>THAIRIS</td></tr><tr><td>Code</td><td><input type=hidden name=CODE value=></td></tr>";
			$sql2 ="select * FROM xray_center order by NAME";
			$result2 = mysql_query($sql2);
			echo "<div id='".$row['ORDERID']."'>\n";
			echo "Center Code: <select name=center_code id=select_center".$row['ORDERID'].">";
			echo "<option value=''>Select Center</option>\n";
			while ($row =mysql_fetch_array($result2))
				{
					echo "<option name=center_code value=".$row['CODE'];
					if ($row['CODE'] == $center_code)
						{ 
							echo " selected=selected "; 
						}   
					echo " >".$row['NAME']."</option>\n";
					echo $row['CODE']."VS".$center_code."<br>";
				}
				
				echo "<select></div>";

//echo "</table>"
?>


<FORM method="post"action=../xraythai.com/public_html/procedure-edit-up.php>


<table><tr><td>Center</td><td>
<?php
$sql2 ="select * FROM xray_center order by NAME";
			$result2 = mysql_query($sql2);
			echo "<option value=''>Select Center</option>\n";
			while ($row =mysql_fetch_array($result2))
				{
					echo "<option name=center_code value=".$row['CODE'];
					if ($row['CODE'] == $center_code)
						{ 
							echo " selected=selected "; 
						}   
					echo " >".$row['NAME']."</option>\n";
					echo $row['CODE']."VS".$center_code."<br>";
				}
				
				echo "<select></div>";
?>
</td></tr>
<tr><td>Code</td><td><input type="text" name=CODE value=''></td></tr>
<tr><td>Description</td><td><input type="text" name="DESCRIPTION"  size=50 /></td></tr>
<tr><td>TYPE</td><td><input type="text" name=""  size=50 ></td></tr>
<tr><td>Body Part</td><td><input type="text" name=""  size=50 ></td></tr>
<tr><td>Charge</td><td><input type="text" name=""  size=50 ></td></tr>
<tr><td>Portable Charge</td><td><input type="text" name=""  size=50 ></td></tr>
<tr><td>DF</td><td><input type="text" name=""  size=5 ></td></tr>
<tr><td>TIME</td><td><input type="text" name=""  size=50 ></td></tr>
<tr><td>BIRAD</td><td><input type="text" name=""  size=50 ></td></tr>
<tr><td>PREPARATION  FORM</td>
<td><select name="select" id="select">
<option value="">-</option><option value='1'>test</option>
<option value='2'>test2</option><option value='3'>test2</option>
<option value='4'>test</option><option value='5'>CT Upper Abdomen</option>
<option value='6'>TEST001</option><option value='7'>Upper Abdomen (Female)</option></select>
</table><input type="submit" name="button" id="button" value="Create New" />
</FORM>


</body>
</html>