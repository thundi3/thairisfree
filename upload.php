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
include ("session.php");
include ("connectdb.php");
include ("function.php");
$MRN = $_GET[MRN];
$ACCESSION = $_GET[ACCESSION];

echo "<body bgcolor=#E8E8E8>";	
echo "<center><font color=#6600CC><b><u>Upload File</u></b></font></center>";
echo "<p></p>";
//echo "<br>MRN =".$MRN;

$sql = "select MRN, NAME, LASTNAME, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result);

echo "<center><table bgcolor=#F5F5F5 width=500><tr><td valign=top width=110><img src=image/upload.jpg></td><td valign=top width=490>";
echo "<center><u>Patient Info</u></center>NAME : ".$row[NAME]." ".$row[LASTNAME]." AGE :<br>";
echo "HN : ".$MRN."<br>ACCESSION : ".$ACCESSION;
echo "</td></tr></table></center><p></p>";

?>
<center><font color=#6600CC>Select Upload Type</font></center>

<center>
<table width=500 bgcolor=#F5F5F5>
<tr>
<td width=120 bgcolor=white>Pataient Data<br>HN : <?php echo $MRN ?></td>
<td>
<ul><li><a href="upload/uploadpdf.php?MRN=<?php echo $MRN  ?>">Upload Document (PDF)</a>
<li><a href="upload/uploadpdf.php">Upload Image</a></ul>
</td>
</tr>
</table>
</center>
<p>
<p>

<center>
<table width=500 bgcolor=#F5F5F5>
<tr>
<td width=120 bgcolor=white>Exam Data<br><?php echo $ACCESSION ?></td>
<td>
<ul>
<li>Request From</li>
<ul>
<li><a href="upload/uploadpdf.php?id=<?php echo $MRN;?>&ACCESSION=<?php echo $ACCESSION; ?>">Request Form  (PDF)</a></li>
</ul>
</ul>
<ul>
<li>Image</li>
<ul>
<li><a href="upload/uploadzip.php?id=999">ZIP (DICOM Zip)</a></li>
<li><a href="upload/uploaddicom.php?id=999">DICOM (.DCM)</a></li>
<li><a href='upload/index.php?id=999'>JPEG, GIF</a></li>
</ul>
</ul>
</td>
</tr>
</table>
</center>

