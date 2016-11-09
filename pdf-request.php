<?php
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: 
# Description :  
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################;
$REQUEST_NO = $_GET['REQUEST_NO'];
include ("./pdf/fpdf.php");
define('FPDF_FONTPATH', './pdf/font/');
include ("connectdb.php");

$sql = "SELECT * FROM xray_report INNER JOIN xray_request ON xray_report.ACCESSION = '$ACCESSION' 
INNER JOIN xray_request_detail ON xray_report.ACCESSION=xray_request_detail.ACCESSION 
AND xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
INNER JOIN xray_patient_info ON xray_request.MRN = xray_patient_info.MRN 
INNER JOIN xray_code ON xray_request_detail.XRAY_CODE=xray_code.XRAY_CODE";

$sql = "SELECT xray_patient_info.MRN, xray_patient_info.CENTER_CODE, xray_request_detail.ID  AS ORDERID,xray_request_detail.REQUEST_DATE AS REQ_DATE,xray_request_detail.REQUEST_TIME AS REQ_TIME, xray_request.REQUEST_NO, xray_request_detail.ACCESSION,xray_request_detail.STATUS, xray_patient_info.NAME AS PTNAME, xray_patient_info.LASTNAME  AS PTLASTNAME, xray_patient_info.NAME_ENG AS NAMEENG, xray_patient_info.LASTNAME_ENG AS LASTNAMEENG, xray_code.DESCRIPTION, xray_referrer.NAME, xray_referrer.LASTNAME, xray_request_detail.REQUEST_TIMESTAMP AS ORDERTIME FROM  xray_request INNER JOIN xray_request_detail ON (xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO) INNER JOIN xray_user ON (xray_request.USER = xray_user.CODE) INNER JOIN xray_patient_info ON (xray_request.MRN = xray_patient_info.MRN) INNER JOIN xray_department ON (xray_request.DEPARTMENT_ID = xray_department.DEPARTMENT_ID) INNER JOIN xray_referrer ON (xray_request.REFERRER = xray_referrer.REFERRER_ID)INNER JOIN xray_code ON (xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE) WHERE (xray_request_detail.PAGE = 'ORDER LIST')  and (xray_request_detail.STATUS != 'CANCEL') and (xray_patient_info.CENTER_CODE ='$center_code')order by ORDERTIME desc";

$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	$acc = ": ".$row['ACCESSION'];
	$ptname = ": ".$row['NAME'];
	$ptlastname = ": ".$row['LASTNAME'];
	$report = $row['REPORT'];
	$MRN= ": ".$row['MRN'];
	$procedure = ": ".$row['DESCRIPTION'];

}


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
	// เพิ่มรูปเข้าไปในพิกัด 20 มิลลิเมตรจากซ้าย 5 มิลลิเมตรจากบน และมีขนาดสูง 33 มิลลิเมตร
   // $this->Image('image/banner-report.jpg',30,5,150);
	$this->Image('image/banner-report.jpg',30,5,150);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
    $this->Cell(30,10,'RIS DEMO',1,0,'C');
    //Line break
    $this->Ln(10);
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

