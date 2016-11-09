<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified:  12 AUG 2015
# File name: dictate-edit.php
# Description :  Report editor for Edit or Update report
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
header("Content-type: text/html;  charset=TIS-620");
include "session.php";
include "connectdb.php";
include "function.php";
$ORDERID = $_GET['ORDERID'];
$RADID = $_GET['RADID'];

if ($usertype !=='RADIOLOGIST' AND $superadmin =='0')
		{
			echo "<p><p><p><br \>";
			echo "<li>You Can't Access Reporting page</li>";
			exit;
		}
	
?>
<!DOCTYPE HTML>
<html>
<head><title>Dictate</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>
<!--<script type="text/javascript" src="unlockexam.js"></script>-->
<script type="text/javascript" src="nicEdit.js"></script> 
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

<script type="text/javascript" language="javascript">
function doReplace(templateID) {
    if (confirm("Do you Replace text by template?")) {
	var templateID;
	      templateinsert(templateID);
    }
 }
</script>

<link rel="stylesheet" type="text/css" href="css/button.css" />
	<!-- Add jQuery library -->
	<script type="text/javascript" src="./lib/jquery-1.9.0.min.js"></script>
	<script type="text/javascript" src="./source/jquery.fancybox.js"></script>
	<link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css" media="screen" />
	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */
			$('.fancybox').fancybox();

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
	<style>
		a:link {
			text-decoration: none;
			color: #424242;
			}

		a:visited {
			text-decoration: none;
			color: #424242;
			}
		a:hover {
			text-decoration: underline;
			}
		a:active {
			text-decoration: underline;
			}
</style>

<!-- Script for Tab when click Tab button  http://jsfiddle.net/jz6J5/ -->
<!--
<script type="text/javascript" language="javascript">
$(document).delegate('#area2', 'keydown', function(e) { 
  var keyCode = e.keyCode || e.which; 

  if (keyCode == 9) { 
    e.preventDefault(); 
    var start = $(this).get(0).selectionStart;
    var end = $(this).get(0).selectionEnd;

    // set textarea value to: text before caret + tab + text after caret
    $(this).val($(this).val().substring(0, start)
                + "\t"
                + $(this).val().substring(end));

    // put caret at right position again
    $(this).get(0).selectionStart = 
    $(this).get(0).selectionEnd = start + 1;
  } 
});

</script>

---->


<!--
function doUnload()
{
 if (window.event.clientX < 0 && window.event.clientY < 0)
 {
   alert("Window is closing...");
 }
}
<body onunload="doUnload()">
-->
	
<script type="text/javascript" src="template.js"></script>
</head>
<body bgcolor='#d4d4d4' topmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70% align=right>
					<img src=icons/arrow-curve-180-left.png><a href=dictate-worklist.php style="text-decoration: none">
					<b><font color=white> Back To Worklist </font></b></a></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif"><font color=red><b>Edit Report</b></font></td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<br/>
