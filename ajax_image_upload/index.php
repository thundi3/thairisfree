<?
include "../session.php";
include "../connectdb.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>PHP AJAX Image Upload, Truly Web 2.0!</title>
		<meta name="description" content="PHP AJAX Image Upload, Truly Web 2.0!" />
		<meta name="keywords" content="PHP AJAX Image Upload, Truly Web 2.0!" />
		<meta name="robots" content="index,follow" />
		<meta name="copyright" content="AT Web Results, Inc." />
		<meta name="distribution" content="global" />
		<meta name="resource-type" content="document" />
		<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
		<!-- MAKE SURE TO REFERENCE THIS FILE! -->
		<script type="text/javascript" src="scripts/ajaxupload.js"></script>

	</head>
	<body>

			<br />
			<!-- THIS IS THE IMPORTANT STUFF! -->
			<div id="demo_area">
				<div id="left_col">
					<fieldset>
						<legend>Standard Use</legend>
						<!-- 
							VERY IMPORTANT! Update the form elements below ajaxUpload fields:
							1. form - the form to submit or the ID of a form (ex. this.form or standard_use)
							2. url_action - url to submit the form. like 'action' parameter of forms.
							3. id_element - element that will receive return of upload.
							4. html_show_loading - Text (or image) that will be show while loading
							5. html_error_http - Text (or image) that will be show if HTTP error.

							VARIABLE PASSED BY THE FORM:
							maximum allowed file size in bytes:
							maxSize		= 9999999999
							
							maximum image width in pixels:
							maxW			= 200
							
							maximum image height in pixels:
							maxH			= 300
							
							the full path to the image upload folder:
							fullPath		= http://localhost/thairis/ajax_image_upload/uploads/
							
							the relative path from scripts/ajaxupload.php -> uploads/ folder
							relPath		= ../uploads/
							
							The next 3 are for cunstom matte color of transparent images (gif,png), use RGB value
							colorR		= 255
							colorG		= 255
							colorB		= 255

							The form name of the file upload script
							filename		= filename
						-->
						
						<form action="scripts/ajaxupload.php" method="post" name="standard_use" id="standard_use" enctype="multipart/form-data">
							<p><input type="file" name="filename" /></p>
							<button onclick="ajaxUpload(this.form,'scripts/ajaxupload.php?filename=filename&amp;maxSize=9999999999&amp;maxW=200&amp;fullPath=http://localhost/thairis/ajax_image_upload/uploads/&amp;relPath=../uploads/&amp;colorR=255&amp;colorG=255&amp;colorB=255&amp;maxH=300','upload_area','File Uploading Please Wait...&lt;br /&gt;&lt;img src=\'images/loader_light_blue.gif\' width=\'128\' height=\'15\' border=\'0\' /&gt;','&lt;img src=\'images/error.gif\' width=\'16\' height=\'16\' border=\'0\' /&gt; Error in Upload, check settings and path info in source code.'); return false;">Upload Image</button>
						</form>
					</fieldset>
					
		<?php
//		echo $_SERVER['HTTP_REFERER'];
				echo $_SERVER['HTTP_HOST'];
		
		?>

					<br /><small style="font-weight: bold; font-style:italic;">Supported File Types: gif, jpg, png</small>
				</div>
				
				<div id="right_col">
					<div id="upload_area">
<?php

$filename = "../signature/".$userid.".jpg";
echo $filename;
if (file_exists($filename)) 
	{
		echo "<img src=../signature/".$userid.".jpg align=center><br />";
	} else {
    echo "No signature file<br />";
	}
?>

					You can change signature !
					</div>
				</div>
				
				</div>
<script language=JavaScript src="../frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="../mmenu.js" type=text/javascript></script> 

</body>
</html>