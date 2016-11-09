<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mammogram Form</title>
<?php
$MRN = isset($_GET['MRN']) ? $_GET['MRN'] : null;
$ACCESSION = isset($_GET['ACCESSION']) ? $_GET['ACCESSION'] : null;
?>
<style type="text/css">
<!--
.text {
	font-weight: bold;
}
.text {
	font-weight: bold;
}
.text {
	text-align: justify;
}
-->
</style>

<style type="text/css">
* {
	margin:0;
	padding:0;
	font-family:Arial, "times New Roman", tahoma;
	font-size:12px;
}
html {
	font-family:Arial, "times New Roman", tahoma;
	font-size:12px;
	color:#000000;
}
body {
	font-family:Arial, "times New Roman", tahoma;
	font-size:12px;
	padding:0;
	margin:0;
	color:#000000;
}
.headTitle {
	font-size:12px;
	font-weight:bold;
	text-transform:uppercase;
}
.headerTitle01 {
	border:1px solid #333333;
	border-left:2px solid #000;
	border-bottom-width:2px;
	border-top-width:2px;
	font-size:11px;
}
.headerTitle01_r {
	border:1px solid #333333;
	border-left:2px solid #000;
	border-right:2px solid #000;
	border-bottom-width:2px;
	border-top-width:2px;
	font-size:11px;
}
/* สำหรับช่องกรอกข้อมูล  */
.box_data1 {
	font-family:Arial, "times New Roman", tahoma;
	height:18px;
	border:0px dotted #333333;
	border-bottom-width:1px;
}
/* กำหนดเส้นบรรทัดซ้าย  และด้านล่าง */
.left_bottom {
	border-left:2px solid #000;
	border-bottom:1px solid #000;
}
/* กำหนดเส้นบรรทัดซ้าย ขวา และด้านล่าง */
.left_right_bottom {
	border-left:2px solid #000;
	border-bottom:1px solid #000;
	border-right:2px solid #000;
}
/* สร้างช่องสี่เหลี่ยมสำหรับเช็คเลือก */
.chk_box {
	display:block;
	width:10px;
	height:10px;
	overflow:hidden;
	border:1px solid #000;
}
/* css ส่วนสำหรับการแบ่งหน้าข้อมูลสำหรับการพิมพ์ */
@media all
{
	.page-break	{ display:none; }
	.page-break-no{ display:none; }
}
@media print
{
	.page-break	{ display:block;height:1px; page-break-before:always; }
	.page-break-no{ display:block;height:1px; page-break-after:avoid; }	
}
</style>
</head>
<?php

if ($MRN == '')
	{
		$MRN= 'DEMO';
	}
if ($NAME == '')
	{
		$NAME= 'MR.DEMO THAIRIS';
	}
if ($PROCEDURE == '')
	{
		$PROCEDURE= 'Mammography';
	}

?>
<body>
<center>
<p>&nbsp;</p>
<table width="750" border="1" cellpadding="0" cellspacing="0">
  <tr>
    <td width="370">
	  <p><b>Patient</b> :<?php echo $NAME; ?></p>
	  <p><b>MRN</b> : <?php echo $MRN; ?></p>
      <p><b>DOB</b> : </p>
      <p><b>SEX</b> : </p>
	  <p><b>ACCESSION</b> : <?php echo $ACCESSION; ?></p>
	  <p><b>Procedure</b> : <?php echo $PROCEDURE; ?></p>
      <p><b>Date</b> : </p></td>
    <td width="364"><center>
      <p><b>ThaiRIS IMAGING</b></p>
      <p>MAMMOGRAM PATIENT HISTORY FORM</p>
    </center></td>
  </tr>
</table>
<table width="750" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="359" valign="top"><p>Have you performed mammography before ?</p>
      <p>
  <label>
    <input type="radio" name="radio" id="perform_yes" value="perform_yes" />
  </label>
        Yes 
        <label>
          <input type="radio" name="radio" id="perform_no" value="perform_no" />
        </label>
        No</p>
    <p>&nbsp;</p>
    <table width="100%" border="0">
    
    
       <tr>
        <td colspan="2" bgcolor="#CCCCCC" class="text">FAMILY HISTORY</td>
        </tr>
        
        
      <tr>
        <td colspan="2"><b>Is there a history of breast cancer in you farmily ?</b>
          <label>
            <br />
            <input type="radio" name="radio" id="family_yes" value="family_yes" />
          </label>
Yes
<label>
  <input type="radio" name="radio" id="family_no" value="family_no" />
</label>
No</td>
        </tr>
      <tr>
        <td width="154"><label>
          <input type="checkbox" name="family_mother" id="family_mother" />
        </label>
Mother</td>
        <td width="130">Age
          <label>
            <input name="family_mother_age" type="text" id="family_mother_age" size="3" maxlength="3" />
          </label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="family_sister" id="family_sister" />
        </label>
Sister</td>
        <td> Age
          <label>
            <input name="family_sister_age" type="text" id="family_sister_age" size="3" maxlength="3" />
          </label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="family_aunt" id="family_aunt" />
        </label>
Aunt</td>
        <td>Age
          <label>
            <input name="family_aunt_age" type="text" id="family_aunt_age" size="3" maxlength="3" />
          </label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="family_grandmother" id="family_grandmother" />
        </label>
Grandmother</td>
        <td>Age
          <label>
            <input name="family_grandmother_age" type="text" id="family_grandmother_age" size="3" maxlength="3" />
          </label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="family_daugther" id="family_daugther" />
        </label>
