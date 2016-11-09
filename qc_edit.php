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
include "session.php";
include "connectdb.php";
echo "<script type=\"text/JavaScript\" src=\"examroom-examlist.js\"></script>";
$ACCESSION = $_GET['ACCESSION'];
$ORDERID = $_GET['ORDERID'];
$MRN = $_GET['MRN'];



?>
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.7.2.custom.css">  
<style type="text/css">  
/* Overide css code*/  
.ui-datepicker{  
    width:170px;  
    font-family:tahoma;  
    font-size:11px;  
    text-align:center;  
}  
</style> 

<script language="javascript">
function fncSubmit()
	{
		if(document.qc.tech1.value == "")
			{
				alert('Please input Input Technician');
				document.qc.tech1.focus();
				return false;
			}  
		if(document.qc.tech1.value == document.qc.tech2.value )
			{
				alert('Please input Input  New Technician2');
				document.qc.tech2.focus();
				return false;
			}  
		if(document.qc.tech1.value !=="" && document.qc.tech2.value == "" && document.qc.tech3.value !== "")
			{
				alert('Please input Input  New Technician2 before Technician3');
				document.qc.tech2.focus();
				return false;
			}
		if(document.qc.tech1.value == document.qc.tech3.value )
			{
				alert('Please input Input  New Technician3');
				document.qc.tech3.focus();
				return false;
			}  			
		if(document.qc.tech2.value !=="" && document.qc.tech2.value == document.qc.tech3.value )
			{
				alert('Please input Input  New Technician3');
				document.qc.tech3.focus();
				return false;
			}  	

		
		if(document.qc.radio0.checked == false && document.qc.radio1.checked == false && document.qc.radio2.checked == false && document.qc.radio3.checked  == false)
			{
				alert('Please input Input Time for Report');
				document.qc.radio1.focus();
				return false;
			} 
		if(document.qc.radio3.checked == true && document.qc.dateInput.value =="")
			{
				alert('Please input Input DD/MM/YYYY');
				document.qc.dateInput.focus();       
				return false;
			}  
			if(document.qc.selectrad.value == "")
			{
				alert('Please input Input Radiologist');
				document.qc.selectrad.focus();       
				return false;
			}  
		document.qc.submit();
	}
	
</script>

<?php


$sql = "SELECT TECH1, TECH2, TECH3, FLAG1, FLAG2, FLAG3 FROM xray_request_deatil WHERE ID = $ORDERID";
$result1 = mysql_query($sql);
while ($row =mysql_fetch_array($result1))
	{

	if ($row[TECH1] !== '')
		{
			$TECH1 = $row[TECH1];
		}
	
	if ($row[TECH2] !== '')
		{
			$TECH2 = $row[TECH2];
		}

	if ($row[TECH3] !== '')
		{
			$TECH3 = $row[TECH3];
		}	
	}
echo $TECH1;
echo $TECH2;
echo $TECH3;

