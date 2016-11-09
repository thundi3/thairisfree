<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 24 APR 2016
# File name: order.php
# Description :  Show Order worklist
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
// Input isset then search don't work
//include "connectdb.php";
include "session.php";
include ("function.php");
set_time_limit(0);

//$searchbox = isset($_GET['searchbox']) ? $_GET['searchbox'] : null;
//$searchdate = isset($_GET['searchdate']) ? $_GET['searchdate'] : null;
//$datestart = isset($_GET['date001']) ? $_GET['date001'] : null;
//$dateend = isset($_GET['date002']) ? $_GET['date002'] : null;
//$searchtoday = isset($_GET['today']) ? $_GET['today'] : null;
//$todaytype = isset($_GET['todaytype']) ? $_GET['todaytype'] : null;
//$searchhn = isset($_GET['searchhn']) ? $_GET['searchhn'] : null;
//$searchxn = isset($_GET['searchxn']) ? $_GET['searchxn'] : null;
//$searchname = isset($_GET['searchname']) ? $_GET['searchname'] : null;
//$searchlast = isset($_GET['searchlast']) ? $_GET['searchlast'] : null;
//$department = isset($_GET['department']) ? $_GET['department'] : null;
//$mod1 = isset($_GET['Mod_option1']) ? $_GET['Mod_option1'] : null;
//$mod2 = isset($_GET['Mod_option2']) ? $_GET['Mod_option2'] : null;
//$mod3 = isset($_GET['Mod_option3']) ? $_GET['Mod_option3'] : null;
//$mod4 = isset($_GET['Mod_option4']) ? $_GET['Mod_option4'] : null;
//$mod5 = isset($_GET['Mod_option5']) ? $_GET['Mod_option5'] : null;
//$mod6 = isset($_GET['Mod_option6']) ? $_GET['Mod_option6'] : null;
//$mod7 = isset($_GET['Mod_option7']) ? $_GET['Mod_option7'] : null;
//$mod8 = isset($_GET['Mod_option8']) ? $_GET['Mod_option8'] : null;


$searchbox = $_POST['searchbox'];
$searchdate = $_POST['searchdate'];
$datestart = $_POST['date001'];
$dateend = $_POST['date002'];
$searchtoday = $_POST['today'];
$todaytype = $_POST['todaytype'];
$searchhn = $_POST['searchhn'];
$searchxn = $_POST['searchxn'];
$searchname = $_POST['searchname'];
$searchlast = $_POST['searchlast'];
$department = $_POST['department'];
$mod1 = $_POST['Mod_option1'];
$mod2 = $_POST['Mod_option2'];
$mod3 = $_POST['Mod_option3'];
$mod4 = $_POST['Mod_option4'];
$mod5 = $_POST['Mod_option5'];
$mod6 = $_POST['Mod_option6'];
$mod7 = $_POST['Mod_option7'];
$mod8 = $_POST['Mod_option8'];


if ($datestart =="")
	{
		$datestart = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-30,date("Y"))); // 30 daby back Yesterday
		//$datestart = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-3,date("Y")));  3 day back
	}

if ($dateend =='')
	{
		$dateend = date("Y-m-d");
	}

?>
<!DOCTYPE html>
<html>
<head>
<title>Order</title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/layout.css" rel="stylesheet" type="text/css" />
<link href="css/modal.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src='css/taskbar.js'></script>
<!--[if IE 6]>
<link href="css/ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css">  
<style type="text/css">  
/* Overide css code กำหนดความกว้างของปฏิทินและอื่นๆ */  
.ui-datepicker{  
    width:170px;  
    font-family:tahoma;  
    font-size:11px;  
    text-align:center;  
}  
</style> 
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
  
<script type="text/javascript" src='Scripts/jquery-1.4.4.js'></script>
<script type="text/javascript" src="Scripts/jquery.jclock.js"></script>  
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
	
<!--http://www.scientificpsychic.com/etc/css-mouseover.html-->
<style type="text/css">
span.dropt 
	{
		border-bottom: thin dotted;
	}
span.dropt:hover 
	{
		text-decoration: none; background: #ffffff; z-index: 6; 
	}
span.dropt span 
	{
		position: absolute; left: -9999px;
		margin: 20px 0 0 0px; padding: 3px 3px 3px 3px;
		border-style:solid; border-color:black; border-width:1px; z-index: 6;
	}
span.dropt:hover span 
	{
		left: 2%; background: #ffffff;
		margin: 20px 0 0 170px; background: #ffffff; z-index:6;
	} 
</style>
	
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
	
