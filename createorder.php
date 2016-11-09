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
$mrn = $_POST['MRN'];
include ("session.php");
include "connectdb.php";

$sql = "select * FROM xray_patient_info WHERE MRN = '$mrn'";
$result = mysql_query($sql);
$list = mysql_fetch_array($result);
$hn = $list['MRN'];
$name = $list['NAME'];
$lastname = $list['LASTNAME'];
echo "<html>\n";
echo "<head><title>ThaiRIS</title>";
echo "<script language=JavaScript src=\"frames_body_array.js\" type=text/javascript></script>\n";
echo "<script language=JavaScript src=\"mmenu.js\" type=text/javascript></script> \n";
echo "</head>\n";
echo "<body bgcolor=#d4d4d4><meta http-equiv=\"Content-Type\" content=\"text/html; charset=tis-620\">\n";
?>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<body bgcolor="gray" leftmargin="3">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Create Order</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />
<script type="text/JavaScript" src="ordercart.js"></script>

<?php
//addcart.open("GET","ordercart.php?HN="+HN+XRAYCODE+AAND+Math.random(),true);
echo "<div id=showcompleateorder>";
echo "<table border=0 width=100%><tr valign=top><td bgcolor=#848484 width=200>";
echo "<table>";
echo "<tr><td bgcolor=#79acf3><center><b>Patient Infomation</b></center></td></tr><tr><td>";
echo "<table width=100%><tr><td bgcolor=#EBEBEB>";
echo "<b>HN </b>: ".$hn."<br>";
echo "<b>NAME </b>".$name."\t<br><b>LASTNAME </b>".$lastname;
echo "</td></tr></table>";
echo "<hr>";
 
echo "<table><tr><td bgcolor=#79acf3>";
echo "<b>Order By</b></td></tr><tr><td bgcolor=#EBEBEB>";
echo "<form name=referrerform>";
echo "<div id=referrer><font color=red>Please search Doctor</font>";
echo "<input type=\"hidden\" name=\"referrer\" id=\"referrer\" value=''></div>";
echo "<input type=\"text\" name=\"referrer2\" id=\"referrer2\" onKeyup=\"select_referrer()\" onkeypress=\"return event.keyCode!=13\"><input type=\"button\" value=\"Search\" onclick=select_referrer()>";
echo "</form>";
echo "</td></tr></table><hr>";


echo "<table width=100%><tr><td bgcolor=#79acf3>";
echo "<b>Department</b></td></tr><tr><td bgcolor=#EBEBEB>";
echo "<form name=departmentform>";
echo "<div id=department><font color=red>Please search department</font>";
echo "<input type=\"hidden\" name=\"department_selected\" value=''></div>";
//echo "<input type=\"text\" name=\"department\" id=\"department\" onKeyPress=select_department()><input type=\"button\" na
echo "<input type=\"text\" name=\"department\" id=\"department\" onKeyup=\"select_department()\" onkeypress=\"return event.keyCode!=13\" ><input type=\"button\" name=\"search\" value=\"Search\"  onclick=select_department()>";
echo "</form></td></tr></table><hr>";


echo "<table width=100%><tr><td bgcolor=#79acf3>";
echo "<b>Select Order Type</b></td></tr><tr><td bgcolor=#EBEBEB>";
$sql2 ="select * FROM xray_type";
$result2 = mysql_query($sql2);

echo "<select id=procedurelist onChange=open_procedure('xxxx','".$mrn."');>";
echo "<OPTION>Please Select Type</OPTION>";
while ($row =mysql_fetch_array($result2))
	{
		echo "<option value='".$row['XRAY_TYPE_CODE']."'>".$row['TYPE_NAME']."</option>";
	}

echo "</select>";
echo "</td></tr></table>\n";
echo "</td></tr></table>\n";
echo "<form name=typeselect>";
echo "<input type=\"hidden\" name=\"TYPE\" value=\"CT\">\n";
echo "</form>\n"; 
echo "<td width=60%>";
echo "<table width=100%><tr><td>Search : <input type=textbox> <input type=button name=Search3 value=Search></td><tr><td><font face=\"MS Sans Serif\"><div id=show></div></font></td></tr></table></td>\n";
echo "<form>";
echo "<td align=center bgcolor=#CCCCCC>";
echo "<table width=100%><tr><td>";
echo "Selected Order <br> <div id=selectorder></div>";
echo "</tr></td></table>";
echo "</td></form>";
echo"</tr><table>";
echo "</div>"; //end showselectorder
//include ('footer.php');
?>