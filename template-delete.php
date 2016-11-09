<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: createtemplate.php
# Description :  Show text box for create template
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
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>  

<?php
include "connectdb.php";
include "session.php";

$sql ="select ID, NAME, XRAY_CODE, XRAY_TYPE_CODE, BODY_PART, USER_ID, REPORT_DETAIL FROM xray_report_template WHERE ID='$TEMPLATE_ID'";
$result = mysql_query($sql);
while($row = mysql_fetch_array($result))
				{
					$TEMPLATE_ID = $row['ID'];
					$REPORT_DETAIL = $row['REPORT_DETAIL'];
					$TEMPLATE_NAME =  $row['NAME'];
				}
				
echo "<b><u>Delete Template</u></b><p>";
echo "<u>Template Name</u> : ".$TEMPLATE_NAME;
echo " <br />";
echo "After deleted this template can't recovery. ";
echo "<form name=template method=post action=template-deleted.php enctype=\"multipart/form-data\">";
echo "<input type=hidden name='CENTER' value=\"".$center_code."\">";
echo "<input type=hidden name='TEMPLATE_ID' value=\"".$TEMPLATE_ID."\">";

?>
<div id=showprocedure></div>
<div id="reportspace">
<textarea cols="105" rows="20" id="area2" name="TEXTREPORT">
<?php
echo $REPORT_DETAIL;
?>

</textarea><br>
<input type=submit value="Delete"> </div>
<?php
echo "</form>\n";
echo "</td></tr></table>";
echo "<center>CopyRight(C)</center>"
?>