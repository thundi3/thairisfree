<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 08 Nov 2016
# File name: worklolad-department.php
# Description :  Show workload for each radiologist
# http://www.thairis.net
# Email : info.xraythai@gmail.com
###########################################
include "connectdb.php";
include ("session.php");
include ("function.php");
$datestart = $_POST['date1'];
$dateend = $_POST['date2'];

$sql = "SELECT xray_department.NAME_THAI AS DEP, xray_request.REQUEST_NO, 
		xray_request.DEPARTMENT_ID, 
		xray_request.REQUEST_DATE,
		COUNT( xray_request.DEPARTMENT_ID ) AS COUNT_DEP
		FROM xray_department
		LEFT JOIN xray_request ON xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID
		WHERE xray_request.REQUEST_TIMESTAMP BETWEEN  '$datestart 00:00:00' AND '$dateend 23:59:59' 
		GROUP BY xray_department.DEPARTMENT_ID
		ORDER BY COUNT_DEP DESC";
		
		
//		ORDEY BY COUNT_DEP AS DESC";
//ORDER BY birth DESC;
//WHERE xray_request.DEPARTMENT_ID !=  ''

?>
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>  
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
<body bgcolor="#d4d4d4">
<center><form method="post" action="workload-department.php">
FROM : 
<input type="text" name="date1" id="dateInput1" value=''  size=8/> 
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.7.2.custom.min.js"></script> 
<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#dateInput1").datepicker({  
        dateFormat: 'yy-mm-dd',  
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
		
TO : 
<input type="text" name="date2" id="dateInput2" value='' size=8/> 
<script type="text/javascript">  
$(function(){  
    var dateBefore=null;  
    $("#dateInput2").datepicker({  
        dateFormat: 'yy-mm-dd',  
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

</center>
<center>
  <button type=submit class="positive" value="submit"><img src="icons/find.png" width=15 alt="Search" border=0 /> Search </button>
</center>
</form>

<?php
			
$result = mysql_query($sql);
echo "<center>Search From ".$datestart." To ".$dateend."</center>";
echo "<table align=center width=50% bgcolor=white>";
echo "<tr bgcolor=#ccaacc><td>Department </td><td>Total</td></tr>";
while($row = mysql_fetch_array($result)) 
	{
		echo "<tr><td>".$row[DEP]."</td><td>".$row[COUNT_DEP]."</td></tr>";
		$num = $num + $row[COUNT_DEP];

	}
echo "<tr bgcolor=#81BEF7><td>";
echo "Total </td><td>".$num;
echo "</td></tr>";
echo "</table>";
?>