<?php
$sql = "SELECT 
			xray_patient_info.MRN, 
			xray_patient_info.NAME AS PTNAME, 
			xray_patient_info.LASTNAME  AS PTLASTNAME, 
			xray_patient_info.NAME_ENG  AS PTENGNAME, 
			xray_patient_info.LASTNAME_ENG  AS PTENGLAST, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.SEX,
			xray_patient_info.BIRTH_DATE AS DOB,
			xray_patient_info.NOTE AS PT_NOTE,
			xray_request.REQUEST_NO AS req_no, 			
			xray_request.NOTE,
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.STATUS, 
			xray_request_detail.ASSIGN,
			xray_request_detail.ASSIGN_BY,
			xray_request_detail.TECH1,
			xray_request_detail.TECH2,
			xray_request_detail.TECH3,
			xray_request_detail.FLAG1,
			xray_request_detail.FLAG2,
			xray_code.XRAY_TYPE_CODE AS MOTYPE,
			xray_code.BODY_PART AS PROC,
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_referrer.NAME AS DOCTORNAME, 
			xray_referrer.LASTNAME AS DOCTORLASTNAME,
			xray_department.NAME_THAI AS DPNAME
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO) 
			LEFT JOIN xray_user ON (xray_user.CODE = xray_request.USER) 
			LEFT JOIN xray_patient_info ON (xray_patient_info.MRN = xray_request.MRN) 
			LEFT JOIN xray_department ON (xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID) 
			LEFT JOIN xray_referrer ON (xray_referrer.REFERRER_ID = xray_request.REFERRER)
			LEFT JOIN xray_code ON (xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE) 
			WHERE (xray_request_detail.PAGE = 'END' and xray_request_detail.ID = '$ORDERID') 
			ORDER BY ORDERTIME desc";
			
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
	{
			$MRN             = $row['MRN'];
			$PATIENTNAME     = $row['PTNAME'];
			$PATIENTLASTNAME = $row['PTLASTNAME'];
			$PATIENTENGNAME	 = $row['PTENGNAME'];
			$PATIENTENGLAST	 = $row['PTENGLAST'];
			$PT_NOTE = $row['PT_NOTE'];
			$SEX = $row['SEX'];
			$DOB = $row['DOB'];
			$ACCESSION		 = $row['ACCESSION'];
			$REQUEST_NO 	 = $row['req_no'];
			$EXAM_NOTE = $row['NOTE'];
			$REQ_DATE = $row['REQ_DATE'];
			$REQ_TIME = $row['REQ_TIME'];
			$ORDERDATE	     = $row['ORDERTIME'];
			$PROCEDURE		 = $row['DESCRIPTION'];
			$MOTYPE = $row['MOTYPE'];
			$PROCBODYPART = $row['PROC'];
			//$REFERRER        = $row[];
			$DEPARTMENT      = $row['DPNAME'];
			$PHYSICIANNAME 		= $row['DOCTORNAME'];
			$PHYSICIANLASTNAME	= $row['DOCTORLASTNAME'];
			$BIRADFLAG = $row['BIRAD_FLAG'];
			$ASSIGN1 = $row['ASSIGN'];
			$ASSIGN_BY1 = $row['ASSIGN_BY'];
			$TECH1 = $row['TECH1'];
			$TECH2 = $row['TECH2'];
			$TECH3 = $row['TECH3'];
			$FLAG1 = $row['FLAG1'];
			$FLAG2 = $row['FLAG2'];
			$NOTE = $row['NOTE'];
	}
	
$sql2 = "SELECT LOCKBY FROM xray_request_detail  WHERE xray_request_detail.ACCESSION='$ACCESSION'";
$result =mysql_query($sql2);
while($row=mysql_fetch_array($result))
	{
		$LOCKBY = $row['LOCKBY'];
		$LOCKBY = trim($LOCKBY);
		if  ($LOCKBY !=='')
			{
				echo "<br /><br /><br />";
				echo "<img src=icons/exclamation-red.png> This Exam Locked by other Radiologist (".$LOCKBY.") <b> [ </b>";
				echo "<a href=dictate-worklist.php>Black to Work list </a><b>]</b>";
				exit;
			}
	}
	
// Lock Report for Reporting
$sql = "UPDATE xray_request_detail SET LOCKBY ='$userid' WHERE xray_request_detail.ID = '$ORDERID'";
mysql_query($sql);
echo "<table width=100% bgcolor=#D8D8D8>";
echo "<tr><td>";
echo "<table border=0 bgcolor=#D8D8D8><tr><td valign=top>";

////////////////////////////////////////////////////Auto Save Report///////////////////////////////////////
//http://jetlogs.org/2007/11/11/auto-saving-with-jquery/	
?>

<script type="text/javascript">
	$(document).ready(function()
		{			
			autosave();
		});
	
	function autosave()
		{  
			var t = setTimeout("autosave()", 10000); //10000 = 10 Seconds
			var content = "";
			if(nicEditors.findEditor("area2"))
				{
					content = nicEditors.findEditor("area2").getContent();
				}

//		var title = $("#txt_title").val();
//		var content = document.getElementById("area2").getContent();
//		alert(content);
		var content = encodeURIComponent(content);
		//if (title.length > 0 || content.length > 0)
		if (content.length > 0)
		{
			$.ajax(
			{
				type: "POST",
				url: "autosave.php",
				data: "ACC= <?php echo $ACCESSION; ?>&content=" + content,
			//	data: "article_id=" + <?php echo $article_id ?> + "&title=" + title + "&content=" + content,
				cache: false,
				success: function(message)
				{	
					$("#timestamp").empty().append(message);
					//alert(content);
				}
			});
		}
	} 
	</script>

