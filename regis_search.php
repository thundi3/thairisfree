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
include "connectdb.php";
include "session.php";
header("Content-type: text/html;  charset=utf-8");
?>

<!DOCTYPE html>
<html>
<head>

<title>Search</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
    <script language=JavaScript src="frames_body_array_<?php  echo $LANGUAGE; ?>.js" type=text/javascript></script>
    <script language=JavaScript src="mmenu.js" type=text/javascript></script>   

</head>
<body>

<?php
//mysql_select_db($dbname,$dbconnect);

$mrn = $_POST['mrn'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];


if ($mrn =="" && $fname =="" && $lname =="") {

echo "<table width=\"794\" border=\"0\" align=center>
  <tr>
    <td width=\"191\"><font face=\"MS Sans Serif\"><img src=\"icon/pen.gif\" width=\"54\" height=\"59\" align=\"middle\">Search</font></td>
    <td width=\"587\" bgcolor=\"#F4F4F4\"><table width=\"90%\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td><form name=\"form1\" method=\"post\" action=\"regis_search.php\" accept-charset=\"UTF-8\">
          <p><font face=\"MS Sans Serif\">MRN</font> <font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"mrn\">
          </font></p>
          <p><font face=\"MS Sans Serif\">$_NAME
            <input type=\"text\" name=\"fname\" value=\"\">$_LASTNAME</font>
            <input type=\"text\" name=\"lname\">
            <input type=\"submit\" name=\"Submit\" value=\"Search\">
          </p>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>";

echo "<br><center><font color=red>Please input data for search</font></center>";

exit;

}

//$result = mysql_query("SELECT HN,NAME,LASTNAME FROM `patient_info where NAME LIKE %$fname%");

$result = mysql_query("SELECT MRN,NAME,LASTNAME FROM xray_patient_info WHERE (MRN LIKE '%$mrn%') AND (NAME LIKE '%$fname%') AND (LASTNAME LIKE '%$lname%') AND (CENTER_CODE ='$center_code') LIMIT 0,99");
//$result = mysql_query("SELECT HN,NAME,LASTNAME FROM patient_info WHERE HN LIKE $hn");
//$result = mysql_query("SELECT * FROM Persons");
$num_rows = mysql_num_rows($result);


echo "<table width=\"794\" border=\"0\" align=center>
  <tr>
    <td width=\"191\"><font face=\"MS Sans Serif\"><img src=\"icon/pen.gif\" width=\"54\" height=\"59\" align=\"middle\">Search</font></td>
    <td width=\"587\" bgcolor=\"#F4F4F4\"><table width=\"90%\" cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <td><form name=\"form1\" method=\"post\" action=\"regis_search.php\" accept-charset=\"UTF-8\">
          <p><font face=\"MS Sans Serif\">Search HN</font> <font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"mrn\">
          </font></p>
          <p><font face=\"MS Sans Serif\">$_NAME
            <input type=\"text\" name=\"fname\" value=\"\">$_LASTNAME</font>
            <input type=\"text\" name=\"lname\">
            <input type=\"submit\" name=\"Submit\" value=\"Search\">
          </p>
        </form></td>
      </tr>
    </table></td>
  </tr>
</table>";

if ($num_rows  > 0)
			{ 
						echo "<center>Found : ".$num_rows. " items</center>";
						echo "<table border='0' cellspacing='1' width=70% align=center>\n
						<tr bgcolor=#CCCCCC>\n
						<td><center>HN</center></td>\n
						<td><center>$_NAME</center></td>\n
						<td><center>$_LASTNAME</center></td>\n
						<td><center></center></td>\n
						</tr>";
						while($row = mysql_fetch_array($result))
									{
										echo "<tr>";
										echo "<td align=right>" . $row['MRN'] . "</td>";
										echo "<td>" . $row['NAME'] . "</td>";
										echo "<td>" . $row['LASTNAME'] . "</td>";
										echo "<td><form id=createorder  name=createorder method=post action=\"createorder.php\"> <input name=\"MRN\" type=\"hidden\" id=\"MRN\" value=". $row['MRN'] . "><input type=\"submit\" name=\"button\" id=\"button\" value=\"Create Order\" /></form>";
										//echo "<td><form id=createorder  name=createorder method=post action=\"selectreferrer.php\"> <input name=\"MRN\" type=\"hidden\" id=\"MRN\" value=". $row['MRN'] . "><input type=\"submit\" name=\"button\" id=\"button\" value=\"Create Order\" /></form>";
										echo "</tr>";
									}
						echo "</table>";			
			}



