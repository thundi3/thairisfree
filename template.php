<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: template.php
# Description : 
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
header("Content-type: text/html;  charset=TIS-620");

include ("session.php");
include ("connectdb.php");
//$template = $_GET['TEMPLATE'];
$MOTYPE = $_GET['MOTYPE'];
$procbodypart = $_GET['procbodypart'];
echo "<script type=\"text/javascript\" src=\"template.js\"></script>";
echo "<form name=templateform>";
echo "<input type=hidden name=MOTYPE value=$MOTYPE>";
echo "<b>Template Filter</b>";
echo "<select id=typeOwner onChange=showtemplateOwner() style=\"background-color:#BDBDBD;width:183px\">";
echo "<OPTION value=".$userid.">My Template</OPTION>";
echo "<OPTION value=ALL>Public Template</OPTION>";
echo "</select><br />\n";
echo "<select id=typeMo onChange=showtemplateMo() style=\"background-color:#A4A4A4;width:183px\">";
echo "<OPTION>Select Modality</OPTION>";
echo "<OPTION value=ALL>All</OPTION>";
echo "<OPTION value=CT>CT</OPTION>";
echo "<OPTION value=MRI>MRI</OPTION>";
echo "<OPTION value=XRAY>XRAY</OPTION>";
echo "<OPTION value=US>US</OPTION>";
echo "<OPTION value=MAMMO>MAMMO</OPTION>";
echo "<OPTION value=BMD>BMD</OPTION>";
echo "<OPTION value=ANGIO>ANGIO</OPTION>";
echo "<OPTION value=FLUORO>FLUORO</OPTION>";
echo "</select>";
echo "<br \>";

$sql ="select BODY_PART from xray_body_part";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);
echo "<SELECT id=bodypart onChange=showtemplateBodyPart() style=\"background-color:#BDBDBD;width:183px\">";
echo "<OPTION VALUE=\"\">Select Body Part</OPTION>";
while($row = mysql_fetch_array($result))
	{
		echo "<OPTION value='".$row['BODY_PART']."'>".$row['BODY_PART']."</OPTION>\n";
	}
echo "</SELECT><br \>";
echo "Search :<input type=box id=text onKeyup=\"searchtemplate()\" style=width:179px>";
$sql = "select ID,NAME FROM xray_report_template where USER_ID ='$userid' and XRAY_TYPE_CODE='$MOTYPE'";
if ($procbodypart !='')
	{
			$sql = "select ID,NAME FROM xray_report_template where USER_ID ='$userid' and XRAY_TYPE_CODE='$MOTYPE' and BODY_PART='$procbodypart'";
			$result1 = mysql_query($sql);
				$countrow =  mysql_num_rows($result1);
					if ($countrow == 0)
							{
								$sql = "select ID,NAME FROM xray_report_template where USER_ID ='$userid' and XRAY_TYPE_CODE='$MOTYPE'";
							}
	}
$result = mysql_query($sql);

echo "<br />Template Name :";
echo "<div id=templatebox>";
echo "<SELECT id=selectid SIZE=10 style=\"background-color:#FFFFDD;width:183px\" onChange=showtemplate2()>";

while($row = mysql_fetch_array($result))
	{
		//echo "<OPTION VALUE=\"".$row['ID']."\" >".$row['ID'].". ".$row['NAME']."</OPTION>\n";
		echo "<OPTION VALUE=\"".$row['ID']."\" >".$row['NAME']."</OPTION>\n";
	}
echo "<OPTION>-</OPTION>\n";
echo "</SELECT>\n";
echo "</div>";
echo "</form>\n";

?>


