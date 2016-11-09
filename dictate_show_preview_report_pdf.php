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
while (ob_get_level())
ob_end_clean();
header("Content-Encoding: None", true);

include ("./pdf/fpdf.php");
include ("connectdb.php");
$ACCESSION = $_GET[ACCESSION];
$sql = "SELECT * FROM xray_request_detail
			LEFT JOIN xray_request ON xray_request.REQUEST_NO = xray_request_detail.REQUEST_NO
			LEFT JOIN xray_patient_info ON xray_patient_info.MRN = xray_request.MRN 
			WHERE xray_request_detail.ACCESSION ='$ACCESSION'";
			
			
$result = mysql_query($sql);
while($row = mysql_fetch_array($result)){
	$acc = ": ".$row[ACCESSION];
	$ptname = ": ".$row[NAME];
	$ptlastname = ": ".$row[LASTNAME];
	$report = $row[TEMP_REPORT];
	$MRN= ": ".$row[MRN];
	$procedure = ": ".$row[DESCRIPTION];
}
$report= preg_replace('#<div\s*/?>#i', '', $report);  // Replace <br > with new line \n
$report= preg_replace('#</div\s*/?>#i', '<br />', $report);  // Replace <br > with new line \n
$report = str_replace("&nbsp;", " ", $report);
$report = str_replace("&amp;", "&", $report);
$report = str_replace("&lt;", "<", $report);
$report = str_replace("&gt;", ">", $report);
$report = str_replace("&quot;", "\"", $report);
$report = str_replace("</p>", "<br />", $report);

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
	$this->Image('image/banner-report.jpg',30,5,150);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Title
    //$this->Cell(30,10,'RIS DEMO',1,0,'C');
    //Line break
    $this->Ln(10);
//	$this->Ln(5);

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
function PDF($orientation='P',$unit='mm',$format='A4')
//function PDF($orientation='L',$unit='mm',$format='A5')
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
}

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
        $pdf->Cell(15,6,'Name',0,0,'L');
        $pdf->Cell(65,6,iconv('UTF-8','TIS-620',$ptname),0,0,'L');
        $pdf->Cell(20,6,'Report Time ',0,0,'L');
        $pdf->Cell(50,6,iconv('UTF-8','TIS-620',$reporttime),0,0,'L');
$pdf->Ln(5);
        $pdf->Cell(15,6,'Age ',0,0,'L');
        $pdf->Cell(65,6,iconv('UTF-8','TIS-620',$dob),0,0,'L');
        $pdf->Cell(20,6,'Exam Time ',0,0,'L');
        $pdf->Cell(50,6,iconv('UTF-8','TIS-620',$requesttime),0,0,'L');
$pdf->Ln(5);		
        $pdf->Cell(15,6,'HN  ',0,0,'L');
        $pdf->Cell(65,6,$MRN,0,0,'L');
        $pdf->Cell(20,6,'Order ',0,0,'L');
        $pdf->Cell(50,6,$procedure,0,0,'L');
$pdf->Ln(5);		
        $pdf->Cell(15,6,'ACC ',0,0,'L');
        $pdf->Cell(65,6,iconv('UTF-8','TIS-620',$acc),0,0,'L');
        $pdf->Cell(20,6,'Department ',0,0,'L');
        $pdf->Cell(50,6,iconv('UTF-8','TIS-620',$department),0,0,'L');
        $pdf->Ln(5);

		
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->Line(20, 48, 196, 48);
$pdf->SetFont('AngsanaNew','',16);

$pdf->Ln(5);
$pdf->WriteHTML($report);

$pdf->Ln(5);
$txt ="Preview Report";
$txt = $pdf->conv($txt);
//$pdf->Cell(0, 0, $txt, 0, 1, 'C');

$pdf->Ln(5);
//$pdf->Write(5,$txt);
$pdf->Ln(3); //New Line
//$pdf->Write(5,'....................................................Preview Report Not Approve Yet.!...............................................................');


$pdf->Output();
?>