<ul id="countrytabs" class="shadetabs">
<li><a href="#" class="selected" rel="#default">Order</a></li>
<li><a href="dictate-patientinfo.php?ORDERID=<?php echo $ORDERID; ?>" rel="countrycontainer">Patient</a></li>
<li><a href="dictate-worklist2.php" rel="worklist">Worklist</a></li>
</ul>
<div id="countrydivcontainer" style="border:1px solid gray; width:200px; margin-bottom: 1em; padding: 1px">
<table bgcolor="#EBEBEB" width="100%" border=0>
<tr><td bgcolor=#79acf3>

<?php
//echo "<center><u><b>Order Detail</b></u></center>";
//echo "</td></tr><tr><td>";
//echo "<b><u>MRN</u></b>  : ".$MRN."<br>\n";
//echo "<b><u>ACC </u> </b> : ".$ACCESSION."<br />";
//echo "<b><u>Name </u></b> <br/><img src=arrow.gif> ".$PATIENTNAME." ".$PATIENTLASTNAME."<br />\n";
//echo "<b><u>Sex</u> </b> :  <b><u>Age</u> </b> : <br />\n";
//echo "<b><u>Date</u></b> :".$ORDERDATE."<br>\n";
//echo "<b><u>Procedure</u></b> :<br/><img src=arrow.gif> ".$PROCEDURE."<br/>\n";
//echo "<b><u>Physician</u></b> : <br/><img src=arrow.gif> ".$PHYSICIANNAME." ".	$PHYSICIANLASTNAME."<br />\n";
//echo "<b><u>Department</u></b>";
//echo "<hr>";
?>

<!--//////////////////////////////////////////////////////-->
<?php
echo "</td></tr><tr><td bgcolor=#79acf3>";
echo "<center><b>Order History</b></center>";
echo "</td></tr><tr><td>";
?>

<!-- HTML Codes by Quackit.com -->
<!--div style="height:490px;width:200px;font:16px/26px MS Sans Serif;overflow:scroll;"-->

<?php
$sql2 = "SELECT 
			xray_request_detail.ID,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE,
			xray_request_detail.STATUS,
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS ORDERTIME,
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIMESTAMP,
			xray_request_detail.ASSIGN AS ASSIGN,
			xray_request_detail.REPORT_STATUS, 
			xray_code.DESCRIPTION 
			FROM xray_request_detail 
			LEFT JOIN xray_request ON (xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO AND xray_request.MRN = '$MRN')
			INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE)
			INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) ORDER BY ORDERTIMESTAMP DESC";
$result2 = mysql_query($sql2);
$bg ="#FFCCCC";
echo "<center><table width=100% border=0><tr bgcolor=#ccDDff><td colspan=2><center><b>Date/Procedure</b></center></td></tr>";
while($row = mysql_fetch_array($result2))
		{
			if($bg == "#FFFFFF" or $bg =="#f8d290") 
				{ 
					$bg = "#C2DFFF";
				} 
			elseif ($ORDERID !== $row['ID'])
				{
					$bg = "#FFFFFF";
				}
			if ($ORDERID == $row['ID'])
				{
					$bg = "#f8d290";
				}
			if ($row['REPORT_STATUS']=='1')
				{
					$report_icon ="<a class=\"fancybox fancybox.iframe\" href=showreport.php?ACCESSION=".$row['ACCESSION']." ><img src=icons/report1.png border=0></a>";
				}
			//xray_request_detail.ID = '$ORDERID'
			else 
				{
					$report_icon ="<img src=icons/layer--minus.png>";
					$report_icon ="";
				}
			//echo "<tr bgcolor=".$bg."><td width=45>".$report_icon."</td><td>".EngEachDate($row[REQ_DATE])."</td><td>".$row[ACCESSION]."</td><td>".$row[XRAY_CODE]."</td><td>".$row[DESCRIPTION]."</td><td>".$row[STATUS]."</td><td>View</td></tr>";
			//<a class=\"fancybox fancybox.iframe\" href=order-info.php?MRN=$MRN&ACCESSION=$ACCESSION>
			echo "<tr bgcolor=".$bg."><td valign=top>".$report_icon."</td><td><font color=#084B8A size=-1><b><a class=\"fancybox fancybox.iframe\" href=order-info.php?MRN=$MRN&ACCESSION=".$row['ACCESSION'].">".EngEachDate(($row['REQ_DATE']))."  ".($row['ORDERTIME'])."</b></font></a><br />";
			echo "<img src=arrow.gif> <font size=-2>".$row['DESCRIPTION']."</font>";
			//echo "<br /><img src=arrow.gif border=0><font size=-2>Assign To : ".$row[ASSIGN]."</font>";
			echo "</td></tr>";
		}