function Barcode($x, $y, $barcode, $h, $w, $len)
{
    //Padding
    $barcode=str_pad($barcode, $len-1, '0', STR_PAD_LEFT);
    if($len==12)
        $barcode='0'.$barcode;
    //Add or control the check digit
    if(strlen($barcode)==12)
        $barcode.=$this->GetCheckDigit($barcode);
    elseif(!$this->TestCheckDigit($barcode))
        $this->Error('Incorrect check digit');
    //Convert digits to bars
    $codes=array(
        'A'=>array(
            '0'=>'0001101', '1'=>'0011001', '2'=>'0010011', '3'=>'0111101', '4'=>'0100011',
            '5'=>'0110001', '6'=>'0101111', '7'=>'0111011', '8'=>'0110111', '9'=>'0001011'),
        'B'=>array(
            '0'=>'0100111', '1'=>'0110011', '2'=>'0011011', '3'=>'0100001', '4'=>'0011101',
            '5'=>'0111001', '6'=>'0000101', '7'=>'0010001', '8'=>'0001001', '9'=>'0010111'),
        'C'=>array(
            '0'=>'1110010', '1'=>'1100110', '2'=>'1101100', '3'=>'1000010', '4'=>'1011100',
            '5'=>'1001110', '6'=>'1010000', '7'=>'1000100', '8'=>'1001000', '9'=>'1110100')
        );
    $parities=array(
        '0'=>array('A', 'A', 'A', 'A', 'A', 'A'),
        '1'=>array('A', 'A', 'B', 'A', 'B', 'B'),
        '2'=>array('A', 'A', 'B', 'B', 'A', 'B'),
        '3'=>array('A', 'A', 'B', 'B', 'B', 'A'),
        '4'=>array('A', 'B', 'A', 'A', 'B', 'B'),
        '5'=>array('A', 'B', 'B', 'A', 'A', 'B'),
        '6'=>array('A', 'B', 'B', 'B', 'A', 'A'),
        '7'=>array('A', 'B', 'A', 'B', 'A', 'B'),
        '8'=>array('A', 'B', 'A', 'B', 'B', 'A'),
        '9'=>array('A', 'B', 'B', 'A', 'B', 'A')
        );
    $code='101';
    $p=$parities[$barcode{0}];
    for($i=1;$i<=6;$i++)
        $code.=$codes[$p[$i-1]][$barcode{$i}];
    $code.='01010';
    for($i=7;$i<=12;$i++)
        $code.=$codes['C'][$barcode{$i}];
    $code.='101';
    //Draw bars
    for($i=0;$i<strlen($code);$i++)
    {
        if($code{$i}=='1')
            $this->Rect($x+$i*$w, $y, $w, $h, 'F');
    }
    //Print text uder barcode
    $this->SetFont('Arial', '', 12);
    $this->Text($x, $y+$h+11/$this->k, substr($barcode, -$len));
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
$pdf->SetLeftMargin(20);
$pdf->AliasNbPages();
//$pdf->AddPage();
//$pdf->SetFont('Arial','',12);

$pdf->Ln(5);
        $pdf->Cell(15,6,'ACC ',0,0,'L');
        $pdf->Cell(80,6,$acc,0,0,'L');
        $pdf->Cell(20,6,'Report Date ',0,0,'L');
        $pdf->Cell(50,6,$ptlastname,0,0,'L');
$pdf->Ln(5);
        $pdf->Cell(15,6,'Name ',0,0,'L');
        $pdf->Cell(80,6,$ptname,0,0,'L');
        $pdf->Cell(20,6,'LastName ',0,0,'L');
        $pdf->Cell(50,6,$ptlastname,0,0,'L');
$pdf->Ln(5);		
        $pdf->Cell(15,6,'HN  ',0,0,'L');
        $pdf->Cell(80,6,$MRN,0,0,'L');
        $pdf->Cell(20,6,'Order ',0,0,'L');
        $pdf->Cell(50,6,$procedure,0,0,'L');
        $pdf->Ln(5);

//สร้าง Line เอาไว้ใส่ใน Header จะดีกว่า
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->Line(20, 42, 196, 42);
$pdf->SetFont('AngsanaNew','',16);

$pdf->Ln(5);
$pdf->WriteHTML($report);

$pdf->Ln(5);
$txt ="ภาษาไทย ภาษาไทย";
$txt = $pdf->conv($txt);
//$pdf->Cell(0, 0, $txt, 0, 1, 'C');
//$pdf->Ln(5);
//$pdf->Write(5,$txt);
//$pdf->Ln(3); //New Line
//$pdf->Write(5,'...............................................................................................................................................................................................');
//$pdf->Ln(5);
//$pdf->Write(5,'Report By :');
//$pdf->Write(5,'...............................................................................................................................................................................................');
$pdf->EAN13(80, 40, '1234567890'); //barcode 1
$pdf->Code39(80,80,'1234567890',1,10); 
$pdf->Image('image/banner-report.jpg',10,5,150);
//$pdf->Image('barcode.php',10,15,150);
$pdf->Output();

?>
