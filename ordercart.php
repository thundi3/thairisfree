<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: ordercart.php
# Description :  Order Cart
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
header("Content-type: text/html;  charset=utf-8");
include ("session.php");
include ("connectdb.php");
$sessionID = session_id();

$addcode = $_GET['XRAY_CODE'];
$hn = $_GET['HN'];
$addorder = $_GET['ADDORDER'];
$REFERRER = $_GET['REFERRER'];
$DEPARTMENT = $_GET['DEPARTMENT'];
$type = $_GET['TYPE'];
$today = date("Y-m-d");
$code = $_GET['CODE'];
	
//Delete an exam in cart

if ($type =='DEL')
	{
		echo $addcode;
		$sql= "delete FROM xray_order_cart where XRAY_CODE='$code'";
		mysql_query($sql);
	}
//Delete all in cart
if ($type == 'DELALL') 
	{
		$sqldel = "delete FROM xray_order_cart where SESSION_ID='$sessionID'";
		mysql_query($sqldel);
	}
///////////////////// Insert to request table 
if ($type == 'INSERTNEW') 
	{
		$sql_last_no = "select LAST_REQUEST_NO FROM xray_auto";
		$last_num = "";
		// Fucntion 
		$yearPHP = date("Y");
		$year = $yearPHP;
		$year = substr($year,-2);
		$findyear1 = "SELECT YEAR(CURRENT_DATE())"; //SELECT YEAR(NOW())
		$findyear = mysql_query($findyear1);
		while ($row = mysql_fetch_array($findyear))
			{
				$yearMySQL = $row[0]; //[YEAR(CURRENT_DATE())]
				//echo $yearMySQL."<br />";
			}
		////////////////// CHECK Last AUTO Number ////////////////////////
		$sqlyear1 = "SELECT LAST_REQUEST_NO,YEAR FROM xray_auto";
		$sqlyear2 = mysql_query($sqlyear1);
		while ($row = mysql_fetch_array($sqlyear2)) 
			{
				$last_no = $row['LAST_REQUEST_NO'];
				$sqlyear = $row['YEAR'];
				//echo "<br />SQLyear =".$sqlyear;
				//echo "<br />Last =".$last_no;
				echo "<br />";
			}
		/////////////////////////////////////////////////////////////////////////////////////
		//$yearPHP = $yearPHP+91;
		if ($yearPHP != $sqlyear)
			{
				$last_no = 0;
				echo "Year not same<br />";
				echo $yearPHP;
				mysql_query("UPDATE  xray_auto SET LAST_REQUEST_NO='$last_no'");
				mysql_query("UPDATE  xray_auto SET YEAR='$yearPHP'");
			}
		$last_no = $last_no+1;
		$request_no = "X".$year."-".$last_no;
		$result = mysql_query("select CODE FROM xray_user WHERE LOGIN ='$username'");
			while ($row = mysql_fetch_array($result))
				{
					$usercode = $row['CODE']	;
				}
		mysql_query("Update xray_auto SET LAST_REQUEST_NO='$last_no'");
		//loop from cart
		$sql_from_cart = "select xray_code.XRAY_CODE, xray_code.DESCRIPTION, xray_code.CHARGE_TOTAL from xray_code, xray_order_cart WHERE xray_order_cart.xray_code=xray_code.XRAY_CODE and xray_order_cart.SESSION_ID='$sessionID' and xray_order_cart.MRN='$hn'";
		$result = mysql_query($sql_from_cart);
		$del= "delete FROM xray_order_cart where XRAY_CODE='$code'";
		$sqlinsertorder = "insert INTO xray_request (REQUEST_NO,MRN,REFERRER,REQUEST_DATE, REQUEST_TIMESTAMP, DEPARTMENT_ID, USER,CANCEL_STATUS,CENTER_CODE) VALUES  ('$request_no','$hn','$REFERRER',CURDATE(), NOW(),'$DEPARTMENT','$usercode','1','$center_code')";
		mysql_query($sqlinsertorder);
		$resultdate = mysql_query("select curdate()");
		$rowdate=mysql_fetch_array($resultdate);
		$dbdate = $rowdate[0];
		while($row=mysql_fetch_array($result))
			{	
				$resulttime = mysql_query("select curtime()");
				$rowtime=mysql_fetch_array($resulttime);
				$dbtime = $rowtime[0];
				$code = $row['XRAY_CODE'];
				$description =$row['DESCRIPTION'];
				$ACCESSION = $request_no."-".$code;
				$resulttime = mysql_query("select curtime()");
				$rowtime=mysql_fetch_array($resulttime);
			
				//$sqlinsertorder_datail ="insert INTO xray_request_detail (REQUEST_NO,ACCESSION,XRAY_CODE,REQUEST_TIMESTAMP, REQUEST_DATE,REQUEST_TIME,STATUS,PAGE)VALUES('$request_no','$accession','$code',NOW(),'$date','$time','NEW','ORDER LIST')";
				$sqlinsertorder_datail ="insert INTO xray_request_detail (REQUEST_NO,ACCESSION,XRAY_CODE,REQUEST_TIMESTAMP,REQUEST_TIME,REQUEST_DATE,STATUS,PAGE,LOCKBY)VALUES('$request_no','$ACCESSION','$code',NOW(),'$dbtime','$dbdate','NEW','ORDER LIST','')";
				$c_starttime = date(YmdHis);
				$c_endtime = date('YmdHis', strtotime("+15 min"));
				$inseart_calendar = "insert into xray_sc_events(event_name,event_description, MRN, ACCESSION, calendar_id, all_day, start_time, end_time) VALUES ('$hn', 'ACCESSION', '$hn', '$ACCESSION', '1', '','$c_starttime','$c_endtime')";
				mysql_query($inseart_calendar);
				//exit;
				/////////////INSERT LOG/////////////
				if ($CREATELOG_FILE==1)
					{
						$URL=$_SERVER["HTTP_REFERER"];
						mysql_query("insert into xray_log (USER,IP,EVENT,URL,MRN,ACCESSION)VALUES ('$username','$IP','CREATEORDER','$URL','$hn','$ACCESSION')");
					}
				////////////////Create HL7///////////////ORM NEW
				mysql_query($sqlinsertorder_datail);
				mysql_query("delete FROM xray_order_cart where XRAY_CODE='$code'and xray_order_cart.SESSION_ID='$sessionID'");

			}

		//echo $hn.$year;
		//echo "<br>".$mysqlyear;
		echo "<font size=11>Created Order</font><br />";
		//echo "<br \>Print";
		//echo "<li>Soundex <li><a href=print-request.php?REQUEST_NO=".$ACCESSION."> Print Request</a> <li>Barcode<br />";
		//echo "<script type=\"text/javascript\">window.location=\"reporting.php\";</script>";
		//echo "<img src=barcode.php?barcode=".$ACCESSION."&width=320&height=50>";
	}
	
