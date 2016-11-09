<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 08 OCT 2016
# File name: order-info.php
# Description :  Show order information
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
include "connectdb.php";
include "session.php";

$MRN = isset($_GET['MRN']) ? $_GET['MRN'] : null;
$ACCESSION = isset($_GET['ACCESSION']) ? $_GET['ACCESSION'] : null;
$XRAYCODE = isset($_GET['XRAYCODE']) ? $_GET['XRAYCODE'] : null;
$CHANGESTATUS = isset($_GET['CHANGESTATUS']) ? $_GET['CHANGESTATUS'] : null;


$sql1 = "select MRN, NAME, LASTNAME, NAME_ENG, LASTNAME_ENG, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";

//ORDER_ID
$sql0 = "SELECT xray_request.REQUEST_NO
			FROM xray_request 
			INNER JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO)
			WHERE xray_request_detail.ACCESSION ='$ACCESSION'";
 $result0= mysql_query($sql0);
while($row0 = mysql_fetch_array($result0))
		{
			$REQUEST_NO = $row0['REQUEST_NO'];
		}
		
$result1= mysql_query($sql1);
$row1 = mysql_fetch_array($result1);

$sql2 = "select   
			xray_code.DESCRIPTION AS DESCRIPTION,
			xray_code.BIRAD_FLAG AS MAMMO,
			xray_request.NOTE,
			xray_request_detail.ID  AS ORDERID,
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,
			xray_request_detail.ARRIVAL_TIME AS ARRIVETIME, 		
			xray_request_detail.START_TIME AS STARTTIME,
			xray_request_detail.COMPLETE_TIME AS COMPLETETIME,
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.APPROVED_TIME AS APPROVETIME,
			xray_request_detail.ASSIGN,
			xray_request_detail.ASSIGN_BY,
			xray_request_detail.TECH1,
			xray_request_detail.TECH2,
			xray_request_detail.TECH3
			from xray_request_detail 
			INNER JOIN  xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO)			
			WHERE xray_request_detail.ACCESSION='$ACCESSION'";
$result2= mysql_query($sql2);
while($row2 = mysql_fetch_array($result2))
		{
			$DESCRIPTION = $row2['DESCRIPTION'];
			$MAMMO = $row2['MAMMO'];
			$STATUS = $row2['STATUS'];
			$ORDERID = $row2['ORDERID'];
			$ORDERTIME = $row2['ORDERTIME'];
			$ARRIVETIME = $row2['ARRIVETIME'];
			$STARTTIME = $row2['STARTTIME'];
			$COMPLETETIME = $row2['COMPLETETIME'];
			$ASSIGNTIME = $row2['ASSIGNTIME'];
			$APPROVETIME = $row2['APPROVETIME'];
			$NOTE = $row2['NOTE'];
			$ASSIGN = $row2['ASSIGN'];
			$ASSIGN_BY = $row2['ASSIGN_BY'];
			$TECH1 = $row2['TECH1'];
			$TECH2 = $row2['TECH2'];
			$TECH3 = $row2['TECH3'];
		}
if ($CHANGESTATUS == 1)
	{
		$sql = "UPDATE xray_request_detail SET URGENT = '1' WHERE ACCESSION ='$ACCESSION'";
		mysql_query($sql);
	}
if ($CHANGESTATUS == 'Y')
	{
		$sql = "UPDATE xray_request_detail SET URGENT = '0' WHERE ACCESSION ='$ACCESSION'";
		mysql_query($sql);
	}
echo "<body bgcolor=#E8E8E8>";	
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<?php
echo "<center><u>Order Detail</u></center>";
echo "<table align=center width=90% border=0><tr><td valign=top >";
echo"<table width=100% border=0 bordercolor=#FFFFFF>";
echo "<tr><td bgcolor=#79acf3 width=100% align=center>";
echo "Patient Information";
echo "</td></tr>";
echo "<tr><td>";
echo "<img src=icons/man.png align=left>";
echo "MRN : <a href=patient-info.php?MRN=".$MRN.">".$MRN."</a><br />";// <a href=patient-edit.php?MRN=".$MRN.">Edit</a><br />";
echo "Name : ".$row1['NAME']." ".$row1['LASTNAME']."<br />";
echo "Age :  Sex : <br />";
echo "DOB : ".$row1['BIRTH_DATE']."<br />";
echo "</td></tr>";
echo "<tr><td bgcolor=#79acf3 width=100% align=center>";	
echo "<img src=icons/information-shield.png> Order Information";
echo "</td></tr>";
echo "<tr><td>\n";
echo "Accession : ".$ACCESSION."<br/>";
echo "Procedure : ".$DESCRIPTION." ";
echo $row2['DESCRIPTION']."<br/>";
$sql ="SELECT URGENT FROM xray_request_detail where xray_request_detail.ACCESSION = '$ACCESSION'";