<STYLE>
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation
			{
			background-color:#000000;
			text-align:center;
			vertical-align:center;
			text-decoration:none;
			color:#FFFFFF;
			font-weight:bold;
			}
	.TESTcpDayColumnHeader,
	.TESTcpYearNavigation,
	.TESTcpMonthNavigation,
	.TESTcpCurrentMonthDate,
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDate,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDate,
	.TESTcpCurrentDateDisabled,
	.TESTcpTodayText,
	.TESTcpTodayTextDisabled,
	.TESTcpText
			{
			font-family:arial;
			font-size:8pt;
			}
	TD.TESTcpDayColumnHeader
			{
			text-align:right;
			border:solid thin #6677DD;
			border-width:0 0 1 0;
			}
	.TESTcpCurrentMonthDate,
	.TESTcpOtherMonthDate,
	.TESTcpCurrentDate
			{
			text-align:right;
			text-decoration:none;
			}
	.TESTcpCurrentMonthDateDisabled,
	.TESTcpOtherMonthDateDisabled,
	.TESTcpCurrentDateDisabled
			{
			color:#D0D0D0;
			text-align:right;
			text-decoration:line-through;
			}
	.TESTcpCurrentMonthDate
			{
			color:#6677DD;
			font-weight:bold;
			}
	.TESTcpCurrentDate
			{
			color: #FFFFFF;
			font-weight:bold;
			}
	.TESTcpOtherMonthDate
			{
			color:#808080;
			}
	TD.TESTcpCurrentDate
			{
			color:#FFFFFF;
			background-color: #6677DD;
			border-width:1;
			border:solid thin #000000;
			}
	TD.TESTcpCurrentDateDisabled
			{
			border-width:1;
			border:solid thin #FFAAAA;
			}
	TD.TESTcpTodayText,
	TD.TESTcpTodayTextDisabled
			{
			border:solid thin #6677DD;
			border-width:1 0 0 0;
			}
	A.TESTcpTodayText,
	SPAN.TESTcpTodayTextDisabled
			{
			height:20px;
			}
	A.TESTcpTodayText
			{
			color:#6677DD;
			font-weight:bold;
			}
	SPAN.TESTcpTodayTextDisabled
			{
			color:#FFFFFF;
			}
	.TESTcpBorder
			{
			border:solid thin #000000;
			}
</STYLE>

<script>
		!window.jQuery && document.write('<script src="jquery.js"></script>');
</script>

<script type="text/javascript" src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="./fancybox/jquery.fancybox-1.3.4.css" media="screen" />


<script type="text/javascript">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/

			$("a#example1").fancybox();

			$("a#example2").fancybox({
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic'
			});

			$("a#example3").fancybox({
				'transitionIn'	: 'none',
				'transitionOut'	: 'none'	
			});

			$("a#example4").fancybox({
				'opacity'		: true,
				'overlayShow'	: false,
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'none'
			});

			$("a#example5").fancybox();

			$("a#example6").fancybox({
				'titlePosition'		: 'outside',
				'overlayColor'		: '#000',
				'overlayOpacity'	: 0.9
			});

			$("a#example7").fancybox({
				'titlePosition'	: 'inside'
			});

			$("a#example8").fancybox({
				'titlePosition'	: 'over'
			});

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

			/*
			*   Examples - various
			*/

			$("#various1").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

			$("#various2").fancybox();

			$("#various3").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("#various4").fancybox({
				'padding'			: 0,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
			
<?php

for ($X=0; $X<51; $X++)
	{	
		echo "$(\"#variousL".$X."\").fancybox({
				'width'				: '75%',
				'height'			: '90%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
				});"
			;}


		?>	
			
			
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

<script type="text/JavaScript" src="orderlist.js"></script>

<script>
<!--
// Auto Refresh 
//enter refresh time in "minutes:seconds" Minutes should range from 0 to inifinity. Seconds should range from 0 to 59
var limit="0:60"
if (document.images)
	{ 
		var parselimit=limit.split(":")
		parselimit=parselimit[0]*60+parselimit[1]*1
	}
function beginrefresh()
	{
		if (!document.images)
			return
		if (parselimit==1)
			window.location.reload()
		else
			{
				parselimit-=1
				curmin=Math.floor(parselimit/60)
				cursec=parselimit%60
				if (curmin!=0)
					curtime=curmin+" minutes and "+cursec+" seconds left until page refresh!"
				else
					curtime=cursec+" seconds left until page refresh!"
					window.status=curtime
					//setTimeout("beginrefresh()",1000)
					setTimeout("beginrefresh()",500)
			}
	}

