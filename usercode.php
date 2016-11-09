<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: usercode.php
# Description :  User perferrence 
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
header("Content-type: text/html;  charset=TIS-620");
include ("session.php");
include ("connectdb.php");
include ("function.php");

//$usercode 
//$username 
//$userlastname
//echo "<body bgcolor=\"#d4d4d4\">";
?>
<head>
<link href="css/styles-user.css" rel="stylesheet" type="text/css" />
<script src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function (e) {
	$("#uploadForm").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "user-upload.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    cache: false,
			processData:false,
			success: function(data)
		    {
			$("#targetLayer").html(data);
		    },
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
</script>
</head>
<body  bgcolor="gray" topmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">User Code</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>

<br/>

<?php

echo "<table>";
echo "<tr><td valign=top><table width=100%>";
echo "<tr><td bgcolor=#79ACF3> User Center </td><td bgcolor=#E0E0E0>".$usercenter."</td></tr>";
echo "<tr><td bgcolor=#79ACF3> User ID </td><td bgcolor=#E0E0E0>".$userid."</td></tr>";
echo "<tr><td bgcolor=#79ACF3> User Code  </td><td bgcolor=#E0E0E0> ".$usercode." </td></tr>";
echo "<tr><td bgcolor=#79ACF3> User Name </td><td bgcolor=#E0E0E0>".$username." ".$userlastname."</td></tr>";
echo "<tr><td bgcolor=#79ACF3> User Type </td><td bgcolor=#E0E0E0>".$usertype."</td></tr>";


$sql2 = "select USER_ID, DF_CODE, NAME_THAI, NAME_ENG  FROM XRAY_USER_DF_CODE WHERE USER_ID ='$userid'";
$result2 = mysql_query($sql2);
//$numrows = mysql_num_rows($result2);
//if($numrows == 0)
//	{
//		echo "<tr><td bgcolor=#79ACF3>Change Doctor Fee Code </td><td bgcolor=#E0E0E0>Create New Doctor Code</td></tr>";
//	}

?>
<tr><td bgcolor=#79ACF3>Default Page Logon</td><td  bgcolor=#E0E0E0> Main </td></tr>
<tr><td bgcolor=#79ACF3>User Image</td>
<td bgcolor=#E0E0E0>

<?php
$filename = "images/user/".$userid.".jpg";

if (file_exists($filename)) 
	{
		$display=$filename;
	} 
if ($display=='')
	{
		$display="tmp/display.png";
	}
	
echo "<img src=".$display." width=80 height=80>";
?>


</td></tr>
</table>
<div class="bgColor">
<form id="uploadForm" action="upload.php" method="post">
<div id="targetLayer">No Image</div>
	<div id="uploadFormLayer">
		<label>Upload Image File: (.jpg) </label><br />
		<input name="userImage" type="file" class="inputFile" />
		<input type="submit" value="Submit" class="btnSubmit" />
	</div>
</form>
</td>



<?php
 if ($usertype=='RADIOLOGIST')

	{ 	
		echo "<td><table>";
		echo"<tr><td bgcolor=#79ACF3>Digital Signature <br />
		<form action=\"uploaduserpic.php\" enctype=\"multipart/form-data\" method=\"post\">
		<p><input type=\"file\" name=\"datafile\" size=\"40\"></p>
		<div><input type=\"submit\" value=\"Upload\"></div>
		<hr>
		<input type=\"checkbox\" name=\"option1\" value=\"Milk\"> Active
		</form>
		</td><td bgcolor=#E0E0E0><img src=signature/1.jpg></td></tr>
		<tr><td bgcolor=#79ACF3> Text Signature <br />
		<hr>
		<input type=\"checkbox\" name=\"option1\" value=\"Milk\"> Active
		</td>
		<td bgcolor=white>
		<form method=post action=signature-text.php enctype=\"multipart/form-data\">
		<div id=\"reportspace\">
		<textarea cols=\"59\" rows=\"5\" id=\"area2\" name=\"SIGN\" >";
   $sql = "select TEXT_SIGNATURE from xray_user WHERE ID='$userid'";
   $result = mysql_query($sql);
   $row = mysql_fetch_array($result);
   echo $row['TEXT_SIGNATURE'];
	echo "</textarea><br>
		<input type=\"reset\" value=Clear> <input type=submit value=SAVE> 
		</div>
		<script type=\"text/javascript\" src=\"nicEdit.js\"></script> 
		<script type=\"text/javascript\">
			bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		</script>";
	echo "</table></td>";
	}

?>
</table>
</td></tr>
</table>



<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
