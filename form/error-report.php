<?php
include "../session.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Error Form</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   
</head>
<body id="main_body" >
	
	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Error Form</a></h1>
		<form id="form_292483" class="appnitro" enctype="multipart/form-data" method="post" action="">
					<div class="form_description">
			<h2>Send Error Report to Administrator</h2>
			<p>Please put your detail.</p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Name </label>
		<div>
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Email </label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Detail </label>
		<div>
			<textarea id="element_3" name="element_3" class="element textarea medium"></textarea> 
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Upload a File (Screen capture) </label>
		<div>
			<input id="element_4" name="element_4" class="element file" type="file"/> 
		</div>  
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="292483" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	

	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>