window.onload=beginrefresh
//-->
</script>
<script type="text/javascript" language="javascript">
function doDelete(ORDERID) 
	{
		if (confirm("Do you really want to delete?")) 
			{
				var ORDERID;
				window.location.href ="deleteorder.php?ORDERID="+ORDERID;
			}
	}
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
				<td background="cornner/hm2.gif">Order</td>
				<td background="cornner/hm4.gif" width=1></td>
				<td background="cornner/hm2.gif">
				 <div class="jclock" style="float:left; margin:5px 10px;" ></div></td>
	            <td background="cornner/hm3.gif" width=30></td>
			</tr>
		</table>
	</div>
</div>
<br />
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#79acf3">
		<tr>
				<td align=center width=25%>Search Order Xray </td><td align=center width=25%>Option Search Today</td><td align=center width=25% >Department</td><td align=center width=25%>Select Date</td>
		</tr>

		<tr bgcolor="#f8d290"> 
			<td>
				<FORM method="post" action="order.php" name="searchpatient">
				<INPUT TYPE=hidden NAME="searchbox" value="1">
					<table>
						<tr><td>HN</td><td><input type="text" name="searchhn"></td><td>XN </td><td><input type="text" name="searchxn"> </td></tr>
						<tr><td>Name </td><td><input type="text" name="searchname"></td><td>Lastname </td><td><input type="text" name="searchlast"></td></tr>
					</table>
					<center><input type="submit" name="Submit4" value="Search"></center>
				</FORM>
			</td>
			
			<td align=center> 
				<FORM method="post" action="order.php" name="searchbyMo">
				<INPUT TYPE=hidden NAME="today" value="1">

				<table>
				<tr>
					<td><input type="checkbox" name=Mod_option1 value="CT" /><label for="demo_box_1" name="demo_lbl_1" class="css-label"> CT</label></td>
					<td><input type="checkbox" name=Mod_option2 value="MRI" /><label for="demo_box_1" name="demo_lbl_2" class="css-label"> MRI</label></td>
					<td><input type="checkbox" name=Mod_option3 value="XRAY" /><label for="demo_box_1" name="demo_lbl_3" class="css-label"> XRAY</label></td>
					<td><input type="checkbox" name=Mod_option4 value="MAMMO" /><label for="demo_box_1" name="demo_lbl_4" class="css-label"> MAMMO</label></td>
				</tr>
				<tr>
					<td><input type="checkbox" name=Mod_option5 value="US" /><label for="demo_box_1" name="demo_lbl_5" class="css-label"> U/S</label></td>
					<td><input type="checkbox" name=Mod_option6 value="ANGIO" /><label for="demo_box_1" name="demo_lbl_6" class="css-label"> FLU/IVP</label></td>
					<td><input type="checkbox" name=Mod_option7 value="BMD" /><label for="demo_box_1" name="demo_lbl_7" class="css-label"> BMD</label></td>
					<td><input type="checkbox" name=Mod_option8 value="PORTABLE" /><label for="demo_box_1" name="demo_lbl_8" class="css-label"> PORTABLE</label></td>
				</tr>
				</table>
				<input type="submit" name="Submit5" value="Search">
				</FORM>
				<!--<center><input type=button value="refresh" onClick="window.open('order.php','main')"></center>-->
			</td>
			<td><center>
			<input type="text" name="department" size=15>
			<input type="submit" name="submit_d" value="Search" >
			</center>
			</td>
			<td align=center> 
			
			
<FORM method="post" action="order.php" name="searchbydate"><INPUT TYPE=hidden NAME=searchdate value=1>

<input type="text" name="date001" id="date001" size="10" value="<?php echo $datestart; ?>"> 
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> 

<script type="text/javascript">  
$(function(){  
    var dateBefore=null;
    $("#date001").datepicker({  
        dateFormat: 'yy-mm-dd',  
        showOn: 'button',  
        buttonImage: 'icons/calendar-select.png',  
        buttonImageOnly: true,  
        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'Sa'],   
        monthNamesShort: ['January','February','March','April','May','June','July','August','September','October','November','December'],  
        changeMonth: true,  
        changeYear: true ,  
        beforeShow:function(){  

            if($(this).val()!=""){  
                var arrayDate=$(this).val().split("-");       
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])-543;  
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);  
  
        },  
        onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
        onClose:function(){  
            if($(this).val()!="" && $(this).val()==dateBefore){           
                var arrayDate=dateBefore.split("-");  
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])+543;  
			   $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }         
        },  
        onSelect: function(dateText, inst){   
            dateBefore=$(this).val();  
            var arrayDate=dateText.split("-");  
            arrayDate[2]=parseInt(arrayDate[2]);  
            //arrayDate[2]=parseInt(arrayDate[2])+543; 
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
        }  
  
    });  
      
});  
</script>  		
To 