echo "</table></center>";

///////////////////////////////
?>
<!--/div-->
</td></tr></table>
</div>

<table>

</table>

<script type="text/javascript">
var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>

<?php
echo "</td>";
echo "<td valign=top>\n";
echo "<table width=100% align=center bgcolor=#79acf3 cellspacing=0><tr><td colspan=4><b><img src=icons/information-shield.png> Order Information</b></td></tr>";
echo "<tr bgcolor=#f8d290><td><font color=black><b>Name</b>  </td><td>: ".$PATIENTNAME." ".$PATIENTENGNAME." ".$PATIENTLASTNAME." ".$PATIENTENGLAST."</font></td><td><b>Age </b></td><td>: ".AgeCal($DOB)."</td></tr>\n";
echo "<tr bgcolor=#f8d290><td><font color=black><b>HN</b> </td><td> : ".$MRN. "</td><td><b> Order Time</b> </td><td> : ".EngEachDate($REQ_DATE)." ".$REQ_TIME."</font></td></tr>\n";
echo "<tr bgcolor=#f8d290><td><b>Sex</b></td><td>: ".$SEX."</td><td><b>Department</b></td><td> : ".$DEPARTMENT."</td></tr>\n";
echo "<tr bgcolor=#f8d290><td><b>Procedure</b></td><td> : ".$PROCEDURE."</td><td><b>Physician</b></td><td>: ".$PHYSICIANNAME." ".	$PHYSICIANLASTNAME."</td></tr>\n";
echo "<tr bgcolor=#f8d290><td><b>Accession No.</b></td><td> : ".$ACCESSION."</td><td><b></b></td><td></td></tr>\n";
echo "</table>";

if ($BIRADFLAG =='1')
		{	
			echo "<script language=\"javascript\">";
			echo "function fncSubmit()";
			echo "{";
			echo "	if(document.REPORT.BIRAD.value == \"0\")";
			echo "		{";
			echo "			alert('Please Select BIRAD');";
			echo "			document.REPORT.BIRAD.focus();";
			echo "			return false;";
			echo "		}";
			echo "document.qc.submit();";
			echo "}";
			echo "</script>"; 
		}
		
echo "<form name=REPORT method=post action=dictated.php enctype=\"multipart/form-data\" onSubmit=\"JavaScript:return fncSubmit();\">";

if ($BIRADFLAG =='1')
		{		
			$sql ="select BIRAD, DESCRIPTION FROM xray_birad";
			$result = mysql_query($sql);
			echo "<center>[Mammography option]</center><center> <b>Select BIRAD</b> : <select name=BIRAD>";
			echo "<OPTION value='0'>-</OPTION>";
				while ($row =mysql_fetch_array($result))
					{
						echo "<option value='".$row['BIRAD']."'>".$row['DESCRIPTION']."</option>";
					}
			echo "</select></center>";
		}