$result =mysql_query($sql);
while($row=mysql_fetch_array($result))
	{
		$URGENT = $row[0];
	}

if ($URGENT == 0)
	{
		echo "Change Status  : <a href=order-info.php?ACCESSION=$ACCESSION&CHANGESTATUS=1>Urgent</a><br />\n";
	}
	
if ($URGENT == 1)
	{
		echo "Status : <img src=./icon/urgent.jpg>Urgent <br/>\n";
		echo "Change Status : <a href=order-info.php?ACCESSION=$ACCESSION&CHANGESTATUS=Y>Not Urgent</a><br />\n";
	}

$sql = "SELECT ID,ACCESSION,APPROVE_DATE, APPROVE_TIME FROM xray_report WHERE ACCESSION='$ACCESSION' ORDER BY ID desc";
$result =mysql_query($sql);
while($row=mysql_fetch_array($result))
	{
		echo "<img src=./image/report.gif> <a href=showreport.php?ACCESSION=".$row['ACCESSION']."&ID=".$row['ID'].">";
		echo "Report ID".$row['ID']."</a> : ";
		echo "ACC ".$row['ACCESSION']." ".$row['APPROVE_DATE']." ".$row['APPROVE_TIME']."<br />";
	}

echo "</td></tr>";
echo "<tr><td bgcolor=#79acf3 align=center>Attach Files</td></tr>";
echo "<tr><td>File Name :  No File <br />";
$path = "document-uploads/uploads/".$ACCESSION."/";

if (file_exists($path)) 
	{
		$string =array();
		$filePath=$path;  
		$dir = opendir($filePath);
		while ($file = readdir($dir)) 
			{ 
				if (eregi("\.png",$file) || eregi("\.jpg",$file) || eregi("\.gif",$file) ) 
					{ 
						$string[] = $file;
						$ext = end(explode('.', $file));
					}
			}
		while (sizeof($string) != 0)
			{
				$img = array_pop($string);
				echo "<a href=resizeimage$ext.php?image=$filePath$img><img src='$filePath$img'  width='100px'/></a> <a href=order-info-delpic.php?filename=$img&ACCESSION=$ACCESSION&MRN=$MRN><img src=icons/minus-circle.png border=0></a> Delete ";

			}
	}

echo "</td></tr>";
echo "<tr><td><img src=arrow.gif><a href=document-uploads/index.php?MRN=$MRN&ACCESSION=$ACCESSION> Upload New File</td></tr>";
echo "<tr><td bgcolor=#79acf3 align=center>Utility</td></tr>";
echo "<tr><td>";
//echo "<img src=arrow.gif> <a href=cancelexam.php?MRN=$MRN&ACCESSION=$ACCESSION>Cancel </a> <img src=image/bin.png><br />";
//echo "<img src=arrow.gif> <a href=prepare-print.php?MRN=$MRN&ACCESSION&XRAYCODE=$XRAYCODE>Prep Forms </a> Thai <img src=icons/pdf_icon.gif> Eng <img src=icons/pdf_icon.gif><br />";
echo "<img src=arrow.gif> Prep Forms  : Thai <a href=prepare-thai.php>";
echo "<img src=icons/pdf_icon.gif></a> Eng <img src=icons/pdf_icon.gif><br />";
echo "<img src=arrow.gif> Concent  Forms  <br />";
echo "<img src=arrow.gif> Re-QC : ";
if (($STATUS == 'QC') or ($STATUS =='TOREPORT') or ($STATUS =='PRELIM'))
	{
		echo "<a href=qc.php?ACCESSION=$ACCESSION&ORDERID=$ORDERID&MRN=$MRN>QC Study</a>";
	}
echo "<br />";
echo "<img src=arrow.gif> Re-Send Report : HIS , PACS <br />";
echo "<img src=arrow.gif> Merge Order <br />";


if ($MAMMO == 1)
	{
		echo "This is Mammo study<br />";
		echo "<a href=mammo_form.php?MRN=$MRN&ACCESSION=$ACCESSION><img src=mammo.png width=199px></a>";
	}
