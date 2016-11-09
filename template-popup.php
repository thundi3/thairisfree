<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 0.9
# File last modified: 8 Nov 2016
# File name: template-popup.php
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################

$templateid = $_GET['templateid'];
//$templateid = xxxxxx;
?>

<html>
<head>
<title>Template</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

</head>
<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0" bgcolor="#FFFFFF">
<br>
Template Name : <br> 
<?php
echo "ID = ".$templateid;
?>
 <br>

<input type=button value=ViewTemplate> <input type=button value=Confirm onClick="templateinsert('<?php echo $templateid; ?>')">


</body>
</html> 