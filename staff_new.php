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
include "session.php";
include "connectdb.php";

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Add New Staff</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<body bgcolor="#d4d4d4">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<?php
$topbar = "Add New User";
include "topbar.php";
?>
<strong><a href=staff_new.php>Add New Start</a> </strong><br />
<form id="form1" name="form1" method="post" action="staff_insert.php">
<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Add New Staff</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><img src="icon/pen.gif" width="54" height="59" align="middle"> New User </font></td>
	
    <td width="587" bgcolor="#f8d290">




<?php
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

?>


<br />
   
<?php
			$sql2 ="select * FROM xray_user_type order by NAME";
			$result2 = mysql_query($sql2);
			echo "<div id='".$row['ORDERID']."'>\n";
			echo "Staff Type :<select name=user_type id=selectrad".$row['ORDERID'].">";
			echo "<option value=''>Select User Type</option>\n";
			while ($row =mysql_fetch_array($result2))
				{
					echo "<option name=user_type value=\"".$row['TYPE']."\">".$row['NAME']."  ".$row['LASTNAME']."</option>\n";
				}
				echo "</select></div>";
?>



<br/>
  <p>Login Name
    <label>
      <input type="text" name="loginname" id="loginname" />
    </label>
  </p>

  <p>CODE
    <label>
      <input type="text" name="code" id="code" /> DF Code <input type="text" name="dfcode" id="dfcode" />
    </label>
  </p>
  <p>Name 
    <label>
      <input type="text" name="name" id="name" />
Lastname 

      <input type="text" name="lastname" id="lastname" />
    </label>
  </p>
  <p>ENG NAME 
    <label>
      <input type="text" name="name_eng" id="name_eng" />
ENG LASTNAME 
    <label>
      <input type="text" name="lastname_eng" id="lastname_eng" />
    </label>
  </p>
  <p> Password : <label> <input type="text" name="password" id="password" />  Confirm Password<input type="text" name="password2" id="password2" /></label>
  
  
  <br />----------------------------------------------<br />
  PACS USER
    <label>
      <input type="text" name="pacs_user" id="pacs_user" />
    </label>
	
  <p>
    <label>
      <input type="reset" name="clear" id="clear" value="Reset" />
    </label>
    <label>
      <input type="submit" name="button" id="button" value="Submit" />
    </label>
  </p>
  <p>&nbsp;</p>
  
  </form>
  
  </td></tr><table>
  
  
  </body></html>