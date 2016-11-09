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
include ("connectdb.php");
//include ("function.php");
//define('FPDF_FONTPATH', 'pdf/font/');
include ("./pdf/fpdf_thai.php");

$ACCESSION = $_GET[ACCESSION];
/////////////////////////////Fuction//////////////////////////////////////
function DateThai02($strDate)
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strDay $strMonthThai $strYear, $strHour:$strMinute:$strSeconds";
}
function AgeCal($birthday)
	{
		$today = date("Y-m-d");
		//list($bday, $bmonth, $byear) = explode("/", $birthday);
		//list($tday, $tmonth, $tyear) = explode("/", $today);
		list($byear, $bmonth, $bday) = explode("-", $birthday);
		list($tyear, $tmonth, $tday) = explode("-", $today);
		if ($byear < 1970)
			{
				$YearAdjust = 1970 - $byear;
				$byear = 1970;
			}
		else 
			{
				$YearAdjust = 0;
			}
		$mBirth = mktime (0, 0, 0, $bmonth,$bday,$byear);
		$mNow = mktime (0, 0, 0, $tmonth,$tday,$tyear);
		$mAge = ($mNow - $mBirth);
		$Year = (date("Y",$mAge)- 1970 + $YearAdjust);
		$month = (date("m",$mAge)-1 );
		$Day = (date("d",$mAge)-1 );
		if ($Year > 0)
			{
				$YearText = $Year."Y ";
			}
		if ($Year > 0 && $month > 0) 
			{
				$monthText = $month."M ";
			}
		if ($Year == 0 && $month == 0 && $Day < 0)
			{
				$Age ="New Born";
			}
		else //($year or $month or $Day !== 0)
			{
				$Age = " ".$YearText. $monthText. $Day. "D ";
			}
		if ($birthday == "")
			{
				$Age = "";
			}
		return($Age);
	}
/////////////////////////////////////////////////////////////////////	

$sql = "SELECT 
			xray_request_detail.ACCESSION, 
			xray_patient_info.NAME, 
			xray_patient_info.LASTNAME, 
			xray_patient_info.MRN, 
			xray_patient_info.SEX, 
			xray_patient_info.BIRTH_DATE, 
			xray_code.DESCRIPTION, 
			xray_department.NAME_THAI,
			xray_request_detail.ARRIVAL_TIME,
			xray_request_detail.APPROVED_TIME,
			xray_report.REPORT,
			xray_user.NAME AS APPROVE_BY,
			xray_user.LASTNAME AS AP_LAST,
			xray_referrer.NAME AS RNAME,
			xray_referrer.LASTNAME AS RLAST
			FROM xray_report 
			INNER JOIN xray_request ON xray_report.ACCESSION = '$ACCESSION' 
			INNER JOIN xray_request_detail ON xray_report.ACCESSION=xray_request_detail.ACCESSION AND xray_request_detail.REQUEST_NO = xray_request.REQUEST_NO
			INNER JOIN xray_patient_info ON xray_request.MRN = xray_patient_info.MRN 
			INNER JOIN xray_code ON xray_request_detail.XRAY_CODE=xray_code.XRAY_CODE
			INNER JOIN xray_department ON xray_department.DEPARTMENT_ID = xray_request.DEPARTMENT_ID
			INNER JOIN xray_user ON xray_report.APPROVE_BY = xray_user.ID
			INNER JOIN xray_referrer on xray_request.REFERRER = xray_referrer.REFERRER_ID";			
$result = mysql_query($sql);

$refer_last = $row[RLAST];

while($row = mysql_fetch_array($result)){
	$acc = ": ".$row[ACCESSION];
	$ptname = ": ".$row[NAME]. " ".$row[LASTNAME];
	$age = ": ".AgeCal($row[BIRTH_DATE]);
	$sex = $row[SEX];
	$report = $row[REPORT];
	$MRN= ": ".$row[MRN];
	$procedure = ": ".$row[DESCRIPTION];
	$department = ": ".$row[NAME_THAI];
	$reporttime = " : ".DateThai02($row[APPROVED_TIME]);
	$requesttime = ": ".DateThai02($row[ARRIVAL_TIME]);
	$approveby = $row[APPROVE_BY]." ".$row[AP_LAST];
	$referrer = $row[RNAME]." ".$row[RLAST];
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
				}

			//Page footer
			function Footer()
				{
					$department = $GLOBALS['approveby'];
					$referrer = $GLOBALS['referrer'];
					//Position at 1.5 cm from bottom
					$this->SetY(-15);
					$this->SetFont('AngsanaNew','I',14);
					$this->Cell(15,6,'Report By : ',0,0,'L');
					$this->Cell(65,6, iconv('UTF-8','TIS-620',$department) ,0,0,'L');		
					$this->Cell(15,6,'Physician : ',0,0,'L');
					$this->Cell(70,6, iconv('UTF-8','TIS-620',$referrer) ,0,0,'L');		
					//Page numer
					$this->Cell(5,6,'Page '.$this->PageNo().'/{nb}',0,0,'C');
					//$this->Cell(0,10,'Curriculum Vitae de ' . $this->ultimoNome . ', ' . $this->primeiroNome . ' | MANVIA, S.A', 0, 0, 'R');
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


$pdf->Ln(5);
        $pdf->Cell(15,6,'Name',0,0,'L');
        $pdf->Cell(65,6,iconv('UTF-8','TIS-620',$ptname),0,0,'L');
        $pdf->Cell(20,6,'Report Time ',0,0,'L');
        $pdf->Cell(50,6,iconv('UTF-8','TIS-620',$reporttime),0,0,'L');
$pdf->Ln(5);
        $pdf->Cell(15,6,'Age ',0,0,'L');
        $pdf->Cell(30,6,iconv('UTF-8','TIS-620',$age),0,0,'L');
        $pdf->Cell(9,6,'Sex : ',0,0,'L');
		$pdf->Cell(26,6,$sex ,0,0,'L');
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

		

//$pdf->Cell(0,20,iconv( 'UTF-8','TIS-620','สวัสดี ชาวไทยครีเอท'),0,1,"C");
		
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetLineWidth(0.2);
$pdf->Line(20, 48, 196, 48);
$pdf->SetFont('AngsanaNew','',16);

$pdf->Ln(5);
$pdf->WriteHTML($report);

//$pdf->Ln(5);
//$txt ="TEST";
//$txt = $pdf->conv($txt);
//$pdf->Cell(0, 0, $txt, 0, 1, 'C');

$pdf->Ln(5);
$pdf->Write(5,$txt);
$pdf->Ln(3); //New Line

$pdf->Line(20, 275, 196, 275);
$pdf->Output();
?>
