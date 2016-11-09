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
include ("./pdf/fpdf.php");
include "session.php";
define('FPDF_FONTPATH', './pdf/font/');
include ("connectdb.php");
$REQUEST_NO = $_GET[REQUEST_NO];

$sql = "SELECT xray_patient_info.MRN, xray_patient_info.CENTER_CODE, xray_request_detail.ID  AS ORDERID,xray_request_detail.REQUEST_DATE AS REQ_DATE,xray_request_detail.REQUEST_TIME AS REQ_TIME, xray_request.REQUEST_NO, xray_request_detail.ACCESSION,xray_request_detail.STATUS, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_patient_info.NAME_ENG AS NAMEENG, xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, xray_code.DESCRIPTION, xray_referrer.NAME AS DRNAME, xray_referrer.LASTNAME AS DRLASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request.REQUEST_NO = '$REQUEST_NO') and (xray_request_detail.STATUS != 'CANCEL')" ;


$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	$acc = ": ".$row[ACCESSION];
	$ptname = $row[PTNAME];
	$ptlastname = $row[PTLASTNAME];
	$report = $row[REPORT];
	$MRN = $row[MRN];
	$procedure = ": ".$row[DESCRIPTION];
	$DRNAME = $row[DRNAME];
	$DRLASTNAME = $row[DRLASTNAME];

}

////////////////////////////// Query Order From Request//////////////////////////////
//$result = mysql_query("select XRAY_CODE, DESCRIPTION, CHARGE_TOTAL from xray_code where BODY_PART = 'CHEST'");

$result = mysql_query("select XRAY_CODE, DESCRIPTION, CHARGE_TOTAL from xray_code where XRAY_TYPE_CODE = 'MAMMO'");
$number_of_products = mysql_num_rows($result);

//Initialize the 3 columns and the total
$column_code = "";
$column_name = "";
$column_price = "";
$total = 0;

//For each row, add the field to the corresponding column
//while($row = mysql_fetch_array($result))
//{
//    $code = $row["XRAY_CODE"];
//    $name = substr($row["DESCRIPTION"],0,20);
//    $real_price = $row["CHARGE_TOTAL"];
//    $price_to_show = $row["CHAREG_TOTAL"];

//    $column_code = $column_code.$code."\n";
//    $column_name = $column_name.$name."\n";
//    $column_price = $column_price.$real_price."\n";

    //Sum all the Prices (TOTAL)
 //   $total = $total+$real_price;
//}

//mysql_close();
/////////////////////////////////////////////////////////////////////
class PDF extends FPDF
{
var $B;
var $I;
var $U;
var $HREF;

//Page header
function Header()
{
    //Logo
   // $this->Image('image/banner-report.jpg',30,5,150);
	//$this->Image('image/banner-report.jpg',30,5,150);
    //Arial bold 15
   // $this->SetFont('Arial','B',15);
    //Move to the right
   // $this->Cell(80);
    //Title
   // $this->Cell(30,10,'RIS DEMO',1,0,'C');
    //Line break
   // $this->Ln(10);
}

//Page footer
function Footer()
{

    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
 
}
//function PDF($orientation='P',$unit='mm',$format='A4')
function PDF($orientation='L',$unit='mm',$format='A5')
{
    //Call parent constructor
    $this->FPDF($orientation,$unit,$format);
    //Initialization
    $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';
}

function WriteHTML($html)
{
    //HTML parser
    $html=str_replace("\n",' ',$html);
    $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            //Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            //Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                //Extract attributes
                $a2=explode(' ',$e);
                $tag=strtoupper(array_shift($a2));
                $attr=array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])]=$a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag,$attr)
{
    //Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF=$attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    //Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF='';
}

