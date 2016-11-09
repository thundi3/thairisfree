<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 29 May 2014
# File name: template-edit-show.php
# Description :  Show text box for create template edit
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
header("Content-type: text/html;  charset=TIS-620");
include ("session.php");
$TEMPLATE_ID = $_GET['TEMPLATE_ID'];
?>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<script type="text/JavaScript" src="createtemplate.js"></script>
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
bkLib.onDomLoaded(function() {
	//new nicEditor().panelInstance('area1');
	//new nicEditor({fullPanel : true}).panelInstance('area2');
	//new nicEditor({fullPanel : true}).panelInstance('area2');
	//new nicEditor({iconsPath : 'nicEditorIcons.gif'}).panelInstance('area3');
	new nicEditor({iconsPath : 'nicEditIcons-latest.gif'}).panelInstance('area2');
	//new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html','image']}).panelInstance('area4');
	//new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','html']}).panelInstance('area2');
	//new nicEditor({maxHeight : 100}).panelInstance('area5');
});
</script>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  
<script language="javascript">
function fncSubmit()
	{
			if(document.template.modality.value == "")
			{
				alert('Please Select a modality type !');
				document.template.modality.focus();       
				return false;
			}  
			if(document.template.BODYPART.value == "")
			{
				alert('Please Select body part !');
				document.template.BODYPART.focus();       
				return false;
			}
		document.template.submit();
	}
	
</script>
<?php
include "connectdb.php";
include "session.php";

$sql = "select XRAY_TYPE_CODE from xray_type";
$result = mysql_query($sql);
echo "<b><u>Update Template</u></b><p>";
echo "<form name=template method=post action=template-edit-save.php enctype=\"multipart/form-data\" onSubmit=\"JavaScript:return fncSubmit();\">";
echo "<input type=hidden name='CENTER' value=\"".$center_code."\">";

echo "<input type=\"hidden\" name=\"department_selected\" value=''></div>";
echo "Template In :";
echo "<SELECT NAME=\"owner\">\n<OPTION VALUE=".$usercode.">My Template</OPTION>\n";
echo "<OPTION VALUE=\"ALL\">ALL User</OPION></SELECT>";
echo "Modality Type : <SELECT id=\"modality\" name=\"modality\" onChange=select_mod('xxx')>";
echo "<OPTION></OPTION>";
while($row = mysql_fetch_array($result))
	{
		echo "<OPTION VALUE=".$row['XRAY_TYPE_CODE'].">".$row['XRAY_TYPE_CODE']."</OPTION>";
	}
echo "</SELECT>";

?>
<div id=showprocedure></div>
<div id="reportspace">
<textarea cols="105" rows="20" id="area2" name="TEXTREPORT">
<?php
$sql ="select ID, NAME, XRAY_CODE, XRAY_TYPE_CODE, BODY_PART, USER_ID, REPORT_DETAIL FROM xray_report_template WHERE ID='$TEMPLATE_ID'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
				{
					echo $row['REPORT_DETAIL'];
					$TEMPLATE_ID = $row['ID'];
					$TEMPLATE_NAME =  $row['NAME'];
				}

?>

</textarea><br>
Template Name : 
<?php
echo "<b>".$TEMPLATE_NAME."</b>";
echo "<input type=hidden name='TEMPLATE_ID' value=\"".$TEMPLATE_ID."\">";
?>

<input type=submit value="Update Template"> </div>
<?php
echo "</form>\n";
echo "</td></tr></table>";
echo "<center>CopyRight(C)</center>"
?>