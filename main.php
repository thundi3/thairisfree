<?php 
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 23 Apr 2016
# File name: main.php
# Description : Main page and Dash board
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
include ("session.php");
include ("connectdb.php");
header("Content-type: text/html;  charset=utf-8");
?>
<!DOCTYPE html>
<html>

<head>
<title>Main</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">

<!--

body {  margin: 0px  0px; padding: 0px  0px}
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: underline}
a:hover { color: #0099FF; text-decoration: underline}

-->

</style>

    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  

</head>



<body bgcolor="#d4d4d4">
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Main</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"><?php echo $username; ?></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>


<table width="80%" border="0" cellspacing="0" cellpadding="0" height="311" bgcolor="#d4d4d4" align=center>

  <tr> 

    <td rowspan="2" valign="top" width="60%"> 

      <div> 

        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">

          <tr >

            <td  valign="top" height="442"> 


               <table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr><td><img src="icon/news.gif" height=50></td></tr>
					
                  <tr bgcolor="#79acf3">   <td width="100%"><font face="MS Sans Serif"><b><font color="#000066"><?php  echo $_NEWS_HEADER; ?></font></b></font></td>  </tr>
            

<tr bgcolor=#EBEBEB><td>

<?php 

 $sql = "select NEWS from xray_news WHERE CENTER_CODE='$center_code'";
 $result = mysql_query($sql);
 $row = mysql_fetch_array($result);
 echo $row['NEWS'];

?>

   </td></tr>
       </table>

            </td>

          </tr>

        </table>

      </div>

      </td>

    <td width="40%" height="191" valign="top"> 

      <font face="MS Sans Serif"><b><img src="icon/stat.gif" width="70" height=50></b></font>

      

      <table width="100%" border="0" cellspacing="2" cellpadding="0">

        <tr> <td  colspan=2 widht=100% bgcolor=#79acf3 ><font face="MS Sans Serif"><b><?php  echo $_TODAY_STATUS; ?></b></font></td></tr>
		<tr>
		   <td width="71%" bgcolor="#D7D7D7"><font face="MS Sans Serif"><?php  echo "Studies Today"; ?></font></td>
          <td width="29%" bgcolor="#D7D7D7"><font face="MS Sans Serif">
		  
<?php 
$result = mysql_query("SELECT ID FROM xray_request_detail  WHERE xray_request_detail.REQUEST_DATE = DATE(NOW())");// And Complate Date =  
$num_rows = mysql_num_rows($result);
echo "<a href=order.php>".$num_rows."</a>";
?>
		  <?php echo "Studies"; ?></font></td>

        </tr>

        <tr> 

          <td width="71%" bgcolor="#EBEBEB"><font face="MS Sans Serif"><?php  echo "Waiting"; ?></font></td>
          <td width="29%" bgcolor="#EBEBEB"><font face="MS Sans Serif">
<?php 
	$result = mysql_query("SELECT ID FROM xray_request_detail where status ='READY' AND xray_request_detail.REQUEST_DATE = DATE(NOW())");// And Complate Date =  
	$num_rows = mysql_num_rows($result);
	//echo "<a href=waiting.php>".$num_rows."</a>";
	echo $num_rows;
?>

<?php echo "Studies"; ?></font></td>

        </tr>
        <tr> 
          <td width="71%" bgcolor="#D7D7D7"><font face="MS Sans Serif"><?php  echo "Schedule"; ?></font></td>
          <td width="29%" bgcolor="#D7D7D7"><font face="MS Sans Serif">0 <?php echo "Studies"; ?></font></td>
        </tr>
        <tr> 
          <td width="71%" bgcolor="#EBEBEB"><font face="MS Sans Serif"><?php echo "Waiting Report"; ?></font></td>
          <td width="29%" bgcolor="#EBEBEB"><font face="MS Sans Serif">

<?php 
		$result = mysql_query("SELECT ID FROM xray_request_detail where status ='TOREPORT' AND xray_request_detail.REQUEST_DATE = DATE(NOW())");
		$num_rows = mysql_num_rows($result);
		//echo "<a href=reporting2.php?selectuser=ALL>".$num_rows."</a>";
		echo $num_rows;
?>
		 <?php echo "Studies"; ?></font></td>

        </tr>

        <tr> 
          <td width="71%" bgcolor="#D7D7D7"><font face="MS Sans Serif"><?php echo "Approved Report"; ?></font></td>
          <td width="29%" bgcolor="#D7D7D7"><font face="MS Sans Serif">
<?php 
$result = mysql_query("SELECT ID FROM xray_request_detail where status ='APPROVED' AND xray_request_detail.REQUEST_DATE = DATE(NOW())");// And Complate Date =  
$num_rows = mysql_num_rows($result);
echo "<a href=reported.php>".$num_rows."</a>";
?>
	<?php echo "Studies"; ?></font></td>

        </tr>

        <tr> 
          <td width="71%"  bgcolor="#EBEBEB"><font face="MS Sans Serif"><?php echo "Cancel"; ?></font></td>
          <td width="29%"  bgcolor="#EBEBEB"><font face="MS Sans Serif">
<?php 
$result = mysql_query("SELECT ID FROM xray_request_detail WHERE status='CANCEL' AND xray_request_detail.REQUEST_DATE = DATE(NOW())");// And Complate Date =  
$num_rows = mysql_num_rows($result);
echo $num_rows;
?>
		  <?php echo "Studies"; ?></font></td>

        </tr>

      </table>


    </td>

  </tr>

  <tr> 

    <td width="61%" valign="top"> 
<p></p>
<center>	   
<img src="main-graph.php?_jpg_csimd=1" ismap="ismap" usemap="#__mapname37500__" height="300" alt="" />
</center>
 
    </td>
  </tr>

</table>
</body>
</html>