function SetStyle($tag,$enable)
{
    //Modify style and select corresponding font
    $this->$tag+=($enable ? 1 : -1);
    $style='';
    foreach(array('B','I','U') as $s)
    {
        if($this->$s>0)
            $style.=$s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL,$txt)
{
    //Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}

    function conv($string) {
        return iconv('UTF-8', 'TIS-620', $string);
    }


///////////////////////////////////////BAR CODE FUNCTION///////////////////////////////////////////////////


function EAN13($x, $y, $barcode, $h=16, $w=.35)
{
    $this->Barcode($x, $y, $barcode, $h, $w, 13);
}

function UPC_A($x, $y, $barcode, $h=16, $w=.35)
{
    $this->Barcode($x, $y, $barcode, $h, $w, 12);
}

function GetCheckDigit($barcode)
{
    //Compute the check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    $r=$sum%10;
    if($r>0)
        $r=10-$r;
    return $r;
}

function TestCheckDigit($barcode)
{
    //Test validity of check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    return ($sum+$barcode{12})%10==0;
}




///////////////////////////////////////BAR Code39///////////////////////////////////////////////////

function Code39($xpos, $ypos, $code, $baseline=0.5, $height=5){

    $wide = $baseline;
    $narrow = $baseline / 3 ; 
    $gap = $narrow;

    $barChar['0'] = 'nnnwwnwnn';
    $barChar['1'] = 'wnnwnnnnw';
    $barChar['2'] = 'nnwwnnnnw';
    $barChar['3'] = 'wnwwnnnnn';
    $barChar['4'] = 'nnnwwnnnw';
    $barChar['5'] = 'wnnwwnnnn';
    $barChar['6'] = 'nnwwwnnnn';
    $barChar['7'] = 'nnnwnnwnw';
    $barChar['8'] = 'wnnwnnwnn';
    $barChar['9'] = 'nnwwnnwnn';
    $barChar['A'] = 'wnnnnwnnw';
    $barChar['B'] = 'nnwnnwnnw';
    $barChar['C'] = 'wnwnnwnnn';
    $barChar['D'] = 'nnnnwwnnw';
    $barChar['E'] = 'wnnnwwnnn';
    $barChar['F'] = 'nnwnwwnnn';
    $barChar['G'] = 'nnnnnwwnw';
    $barChar['H'] = 'wnnnnwwnn';
    $barChar['I'] = 'nnwnnwwnn';
    $barChar['J'] = 'nnnnwwwnn';
    $barChar['K'] = 'wnnnnnnww';
    $barChar['L'] = 'nnwnnnnww';
    $barChar['M'] = 'wnwnnnnwn';
    $barChar['N'] = 'nnnnwnnww';
    $barChar['O'] = 'wnnnwnnwn'; 
    $barChar['P'] = 'nnwnwnnwn';
    $barChar['Q'] = 'nnnnnnwww';
    $barChar['R'] = 'wnnnnnwwn';
    $barChar['S'] = 'nnwnnnwwn';
    $barChar['T'] = 'nnnnwnwwn';
    $barChar['U'] = 'wwnnnnnnw';
    $barChar['V'] = 'nwwnnnnnw';
    $barChar['W'] = 'wwwnnnnnn';
    $barChar['X'] = 'nwnnwnnnw';
    $barChar['Y'] = 'wwnnwnnnn';
    $barChar['Z'] = 'nwwnwnnnn';
    $barChar['-'] = 'nwnnnnwnw';
    $barChar['.'] = 'wwnnnnwnn';
    $barChar[' '] = 'nwwnnnwnn';
    $barChar['*'] = 'nwnnwnwnn';
    $barChar['$'] = 'nwnwnwnnn';
    $barChar['/'] = 'nwnwnnnwn';
    $barChar['+'] = 'nwnnnwnwn';
    $barChar['%'] = 'nnnwnwnwn';

    $this->SetFont('Arial','',10);
    $this->Text($xpos, $ypos + $height + 4, $code);
    $this->SetFillColor(0);

    $code = '*'.strtoupper($code).'*';
    for($i=0; $i<strlen($code); $i++){
        $char = $code[$i];
        if(!isset($barChar[$char])){
            $this->Error('Invalid character in barcode: '.$char);
        }
        $seq = $barChar[$char];
        for($bar=0; $bar<9; $bar++){
            if($seq[$bar] == 'n'){
                $lineWidth = $narrow;
            }else{
                $lineWidth = $wide;
            }
            if($bar % 2 == 0){
                $this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
            }
            $xpos += $lineWidth;
        }
        $xpos += $gap;
    }
}
}

//////////////////////////////////////////////////////////////////////////////////////////

//Instanciation of inherited class
$pdf=new PDF();

$pdf->AddFont('AngsanaNew','','angsa.php');
$pdf->AddFont('AngsanaNew','B','angsab.php');
$pdf->AddFont('AngsanaNew','I','angsai.php');
$pdf->AddFont('AngsanaNew','BI','angsai.php');
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','B',16);
$pdf->SetTopMargin(0);
$pdf->SetLeftMargin(10);
$pdf->AliasNbPages();
//$pdf->AddPage();
//$pdf->SetFont('Arial','',12);
//$pdf->SetXY(5,5);
$pdf->Cell(70,25,'',1,0,'C');
$pdf->Line(10, 15, 80, 15);
$pdf->Ln(-1);
        $pdf->Cell(18,6,'',0,0,'L');
        $pdf->Cell(80,6,$center_name_eng,0,0,'L');
        $pdf->Cell(20,6,'',0,0,'L');
        $pdf->Cell(50,6,'',0,0,'L');
$pdf->Ln(5);
        $pdf->Cell(15,6,'Name ',0,0,'L');
        $pdf->Cell(80,6,$ptname.' '.$ptlastname,0,0,'L');
        $pdf->Cell(20,6,'',0,0,'L');
        $pdf->Cell(50,6,'',0,0,'L');
$pdf->Ln(5);
        $pdf->Cell(15,6,'HN',0,0,'L');
        $pdf->Cell(30,6,$MRN,0,0,'L');
        $pdf->Cell(10,6,'AGE',0,0,'L');
        $pdf->Cell(8,6,'32 Y',0,0,'L');
$pdf->Ln(5);		
        $pdf->Cell(15,6,'DATE  ',0,0,'L');
        $pdf->Cell(80,6,'10/01/2009',0,0,'L');
        $pdf->Cell(20,6,'',0,0,'L');
        $pdf->Cell(50,6,'',0,0,'L');
        $pdf->Ln(5);
$pdf->SetXY(133,45);
$pdf->Cell(70,50,'',1,0,'C');

$pdf->SetXY(135,48);
$pdf->Cell(0,0,'Clinic : xxx  ',0,0,'L');
$pdf->SetXY(135,48);
$pdf->Cell(0,10,'Physician : '.$DRNAME.' '.$DRLASTNAME,0,0,'L');
$pdf->SetXY(135,48);
$pdf->Cell(0,20,'Physician : xxx  ',0,0,'L');

$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->Line(10, 42, 200, 42);
$pdf->SetFont('AngsanaNew','',16);

$pdf->Ln(5);
$pdf->WriteHTML($report);

$pdf->Ln(5);
$txt ="เธ เธฒเธฉเธฒเนเธ—เธข";
$txt = $pdf->conv($txt);

//$pdf->EAN13(80, 40, '31-03335'); //barcode 1
$pdf->Code39(140,20,$MRN,1,5); 
$pdf->Line(10, 142, 200, 142);
$pdf->SetXY(142,10);
$pdf->Cell(0,0,'Req No. '.$REQUEST_NO);
$pdf->SetXY(142,15);
$pdf->Cell(0,0,'Test Test!');



/////////////////////Shor Order From Query/////////////////////////////////////

//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.
//$total = number_format($total,',','.','.');

//Create a new PDF file

//Fields Name position
$Y_Fields_Name_position = 45;
//Table position, under Fields Name
//$Y_Table_Position = 26;
$Y_Table_Position = 51;
//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(232,232,232);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',9);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(10);
$pdf->Cell(20,6,'CODE',1,0,'L',1);
$pdf->SetX(30);
$pdf->Cell(100,6,'NAME',1,0,'L',1);
$pdf->SetX(100);
$pdf->Cell(30,6,'PRICE',1,0,'R',1);
$pdf->Ln();
///////////////////

while($row = mysql_fetch_array($result))
{
    $code = $row["XRAY_CODE"];
    $name = substr($row["DESCRIPTION"],0,20);
    $price = $row["CHARGE_TOTAL"];
    $pdf->SetFont('Arial','',9);
	
    $pdf->SetY($Y_Table_Position);
    $pdf->SetX(10);
    $pdf->Cell(20,4,$code,1);
	
	$pdf->SetY($Y_Table_Position);
	$pdf->SetX(30);
	$pdf->Cell(100,4,$name,1);
	
	$pdf->SetY($Y_Table_Position);
	$pdf->SetX(100);
	$pdf->Cell(30,4,$price,1,0,'R');


	$Y_Table_Position = $Y_Table_Position + 4;
    //Sum all the Prices (TOTAL)
	if ($Y_Table_Position > 124){
	$pdf->AddPage();
		$pdf->Cell(0,15,'Req No '.$REQUEST_NO);
		$Y_Table_Position = 15;
	}

    $total = $total+$price;
}

	$pdf->SetY($Y_Table_Position);
	$pdf->SetX(100);
	$pdf->Cell(30,4,$total,1,0,'R');


//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
//$i = 0;
//$pdf->SetY($Y_Table_Position);
//while ($i < $number_of_products)
//{
  //  $pdf->SetX(10);
  //  $pdf->MultiCell(120,4,'',0);
    //$i = $i +1;
//}

//////////////////////////////////////////////////////////
$pdf->Output();

?>