//echo "<form name=REPORT method=post action=dictated.php enctype=\"multipart/form-data\">\n";
echo "<input type=hidden name='ORDERID' value=\"".$ORDERID."\"><input type=hidden name='ACCESSION' value=\"".$ACCESSION."\"><inputer type=hidden name='RADID' value=\"".$usercode."\">\n";
echo "<input type=hidden name='hn' value=\"".$MRN."\">";
?>

<table style=border-style:solid;border-width:1px; bgcolor=#EEEEEE cellspacing="0" cellpadding="0">
<tr><td>
<div id="reportspace">
	<textarea id="area2" name="TEXTREPORT" cols="109" rows="22">
	<div id="REPORTAREA">
	<?php
	// Check Auto Saved report //
	$result = mysql_query("SELECT TEMP_REPORT FROM xray_request_detail WHERE ACCESSION = '$ACCESSION'");
	while($row = mysql_fetch_array($result))
		{
			$TEMP = $row['TEMP_REPORT'];
			$TEMP = str_replace("<div id=\"REPORTAREA\">", "<div>", $TEMP);
			// Remove Hilight text from google chrome
				$TEMP = str_replace("<span style=\"line-height: 16.5454540252686px; background-color: rgb(238, 238, 238);\">", "", $TEMP);
				$TEMP = str_replace("<span style=\"line-height: 1.3; background-color: rgb(238, 238, 238);\">", "", $TEMP);
				$TEMP = str_replace("background-color: rgb(238, 238, 238)", "", $TEMP);			
				$TEMP = preg_replace("/<span[^>]+\>/i", "", $TEMP);
				$TEMP = str_replace("</span>", "", $TEMP);
		}
	echo $TEMP;
	?>
	</div>
	</textarea>
</div></td></tr>
</table>
<center>
<table width=100%><tr><td>
<div id="timestamp" align=right><font size=-1>Auto Save : Time</font></div>
<?php
//$sql = "select ACCESSION, XRAY_CODE from xray_request_detail where REQUEST_NO ='$REQUEST_NO' and STATUS='TOREPORT' and ASSIGN ='$usercode'";
$sql1 = "select ACCESSION, XRAY_CODE from xray_request_detail where STATUS='TOREPORT' and ASSIGN ='$usercode' and ACCESSION <> '$ACCESSION'";
$amount = mysql_query($sql1);

$num_rows = mysql_num_rows($amount);
if ($num_rows > 1)
	{
		$sql ="SELECT xray_request.MRN, 
			xray_patient_info.MRN AS MRN, 
			xray_patient_info.CENTER_CODE, 
			xray_patient_info.NOTE AS PT_NOTE,
			xray_request.REQUEST_NO AS req_no, 
			xray_request_detail.ID AS ORDERID, 
			xray_request_detail.REQUEST_DATE AS REQ_DATE, 
			xray_request_detail.REQUEST_TIME AS REQ_TIME, 
			xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
			xray_request_detail.ASSIGN_TIME AS ASSIGNTIME,
			xray_request_detail.REQUEST_NO AS REQNUMBER, 
			xray_request_detail.REQUEST_DATE,
			xray_request_detail.ACCESSION, 
			xray_request_detail.XRAY_CODE AS XRAY_CODE, 
			xray_request_detail.STATUS, 
			xray_request_detail.URGENT, 
			xray_request_detail.ACCESSION,
			xray_request_detail.ASSIGN AS ASSIGN,
			xray_request_detail.ASSIGN_BY AS ASSIGN_BY, 
			xray_request_detail.STATUS AS STATUS,
			xray_request_detail.ARRIVAL_TIME AS ARRIVAL, 
			xray_request_detail.LOCKBY,
			xray_request_detail.FLAG1,
			xray_code.XRAY_TYPE_CODE AS MODALITY,
			xray_code.DESCRIPTION, 
			xray_code.BIRAD_FLAG, 
			xray_user.NAME AS RAD
			FROM  xray_request 
			LEFT JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_request_detail.ASSIGN = '$usercode' AND ACCESSION <> '$ACCESSION') 
			LEFT JOIN xray_user ON (xray_request_detail.ASSIGN = xray_user.CODE) 
			LEFT JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) 
			LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
			WHERE 
			(xray_patient_info.MRN = '$MRN')
			AND	(xray_request_detail.STATUS ='TOREPORT') OR (xray_request_detail.STATUS = 'PRELIM')
			AND (xray_request_detail.PAGE = 'RADIOLOGIST') 
			AND (xray_patient_info.CENTER_CODE ='POLICE')
			ORDER BY URGENT desc, FLAG1 ASC, ORDERTIME ASC
			LIMIT 0 , 10";
			
		$result = mysql_query($sql);
		//$num_rows = mysql_num_rows($result);
		$num = 0;