echo "<body bgcolor=#E8E8E8 >";
echo "<center><table bgcolor=#F0F0F0 ><tr><td>";
				echo "<form name=qc action=examroom-assignradQC.php onSubmit=\"JavaScript:return fncSubmit();\">";
				echo "<INPUT TYPE=hidden NAME=\"ORDERID\" value=".$ORDERID.">";
				echo "<u><font color=green><b>QC : บันทึกการตรวจรังสี </b></font></u><br/>";
				echo "HN = ".$MRN."<br />";
				echo "ACCESSION=".$ACCESSION."<br /><br />";
				//echo "ORDER_ID=".$ORDERID."<br /><br />";
				
				echo "<u><font color=blue>Technician </font></u><br />";
		
				$sql = "SELECT ID, NAME FROM xray_user WHERE USER_TYPE_CODE='TECHNICIAN' AND ENABLE ='1' ORDER BY CODE asc";
				$result1 = mysql_query($sql);
				$result2 = mysql_query($sql);
				$result3 = mysql_query($sql);
				echo "1. <INPUT TYPE=hidden NAME=\"radiograper\" value=\"1\">
						 <select name=\"tech1\">";
				echo "<option value=''>Please Select Technician 1</option>";
				while($row = mysql_fetch_array($result1))
					{
						echo "<option value=\"".$row[ID]."\">".$row[NAME]."</option>";
					}
				echo "</select><br />";
				
				echo "2. <INPUT TYPE=hidden NAME=\"radiograper\" value=\"1\">
						 <select name=\"tech2\">";
				echo "<option value=''>Please Select Technician 2</option>";
				while($row = mysql_fetch_array($result2))
					{
						echo "<option value=\"".$row[ID]."\">".$row[NAME]."</option>";
					}
				echo "</select><br />";

				echo "3. <INPUT TYPE=hidden NAME=\"radiograper3\" value=\"1\">
						 <select name=\"tech3\">";
				echo "<option value=''>Please Select Technician 3</option>";
				while($row = mysql_fetch_array($result3))
					{
						echo "<option value=\"".$row[ID]."\">".$row[NAME]."</option>";
					}
				echo "</select><br />";				

				//echo "Repeating Xray<br />";
				//echo "<select name='repeating'>";
				//echo "<option value=''>Over Exposure</option>";
				//echo "<option value=''>Under Exposure</option>";				
				//echo "<option value=''>Patient Movment</option>";				
				//echo "<option value=''>Artifact</option>";
				//echo "<option value=''>Scater Ray</option>";
				echo "</select><br />";
				echo "<u><font color=blue>ความเร่งด่วน </font></u><br />";
				
				

				echo "<input type=radio name=readtime id=radio1 value=1>อ่านผลทันที<br />";
				echo "<input type=radio name=readtime id=radio2 value=2>หนึ่งวันทำการ<br />";
				/////////////////////////////////////////// Auto select  radiologist (no)///////////////////////////////////////
				echo "<input type=radio name=\"readtime\" id=radio0 value='' onClick=\"javaScript:if(this.checked) { document.getElementById('selectrad').getElementsByTagName('option')[3].selected = 'selected'; }\">แพทย์ผู้ส่งอ่านผลเอง<br />";
				////////////////////////////////
				echo "<input type=radio name=readtime id=radio3 value=3>ระบุวัน";
			
				
?>

<input type="text" name="dateInput" id="dateInput" /> 
  
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> 
<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#dateInput").datepicker({  
        dateFormat: 'dd-mm-yy',  
        showOn: 'button',  
        buttonImage: 'image/calandar.jpg',  
        buttonImageOnly: true,  
        dayNamesMin: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],   
        monthNamesShort: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],  
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
<br />
<input type=checkbox name="flag02" value="1"> ผู้ป่วยคดีความ <br />
<br />
<u><font color=blue>Assign Radiologist </font></u><br />
<?php				

			$sql2 ="select * FROM xray_user  WHERE USER_TYPE_CODE ='RADIOLOGIST' AND CENTER_CODE='$center_code' order by ID";
			$result2 = mysql_query($sql2);
			//echo "<div id='".$ORDERID."'>\n";
			//echo "<select name=selectrad id=selectrad".$ORDERID.">";
			echo "<select name=selectrad id=selectrad>";
			echo "<option value=''>Select Radiologist</option>\n";
			while ($row =mysql_fetch_array($result2))
				{
					echo "<option name=radid value=\"".$row[CODE]."\">".$row[NAME]."  ".$row[LASTNAME]."</option>\n";
				}
				echo "</select>";
				//echo "<input type=button name=Start value=Submit onclick=assignradQC('".$ORDERID."','ASSIGN')></div>";

				//echo "<a href=\"#close\"><input type=button name=Submit value=Completed onclick=pt_qc('".$ORDERID."','ENDEXAM')></a>";
				//echo "<input type=button value=Submit>";
				//echo "<a href=\"#close\"><input type=button name=Start value=Completed onclick=pt_qc('".$ORDERID."','ENDEXAM')></a>";
				//echo "<a href=\"#close\"><input type=button name=Cancel value=Cancel></a>";
echo "</td>";
echo "<td valign=top>";
echo "<u><font color=blue>Exam Note</font></u><br />";
echo "<textarea name=examnote rows=\"20\" cols=\"20\"></textarea>";
echo "</td></tr></table></center>";
echo "<center><input type=submit value=Submit></center>";
echo "</form>";				
?>				
<br />
<br />
<center><a href="javascript:parent.jQuery.fancybox.close();"><input type=button value=Cancle></a></center>

</body>




