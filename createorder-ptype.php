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
//if (is_numeric($_GET['XRAY_TYPE'])) {
$TYPE = $_GET['XRAY_TYPE'];

echo $TYPE;
include "connectdb.php";
    $query="select XRAY_CODE, DESCRIPTION, XRAY_TYPE_CODE, CHARGE_TOTAL from xray_code where XRAY_TYPE_CODE='$TYPE' LIMIT 21";
    $result=mysql_query($query);
   echo "<table border=\"1\"><tr><td>Code</td><td>รายการ</td><td>Type</td><td>ราคา</td><td>Select</td></tr>";
while ($row =mysql_fetch_array($result))
{
  echo "<tr><td>" . $row['XRAY_CODE'] . "</td>";
  echo "<td>" . $row['DESCRIPTION'] . "</td>";
  echo "<td>" . $row['XRAY_TYPE_CODE'] . "</td>";
  echo "<td align=right>" . $row['CHARGE_TOTAL'] . "</td>";
echo "<td><input type=\"submit\" name=\"pselect\" id=\"pselect\" value=\"Select\" /></td></tr>";
}
 echo " </table>";
?> 