echo "<table border=0 width=100% bgcolor=#F5F6CE>\n";
echo "<font color=black><u>Option</u> : Copy this report to</font><br />";		
			while($row = mysql_fetch_array($result))
				{
					$num = $num+1;
					if ($row['ID'] !=$ORDERID)
						{
							if ($row['MRN'] == $MRN)
								{
									$REQ_DATE = $row['REQ_DATE'];
									//echo "<tr><td><font color=gray><INPUT TYPE=CHECKBOX NAME=COPYREPORT".$num." VALUE='".$row[ORDERID]."'><INPUT TYPE=HIDDEN NAME='COPYACC".$num."' VALUE='".$row[ACCESSION]."'></td><td> HN:".$row[MRN]. " Acc:".$row[ACCESSION]." </td><td>".$row[MODALITY]."</td><td> ".$row[DESCRIPTION]." </td><td> ".DateThai02($row[ARRIVAL])."</font></td></tr>\n";
									echo "<tr><td><font color=gray><INPUT TYPE=CHECKBOX NAME=COPYREPORT".$num." VALUE='".$row['ORDERID']."'><INPUT TYPE=HIDDEN NAME='COPYACC".$num."' VALUE='".$row['ACCESSION']."'></td><td> HN:".$row['MRN']." </td><td>".$row['MODALITY']."</td><td> ".$row['DESCRIPTION']." </td><td> ".EngEachDate($row['ARRIVAL'])."</font></td></tr>\n";									
								}
						}
				}
	echo "</table>\n";		
	
	}
					//WHERE (xray_request_detail.REQUEST_NO = '$REQUEST_NO')
?>

<br />

	<div class="buttons">
	<!--
    <a href="" class="regular"><img src="images/textfield_key.png" alt=""/>  Change Password </a>
	<a href="#" class="negative">  <img src="images/cross.png" alt=""/>  Cancel   </a>
	-->
	</div>
	<center>
	<?php echo  "<a href=http://127.0.0.1:8080/?AccessionID=$ACCESSION&UserName=$pacs_login target=pacsResult><button type=button class=positive value=OpenImage><img src=images/eye.png alt=\"\" />
	Open Image</button></a>";  
	?>
	<a  class="fancybox fancybox.iframe" href=dictate_show_preview_report_pdf.php?ACCESSION=<?php echo $ACCESSION; ?> >
	<button type=button class="positive" value="Preview"><img src="images/magnifier.png" alt=""/> Preview Report</button></a>
	<a  class="fancybox fancybox.iframe" href=createtemplate.php?Accession=<?php echo $ACCESSION; ?>>
	<button type=button class="positive" value="Save Template"><img src="images/page_add.png" alt=""/> Save As Template</button></a>
	<button type=submit class="positive" name=dictate_type value="Save"><img src="images/database_save.png" alt=""/> Save Draft</button>
	<button type=submit class="positive" name=dictate_type value="Approve"> <img src="images/disk.png" alt=""/> Approve Report</button>
	</div>
	</center>
</td></tr>
</table>
</center>

