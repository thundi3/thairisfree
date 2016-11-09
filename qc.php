<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 24 FEB 2015
# File name: qc.php
# Description :  Show qc screen
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
include "session.php";
include "connectdb.php";
header("Content-type: text/html;  charset=utf-8");
echo "<script type=\"text/JavaScript\" src=\"examroom-examlist.js\"></script>";
$ACCESSION = $_GET['ACCESSION'];
$ORDERID = $_GET['ORDERID'];
$MRN = $_GET['MRN'];

?>
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
	<script type="text/javascript" src="document-uploads/js/jquery.7.1.min.js"></script>
	<script type="text/javascript" src="document-uploads/js/jquery.form.js"></script>
	<script type="text/javascript" src="document-uploads/js/script.js"></script>
	<style>

	body{
		background: #E7EDEE;
		width: 100%;
		margin: 0;
		padding: 0;
	}
	.wrap{
		width: 700px;
		margin: 10px auto;
		padding: 10px 15px;
		background: white;
		border: 2px solid #DBDBDB;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		text-align: center;
		overflow: hidden;
	}
	#preview {
		color: red;
	}
	#preview img{
		margin-top: 30px;
		max-width: 100%;
		border: 0;
		border-radius: 3px;
		-webkit-box-shadow: 0px 2px 7px 0px rgba(0, 0, 0, .27);
		box-shadow: 0px 2px 7px 0px rgba(0, 0, 0, .27);
		overflow: hidden;
	}
	input[type="submit"]{
		border-radius: 10px;
		background-color: #61B3DE;
		border: 0;
		color: white;
		font-weight: bold;
		font-style: italic;
		padding: 6px 15px 5px;
		cursor: pointer;
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
		if(document.qc.radio0.checked == false && document.qc.radio1.checked == false && document.qc.radio2.checked == false && document.qc.radio3.checked  == false && document.qc.radio4.checked  == false && document.qc.radio5.checked  == false)
			{
				alert('Please input Input Time for Report');
				document.qc.radio1.focus();
				return false;
			} 
		if(document.qc.radio5.checked == true && document.qc.dateInput.value =="")
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
$sql0 = "select MRN, NAME, LASTNAME, SEX, BIRTH_DATE FROM xray_patient_info WHERE MRN='$MRN'";
$result0 = mysql_query($sql0);
$row0 = mysql_fetch_array($result0);
$ptname = $row0['NAME'];
$ptlastname = $row0['LASTNAME'];
$ptsex = $row0['SEX'];

$sql01 = "SELECT xray_code.XRAY_CODE, xray_code.DESCRIPTION 
			FROM xray_code 
			INNER JOIN xray_request_detail ON xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE
			WHERE xray_request_detail.ACCESSION = '$ACCESSION'";
			
$result01 = mysql_query($sql01);
$row01 = mysql_fetch_array($result01);		
$procedure = $row01['DESCRIPTION'];

echo "<body bgcolor=#E8E8E8 >";
echo "<center><table bgcolor=#F0F0F0 ><tr><td>";
				echo "<form name=qc action=examroom-assignradQC.php onSubmit=\"JavaScript:return fncSubmit();\">";
				echo "<INPUT TYPE=hidden NAME=\"ORDERID\" value=".$ORDERID.">";
				echo "<u><font color=green><b>QC : Record data</b></font></u><br/>";
				echo "<table width=100%>";
				echo "<tr><td bgcolor=#FFFFFF><img src=icons/man.png valign=top></td>";
				echo "<td valign=top width=90%  bgcolor=#FCEBB5>";
				echo "Name : ".$ptname." ".$ptlastname."<br />";
				echo "MRN  : ".$MRN."<br />";
				echo "Sex  : ".$ptsex."<br />";
				echo "</td></tr></table>";
				echo "<table width=100% bgcolor=#E0F8F7><tr><td>";
				echo "<font color=#0E60F9><u><b>Accession</b></u></font> : ".$ACCESSION."<br />";
				echo "<font color=#0E60F9><u><b>Procedure</b></u></font> : ".$procedure."<br /><br />";
				echo "</td></tr></table>";
				
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
						echo "<option value=\"".$row['ID']."\">".$row['NAME']."</option>";
					}
				echo "</select><br />";
				
				echo "2. <INPUT TYPE=hidden NAME=\"radiograper\" value=\"1\">
						 <select name=\"tech2\">";
				echo "<option value=''>Please Select Technician 2</option>";
				while($row = mysql_fetch_array($result2))
					{
						echo "<option value=\"".$row['ID']."\">".$row['NAME']."</option>";
					}
				echo "</select><br />";

				echo "3. <INPUT TYPE=hidden NAME=\"radiograper3\" value=\"1\">
						 <select name=\"tech3\">";
				echo "<option value=''>Please Select Technician 3</option>";
				while($row = mysql_fetch_array($result3))
					{
						echo "<option value=\"".$row['ID']."\">".$row['NAME']."</option>";
					}
				echo "</select><br />";				


				
				$d=strtotime("tomorrow");
				echo "</select><br />";
				echo "<u><font color=blue>Priority Reporting</font></u><br />";
				echo "<input type=radio name=readtime id=radio1 value=1>Urgent<br />";
				echo "<input type=radio name=readtime id=radio2 value=2>One day ".date("d-m-Y")."<br />";
				echo "<input type=radio name=readtime id=radio3 value=3>Two day ".date("d-m-Y", $d)."<br />";
				echo "<input type=radio name=readtime id=radio4 value=4>One Week<br />";
				/////////////////////////////////////////// Auto select  radiologist (no)///////////////////////////////////////
				echo "<input type=radio name=\"readtime\" id=radio0 value='' onClick=\"javaScript:if(this.checked) { document.getElementById('selectrad').getElementsByTagName('option')[2].selected = 'selected'; }\">No Report<br />";
				////////////////////////////////
				echo "<input type=radio name=readtime id=radio5 value=5>Schedule";
			
				
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
<br />
<u><font color=blue>Option Note </font></u><br />
<input type=checkbox name="flag02" value="1"> VIP <br />
<br />
<u><font color=blue>Assign Radiologist </font></u><br />
<?php				

			$sql2 ="select * FROM xray_user  WHERE USER_TYPE_CODE ='RADIOLOGIST' AND CENTER_CODE='$center_code' order by ID";
			$result2 = mysql_query($sql2);
			//echo "<div id='".$ORDERID."'>\n";
			//echo "<select name=selectrad id=selectrad".$ORDERID.">";
			echo "<select name=selectrad id=selectrad>\n";
			echo "<option value=''>Select Radiologist</option>\n";
			while ($row =mysql_fetch_array($result2))
				{
					echo "<option name=radid value=\"".$row['CODE']."\">".$row['NAME']."  ".$row['LASTNAME']."</option>\n";
				}
				echo "</select>\n";
				//echo "<input type=button name=Start value=Submit onclick=assignradQC('".$ORDERID."','ASSIGN')></div>";

				//echo "<a href=\"#close\"><input type=button name=Submit value=Completed onclick=pt_qc('".$ORDERID."','ENDEXAM')></a>";
				//echo "<input type=button value=Submit>";
				//echo "<a href=\"#close\"><input type=button name=Start value=Completed onclick=pt_qc('".$ORDERID."','ENDEXAM')></a>";
				//echo "<a href=\"#close\"><input type=button name=Cancel value=Cancel></a>";