<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#date002").datepicker({  
        dateFormat: 'yy-mm-dd',  
        showOn: 'button',  
        buttonImage: 'icons/calendar-select.png',  
        buttonImageOnly: true,  
        dayNamesMin: ['S', 'M', 'T', 'W', 'Th', 'F', 'Sa'],   
        monthNamesShort: ['January','February','March','April','May','June','July','August','September','October','November','December'],  
        changeMonth: true,  
        changeYear: true ,  
        beforeShow:function(){  
            if($(this).val()!=""){  
                var arrayDate=$(this).val().split("-");       
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])-543;  
				$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
            }  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);  
  
        },  
        onChangeMonthYear: function(){  
            setTimeout(function(){  
                $.each($(".ui-datepicker-year option"),function(j,k){  
                    var textYear=parseInt($(".ui-datepicker-year option").eq(j).val());  
                    //var textYear=parseInt($(".ui-datepicker-year option").eq(j).val())+543;  
					$(".ui-datepicker-year option").eq(j).text(textYear);  
                });               
            },50);        
        },  
        onClose:function(){  
            if($(this).val()!="" && $(this).val()==dateBefore){           
                var arrayDate=dateBefore.split("-");  
                arrayDate[2]=parseInt(arrayDate[2]);  
                //arrayDate[2]=parseInt(arrayDate[2])+543;  
			   $(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);      
            }         
        },  
        onSelect: function(dateText, inst){   
            dateBefore=$(this).val();  
            var arrayDate=dateText.split("-");  
            arrayDate[2]=parseInt(arrayDate[2]);  
            //arrayDate[2]=parseInt(arrayDate[2])+543; 
			$(this).val(arrayDate[0]+"-"+arrayDate[1]+"-"+arrayDate[2]);  
        }  
  
    });  
      
});  
</script>  		
			
			<input type="text" name="date002" id="date002" size=10 value=<?php echo $dateend; ?>> 
						<input type="submit" name="Submit6" value="Search">
					</FORM>			
				
					
				</p>
			</td>
	</tr>
 </table>

<?php
//echo "echo ".$center_code;
// For Multi site
//$sql = "SELECT xray_patient_info.MRN, xray_request_detail.ID  AS ORDERID,xray_request_detail.REQUEST_DATE AS REQ_DATE,xray_request_detail.REQUEST_TIME AS REQ_TIME, xray_request.REQUEST_NO, xray_request_detail.REQUEST_NO AS REQNUMBER, xray_request_detail.ACCESSION, xray_request_detail.XRAY_CODE AS XRAY_CODE,xray_request_detail.STATUS, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_code.DESCRIPTION, xray_referrer.NAME, xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO AND xray_request.CENTER_CODE = '$center_code') INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request_detail.PAGE = 'ORDER LIST') order by ORDERTIME desc";

//$sql = "SELECT xray_patient_info.MRN, xray_patient_info.CENTER_CODE, xray_request_detail.ID  AS ORDERID, xray_request_detail.REQUEST_DATE AS REQ_DATE, xray_request_detail.REQUEST_TIME AS REQ_TIME, xray_request.REQUEST_NO, xray_request_detail.REQUEST_NO AS REQNUMBER, xray_request_detail.ACCESSION, xray_request_detail.XRAY_CODE AS XRAY_CODE,xray_request_detail.STATUS, xray_request_detail.URGENT, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_patient_info.NAME_ENG AS NAMEENG, xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, xray_patient_info.BIRTH_DATE, xray_code.DESCRIPTION, xray_referrer.NAME, xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request_detail.PAGE = 'ORDER LIST')  and (xray_request_detail.STATUS != 'CANCEL') and (xray_patient_info.CENTER_CODE ='$center_code')order by URGENT desc, ORDERTIME ASC";