<?php
echo "</form>\n";
echo "</td><td valign=top >\n";
//echo "<img src=image/monitor1.png>\n";
?>
<table  border=0 style="width:200px;" cellspacing=1 bgcolor=#EBEBEB>
<tr><td bgcolor=#79acf3 align=center><b>Options</b></td></tr>
<tr><td bgcolor=#CFECEC>
<img src=icons/information.png> 
<?php
echo "<a class=\"fancybox fancybox.iframe\" href=order-info.php?MRN=$MRN&ACCESSION=$ACCESSION>";
?>
Order Detail </a><br />
<img src=icons/information.png>
<?php
echo "<a class=\"fancybox fancybox.iframe\" href=patient-info.php?MRN=$MRN>";
?>
Patient Detail</a><br />
<img src=arrow.gif> Save to Teaching <br />
<img src=arrow.gif> Structured Report <br />
<img src=arrow.gif> ICD <br />
<img src=arrow.gif> Reject  <br />
<img src=arrow.gif> Re-Assign
<?php
// Link Open MDC PACS
//echo "<a href=http://localhost:8080/?AccessionID=".$ACCESSION."&User=doctorstation  target=callpacs>OpenPACS";
?>

<iframe src="blank.html" name="callpacs" width="0" height="0" scrolling=no frameborder=0 marginwidth=0 marginheight=0 vspace="0" hspace="0"></iframe>
</td></tr>

<tr><td bgcolor=#79acf3><center><b>Exam Note</b></center></td></tr>
<tr><td bgcolor=#CFECEC>

<?php
	if ($FLAG2 ==1)
		{
			echo "<img src=arrow.gif> VIP <br />";
			echo $REQUEST_NO;
		}
	if ($NOTE =='')
		{
			echo "<img src=arrow.gif> No Exam note <br />";
		}
	if ($NOTE !=='')
		{
			echo "<img src=icons/information-white.png> ";
			echo $NOTE."<br />";
		}
?>
</td></tr>
<tr><td bgcolor=#79acf3><center><b>Patient Note</b></center></td></tr>
<tr><td bgcolor=#CFECEC>
<?php
	if ($PT_NOTE == '')
		{
			echo "<img src=arrow.gif> No  Note for this Patient";
		}
?>

</td></tr>
<tr>
<td bgcolor=#79acf3>
<center><b>File/Document </b></center>
</td></tr>
<tr><td bgcolor=#CFECEC>
<?php

$path = "document-uploads/uploads/".$ACCESSION."/";

if (!file_exists($path)) 
	{
		echo "<img src=arrow.gif> No File scan";
	}

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
					}
			}
		while (sizeof($string) != 0)
			{
				$img = array_pop($string);
				$ext = end(explode('.', $img));
				if ($ext == 'jpg')
					{ 
						echo "<a  class=\"fancybox fancybox.iframe\" href='resizeimage.php?image=$filePath$img'><img src='$filePath$img'   style=\"border:1px outset silver;\" height=45></a> ";
					}
				if ($ext == 'gif')
					{ 
						echo "<a  class=\"fancybox fancybox.iframe\" href='resizeimagegif.php?image=$filePath$img'><img src='$filePath$img'   style=\"border:1px outset silver;\" height=45></a> ";
					}
				if ($ext == 'png')
					{ 
						echo "<a  class=\"fancybox fancybox.iframe\" href='resizeimagepng.php?image=$filePath$img'><img src='$filePath$img'   style=\"border:1px outset silver;\" height=45></a> ";
					}
	
				//echo "<a  class=\"fancybox fancybox.iframe\" href='$filePath$img'><img src='$filePath$img'   style=\"border:1px solid black;\" height=45></a> ";
			}
		
	}

?>

</td>
</tr>
<tr>
<td bgcolor=#79acf3>
<center><b>Technologist </b></center>
</td></tr>
<tr><td bgcolor=#CFECEC>
<?php

/*if ($TECH1 !=='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$TECH1'");
		$TECH1 = mysql_result($result, 0);
		echo "<img src=arrow.gif>  ".$TECH1."<br />";
	}
	
if ($TECH2 !=='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$TECH2'");
		$TECH2 = mysql_result($result, 0);
		echo "<img src=arrow.gif>  ".$TECH2."<br />";
	}
	
if ($TECH3 !=='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$TECH3'");
		$TECH3 = mysql_result($result, 0);
		echo "<img src=arrow.gif>  ".$TECH3."<br />";
	}
	
*/
echo "<b>Tech </b>";
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
		echo "<br /><img src=arrow.gif>  ".$TECH2;
	}
	