echo "</td>\n";
echo "<td valign=top>";
echo "<u><font color=blue>Exam Note</font></u><br />";
echo "<textarea name=examnote rows=\"15\" cols=\"20\">";
$sql = "select NOTE from xray_request WHERE ID = '$ORDERID'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
echo $row[0];
echo "</textarea>";
echo "<br /><br /><br /><br />";
echo "<br /><br />";
//echo "<span style='position:absolute; bottom:0px;'>";
echo "<center><input type=submit value=Submit> <a href=\"javascript:parent.jQuery.fancybox.close();\"><input type=submit value=Cancel></a></center>";
//echo "</span>";
echo "</form>";		

echo "</td><td valign=top>";
echo "<u><font color=blue>Document Scan Upload</font></u><br />";
$path = "document-uploads/uploads/".$ACCESSION."/";

if (!file_exists($path)) 
	{
		echo "<img src=arrow.gif> No File scan";
	}

if (file_exists($path)) 

	{
		$string =array();
		$filePath=$path;  
		$dir = opendir($filePath);
		while ($file = readdir($dir)) 
			{ 
				if (eregi("\.png",$file) || eregi("\.jpg",$file) || eregi("\.gif",$file) ) 
					{ 
						$string[] = $file;
					}
			}
		while (sizeof($string) != 0)
			{
				$img = array_pop($string);
				echo "<a  class=\"fancybox fancybox.iframe\" href='$filePath$img'><img src='$filePath$img'   style=\"border:1px outset silver;\" height=45></a> ";
				//echo "<a  class=\"fancybox fancybox.iframe\" href='$filePath$img'><img src='$filePath$img'   style=\"border:1px solid black;\" height=45></a> ";
			}
		
	}
