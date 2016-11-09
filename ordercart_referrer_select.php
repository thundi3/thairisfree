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
header("Content-type: text/html;  charset=TIS-620");
// Query Procedure
$REFERRER = isset($_GET['REFERRER']) ? $_GET['REFERRER'] : null;
$TYPE = isset($_GET['TYPE']) ? $_GET['TYPE'] : null;
$ID = isset($_GET['ID']) ? $_GET['ID'] : null;

include "connectdb.php";
include ("function.php");

if ($TYPE=="SEARCH")
	{
		echo "search";
		$sql = "SELECT * FROM `xray_referrer` WHERE NAME LIKE '%$REFERRER%'";
		$result = mysql_query($sql);
		$total=mysql_num_rows($result);
		$e_page = 10; // Items per page
		if(!isset($_GET['s_page']))
			{     
				$_GET['s_page']=0;     
			}
		else
			{     
				$chk_page=$_GET['s_page'];       
				$_GET['s_page']=$_GET['s_page']*$e_page;     
			}     
		$sql.=" LIMIT ".$_GET['s_page'].",$e_page";  
		$result=mysql_query($sql);  
		if(mysql_num_rows($result)>=1)
			{     
				$plus_p=($chk_page*$e_page)+mysql_num_rows($result);     
			}
		else
			{     
				$plus_p=($chk_page*$e_page);         
			}     
		$total_p=ceil($total/$e_page);     
		$before_p=($chk_page*$e_page)+1;  


		echo "<html><head>
				<title>Search</title>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=tis-620\">
				<link href=\"css/page.css\" rel=\"stylesheet\" type=\"text/css\" />
				</head>
				<body>";
		echo $REFERRER."<br \><p>";
		echo "<table border='0' width=100%>
				<tr>
				<th>CODE</th>
				<th>DEGREE</th>
				<th>NAME</th>
				<th>LASTNAME</th>
				<th>English Name</th>
				<th>English LASTNAME</th>
				<th></th>
				</tr>\n";
		while($row = mysql_fetch_array($result))
			{
				if($bg == "#FFFFFF") 
					{ 
						$bg = "#EBEBEB";
					} 
				else 
					{
						$bg = "#FFFFFF";
					}
				echo "<tr bgcolor=$bg>";
				echo "<td>" . $row['REFERRER_ID'] . "</td>";
				echo "<td>" . $row['DEGREE'] . "</td>";
				echo "<td>" . $row['NAME'] . "</td>";
				echo "<td>" . $row['LASTNAME'] . "</td>";
				echo "<td>" . $row['NAME_ENG'] . "</td>";
				echo "<td>" . $row['LASTNAME_ENG'] . "</td>";
				echo "<td><input type=\"submit\" value=\"Submit\" onclick=selected_referrer('".$row['REFERRER_ID']."')></td>";
				//echo "<td> <input name=\"id\" type=\"hidden\" id=\"id\" value=\"".$row['ID']."\"><input type=\"submit\" value=\"Submit\" /></td>";
				echo "</tr>\n";
			}
		echo "</table>";
		
echo "<div class=\"browse_page\">";  

if ($total > $e_page)
	{
		page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);     
	}
echo "Total =".$total;	
echo "</div>";
  
	} // end if TYPE=SEARCH

if ($TYPE=="SELECTED")
	{
		$sql = "SELECT NAME, LASTNAME, SEX FROM xray_referrer WHERE REFERRER_ID ='$ID'";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result))
			{
				$name = $row['NAME'];
				$lastanme =$row['LASTNAME'];
				$sex = $row['SEX'];
			}
?>
		<img src='./image/man_icon.gif' OnLoad="ReplaceContentInContainer('show','Physician Selected <br> <font color=red>Please select Deparment</font>')">
<?php
		echo $name;
		echo "<input type=\"hidden\" name=\"referrer\" id=\"referrer\" value=\"".$ID."\">";
		//echo "<form name=referform><input type=\"hidden\" name=\"referrer\" id=\"referrer\" value=\"".$ID."\"></form>";
	}   // End Search

?>
</body>
</html>