if ($TECH3 !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$TECH3'");
		$TECH3 = mysql_result($result, 0);
		echo "<br /><img src=arrow.gif>  ".$TECH3;
	}
echo "<br />";
echo "<b>Assign By </b>";
if ($ASSIGN_BY1 !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE ID='$ASSIGN_BY1'");
		$ASSIGN_BY1 = mysql_result($result, 0);
		echo "<img src=arrow.gif>  ".$ASSIGN_BY1;
	}

echo "<br />";
if ($ASSIGN1 !='')
	{
		$result = mysql_query("SELECT NAME FROM xray_user WHERE CODE='$ASSIGN1'");
		$ASSIGN1 = mysql_result($result, 0);
		echo "<b>Assign To</b> <img src=arrow.gif>  ".$ASSIGN1;
	}
	
	
	
?>
</td></tr></table>
<ul id="countrytabs2" class="shadetabs">

<li><a href="template.php?MOTYPE=<?php echo $MOTYPE; ?>&procbodypart=<?php echo $PROCBODYPART; ?>" rel="countrycontainer">Template</a></li>
<li><a href="dictate-keyimage.php" rel="countrycontainer">Key Image</a></li>
</ul>
<div id="countrydivcontainer2" style="border:1px solid gray; width:180px; margin-bottom: 1em; padding: 5px">
</div>

<script type="text/javascript">
var countries=new ddajaxtabs("countrytabs2", "countrydivcontainer2")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>
 

<script type="text/javascript">
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
 </script>

<?php
echo "</td></tr></table>\n";
echo "<br /><br /><br />";
echo "</td></tr></table>";
echo "<center><font color=#ACACAC>CopyRight 2015 (C)</font></center>\n";
?>

<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 


<!--////////////// Open PACS - MDC //////////////////////-->

<iframe name="pacsResult" frameborder="0" width="0" height="0" src="<?php echo"http://127.0.0.1:8080/?AccessionID=$ACCESSION&UserName=$pacs_login"; ?>"></iframe>
</body>
</html>

<?php

//echo $login_pacs;
///////////////////////////////////////////////////// Display Key Image From DCM4CHEE///////////////////////////////

//if ($TYPE_CODE == 'CT' or $TYPE_CODE == 'MR') 
//{
//				echo "<b><center><font color=blue>ADD KEY IMAGE : CLICK ADD IMAGE TO EDITOR </font></center></b>";
//				echo "<div id=\"reportspace\">";
//				echo "<center><textarea id=\"keyimage1\" name=\"KEYIMAGE\" cols=\"85\" rows=\"3\" ><div id=\"keyimage2\"><br />";
//Open images directory from DCM4CHE
//$host2 ="localhost";
//$user2 ="pacs";
//$password2 ="pacs";
//$dbname2 ="pacsdb";
//$dbconnect2 = mysql_connect($host2,$user2,$password2);
//if (!$dbconnect2) {
//echo "Can't connet to Server Please contect Admin";
//exit;

//}
//mysql_select_db($dbname2, $dbconnect2);
//$sql3 = 'SELECT study.study_iuid as study , series.series_iuid as series , instance.sop_iuid as object '
//        . 'FROM patient LEFT JOIN study '
//        . ' ON ( patient.pk = study.patient_fk ) '
//        . ' LEFT JOIN series '
//        . ' ON ( series.study_fk = study.pk ) '
//        . ' LEFT JOIN instance '
//        . ' ON ( instance.series_fk = series.pk ) WHERE ( patient.pat_id =\'$MRN\') LIMIT 0, 100 ;';
//$result = mysql_query($sql3,$dbconnect2);

//while($row = mysql_fetch_array($result))

//  {
//	$line = $line + $row;
//	$study = $row['study'];
//	$series = $row['series'];
//	$object = $row['object'];

	
 // echo "<img src='http://192.168.1.5:8080/wado?requestType=WADO&studyUID=".$study."&seriesUID=".$series."&objectUID=".$object."' width='250'/>";
//			if ($line%2==0) {
//				echo "<br />";
//			}
  
 // }

///////////////////////////////////////////////////////////////////////////////////////////////////////////
?>