// Add order to xray_request and xray_request_detail table
//  order exit on cart?

$sql = "select ID FROM xray_order_cart where XRAY_CODE ='$addcode' and MRN='$hn' and SESSION_ID='$sessionID'";
$del_old_cart  = "delete FROM xray_order_cart where DATE <> '$today'";
mysql_query($del_old_cart);
$result = mysql_query($sql);
if (mysql_num_rows($result) == 1)
	{
		//	echo "<script language=\"javascript\">";
		//	echo "window.alert('found orderd')";
		//	echo "</script>";
		//	echo "<br><font color=red>Found same order in list</font>";
		//exit;
	}
else
	{
		if ($addcode !='')
			{
				$sql = "insert INTO xray_order_cart (SESSION_ID,MRN,XRAY_CODE,DATE,REFERRER_ID) VALUES('$sessionID','$hn','$addcode','$today','')";
				mysql_query($sql);
			}
	}
$sql = "select  xray_code.XRAY_CODE, xray_code.DESCRIPTION, xray_code.CHARGE_TOTAL from xray_code, xray_order_cart WHERE xray_order_cart.xray_code=xray_code.XRAY_CODE and xray_order_cart.SESSION_ID='$sessionID' and xray_order_cart.MRN='$hn'";
$result = mysql_query($sql);
if (mysql_num_rows($result)==0) 
	{
		exit;
	}

echo "<table width=100%><tr bgcolor=#FFFF11><td>Code</td><td align=center>Detail</td><td>Cost</td><td align=center>Del</td></tr>";

$sum =0;
while($row=mysql_fetch_array($result))
	{
		$code = $row['XRAY_CODE'];
		$des = $row['DESCRIPTION'];
		$cost = $row['CHARGE_TOTAL'];
		$sum += $row['CHARGE_TOTAL'];
		echo "<tr><td>".$code."</td><td><font size=-1>".$des."</font></td><td align=right>".$cost."</td><td><img src=image/delete.gif border=0 onclick=delanexam('".$hn."','".$code."','DEL')></td></tr>";
	}
echo "<tr><td></td><td align=right><font>Total : </font></td><td align=right>".$sum."</td><td align=center></td></tr>";
echo "</table>";
echo "<br \><center><input type=button value='Delete All' onclick=delallcart('".$hn."','DELALL')> <input type=button value=OK onclick=insertexam('".$hn."')></center></form>";
?>
