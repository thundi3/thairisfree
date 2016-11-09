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
include "session.php";
include "connectdb.php";
$id = $_GET[ID];

$sql = "select PREP_ID,NAME, MODALITY, BODY_PART,DESCRIPTION_THAI, DESCRIPTION_ENG from xray_preparation where PREP_ID=$id";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
	{
			$THAI = $row[DESCRIPTION_THAI];
			$ENG =$row[DESCRIPTION_ENG];
			$MOD = $row[MODALITY];
			$NAME = $row[NAME];
			$BODYPART = $row[BODY_PART];
	}

echo "Modality = $MOD <br />";
echo "Name = $NAME <br />";
echo "Body part =$BODYPART <br />";



?>
<body bgcolor="#d4d4d4">
<br />
Thai<br />

<table  border="0" cellspacing="0" cellpadding="0">
<tr><td>

<table width= 350><tr bgcolor=white><td>
		<?php
			echo $THAI;
		?>
</td></tr></table>

  </td></tr>
  </table>
  

English<br />
  <table   border="0" cellspacing="0" cellpadding="0">
<tr><td>
 <table width=350><tr bgcolor=white><td>

<?php
	echo $ENG;
?>
	
</td></tr></table>
    </td></tr>
  </table>
 
 <a href=prepare-edit.php?ID=<?php echo $id ?>> Edit This Form</a>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>