// This for Query default date = DATE(NOW())
$yesterday = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-30,date("Y")));
$sql= "
SELECT 
xray_patient_info.MRN, 
xray_patient_info.CENTER_CODE, 
xray_patient_info.NAME AS PTNAME, 
xray_patient_info.LASTNAME AS PTLASTNAME, 
xray_patient_info.NAME_ENG AS NAMEENG, 
xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
xray_patient_info.BIRTH_DATE, 
xray_patient_info.SEX,
xray_request.REQUEST_NO AS req_no, 
xray_request_detail.ID AS ORDERID, 
xray_request_detail.REQUEST_DATE AS REQ_DATE, 
xray_request_detail.REQUEST_TIME AS REQ_TIME, 
xray_request_detail.REQUEST_NO AS REQNUMBER, 
xray_request_detail.REQUEST_DATE,
xray_request_detail.ACCESSION, 
xray_request_detail.XRAY_CODE AS XRAY_CODE, 
xray_request_detail.STATUS, 
xray_request_detail.URGENT, 
xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME, 
xray_code.XRAY_TYPE_CODE,
xray_code.DESCRIPTION,
xray_department.NAME_THAI AS DEP,
xray_referrer.NAME, 
xray_referrer.LASTNAME 
FROM xray_request 
LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
WHERE 
xray_request.CENTER_CODE ='$center_code' AND
(xray_request_detail.REQUEST_DATE = DATE(NOW()) OR xray_request_detail.REQUEST_DATE = '$yesterday') AND
xray_request_detail.PAGE = 'ORDER LIST' AND 
xray_request_detail.STATUS != 'CANCEL' AND 
xray_patient_info.CENTER_CODE ='$center_code' AND 
xray_department.CENTER ='$center_code' 
order by URGENT desc, ACCESSION ASC, ORDERTIME ASC ";

//AND (xray_code.CENTER ='$usercenter')

if ($searchbox =='1') // $searchhn; $searchxn; $searchname; $searchlast;
	{
	if (($searchhn =='') AND ($searchxm =='') AND ($searchname =='') AND ($searchlast ==''))
		{
			echo "Please search some keyword before click search";
			exit;
		}
		$sql = "SELECT 
					xray_patient_info.MRN, 
					xray_patient_info.CENTER_CODE, 
					xray_patient_info.NAME AS PTNAME, 
					xray_patient_info.LASTNAME  AS PTLASTNAME, 
					xray_patient_info.NAME_ENG AS NAMEENG, 
					xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 	
					xray_patient_info.BIRTH_DATE, 	
					xray_patient_info.SEX,					
					xray_request.REQUEST_NO, 					
					xray_request_detail.ID  AS ORDERID,
					xray_request_detail.REQUEST_DATE AS REQ_DATE,
					xray_request_detail.REQUEST_TIME AS REQ_TIME, 
					xray_request_detail.REQUEST_NO AS REQNUMBER, 
					xray_request_detail.REQUEST_DATE,
					xray_request_detail.ACCESSION, 
					xray_request_detail.XRAY_CODE AS XRAY_CODE,
					xray_request_detail.STATUS, 
					xray_request_detail.URGENT, 
					xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,			
					xray_code.XRAY_TYPE_CODE,
					xray_code.DESCRIPTION, 
					xray_department.NAME_THAI AS DEP,
					xray_referrer.NAME, 
					xray_referrer.LASTNAME
					FROM xray_request 
					LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
					LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
					LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
					LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
					LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
					LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
					WHERE 
					(xray_request_detail.PAGE = 'ORDER LIST') 
					AND(xray_request_detail.STATUS != 'CANCEL') 
					AND (xray_patient_info.CENTER_CODE ='$center_code') 
					AND (xray_patient_info.MRN like '%$searchhn%') 
					AND (xray_patient_info.XN like '%$searchxn%') 
					AND (xray_patient_info.NAME like '%$searchname%') 
					AND (xray_patient_info.LASTNAME like '%$searchlast%')
					AND (xray_department.CENTER ='$center_code')
					order by URGENT desc, ORDERTIME ASC
					LIMIT 0 , 50 ";
	}

if ($searchdate =='1')
	{
		$datestart = Date2MySQL($datestart);
		$dateend = Date2MySQL($dateend);
		$sql = "SELECT 
					xray_patient_info.MRN, 
					xray_patient_info.CENTER_CODE, 
					xray_patient_info.NAME AS PTNAME, 
					xray_patient_info.LASTNAME  AS PTLASTNAME, 
					xray_patient_info.NAME_ENG AS NAMEENG, 
					xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 	
					xray_patient_info.BIRTH_DATE, 		
					xray_patient_info.SEX,
					xray_request.REQUEST_NO, 					
					xray_request_detail.ID  AS ORDERID,
					xray_request_detail.REQUEST_DATE AS REQ_DATE,
					xray_request_detail.REQUEST_TIME AS REQ_TIME, 
					xray_request_detail.REQUEST_NO AS REQNUMBER, 
					xray_request_detail.REQUEST_DATE,
					xray_request_detail.ACCESSION, 
					xray_request_detail.XRAY_CODE AS XRAY_CODE,
					xray_request_detail.STATUS, 
					xray_request_detail.URGENT, 
					xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME,			
					xray_code.XRAY_TYPE_CODE,
					xray_code.DESCRIPTION, 
					xray_department.NAME_THAI AS DEP,
					xray_referrer.NAME, 
					xray_referrer.LASTNAME
					FROM  xray_request 
					LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
					LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
					LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
					LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
					LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
					LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
					WHERE 
					(xray_request_detail.PAGE = 'ORDER LIST')
					AND (xray_request_detail.REQUEST_DATE between '$datestart' and '$dateend')  
					AND (xray_request_detail.STATUS != 'CANCEL') 
					AND (xray_patient_info.CENTER_CODE ='$center_code')
					AND (xray_department.CENTER ='$center_code')
					ORDER BY URGENT desc, ORDERTIME ASC ";
	}
	