echo "</table></td>";
echo "<td valign='top' width='50%'>";
echo "<table border='1' bordercolor='#FFFFFF' width='100%'><tr><td bgcolor='#76acf3' align=center>";
echo "Inventory Use";
echo "</td></tr>";
echo "<tr><td>";
echo "<a href=stockuse.php?MRN=$MRN&ACCESSION=$ACCESSION>";
echo "Contrast <br />";
echo "Film<br />";
echo "CD </a><br />";
echo "</td></tr>";
echo "<tr><td bgcolor=#79acf3 align=center>Exam Note</td></tr>";
echo "<tr><td><img src=icons/notebook--plus.png>";
if ($NOTE !== '')
	{
		echo $NOTE;
		echo "<br />";
	}
echo "<a href=order-info-note.php?MRN=$MRN&ACCESSION=$ACCESSION&REQUEST_NO=$REQUEST_NO>Add note </a></td></tr>";
echo "<tr><td bgcolor=#79acf3 align=center>ICD</td></tr>";
echo "<tr><td><img src=icons/notebook--plus.png> Add ICD </td></tr>";
echo "<tr><td>Status : ".$STATUS;
if ($STATUS =='QC')
	{
		echo "<br /> Update QC";
	}
	
if (($usertype == 'ADMIN') OR ($superadmin == 1) OR ($admin == 1) OR ($change_status == 1)) 
	{
		echo "<form method=\"post\"  action=order-changestatus.php>";
		echo "<input type=hidden name=accession value=".$ACCESSION.">";
		echo "<input type=hidden name=MRN value=".$MRN.">";
		echo "<select name=changestatus>";
				echo "<option name='changestatus' value=''>Change Status</option>";
				echo "<option name='changestatus' value='TOREPORT'>Back To Report Worklist</option>";				
				echo "<option name='changestatus' value='EXAMROOM'>Back To Exam Room</option>";
				echo "<option name='changestatus' value='QC'>Back To QC</option>";				
				echo "<option name='changestatus' value='ORDER'>Back To Order</option>";
		if ($delete_order == 1)
			{
				echo "<option name='changestatus' value='CANCEL'>Cancel Order</option>";
			}
		echo "</select><input type=submit value=Submit>";
		echo "</form>\n";
	}
echo "Radiographer	: ";
if ($TECH1 !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$TECH1'");
		$TECH1 = mysql_result($result, 0);
		echo "<img src=arrow.gif>  ".$TECH1;
	}
	
if ($TECH2 !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$TECH2'");
		$TECH2 = mysql_result($result, 0);
		echo "<img src=arrow.gif>  ".$TECH2;
	}
	
if ($TECH3 !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$TECH3'");
		$TECH3 = mysql_result($result, 0);
		echo "<img src=arrow.gif>  ".$TECH3;
	}
echo "<br />";
echo "Assign By : ";
if ($ASSIGN_BY !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$ASSIGN_BY'");
		$ASSIGN_BY = mysql_result($result, 0);
		echo "<img src=arrow.gif>  ".$ASSIGN_BY;
	}

echo "<br />";
if ($ASSIGN !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE CODE='$ASSIGN'");
		$ASSIGN = mysql_result($result, 0);
		echo "Assign To : <img src=arrow.gif>  ".$ASSIGN;
	}
echo "<br />";

$APPROVE_BY = '';

if ($STATUS == 'APPROVED')
	{
		$sql = "SELECT APPROVE_BY FROM xray_report WHERE ACCESSION='$ACCESSION' ORDER BY ID desc";
		$result = mysql_query($sql);
		$APPROVE_BY = mysql_result($result, 0);
	}


if ($APPROVE_BY !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$APPROVE_BY'");
		$APPROVE_BY = mysql_result($result, 0);
		echo "Report By : <img src=arrow.gif>  ".$APPROVE_BY;
	}	

	
echo "</td></tr></table>";
echo "<table width=100%>";
echo "<tr><td bgcolor=#79acf3 align=center>Time Stamp </td></tr>";
echo "<tr><td>";
echo "<table>";
echo "<tr><td><img src=icons/clock.png> Order Time </td> <td> : $ORDERTIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> Arrived Time </td> <td> : $ARRIVETIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> Start Exam Time </td><td> : $STARTTIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> End Exam Time </td><td> : $COMPLETETIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> QC/Assign Time </td><td> : $ASSIGNTIME </td></tr>\n";
echo "<tr><td><img src=icons/clock.png> Reported Time </td><td> : $APPROVETIME </td></tr>\n";
echo "</table>\n";
echo "</td></tr></table>\n";

?>

