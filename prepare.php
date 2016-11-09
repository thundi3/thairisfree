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
include "function.php";
$sql = "select PREP_ID,NAME, MODALITY, BODY_PART from xray_preparation";
echo "<body bgcolor=\"#d4d4d4\">";
echo "PREPARATION INSTRUCTIONS FORM<br />";
echo "<br />";
echo "<a href=prepare-add.php>Add New Form</a><br />";
echo "Show Preparation Form <br />";


?>

<table>
<tr bgcolor=#79acf3><td>Modality</td><td>FORM Name</td><td>Body Part</td><td></td><td></td></tr>

<?php
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))

		{ 
				if($bg == "#FFFFFF") 
					{  
					$bg = "#EBEBEB";
				} else {
				$bg = "#FFFFFF";
		}				
	
	
		echo "<tr bgcolor=$bg><td>".$row['MODALITY']."</td><td>".$row['NAME']."</td><td>".$row['BODY_PART']."</td><td><a href=prepare-view.php?ID=".$row['PREP_ID'].">View</a></td><td><a href=prepare-edit.php?ID=".$row['PREP_ID'].">Edit</a></td></tr>";
	}

?>


<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   

</table>