if ($searchtoday =='1')
	{
		$sql = "SELECT 
					xray_patient_info.MRN, 
					xray_request_detail.ID  AS ORDERID,
					xray_request_detail.REQUEST_DATE AS REQ_DATE,
					xray_request_detail.REQUEST_TIME AS REQ_TIME, 
					xray_request.REQUEST_NO, 
					xray_request_detail.REQUEST_NO AS REQNUMBER, 
					xray_request_detail.ACCESSION, 
					xray_request_detail.XRAY_CODE AS XRAY_CODE,
					xray_request_detail.STATUS, 
					xray_request_detail.URGENT, 
					xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, 
					xray_patient_info.NAME_ENG AS NAMEENG, 
					xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
					xray_patient_info.SEX,
					xray_code.XRAY_TYPE_CODE,
					xray_code.DESCRIPTION, 
					xray_department.NAME_THAI AS DEP,
					xray_referrer.NAME, 
					xray_referrer.LASTNAME, 
					xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME 
					FROM  xray_request 
					LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
					LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
					LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
					LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
					LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
					LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
					WHERE xray_request_detail.PAGE = 'ORDER LIST'
					AND (xray_code.XRAY_TYPE_CODE = '$mod1' 	
					OR xray_code.XRAY_TYPE_CODE = '$mod2'
					OR xray_code.XRAY_TYPE_CODE = '$mod3'
					OR xray_code.XRAY_TYPE_CODE = '$mod4'
					OR xray_code.XRAY_TYPE_CODE = '$mod5'
					OR xray_code.XRAY_TYPE_CODE = '$mod6'
					OR xray_code.XRAY_TYPE_CODE = '$mod7')
					AND xray_request_detail.REQUEST_DATE = DATE(NOW()) 
					AND (xray_request_detail.STATUS != 'CANCEL') 
					AND (xray_patient_info.CENTER_CODE ='$center_code')
					AND (xray_department.CENTER ='$center_code')
					ORDER BY URGENT desc, ORDERTIME ASC ";
	}
	if ($mod8 == 'PORTABLE') // Search for Portable
		{
			$sql = "SELECT 
					xray_patient_info.MRN, 
					xray_request_detail.ID  AS ORDERID,
					xray_request_detail.REQUEST_DATE AS REQ_DATE,
					xray_request_detail.REQUEST_TIME AS REQ_TIME, 
					xray_request.REQUEST_NO, 
					xray_request_detail.REQUEST_NO AS REQNUMBER, 
					xray_request_detail.ACCESSION, 
					xray_request_detail.XRAY_CODE AS XRAY_CODE,
					xray_request_detail.STATUS, 
					xray_request_detail.URGENT, 
					xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, 
					xray_patient_info.NAME_ENG AS NAMEENG, 
					xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
					xray_patient_info.SEX,
					xray_code.XRAY_TYPE_CODE,
					xray_code.DESCRIPTION, 
					xray_department.NAME_THAI AS DEP,
					xray_referrer.NAME, 
					xray_referrer.LASTNAME, 
					xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME 
					FROM  xray_request 
					LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
					LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
					LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
					LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
					LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
					LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
					WHERE xray_request_detail.PAGE = 'ORDER LIST'
					AND xray_code.DESCRIPTION like  '%$mod8%'
					AND xray_request_detail.REQUEST_DATE = DATE(NOW()) 
					AND (xray_request_detail.STATUS != 'CANCEL') 
					AND (xray_patient_info.CENTER_CODE ='$center_code')
					AND (xray_department.CENTER ='$center_code')
					ORDER BY URGENT desc, ORDERTIME ASC ";	
		
		}

