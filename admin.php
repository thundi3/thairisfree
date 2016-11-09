<?php
include "session.php";
include "connectdb.php";
header("Content-type: text/html;  charset=utf-8");
//echo $usertype.$superadmin;
if (($usertype !== 'ADMIN') AND ($superadmin == 0) AND ($admin == 0))
	{
		?>
		<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
		<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
		<?php
		echo "<body bgcolor=gray>";
		echo "Admin area  you can't use this page";
		echo "<meta http-equiv=\"refresh\" content=\"4;url=main.php\" />";
		exit;
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Administrator </title>

<style type="text/css">

<!--

body {
	margin: 0px  0px;
	padding: 0px  0px;
	background-color: #d4d4d4;
}
a:link { color: #005CA2; text-decoration: none}
a:visited { color: #005CA2; text-decoration: none}
a:active { color: #0099FF; text-decoration: underline}
a:hover { color: #0099FF; text-decoration: underline}

-->

</style>

<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   

</head>
<body bgcolor="#d4d4d4" topmargin=0 leftmargin=0>
<div id="header-wrap">
	<div id="header-container">
		<table border=0 cellspacing=0 cellpedding=0 width=100%>
			<tr>
				<td  BACKGROUND="cornner/hl.gif" border=0 width=20 height=36></td>
				<td background="cornner/bg.gif" height=36 width=70%></td>
				<td background="cornner/hm1.gif" width=33 align=right></td>
				<td background="cornner/hm2.gif">Administrator</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif"></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br/>

<table border=1 cellspacing="0" bordercolor="black" width=90% bgcolor=#E8E8E8 align=center>
<tr>
  <td colspan="3" align="center" valign="top" bgcolor="#79acf3"><h1><strong>Administrator</strong></h1></td>
  </tr>
<tr><td width=33% valign="top" bgcolor="#f8d290"><font face="MS Sans Serif">1.) Procedure Code</font> <ul>
  <li><a href=procedure-new.php>New</a></li>
  <li><a href=procedureshow.php>Edit</a></li>
  <li><a href="procedure.php">View</a> <a href=procedure2.php>Test2</a></li>
  <li>Delete</li>
</ul>
    <font face="MS Sans Serif">2.) Radiology Staff</font>
    <ul>
      <li><a href=staff_new.php>New</a></li>
      <li>Edit</li>
      <li><a href=staff_view.php>View</a></li>
      <li>Delete</li>
      <li><a href=add_df_code.php>Add DF Code</a></li>
	  <li><a href=staff_right.php>Staff Right</a></li>
    </ul>
    <font face="MS Sans Serif">3.)  Referrer Physician</font>
    <ul>
      <li><a href=referrer_new.html>New</a></li>
      <li>Edit</li>
      <li><a href=referrer_view.php>View</a></li>
      <li><a href=referrer_delete.php>Delete</a></li>
    </ul>
    </td>
<td width=33% valign="top" bgcolor="#f8d290">


</ul>
<font face="MS Sans Serif">4.) Department</font>
<ul>
<li><a href=department_view.php>New</a></li>
<li><a href=department_view.php>Edit</a></li>
<li><a href=department_view.php>View</a></li>
<li><a href=department_view.php>Delete</a></li>
</ul>
<p>5.) Admin</p>
<ul>
  <li><a href=center.php>Center</a><br />
  </li>
  <li><a href=mergepatient.php>Merge</a> Patient  </li>
  <li><a href=dmwl.php>MWL Modality Worklist Config</a></li>
  <li><a href=editnews.php>Edit NEWS Page (Main screen)</a></li>
  <li><a href=showlog1.php>Show Log</a></li>
  <li><a href=re-assign.php>Re-Assign Radiologist</a></li>
  <li><a href=prepare.php>Procedure Preparation Form</a></li>
  <li><a href=checklock_study.php>Unlocked study</a></li>

</td>




  




<td width=33% valign="top" bgcolor="#f8d290">


6.) System

<ul>

 <li><a href=delalllog.php>Delete All LOG</a> Testing only!!</li>
  <li><a href=delallhl7.php>Delete All HL7</a> Testing only!!</li>
  <li><a href=delallorder.php>Delete All Order</a> Testing only!!</li>
  <li><a href=hl7-resend.php>Resend ORU (Report )</a></li>
  <li>Restart Database<a href=restartmysq_linux.php> Linux Server</a> <a href=restartmysql_windows.php> Windows Server</a>
</ul>
  
<form action="reboot.php" method="post">
System : 
<input class="button" name="Submit" value="Reboot" type="submit">
</form>

<br/><br/>
7.) <a href=resetpassword.php>Reset User Password</a>
</td>
</tr></table>


<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script>   



</body>
</html>

