<?php
include "connectdb.php";
include "session.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
</head>
<body bgcolor="#d4d4d4">
<br />

<?php
//mysql_select_db($dbname,$dbconnect);

$mrn = $_POST['mrn'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$accession = $_POST['accession'];


if ($mrn =="" && $fname =="" && $lname =="" && $accession == "") 

	{

?>
		<script language=JavaScript src="frames_body_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
		<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
		
		<table width="794" border="0" align=center bgcolor=#FFFFFF>
		<tr><td bgcolor=#79acf3 colspan=2>Search Patient</td></tr>
		<tr>
		<td width="191"><font face="MS Sans Serif"><center><img src="./images/icoSearch.png"></center><br />Search Patient</font></td>
		<td width="587" bgcolor="#f8d290">
			<table width="90%" cellspacing="0" cellpadding="0">
			<tr >
			<td><form name="searchpatient" method="post" action="search-all2.php" accept-charset="UTF-8">
			<p><font face="MS Sans Serif">MRN</font>
            <input type="text" name="mrn" value="">
			<font face="MS Sans Serif">Accession </font> 
			<input type="text" name="accession" value=""></p>
			<p><font face="MS Sans Serif">Name<input type="text" name="fname" value="">Lastname </font>
            <input type="text" name="lname" value="">
            <input type="submit" name="Submit" value="Search">
			</p>
			</form></td>
			</tr>
			</table>
			</td>
			</tr>
		</table>

<?php

echo "<br><center><font color=red>กรุณาใส่ข้อมูลค้นหา</font></center>";
exit;

}

//$result = mysql_query("SELECT HN,NAME,LASTNAME FROM `patient_info where NAME LIKE %$fname%");

if ($accession !== "") 
	{
		$sql="SELECT 
			xray_patient_info.MRN,
			xray_patient_info.NAME,
			xray_patient_info.LASTNAME,
			xray_patient_info.CENTER_CODE,
			xray_request.MRN AS REQ_MRN,
			xray_request_detail.ACCESSION
			FROM xray_patient_info 
			LEFT JOIN xray_request ON xray_request.MRN = xray_patient_info.MRN
			LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
			WHERE (xray_patient_info.MRN LIKE '%$mrn%') 
			AND (xray_patient_info.NAME LIKE '%$fname%') 
			AND (xray_patient_info.LASTNAME LIKE '%$lname%') 
			AND (xray_request_detail.ACCESSION LIKE '%$accession%')
			AND (xray_patient_info.CENTER_CODE ='$center_code') 
			LIMIT 0,99";
	}

if ($mrn !=="" OR $fname !=="" OR $lname !=="") 
	{
		$sql = "SELECT 
			xray_patient_info.MRN,
			xray_patient_info.NAME,
			xray_patient_info.LASTNAME
			FROM xray_patient_info 
			WHERE (MRN LIKE '%$mrn%') 
			AND (NAME LIKE '%$fname%') 
			AND (LASTNAME LIKE '%$lname%') 
			AND (CENTER_CODE ='$center_code') 
			LIMIT 0,99";
	}
//echo $sql;
$result = mysql_query($sql);
//$result = mysql_query("SELECT HN,NAME,LASTNAME FROM patient_info WHERE HN LIKE $hn");
//$result = mysql_query("SELECT * FROM Persons");
$num_rows = mysql_num_rows($result);

?>

<table width="794" border="0" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Search Patient</td></tr>
  <tr>
    <td width="191"><font face="MS Sans Serif"><center><img src="./images/icoSearch.png"></center><br />Search Patient</font></td>
    <td width="587" bgcolor="#f8d290">
	<table width="90%" cellspacing="0" cellpadding="0">
      <tr >
        <td><form name="searchpatient" method="post" action="search-all2.php" accept-charset="UTF-8">
          <p><font face="MS Sans Serif">MRN</font> <font face="MS Sans Serif">
            <input type="text" name="mrn" value="">
			ACCESSION <input type="text" name="accession" value="">
          </font></p>
          <p><font face="MS Sans Serif">Name<input type="text" name="fname" value="">Lastname </font>
            <input type="text" name="lname" value="">
            <input type="submit" name="Submit" value="Search">
          </p>
        </form></td>
      </tr>
    </table>
	</td>
  </tr>
</table>

<?php

if ($num_rows == 1)
	{
		while($row = mysql_fetch_array($result))
			{
				$mrn = $row['MRN'];
			}
			header("Location: patient-info.php?MRN=$mrn");
			exit;
	}

if ($num_rows  > 1)
			{ 
						echo "<center>Found : ".$num_rows. " items (Limit Search 99)</center>";
						echo "<table border='0' cellspacing='1' width=70% align=center>\n
						<tr bgcolor=#CCCCCC>\n
						<td><center>HN</center></td>\n
						<td><center>$_NAME</center></td>\n
						<td><center>$_LASTNAME</center></td>\n
						<td><center>ACCESSION</center></td>\n
						<td>Open </td>\n
						</tr>";
						while($row = mysql_fetch_array($result))
									{
										echo "<tr>";
										echo "<td align=right>" . $row['MRN'] . "</td>";
										echo "<td>" . $row['NAME'] . "</td>";
										echo "<td>" . $row['LASTNAME'] . "</td>";
										echo "<td>" . $row['ACCESSION']. "</td>";
										echo "<td><a href=patient-info.php?MRN=". $row['MRN'] . ">Open Patient Info</a>";
										echo "</tr>";
									}
						echo "</table>";			
			}



?>
</body></html>