//AND (xray_code.XRAY_TYPE_CODE = '$todaytype' OR xray_code.XRAY_TYPE_CODE ='$mod1')
 
	
if ($todaytype =='ALL')
	{
		$sql = "SELECT 
					xray_patient_info.MRN, 
					xray_request_detail.ID  AS ORDERID,
					xray_request_detail.REQUEST_DATE AS REQ_DATE,
					xray_request_detail.REQUEST_TIME AS REQ_TIME, 
					xray_request.REQUEST_NO, 
					xray_request_detail.REQUEST_NO AS REQNUMBER, 
					xray_request_detail.ACCESSION, 
					xray_request_detail.XRAY_CODE AS XRAY_CODE,
					xray_request_detail.STATUS, 
					xray_request_detail.URGENT, 
					xray_patient_info.NAME AS PTNAME, 
					xray_patient_info.LASTNAME  AS PTLASTNAME, 
					xray_patient_info.NAME_ENG AS NAMEENG, 
					xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, 
					xray_patient_info.SEX,
					xray_code.XRAY_TYPE_CODE,
					xray_code.DESCRIPTION, 
					xray_department.NAME_THAI AS DEP,
					xray_referrer.NAME, 
					xray_referrer.LASTNAME, 
					xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME 
					FROM  xray_request 
					LEFT JOIN xray_request_detail ON xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO 
					LEFT JOIN xray_user ON xray_user.CODE = xray_request.USER 
					LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
					LEFT JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID 
					LEFT JOIN xray_referrer ON xray_referrer.REFERRER_ID = xray_request.REFERRER 
					LEFT JOIN xray_code ON xray_code.XRAY_CODE = xray_request_detail.XRAY_CODE 
					WHERE (xray_request_detail.PAGE = 'ORDER LIST') 
					AND (xray_request_detail.STATUS != 'CANCEL') 
					AND (xray_patient_info.CENTER_CODE ='$center_code')
					AND (xray_department.CENTER ='$center_code')					
					ORDER BY URGENT desc, ORDERTIME ASC ";
	}

//echo $sql;	
$result = mysql_query($sql);
$total = mysql_num_rows($result);
$e_page = 500; // Items per page
if(!isset($_GET['s_page']))
	{     
		$_GET['s_page']=0;     
	}
else
	{     
		$chk_page= isset($_GET['s_page']);       
		$_GET['s_page']= isset($_GET['s_page'])*$e_page;     
	}     
$sql.=" LIMIT ".$_GET['s_page'].",$e_page";  
//$result=mysql_query($sql);  
if(mysql_num_rows($result)>=1)
	{     
		$plus_p= (isset($chk_page)*$e_page)+mysql_num_rows($result);     
	}
else
	{     
		$plus_p=(isset($chk_page)*$e_page);         
	}     
$total_p=ceil($total/$e_page);     
$before_p=(isset($chk_page)*$e_page)+1;  

echo "<table border='0' cellspacing='0' bgcolor='#79acf3' width=100%>
<tr>
<th><font color=#000000>ICON</font></th>
<th><font color=#000000>MRN (HN)</font></th>
<th><font color=#000000>ACC</font></th>
<th><font color=#000000>Patient</font></th>
<th><font cololr=#000000>Sex</font></th>
<th>Type</th>
<th><font color=#000000>Procedure</font></th>
<th><font color=#000000>Physician</font></th>
<th><font color=#000000>Order Time</font></th>
<th>Status</th>
</tr>\n";

