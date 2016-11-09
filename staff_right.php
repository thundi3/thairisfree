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
include "session.php";
$sql = 
"SELECT 
xray_user.ID AS ID,
xray_user.CODE AS CODE, 
xray_user.NAME AS NAME, 
xray_user.LOGIN,
xray_user.LASTNAME AS LASTNAME, 
xray_user.CENTER_CODE,
xray_user_right.USER_ID AS USER_ID,
xray_user_right.SUPER_ADMIN AS SUPER_ADMIN,
xray_user_right.ADMIN AS ADMIN,
xray_user_right.DELETE_ORDER AS DELETE_ORDER,
xray_user_right.CHANGE_STATUS AS CHANGE_STATUS,
xray_user_right.EDIT_PATIENT AS EDIT_PATIENT
FROM xray_user
RIGHT JOIN xray_user_right ON xray_user.ID = xray_user_right.USER_ID
WHERE xray_user.CENTER_CODE ='$usercenter'";

$result = mysql_query($sql);

?>
<html>
<head>
<title>User Right</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
</head>
<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">User right</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<center>
<u>User Right</u>
</center><br>
<?php
echo "<center><table border='1' bordercolor=black bgcolor='#79acf3' width=95%>

<tr>
<th>ID</th>
<th>CODE</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>User Login</th>
<th>Super Admin</th>
<th>Admin</th>
<th>Delete</th>
<th>Change Status</th>
<th>Edit Patient</th>
<th>Upload</th>
<th>Delete Upload</th>
</tr>\n";

//$row1 = mysql_fetch_array($result);

//if ($row1 < 0) {

//exit;

//}
$bg ="#FFCCCC";
//while($row = mysql_fetch_array($result))
while($row = mysql_fetch_assoc($result))
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
		
		//$id[]=$row['ID2']; 
		
		echo "<td>" .$row['ID'] ." </td>";
		echo "<td>" . $row['CODE'] . "</td>";
		echo "<td>" . $row['NAME'] . "</td>";
		echo "<td>" . $row['LASTNAME'] . "</td>";
		echo "<td>".$row['LOGIN']."</td>";
		echo "<form name=\"form1\" method=\"post\" action=\"\">\n";
		echo "<input type=hidden name=id[]".$row['ID']." value=".$row['ID'].">";
		//echo "<input type=hidden name=userid".$row['ID']." value=".$row['ID'].">";
		if ($row['SUPER_ADMIN'] == 1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"SUPER_ADMIN[".$row['ID']."]\" id=\"SUPER_ADMIN\" value=\"1\" checked></td>\n";
			}
		else 
			{
				echo "<td align=center><input type=\"checkbox\" name=\"SUPER_ADMIN[".$row['ID']."]\"  id=\"SUPER_ADMIN\" value=\"1\" ></td>\n";
			}
		if ($row['ADMIN'] == 1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"ADMIN[".$row['ID']."]\"  id=\"ADMIN\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"ADMIN[".$row['ID']."]\"  id=\"ADMIN\" value=\"1\"></td>\n";
			}
		if ($row['DELETE_ORDER'] == 1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"DELETE_ORDER[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"DELETE_ORDER[".$row['ID']."]\" value=\"1\"></td>\n";
			}
		if ($row['CHANGE_STATUS'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"CHANGE_STATUS[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else 
			{
				echo "<td align=center><input type=\"checkbox\" name=\"CHANGE_STATUS[".$row['ID']."]\" value=\"1\"></td>\n";
			}
		if ($row['EDIT_PATIENT'] ==1)
			{
				echo "<td align=center><input type=\"checkbox\" name=\"EDIT_PATIENT[".$row['ID']."]\" value=\"1\" checked></td>\n";
			}
		else
			{
				echo "<td align=center><input type=\"checkbox\" name=\"EDIT_PATIENT[".$row['ID']."]\" value=\"1\"></td>\n";
			}
		echo "<td></td><td></td></tr>\n";
	}

echo "
<tr>
<th>ID</th>
<th>CODE</th>
<th>NAME</th>
<th>LASTNAME</th>
<th>User Login</th>
<th>Super Admin</th>
<th>Admin</th>
<th>Delete</th>
<th>Change Status</th>
<th>Edit Patient</th>
<th>Upload</th>
<th>Delete Upload</th>
</tr>\n";

echo "</table></center>\n";
echo "<center><input type=submit name=submit value=Submit></center>"; //<input type="submit" name="Submit" value="Submit">
echo "</form>";
echo "<br /></br />";

?>

</body>
</html>

<?php
if ( isset( $_POST["submit"] ) ) 
	{
	//echo '<pre>';
	//print_r( $_POST );
	//echo '</pre>';
	foreach( $_POST["id"] AS $id ) 
		{
			if ($_POST["SUPER_ADMIN"][$id] == '')
				{
					$_POST["SUPER_ADMIN"][$id] = '0';
				}
			if ($_POST["ADMIN"][$id] == '')
				{
					$_POST["ADMIN"][$id] = '0';
				}
			if ($_POST["DELETE_ORDER"][$id] == '')
				{
					$_POST["DELETE_ORDER"][$id] = '0';
				}
			if ($_POST["CHANGE_STATUS"][$id] == '')
				{
					$_POST["CHANGE_STATUS"][$id] = '0';
				}	
			if ($_POST["EDIT_PATIENT"][$id] == '')
				{
					$_POST["EDIT_PATIENT"][$id] = '0';
				}
				
			//echo 'ID is ' . $id . '<br />';
			//echo 'Super is ' . $_POST["SUPER_ADMIN"][$id]."<br />";
			//echo 'Field2 is ' . $_POST["ADMIN"][$id]."<br />";
			//echo 'Field3 is ' . $_POST["DELETE"][$id]."<br />";
			//echo 'Field4 is ' . $_POST["CHANGE_STATUS"][$id]."<br />";
			//echo 'Field5 is ' . $_POST["EDIT_PATIENT"][$id]."<br />";
			$SUPER_ADMIN = mysql_real_escape_string($_POST["SUPER_ADMIN"][$id]);
			$ADMIN = mysql_real_escape_string($_POST["ADMIN"][$id]);
			$DELETE_ORDER= mysql_real_escape_string($_POST["DELETE_ORDER"][$id]);
			$CHANGE_STATUS = mysql_real_escape_string($_POST["CHANGE_STATUS"][$id]);
			$EDIT_PATIENT = mysql_real_escape_string($_POST["EDIT_PATIENT"][$id]);

			$update ="UPDATE xray_user_right 
							SET SUPER_ADMIN='$SUPER_ADMIN', 
							ADMIN='$ADMIN', 
							DELETE_ORDER='$DELETE_ORDER', 
							CHANGE_STATUS='$CHANGE_STATUS', 
							EDIT_PATIENT='$EDIT_PATIENT' 
							WHERE
							USER_ID='$id' ";
			mysql_query($update);// or die( mysql_error() );
			//echo $update."<br />";
		}
			echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=staff_right.php\">";
	}

?>