if ($num_rows == 0 ){

echo "<center><b><font color=red>Patient not found  !!  </b>Search again or Create new patient </font><br/></center>\n";

echo  "<table width=\"794\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=center bgcolor=#FFFFFF>
<tr><td bgcolor=#79acf3 colspan=2>Create new patient</td></tr>
  <tr>
    <td width=\"561\"><table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">
      <form name=\"form2\" method=\"post\" action=\"regis.php\">
        <tr>
          <td width=\"43%\"><font face=\"MS Sans Serif\"></font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\"></font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#FF0000\">MRN</font></td>
          <td width=\"57%\"><input type=\"text\" name=\"mrn\" maxlength=\"10\"></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#FF0000\">XN</font></td>
          <td width=\"57%\"><input type=\"text\" name=\"xn\" maxlength=\"10\"></td>
        </tr>
        
        
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#FF0000\">Firstname</font></td>
          <td width=\"57%\"><input type=\"text\" name=\"fname\" maxlength=\"100\"></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#FF0000\">Lastname</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"lname\" maxlength=\"100\">
          </font></td>
          </tr>
          <!--
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#000000\">Middle  Name</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"mname\" maxlength=\"100\">
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\">Name (English)</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"efname\" maxlength=\"100\" >
          </font></td>
        </tr>
        
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\">Lastname (English)</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"elname\" maxlength=\"100\" >
          </font></td>
        </tr>
        -->
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\">SSN</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"ID\" size=\"20\" maxlength=\"13\">
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#FF0000\">Sex</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"radio\" name=\"sex\" value=\"M\">
            Male
            <input type=\"radio\" name=\"sex\" value=\"F\">
            Female
            <input type=\"radio\" name=\"sex\" value=\"U\">
            Unknow</font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#FF    \">Date of birth</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">

<SCRIPT LANGUAGE=\"JavaScript\" ID=\"js18\">
var cal18 = new CalendarPopup(\"testdiv1\");
cal18.setCssPrefix(\"TEST\");
</SCRIPT>


<INPUT TYPE=\"text\" NAME=\"dob\" VALUE=\"\" SIZE=10>
<a href='#'><img src=image/calandar.jpg border='0' onClick=\"cal18.select(document.forms[1].dob,'anchor18','dd/MM/yyyy'); return false;\" TITLE=\"dd/MM/yyyy\" NAME=\"anchor18\" ID=\"anchor18\"></a>


<DIV ID=\"testdiv1\" STYLE=\"position:absolute;visibility:hidden;background-color:white;layer-background-color:white;\"></DIV>

        </font></td>
        </tr>
        <tr>
          <td width=\"43%\" valign=\"top\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#000000\">Address</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <textarea name=\"address\"></textarea>
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\">Road</font></td>
          <td width=\"57%\"><input type=\"text\" name=\"road\" maxlength=\"100\"></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\">City</font></td>
          <td width=\"57%\"><input type=\"text\" name=\"tambon2\"></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font color=\"#000000\" face=\"MS Sans Serif\">State</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"ampher\" maxlength=\"100\">
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font color=\"#000000\" face=\"MS Sans Serif\">Province</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"province\" maxlength=\"100\">
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#000000\">Post Code</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"postcode2\" maxlength=\"100\">
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#000000\">Country</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <select name=\"country\">
              <option>Thailand</option>
              <option>England</option>
			  <option>Other</option>
            </select>
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#000000\">Phone</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"telephone\" maxlength=\"100\">
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#000000\">Fax</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"fax\" maxlength=\"100\">
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\" color=\"#000000\">Email</font></td>
          <td width=\"57%\"><font face=\"MS Sans Serif\">
            <input type=\"text\" name=\"email\" maxlength=\"100\">
          </font></td>
        </tr>
        <tr>
          <td width=\"43%\" bgcolor=\"#F0F0F0\"><font face=\"MS Sans Serif\">Note</font></td>
          <td width=\"57%\" valign=\"top\"><textarea name=\"note\" cols=\"30\" rows=\"10\"></textarea></td>
        </tr>
        <tr>
          <td colspan=\"2\" bgcolor=\"#F0F0F0\"><p>&nbsp;</p>
            <p align=\"center\">
              <input type=\"reset\" name=\"Submit4\" value=\"Clear\">
              <input type=\"submit\" name=\"Submit4\" value=\"OK\">
            </p>
            <p>&nbsp;</p></td>
        </tr>
   
    </table></td>
	
	
	
	
	
    <td width=\"388\" valign=\"top\">
      <table width=\"325\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\">
      <tr>
        <td width=\"105\"  bgcolor=\"#F0F0F0\">Creatinine</td>

        <td >
          <input type=\"text\" name=\"textfield\" id=\"textfield\">
        </td>
      </tr>
      <tr>
        <td bgcolor=\"#F0F0F0\">Lab Date</td>
		<td>
          <input type=\"text\" name=\"textfield5\" id=\"textfield5\"></td>
      </tr>
      <tr>
        <td bgcolor=\"#F0F0F0\">Medical alert</td>
        <td><input type=\"text\" name=\"textfield2\" id=\"textfield2\"></td>
      </tr>
      <tr>
        <td bgcolor=\"#F0F0F0\">Height</td>
        <td><input type=\"text\" name=\"textfield3\" id=\"textfield3\"></td>
      </tr>
      <tr>
        <td bgcolor=\"#F0F0F0\">Weight</td>
        <td><input type=\"text\" name=\"textfield4\" id=\"textfield4\"></td>
      </tr>
    </table>
	
	
	<br/>
	
	

	<table border=0>
	<tr>	<td width=\"388\" valign=\"top\" bgcolor=\"#F0F0F0\">Patient type</td></tr>
	<tr><td>
                    <input type=\"checkbox\" name=\"walk\" id=\"walk\">
                    W
            alk
<input type=\"checkbox\" name=\"slide\" id=\"slide\">
Slide
					<input type=\"checkbox\" name=\"wheel\" id=\"wheel\">
					Wheel chair<br/>
					<input type=\"checkbox\" name=\"stretcher\" id=\"stretcher\">Strecher
					<input type=\"checkbox\" name=\"bed\" id=\"bed\">Bed
					<input type=\"checkbox\" name=\"o2\" id=\"o2\">O2
					<input type=\"checkbox\" name=\"portable\" id=\"portable\">Portable
	</td></tr>
     <tr><td bgcolor=\"#F0F0F0\">Medical alert</td></tr>
     <tr><td>        
                    <input type=\"checkbox\" name=\"pregnancy\" id=\"pregnancy\">Pregnancy
					<input type=\"checkbox\" name=\"allergy\" id=\"allergy\">Allergy
	                <label>
	                  <input type=\"text\" name=\"allergy2\" id=\"allergy2\" />
            </label></td></tr>
	<tr><td bgcolor=\"#F0F0F0\">Type</td></tr>
     <tr>
       <td>
					
			<label>
			  <input type=\"radio\" name=\"radio\" id=\"ipd\" value=\"ipd\" />
		    </label>
			OPD
			<label>
			  <input type=\"radio\" name=\"radio\" id=\"ipd2\" value=\"ipd\" />
		    </label>
IPD
<label>
  <input type=\"radio\" name=\"radio\" id=\"emergency\" value=\"emergency\" />
</label>
Emergency </td></tr>
    </table>
	
	

	
	
	
    <p>&nbsp;</p></td>
  </tr>
  
  </FORM>
</table>";





}

?>
</body></html>