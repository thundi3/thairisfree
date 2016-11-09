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
header("Content-type: text/html;  charset=utf-8");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>Thai RIS</title>
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/home_style.css" rel="stylesheet" type="text/css" />    
	<script type="text/javascript" src='Scripts/jquery-1.4.4.js'></script>
    <script type="text/javascript" src="Scripts/jquery-ui-1.8.10.custom.min.js"></script>
    <script type="text/javascript" src="Scripts/PM.UIPage.Home.js"></script>     
	<script type="text/javascript" src="Scripts/PM.UIPage.js"></script> 
    <script type="text/javascript" src="Scripts/jquery.jclock.js"></script>  
	<script language=JavaScript src="frames_header_array_<?php echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script> 
	<script type="text/javascript">
    $(function($) {
       var options = {
            timeNotation: '12h',
            am_pm: true,
            fontFamily: 'Verdana',
            fontSize: '16px',
            foreground: 'black'
          }; 
       $('.jclock').jclock(options);
    });
    </script>     
</head>

<body>
	<div id="header">

		
        <div id="main-menu">
            <ul id="navigation">
                <li class="home">

                </li>
                <li class="line">&nbsp;</li>
                <li class="register">
 
                </li>
                <li class="line">&nbsp;</li>                
                <li class="order">

                </li>
                <li class="line">&nbsp;</li>                
                <li class="operate">

                </li>  
                <li class="line">&nbsp;</li>                
                <li class="reporting">

                </li>
                <li class="line">&nbsp;</li>     
                <li class="search">

                </li>
                <li class="line">&nbsp;</li>     
                <li class="reports">

                </li>
                <li class="line">&nbsp;</li>     
                <li class="management">

                </li>
                <li class="line">&nbsp;</li>     
                <li class="help">

                </li>
                <li class="line">&nbsp;</li>                                                                                    
            </ul> 
            <div id="account-status">
<style>
<?php 
$filename = "images/user/".$userid.".jpg";

if (file_exists($filename)) 
	{
		$display=$filename;
	} 

$filename1 = "images/user/".$userid.".png";
if (file_exists($filename1)) 
	{
		$display=$filename1;
	} 

$filename2 = "images/user/".$userid.".gif";
if (file_exists($filename2)) 
	{
		$display=$filename2;
	} 
	
if ($display=='')
	{
		$display="tmp/display.png";
	}

?>
#account-status .photo-display2
	{
		background:#FFF url(<?php echo $display; ?>) no-repeat;
		background-size:82px 82px;
		height:82px;	
		width:82px;
		float:left;		
	}
</style>		
            	<div class="photo-display2">
	            	<div class="photo-frame">
					</div>
                </div>
            	<div class="Acc-Info">
				
                	<h2>Code : 
					<?php
					echo $usercode;
					?>
					
					</a></h2>
                    <h2>User :  
					<?php
					 echo "<a href=usercode.php target=main>".$username." ".$userlastname."</a>";
					?>

					</h3></h2>
                    <h2>Login since : 
					<?php
					echo $logintime;
					?>
					</h2>
					<br/>
					<!-- donot remove the link, for our credit -->
					<a href=http://www.thairis.net target=_blank><font size=1 color=yellow><b>ThaiRIS.Net</a> Free Version1.0</b></font>					
                </div>
            	<div class="Acc-Status">
                <a href=logoff.php target=_top><img src="image/exit.png" width="32" height="32" border=0 /></a></div>                
          </div>       
        </div>
	</div>

</body>
</html>