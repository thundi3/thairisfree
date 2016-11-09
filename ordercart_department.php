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
header("Content-type: text/html;  charset=utf-8");
$DEPARTMENT = isset($_GET['DEPARTMENT']) ? $_GET['DEPARTMENT'] : null;
$DEPARTMENT_ID = isset($_GET['DEPARTMENT_ID']) ? $_GET['DEPARTMENT_ID'] : null;
$REFERRER = isset($_GET['REFERRER']) ? $_GET['REFERRER'] : null;
$TYPE = isset($_GET['TYPE']) ? $_GET['TYPE'] : null;
if ($REFERRER =='')
		{
			echo "Please select Physician first";
			exit;
		}
//echo "<br>REFER=".$REFERRER;
//echo "<br>DEPARTMENT=".$DEPARTMENT;
//echo "<br>TYPE=".$TYPE;

include "connectdb.php";

if ($TYPE=="SEARCH")
	{
		$result = mysql_query("SELECT * FROM `xray_department` WHERE NAME_THAI LIKE '%$DEPARTMENT%'");
		echo "<table border='0'>
				<tr>
				<td bgcolor=#D7D7D7>Department ID</td>
				<td bgcolor=#D7D7D7>NAME</td>
				<td bgcolor=#D7D7D7>ENGLISH</td>
				<td bgcolor=#D7D7D7></td>
				</tr>\n";
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
				echo "<td>" . $row['DEPARTMENT_ID'] . "</td>";
				echo "<td>" . $row['NAME_THAI'] . "</td>";
				echo "<td>" . $row['NAME_ENG'] . "</td>";
				echo "<td><input type=\"submit\" value=\"Select\" onclick=selected_department('".$row['DEPARTMENT_ID']."')></td>";
				echo "</tr>\n";
			}
		echo "</table>";
	} // end if TYPE=SEARCH

if ($TYPE=="SELECTED")
	{
		$sql = "SELECT NAME_THAI, TYPE FROM xray_department WHERE DEPARTMENT_ID ='$DEPARTMENT'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result))
			{
				$name = $row['NAME_THAI'];
				$department_type =$row['TYPE'];
			}
		echo "<img src='./image/".$department_type.".gif' OnLoad=\"ReplaceContentInContainer('show','Physician Selected <br> Deparment Selected <br> <font color=red>Please Select Order</font>')\">";
		echo " ".$name;
		echo "<input type=\"hidden\" name=\"department_selected\" id=\"department_selected\" value=\"".$DEPARTMENT."\"></form>";
	}
?>