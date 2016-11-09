<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: template-edit.php
# Description : Editor for Template
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

include ("session.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>

<head>

<title>Main</title>

<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<script type="text/JavaScript" src="template-edit.js"></script>
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
<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: underline}
a:hover { color: #0099FF; text-decoration: underline}

-->

</style>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>





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
<?php
include "connectdb.php";
include "session.php";
$sql = "select XRAY_TYPE_CODE from xray_type";
$result = mysql_query($sql);


?>
<body bgcolor="#d4d4d4">

<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Template</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>

<br/>






<?php
echo "<center><table><tr><td>";
echo "<b><u>My Template</u></b><p>";
echo "<form name=template method=post action=createtemplate-save.php enctype=\"multipart/form-data\">";
echo "<input type=hidden name='CENTER' value=\"".$center_code."\">";
echo "<input type=\"hidden\" name=\"department_selected\" value=''></div>";
echo "Template In :";

echo "Modality Type : <SELECT id=\"modality\" name=\"modality\" onChange=select_mod('xxx')>";
echo "<OPTION></OPTION>";
while($row = mysql_fetch_array($result)){
	echo "<OPTION VALUE=".$row['XRAY_TYPE_CODE'].">".$row['XRAY_TYPE_CODE']."</OPTION>";
}
echo "</SELECT>";

?>
<div id=showprocedure></div>
<div id="reportspace">

<?php
echo "</form>\n";
echo "</td></tr></table>";

echo "</td></tr></table>";
//echo "<center>By ThaiRIS</center>"
?>