$bg ="#FFCCCC";
$count = 0;
while($row = mysql_fetch_array($result))
  {
		if($bg == "#FFFFFF") 
			{ 
				$bg = "#C8C8C8";
			} 
		else 
			{
				$bg = "#FFFFFF";
			}
		$count = $count+1;
		echo "<tr bgcolor=$bg onMouseOver=this.bgColor='gold'; onMouseOut=this.bgColor='".$bg."';>";
		echo "<td>";
		$URGENT = $row['URGENT'];
		if ($URGENT == 1) 
			{
				$ALERT = "<img src=./icon/urgent.jpg> <img src=icons/notebook--exclamation.png>";
			}
		if ($URGENT == 0 ) 
			{
				$ALERT = "";
			}
		echo $ALERT;
		echo "</td>";
		
 		echo "<td><span class=\"dropt\" title=\"\">" .$row['MRN'];
		echo "<span style=\"width:100px;\"><img src=icons/alarm-clock.png><br />Time = ?!?</span></span></td>";
		echo "<td><a id='variousL".$count."' href=order-info.php?MRN=".$row['MRN']."&ACCESSION=".$row['ACCESSION']."&XRAYCODE=".$row['XRAY_CODE']."><img border=0 src=./icon-info.png></a> ".$row['ACCESSION']."</td>";
		echo "<td><a id='various4' href=patient-info.php?MRN=".$row['MRN'].">";
		if ($row['SEX'] == 'M')
		{
			echo "<img border=0 src=./icons/user-green.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
		}
		
		if ($row['SEX'] == 'F')
		{
			echo "<img border=0 src=./icons/user-female.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
		}
		if ($row['SEX'] == 'O')
		{
			echo "<img border=0 src=./icons/users.png></a> ".$row['PTNAME']."   ".$row['PTLASTNAME'];
		}
				
		
		if ($row['NAMEENG'] == $row['MRN'] or $row['LASTNAMEENG'] == $row['MRN'] or $row['NAMEENG'] =='' or $row['LASTNAMEENG'] =='')
			{
				//echo "<font color=red> No Eng</font>";
			}
		$birthday = $row['BIRTH_DATE'];
		echo "<font color=gray size=-2>".AgeCal($birthday)."</font>";
		echo "</td>";
		//echo "<td></td>";
		echo "<td><center>".$row['SEX']."</center></td>";
		echo "<td>".$row['XRAY_TYPE_CODE']."</td>";
		echo "<td>".$row['DESCRIPTION']."</td>";
		echo "<td>".$row['NAME']." ".$row['LASTNAME']."<br /><font color=green><img src=arrow.gif>".$row['DEP'];
		echo "</font></td>";

		echo "<td>".EngEachDate($row['REQ_DATE'])." ".$row['REQ_TIME']."</td>";
		//echo "<td><a href=print-request.php?REQUEST_NO=".$row[REQNUMBER]." target=_blank><img src=icon/printer.gif border='0'></a>";
		//echo<img src=./image/bin.png border=0 onclick=\"doDelete(".$row[ORDERID].")\" /> <a href='#'><img src=./image/upload.png border=0 onClick=\"window.open('upload.php?MRN=".$row[MRN]."&ACCESSION=".$row[ACCESSION]."','mywindow3','scrollbars=yes,resizable=yes,width=750,height=600')\"></a>";
		//echo "<a href='#'><img src=./image/needle.gif border=0 onClick=\"window.open('stockuse.php?MRN=".$row[MRN]."&ACCESSION=".$row[ACCESSION]."','mywindow3','scrollbars=yes,resizable=yes,width=750,height=600')\"></a>";
		
		echo "<td></td>";
		if ($row['STATUS']=='ARRIVAL')
			{
				echo "<td><div id='".$row['ORDERID']."'><input type=button name=Start value=READY onclick=pt_arrive(".$row['ORDERID'].",'READY')>".$TYPE."</div></td>";
			}
		if ($row['STATUS']=='NEW')
			{
				//else {
				//echo "<td><div id='".$row[ORDERID]."'><a href=schedule.php?ACCESSION=".$row[ACCESSION]."><img src=./image/sc.gif border=0></a><input type=button value=Arrive onclick=pt_arrive('".$row[ORDERID]."','ARRIVAL')></div></td>";
				echo "<td><div id='".$row['ORDERID']."'><input type=button value=Arrive onclick=pt_arrive('".$row['ORDERID']."','ARRIVAL')></div></td>";
			}
		if ($row['STATUS']=='READY')
			{
				echo "<td></td>";
			}
		echo "</tr>\n";	
	}
  
echo "<tr><th colspan=9 align=right>";
//echo "Total =".$count;
echo "<div class=\"browse_page\">";  

if ($total > $e_page)
	{
		page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);     
	}
echo "Total =".$total;	
echo "</div>";
echo "</th></tr></table>";

//echo $datestart.$dateend;
//echo "lllll=".$searchdate;
//$resultdate = mysql_query("select curdate()");
//$rowdate=mysql_fetch_array($resultdate);
//$today = $rowdate[0];
//echo $mod1.$mod2.$mod3.$mod4.$mod5.$mod6.$mod7.$mod8;
//echo "<br>Today : ".$today;
//echo "<br>Todaysearch = ".$searchtoday.$todaytype;
//echo "<br> Center Code....".$center_code.$usercenter ;
//$yesterday = date("Y-m-d",mktime(0, 0, 0, date("m"), date("d")-1,date("Y")));
echo "Yesterday =".$yesterday;
?>
<script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
<script language=JavaScript src="mmenu.js" type=text/javascript></script> 
<script language=javascript>
document.searchpatient.searchhn.focus();
</script>
</body>