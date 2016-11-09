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

echo "<script language=JavaScript src=\"frames_body_array_english.js\" type=text/javascript></script>";
echo "<script language=JavaScript src=\"mmenu.js\" type=text/javascript></script>";  

echo "<link href=\"css/main.css\" rel=\"stylesheet\" type=\"text/css\" />";
echo "<body bgcolor=#E8E8E8>";	
?>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Manual</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>
<br />

<?php
echo "<table align=center><tr><td>";
echo "<center><u>Manual</u></center>";
echo "<li> All User Manual </li>";
echo "<li>  Radiologist User </li>";
echo "<li> Admin User Manual </li>";
echo "- User can find manual at www.thairis.net";
echo "</td></tr><table>";
echo "<center>-------------------------------------------------------------</center>";

?>
