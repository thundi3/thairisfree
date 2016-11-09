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
$id = $_GET['ID'];


$sql = "select PREP_ID,NAME, MODALITY, BODY_PART,DESCRIPTION_THAI, DESCRIPTION_ENG from xray_preparation where PREP_ID=$id";
$result = mysql_query($sql);

//$timestamp = mysql_result($result, 0);

while($row = mysql_fetch_array($result))
	{
			$THAI = $row['DESCRIPTION_THAI'];
			$ENG =$row['DESCRIPTION_ENG'];
			$MOD = $row['MODALITY'];
			$NAME = $row['NAME'];
			$BODYPART = $row['BODY_PART'];
	}
	
echo "<body bgcolor=\"#d4d4d4\">";



echo "PREARATION FORM Edit<br />";
echo "<table>";
echo "<tr><td>Modality  </td><td> <input type=\"text\" name=\"MOD\"  size=50 value=$MOD></td></tr>";
echo "<tr><td>Name  </td><td><input type=\"text\" name=\"\"  size=50 value=$NAME></td></tr>";
echo "<tr><td>Body part  </td><td><input type=\"text\" name=\"\"  size=50 value=></td></tr>";
echo "</table>";

?>


Thai<br />
<form method=post action=prepare-edit-ins.php enctype=\"multipart/form-data\">
<table bgcolor=white border="0" cellspacing="0" cellpadding="0">
<tr><td>

<input type="hidden" name="ID" input hidden" value="<?php echo $id; ?>" /> 
    <textarea name="PREP_THAI" id="textarea1" cols="100" rows="20">
	<?php
	echo $THAI;
	?>
	</textarea>

  </td></tr>
  </table>
  

English<br />
  <table bgcolor=white border="0" cellspacing="0" cellpadding="0">
<tr><td>

    <textarea name="PREP_ENG" id="textarea2" cols="100" rows="20">
	<?php
	echo $ENG;

	?>
	</textarea>
    </td></tr>
  </table>
   <input type="reset" name="Reset" id="button" value="Clear" />   <input type="submit" name="button2" id="button2" value="Submit" />
</form>

<script type="text/javascript" src="nicEdit.js"></script> 
<script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
 </script>
 
 
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   

</body>
</html>