Daughter</td>
        <td>Age
          <label>
            <input name="family_daugther_age" type="text" id="family_daugther_age" size="3" maxlength="3" />
          </label></td>
      </tr>
      <tr>
        <td><label>
          <input type="checkbox" name="family_cousin" id="family_cousin" />
        </label>
Cousin</td>
        <td>Age
          <label>
            <input name="family_consin_age" type="text" id="family_consin_age" size="3" maxlength="3" />
          </label></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <table width="100%" border="0">
      <tr>
        <td colspan="2"><label><b>Do you currently have any of the following symptoms ?</b></label></td>
        </tr>
      <tr>
        <td>Breast Lump</td>
        <td><label>
          <input type="checkbox" name="Lump_left" id="Lump_left" />
        </label>
Left
<label>
  <input type="checkbox" name="Lump_right" id="Lump_right" />
</label>
Right</td>
      </tr>
      <tr>
        <td>Pain or Discomfort</td>
        <td><label>
          <input type="checkbox" name="Lump_left3" id="Lump_left3" />
        </label>
Left
<label>
  <input type="checkbox" name="Lump_right3" id="Lump_right3" />
</label>
Right</td>
      </tr>
      <tr>
        <td> Discharge from Nipple <br /></td>
        <td><label>
          <input type="checkbox" name="Lump_left4" id="Lump_left4" />
        </label>
Left
<label>
  <input type="checkbox" name="Lump_right4" id="Lump_right4" />
</label>
Right</td>
      </tr>
      <tr>
        <td> Inverted Nipple <br /></td>
        <td><label>
          <input type="checkbox" name="Lump_left5" id="Lump_left5" />
        </label>
Left
<label>
  <input type="checkbox" name="Lump_right5" id="Lump_right5" />
</label>
Right</td>
      </tr>
      <tr>
        <td> Skin Dimpling <br /></td>
        <td><label>
          <input type="checkbox" name="Lump_left6" id="Lump_left6" />
        </label>
Left
<label>
  <input type="checkbox" name="Lump_right6" id="Lump_right6" />
</label>
Right</td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
    <td width="385" valign="top"><table width="100%" border="0">
      <tr>
        <td bgcolor="#CCCCCC" class="text">BREAST SURGERY</td>
      </tr>
      <tr>
        <td>Have you ever any breast surgery? 
          <label>
            <input type="radio" name="radio" id="surgery_yes" value="surgery_yes" />
          Yes 
          <input type="radio" name="radio" id="surgery_no" value="surgery_no" />
          No</label></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <p>Have you had your ovaries removed ? 
      <label>
        <input type="radio" name="radio" id="ovaries_yes" value="ovaries_yes" />
      </label>
    Yes 
    <label>
      <input type="radio" name="radio" id="ovaries_no" value="ovaries_no" />
    </label>
    No</p>
    <p>Are you taking hormones/estrogent ? 
      <label>
        <input type="radio" name="radio" id="hormone_yes" value="hormone_yes" />
      </label>
    Yes 
    <label>
      <input type="radio" name="radio" id="hormone_no" value="hormone_no" />
    </label>
    No</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p><center>
      <p><img src="mammo.png" alt="mammogram" width="343" height="117" border="0" /></p>
      <p>&nbsp;</p>
    </center></p>
    <p>Radiographer Note : </p>
    <p>
      <label>
        <textarea name="tech_note" id="tech_note" cols="65" rows="5"></textarea>
      </label>
    </p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="54%" align="left"><p>- Mammography is an x-ray examination of the breast used primarily to detect cancer. Although mammography is the single best method of detecting breast cancer, it cannot find all breast cancers. Combined with monthly breast self-examinations and yearly clinical exams by your doctor, you can achieve good breast care.</p>
            <p>- In order to obtain the best mammogram, it is essential that the breast be firmly compressed for a few seconds during the examination, which may cause some slight discomfort. A radiologist will interpret your films and the results will be sent to you and your doctor. Our technologists will be glad to provide you with additional information on mammography and breast self-examinations.<br />
          </p></td>
          <td width="46%" align="left"><table width="300" border="0" align="right" cellpadding="0" cellspacing="0">
            <tr>
              <td width="100" align="right">Patient Signature : </td>
              <td width="62%"><input name="textfield" type="text" class="box_data1" id="textfield" style="text-align:center;width:200px;"   /></td>
            </tr>
            <tr>
              <td align="right"><p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>Date : </p></td>
              <td><p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <input name="textfield" type="text" class="box_data1" id="textfield" style="text-align:center;width:150px;"   /></td>
            </tr>
          </table></td>
    </tr>
  </table>
</center>
<div class="page-break">&nbsp;</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<center>
<table width="750" border="0">
  <tr>
    <td width="437" bgcolor=gray>HELLO</td>
    <td width="303">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">IHEARBY ASSIGN AND TRANSFER ANY AND ALL RIGHTS, BENEFITS AND CAUSES OF ACTION TO THE ASSIGNEE.<br />
This is an assignment of my rights and benefits. In the event my insurance company is obligated to make payment to me upon<br />
charges made by the Assignee for its services, and the company fails or refused to make timely, complete payment, I authorize<br />
Assignee to prosecute said cause of action either in my name or Assignee’s name in further I authorize Assignee to compromise,<br />
settle or otherwise resolve said cause of action as they see fit.<br />
      <br />
<p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
</center>
<p>&nbsp;</p>
</body>
</html>