echo "<p>File Type: jpeg, gif, png <br />Max size: 1024kb</p>";
echo "<!-- loader.gif -->";
echo "<img style=\"display:none\" id=\"loader\" src=\"document-uploads/loader.gif\" alt=\"Loading....\" title=\"Loading....\" />";
echo "<!-- simple file uploading form -->";
echo "<form id=\"form\" action=\"document-uploads/ajaxupload.php\" method=\"post\" enctype=\"multipart/form-data\">";
echo "<input id=\"uploadImage\" type=\"file\" accept=\"image/*\" name=\"image\" />";
echo "<input type=hidden name=MRN value=\"$MRN\">";
echo "<input type=\"hidden\" name=\"ACCESSION\" value=$ACCESSION  >";
echo "<input type=hidden name=ORDERID value=\"$ORDERID\">";

echo "<input id=\"button\" type=\"submit\" value=\"Upload\">";
echo "</form>";

echo "<br/>";
echo "<center><a href=http://127.0.0.1:8080/?AccessionID=$ACCESSION&UserName=doctorstation target=pacsResult><input id=\button\" type=\"submit\" value=\"Check DICOM Image\"></a></center>";
////////
echo "<br />";
				echo "<table width=100% bgcolor=#ccd9ff>";
				echo "<tr><td colspan=2 bgcolor=#99b3ff><center>Repeating Xray</center></td></tr>";
				echo "<tr><td>Over Exposure </td><td><input type=\"number\" min=\"0\" step=\"1\" style=\"width: 50px;\"/></td></tr>";
				echo "<tr><td>Under Exposure</td><td><input type=\"number\" min=\"0\" step=\"1\" style=\"width: 50px;\"/></td></tr>";			
				echo "<tr><td>Patient Movment</td><td><input type=\"number\" min=\"0\" step=\"1\" style=\"width: 50px;\"/></td></tr>";			
				echo "<tr><td>Artifact</td><td><input type=\"number\" min=\"0\" step=\"1\" style=\"width: 50px;\"/></td></tr>";
				echo "<tr><td>Scater Ray</td><td><input type=\"number\" min=\"0\" step=\"1\" style=\"width: 50px;\"/></td></tr>";
				echo "</table>";
				echo "<br />";
				echo "<p></p>";
				echo "<center><input id=\"button\" type=\"submit\" value=\"QC Not pass Send back to Examroom\"></center>";

				
echo "<!-- preview action or error msgs -->";
echo "<div id=\"preview\" style=\"display:none\"></div>";

echo "</td></tr></table></center>";
		
?>				
<iframe name="pacsResult" frameborder="0" width="0" height="0"></iframe>

</body>




