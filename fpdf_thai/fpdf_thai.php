<?php
/*******************************************************************************
* Software: FPDF Thai Positioning Improve                                      *
* Version:  1.0                                                                *
* Date:     2005-04-30                                                         *
* Advisor:  Mr. Wittawas Puntumchinda                                          *
* Coding:   Mr. Sirichai Fuangfoo                                              *
* License:  Freeware                                                           *
*                                                                              *
* You may use, modify and redistribute this software as you wish.              *
*******************************************************************************/

require('fpdf.php');

class FPDF_Thai extends FPDF
{
var $txt_error;	
var $s_error;
var $string_th;
var $s_th;
var $pointX;
var $pointY;
var $curPointX;
var $checkFill;
var $array_th;

/****************************************************************************************
* ประเภท: Function ของ Class FPDF_TH													
* อ้างอิง: Function MultiCell ของ Class FPDF											
* การทำงาน: ใช้ในการพิมพ์ข้อความหลายบรรทัดของเอกสาร PDF 										
* รูบแบบ: MultiCell (	$w = ความกว้างของCell,												
*						$h = ความสูงของCell,												
*						$txt = ข้อความที่จะพิมพ์,													
*						$border = กำหนดการแสดงเส้นกรอบ(0 = ไม่แสดง, 1= แสดง)	,				
*						$align = ตำแหน่งข้อความ(L = ซ้าย, R = ขวา, C = กึ่งกลาง, J = กระจาย),
*						$fill = กำหนดการแสดงสีของCell(0 = ไม่แสดง, 1 = แสดง)					
*					)			
*****************************************************************************************/
function MultiCell($w,$h,$txt,$border=0,$align='J',$fill=0)
{
	//Output text with automatic or explicit line breaks
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 && $s[$nb-1]=="\n")
		$nb--;
	$b=0;
	if($border)
	{
		if($border==1)
		{
			$border='LTRB';
			$b='LRT';
			$b2='LR';
		}
		else
		{
			$b2='';
			if(strpos($border,'L')!==false)
				$b2.='L';
			if(strpos($border,'R')!==false)
				$b2.='R';
			$b=(strpos($border,'T')!==false) ? $b2.'T' : $b2;
		}
	}
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$ns=0;
	$nl=1;
	while($i<$nb)
	{
		//Get next character
		$c=$s{$i};
		if($c=="\n")
		{
			//Explicit line break
			if($this->ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			$this->MCell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$ns=0;
			$nl++;
			if($border && $nl==2)
				$b=$b2;
			continue;
		}
		if($c==' ')
		{
			$sep=$i;
			$ls=$l;
			$ns++;
		}
		$l+=$cw[$c];
		if($l>$wmax)
		{
			//Automatic line break
			if($sep==-1)
			{
				if($i==$j)
					$i++;
				if($this->ws>0)
				{
					$this->ws=0;
					$this->_out('0 Tw');
				}
				$this->MCell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
			}
			else
			{
				if($align=='J')
				{
					$this->ws=($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
					$this->_out(sprintf('%.3f Tw',$this->ws*$this->k));
				}
				$this->MCell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
				$i=$sep+1;
			}
			$sep=-1;
			$j=$i;
			$l=0;
			$ns=0;
			$nl++;
			if($border && $nl==2)
				$b=$b2;
		}
		else
			$i++;
	}
	//Last chunk
	if($this->ws>0)
	{
		$this->ws=0;
		$this->_out('0 Tw');
	}
	if($border && strpos($border,'B')!==false)
		$b.='B';
	$this->MCell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
	$this->x=$this->lMargin;
}

/****************************************************************************************
* ประเภท  : Function	ของ Class FPDF_TH													
* อ้างอิง	   : Function Cell	ของ Class FPDF												
* การทำงาน  : ใช้ในการพิมพ์ข้อความทีละบรรทัดของเอกสาร PDF 											
* รูบแบบ  : Cell (	$w = ความกว้างของCell,													
*					$h = ความสูงของCell,													
*					$txt = ข้อความที่จะพิมพ์,													
*					$border = กำหนดการแสดงเส้นกรอบ(0 = ไม่แสดง, 1= แสดง),					
*					$ln = ตำแหน่งที่อยู่ถัดไปจากเซลล์(0 = ขวา, 1 = บรรทัดถัดไป, 2 = ด้านล่าง),
*					$align = ตำแหน่งข้อความ(L = ซ้าย, R = ขวา, C = กึ่งกลาง, T = บน, B = ล่าง),	
*					$fill = กำหนดการแสดงสีของCell(0 = ไม่แสดง, 1 = แสดง),					
*					$link = URL ที่ต้องการให้ข้อความเชื่อมโยงไปถึง									
*				)	
*****************************************************************************************/
function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
{
	$this->checkFill="";
	$k=$this->k;
	if($this->y+$h>$this->PageBreakTrigger && !$this->InFooter && $this->AcceptPageBreak())
	{
		//ขึ้นหน้าใหม่อัตโนมัต
		$x=$this->x;
		$ws=$this->ws;
		if($ws>0)
		{
			$this->ws=0;
			$this->_out('0 Tw');
		}
		$this->AddPage($this->CurOrientation);
		$this->x=$x;
		if($ws>0)
		{
			$this->ws=$ws;
			$this->_out(sprintf('%.3f Tw',$ws*$k));
		}
	}
	//กำหนดความกว้างเซลล์เท่ากับหน้ากระดาษ
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$this->s_th='';
	//กำหนดการแสดงเส้นกรอบ 4 ด้าน และสีกรอบ
	if($fill==1 || $border==1)
	{
		if($fill==1)
			$op=($border==1) ? 'B' : 'f';
		else
			$op='S';
		$this->s_th=sprintf('%.2f %.2f %.2f %.2f re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
		if($op=='f')
			$this->checkFill=$op;
	}
	//กำหนดการแสดงเส้นกรอบทีละเส้น
	if(is_string($border))
	{
		$x=$this->x;
		$y=$this->y;
		if(strpos($border,'L')!==false)
			$this->s_th.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
		if(strpos($border,'T')!==false)
			$this->s_th.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
		if(strpos($border,'R')!==false)
			$this->s_th.=sprintf('%.2f %.2f m %.2f %.2f l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
		if(strpos($border,'B')!==false)
			$this->s_th.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	}


	if($txt!=='')
	{			
		$x=$this->x;
		$y=$this->y;
		//กำหนดการจัดข้อความในเซลล์ตามแนวระดับ
		if(strpos($align,'R')!==false)
			$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
		elseif(strpos($align,'C')!==false)
			$dx=($w-$this->GetStringWidth($txt))/2;
		else
			$dx=$this->cMargin;
		//กำหนดการจัดข้อความในเซลล์ตามแนวดิ่ง
		if(strpos($align,'T')!==false)
			$dy=$h-(.7*$this->k*$this->FontSize);
		elseif(strpos($align,'B')!==false)
			$dy=$h-(.3*$this->k*$this->FontSize);
		else
			$dy=.5*$h;
		//กำหนดการขีดเส้นใต้ข้อความ
		if($this->underline)
		{	
			//กำหนดบันทึกกราฟิก
			if($this->ColorFlag)
				$this->s_th.=' q '.$this->TextColor.' ';
			//ขีดเส้นใต้ข้อความ0
			$this->s_th.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
			//กำหนดคืนค่ากราฟิก
			if($this->ColorFlag)
				$this->s_th.=' Q ';
		}
		//กำหนดข้อความเชื่อมโยงไปถึง
		if($link)
			$this->Link($this->x,$this->y,$this->GetStringWidth($txt),$this->FontSize,$link);
		/*if($s)
			$this->_out($s);
		$s='';*/
		//ตัดอักษรออกจากข้อความ ทีละตัวเก็บลงอะเรย์
		$this->array_th=substr($txt,0);
		$i=0;
		$this->pointY=($this->h-($y+$dy+.3*$this->FontSize))*$k;
		$this->curPointX=($x+$dx)*$k;
		$this->string_th='';
		$this->txt_error=0;

		while($i<=strlen($txt))
		{	
			//กำหนดตำแหน่งที่จะพิมพ์อักษรในเซลล์
			$this->pointX=($x+$dx+.02*$this->GetStringWidth($this->array_th[$i-1]))*$k;
			if(($this->array_th[$i]=='่')||($this->array_th[$i]=='้')||($this->array_th[$i]=='๊')||($this->array_th[$i]=='๋')||($this->array_th[$i]=='์')||($this->array_th[$i]=='ิ')||($this->array_th[$i]=='ี')||($this->array_th[$i]=='ึ')||($this->array_th[$i]=='ื')||($this->array_th[$i]=='็')||($this->array_th[$i]=='ั')||($this->array_th[$i]=='ำ')||($this->array_th[$i]=='ุ')||($this->array_th[$i]=='ู'))
			{
				//ตรวจสอบอักษร ปรับตำแหน่งและทำการพิมพ์
				$this->_checkT($i);

				if($this->txt_error==0)
					$this->string_th.=$this->array_th[$i];
				else
				{
					$this->txt_error=0;
				}
			}
			else
				$this->string_th.=$this->array_th[$i];

			//เลื่อนตำแหน่ง x ไปที่ตัวที่จะพิมพ์ถัดไป
			$x=$x+$this->GetStringWidth($this->array_th[$i]);
			$i++;
		}
		$this->TText($this->curPointX,$this->pointY,$this->string_th);
		/*$this->s_th.=$this->s_hidden.$this->s_error;*/
		//$this->s_th.=$this->s_error;
		if($this->s_th)
			$this->_out($this->s_th);
	}
	else
		//นำค่าไปแสดงเมื่อไม่มีข้อความ
		$this->_out($this->s_th);

	$this->lasth=$h;
	//ตรวจสอบการวางตำแหน่งของเซลล์ถัดไป
	if($ln>0)
	{
		//ขึ้นบรรทัดใหม่
		$this->y+=$h;
		if($ln==1)
			$this->x=$this->lMargin;
	}
	else
		$this->x+=$w;
}

/********************************************************************************
* ใช้งาน: Function	Cell ของ Class FPDF_TH										
* การทำงาน: ใช้ในการตรวจสอบอักษร และปรับตำแหน่งก่อนที่จะทำการพิมพ์							
* ความต้องการ: $this->array_th = อะเรย์ของอักษรที่ตัดออกจากข้อความ						
*						$i = ลำดับปัจจุบันในอะเรย์ที่จะทำการตรวจสอบ						
*						$s = สายอักขระของโคด PDF
*********************************************************************************/
function _checkT($i)
{   
	$pointY=$this->pointY;
	$pointX=$this->pointX;
	//ตวจสอบการแสดงผลของตัวอักษรเหนือสระบน
	if($this->_errorTh($this->array_th[$i])==1)
	{
		//ตรวจสอบตัวอักษรก่อนหน้านั้นไม่ใช่สระบน ปรับตำแหน่งลง	
		if(($this->_errorTh($this->array_th[$i-1])!=2)&&($this->array_th[$i+1]!="ำ"))
		{
			//ถ้าตัวนั้นเป็นไม้เอกหรือไม้จัตวา
			if($this->array_th[$i]=="่"||$this->array_th[$i]=="๋")
			{
				$pointY=$this->pointY-.2*$this->FontSize*$this->k;
				$this->txt_error=1;
			}
			//ถ้าตัวนั้นเป็นไม้โทหรือไม้ตรี
			elseif($this->array_th[$i]=='้'||$this->array_th[$i]=='๊')
			{
				$pointY=$this->pointY-.23*$this->FontSize*$this->k;
				$this->txt_error=1;
			}
			//ถ้าตัวนั้นเป็นการันต์
			else
			{
				$pointY=$this->pointY-.17*$this->FontSize*$this->k;
				$this->txt_error=1;
			}
		}
			
		//ตรวจสอบตัวอักษรตัวก่อนหน้านั้นเป็นตัวอักษรหางยาวบน
		if($this->_errorTh($this->array_th[$i-1])==3)		
		{
			//ถ้าตัวนั้นเป็นไม้เอกหรือไม้จัตวา
			if($this->array_th[$i]=="่"||$this->array_th[$i]=="๋")
			{
				$pointX=$this->pointX-.17*$this->GetStringWidth($this->array_th[$i-1])*$this->k;
				$this->txt_error=1;
			}
			//ถ้าตัวนั้นเป็นไม้โทหรือไม้ตรี
			elseif($this->array_th[$i]=='้'||$this->array_th[$i]=='๊')
			{			
				$pointX=$this->pointX-.25*$this->GetStringWidth($this->array_th[$i-1])*$this->k;
				$this->txt_error=1;
			}
			//ถ้าตัวนั้นเป็นการันต์
			else
			{
				$pointX=$this->pointX-.4*$this->GetStringWidth($this->array_th[$i-1])*$this->k;
				$this->txt_error=1;
			}
		}

		//ตรวจสอบตัวอักษรตัวก่อนหน้านั้นไปอีกเป็นตัวอักษรหางยาวบน	
		if($this->_errorTh($this->array_th[$i-2])==3)	
		{					
			//ถ้าตัวนั้นเป็นไม้เอกหรือไม้จัตวา
			if($this->array_th[$i]=="่"||$this->array_th[$i]=="๋")
			{
				$pointX=$this->pointX-.17*$this->GetStringWidth($this->array_th[$i-2])*$this->k;
				$this->txt_error=1;
			}
			//ถ้าตัวนั้นเป็นไม้โทหรือไม้ตรี
			elseif($this->array_th[$i]=='้'||$this->array_th[$i]=='๊')
			{						
				$pointX=$this->pointX-.25*$this->GetStringWidth($this->array_th[$i-2])*$this->k;
				$this->txt_error=1;
			}
			//ถ้าตัวนั้นเป็นการันต์
			else
			{
				$pointX=$this->pointX-.4*$this->GetStringWidth($this->array_th[$i-2])*$this->k;						
				$this->txt_error=1;
			}
		}
	}
	//จบการตรวจสอบตัวอักษรเหนือสระบน

	//ตวจสอบการแสดงผลของตัวอักษรสระบน
	elseif($this->_errorTh($this->array_th[$i])==2)
	{
		//ตรวจสอบตัวอักษรตัวก่อนหน้านั้นเป็นตัวอักษรหางยาวบน
		if($this->_errorTh($this->array_th[$i-1])==3)	
		{
			$pointX=$this->pointX-.17*$this->GetStringWidth($this->array_th[$i-1])*$this->k;
			$this->txt_error=1;
		}
		//ถ้าตัวนั้นเป็นสระอำ
		if($this->array_th[$i]=="ำ")
			//ตรวจสอบตัวอักษรตัวก่อนหน้านั้นเป็นตัวอักษรหางยาวบน
			if($this->_errorTh($this->array_th[$i-2])==3)	
			{
				$pointX=$this->pointX-.17*$this->GetStringWidth($this->array_th[$i-2])*$this->k;
				$this->txt_error=1;
			}
	}																						
	//จบการตรวจสอบตัวอักษรสระบน

	//ตวจสอบการแสดงผลของตัวอักษรสระล่าง
	elseif($this->_errorTh($this->array_th[$i])==6)
	{
		//ตรวจสอบตัวอักษรตัวก่อนหน้านั้นเป็นตัวอักษร ญ. กับ ฐ.
		if($this->_errorTh($this->array_th[$i-1])==5)						
		{	//$this->string_th		$this->curPointX
			$this->TText($this->curPointX,$this->pointY,$this->string_th);
			$this->string_th='';
			$this->curPointX=$this->pointX;

			if($this->checkFill=='f')
				$this->s_th.=' q ';
			else
				$this->s_th.=' q 1 g ';
			//สร้างสี่เหลี่ยมไปปิดที่ฐานล่างของตัวอักษร ญ. กับ ฐ. $s.
			$this->s_th.=sprintf('%.2f %.2f %.2f %.2f re f ',$this->pointX-$this->GetStringWidth($this->array_th[$i-1])*$this->k,$this->pointY-.27*$this->FontSize*$this->k,.9*$this->GetStringWidth($this->array_th[$i-1])*$this->k,.25*$this->FontSize*$this->k);
			$this->s_th.=' Q ';

			$this->txt_error=1;
		}
		//ตรวจสอบตัวอักษรตัวก่อนหน้านั้นเป็นอักขระ ฏ. กับ ฎ.
		elseif($this->_errorTh($this->array_th[$i-1])==4)							
		{
			$pointY=$this->pointY-.25*$this->FontSize*$this->k;
			$this->txt_error=1;
		}
		//จบการตรวจสอบตัวอักษรสระล่าง
	}																						
	//จบการตรวจสอบตัวอักษระสระล่าง
		
	if($this->txt_error==1)
		$this->TText($pointX,$pointY,$this->array_th[$i]);
}

/********************************************************************************
* ใช้งาน: Function	_checkT ของ Class FPDF_TH				
* การทำงาน: ใช้ในการตรวจสอบอักษรที่อาจจะทำให้เกิดการพิมพ์ที่ผิดพลาด			
* ความต้องการ: $char_th = ตัวอักษรที่จะใช้ในการเปรียบเทียบ			
*********************************************************************************/
function _errorTh($char_th)
{	
	$txt_error=0;
	//ตัวอักษรบน-บน
	if(($char_th=='่')||($char_th=='้')||($char_th=='๊')||($char_th=='๋')||($char_th=='์'))
		$txt_error=1;
	//ตัวอักษรบน
	elseif(($char_th=='ิ')||($char_th=='ี')||($char_th=='ึ')||($char_th=='ื')||($char_th=='็')||($char_th=='ั')||($char_th=='ำ'))
		$txt_error=2;
	//ตัวอักษรกลาง-บน
	elseif(($char_th=='ป')||($char_th=='ฟ')||($char_th=='ฝ'))
		$txt_error=3;
	//ตัวอักษรกลาง-ล่าง
	elseif(($char_th=='ฎ')||($char_th=='ฏ'))
		$txt_error=4;
	//ตัวอักษรกลาง-ล่าง
	elseif(($char_th=='ญ')||($char_th=='ฐ'))
		$txt_error=5;
	//ตัวอักษรสระล่าง
	elseif(($char_th=='ุ')||($char_th=='ู'))
		$txt_error=6;
	else
		$txt_error=0;
	return $txt_error;
}

/********************************************************************************
* ใช้งาน: Function	_checkT ของ Class FPDF_TH									*
* การทำงาน: ใช้ในพิมพ์ตัวอักษรที่ตรวจสอบแล้ว									*
* ความต้องการ: $txt_th = ตัวอักษร 1 ตัว ที่ตรวจสอบแล้ว							*
*						$s = สายอักขระของโคด PDF								*
*********************************************************************************/
function TText($pX,$pY,$txt_th)
{	
	//ตวจสอบการใส่สีเซลล์
	if($this->ColorFlag)
		$this->s_th.=' q '.$this->TextColor.' ';
	$txt_th2=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt_th)));
	//ระบุตำแหน่ง และพิมพ์ตัวอักษร
	$this->s_th.=sprintf(' BT %.2f %.2f Td (%s) Tj ET ',$pX,$pY,$txt_th2);
	if($this->ColorFlag)
		$this->s_th.=' Q ';
}

/****************************************************************************************
* ใช้งาน: called by function MultiCell within this class								
* อ้างอิง: Function Cell	ของ Class FPDF												
* การทำงาน: ใช้ในการพิมพ์ข้อความทีละบรรทัดของเอกสาร PDF 											
* รูบแบบ: MCell (	$w = ความกว้างของCell,													
*					$h = ความสูงของCell,													
*					$txt = ข้อความที่จะพิมพ์,													
*					$border = กำหนดการแสดงเส้นกรอบ(0 = ไม่แสดง, 1= แสดง),					
*					$ln = ตำแหน่งที่อยู่ถัดไปจากเซลล์(0 = ขวา, 1 = บรรทัดถัดไป, 2 = ด้านล่าง),
*					$align = ตำแหน่งข้อความ(L = ซ้าย, R = ขวา, C = กึ่งกลาง, T = บน, B = ล่าง),	
*					$fill = กำหนดการแสดงสีของCell(0 = ไม่แสดง, 1 = แสดง)			
*					$link = URL ที่ต้องการให้ข้อความเชื่อมโยงไปถึง		
*				)
*****************************************************************************************/
function MCell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
{
	$this->checkFill="";
	$k=$this->k;
	if($this->y+$h>$this->PageBreakTrigger && !$this->InFooter && $this->AcceptPageBreak())
	{
		//ขึ้นหน้าใหม่อัตโนมัต
		$x=$this->x;
		$ws=$this->ws;
		if($ws>0)
		{
			$this->ws=0;
			$this->_out('0 Tw');
		}
		$this->AddPage($this->CurOrientation);
		$this->x=$x;
		if($ws>0)
		{
			$this->ws=$ws;
			$this->_out(sprintf('%.3f Tw',$ws*$k));
		}
	}
	//กำหนดความกว้างเซลล์เท่ากับหน้ากระดาษ
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$this->s_th='';
	//กำหนดการแสดงเส้นกรอบ 4 ด้าน และสีกรอบ
	if($fill==1 || $border==1)
	{
		if($fill==1)
			$op=($border==1) ? 'B' : 'f';
		else
			$op='S';
		$this->s_th=sprintf('%.2f %.2f %.2f %.2f re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
		if($op=='f')
			$this->checkFill=$op;
	}
	//กำหนดการแสดงเส้นกรอบทีละเส้น
	if(is_string($border))
	{
		$x=$this->x;
		$y=$this->y;
		if(strpos($border,'L')!==false)
			$this->s_th.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
		if(strpos($border,'T')!==false)
			$this->s_th.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
		if(strpos($border,'R')!==false)
			$this->s_th.=sprintf('%.2f %.2f m %.2f %.2f l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
		if(strpos($border,'B')!==false)
			$this->s_th.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	}


	if($txt!=='')
	{			
		$x=$this->x;
		$y=$this->y;
		//กำหนดการจัดข้อความในเซลล์ตามแนวระดับ
		if(strpos($align,'R')!==false)
			$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
		elseif(strpos($align,'C')!==false)
			$dx=($w-$this->GetStringWidth($txt))/2;
		else
			$dx=$this->cMargin;
		//กำหนดการจัดข้อความในเซลล์ตามแนวดิ่ง
		if(strpos($align,'T')!==false)
			$dy=$h-(.7*$this->k*$this->FontSize);
		elseif(strpos($align,'B')!==false)
			$dy=$h-(.3*$this->k*$this->FontSize);
		else
			$dy=.5*$h;
		//กำหนดการขีดเส้นใต้ข้อความ
		if($this->underline)
		{	
			//กำหนดบันทึกกราฟิก
			if($this->ColorFlag)
				$this->s_th.='q '.$this->TextColor.' ';
			//ขีดเส้นใต้ข้อความ0
			$this->s_th.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
			//กำหนดคืนค่ากราฟิก
			if($this->ColorFlag)
				$this->s_th.=' Q';
		}
		//กำหนดข้อความเชื่อมโยงไปถึง
		if($link)
			$this->Link($this->x,$this->y,$this->GetStringWidth($txt),$this->FontSize,$link);
		if($this->s_th)
			$this->_out($this->s_th);
		$this->s_th='';
		//ตัดอักษรออกจากข้อความ ทีละตัวเก็บลงอะเรย์
		$this->array_th=substr($txt,0);
		$i=0;

		while($i<=strlen($txt))
		{	
			//กำหนดตำแหน่งที่จะพิมพ์อักษรในเซลล์
			$this->pointX=($x+$dx+.02*$this->GetStringWidth($this->array_th[$i-1]))*$k;
			$this->pointY=($this->h-($y+$dy+.3*$this->FontSize))*$k;
			//ตรวจสอบอักษร ปรับตำแหน่งและทำการพิมพ์
			$this->_checkT($i);
			if($this->txt_error==0)
				$this->TText($this->pointX,$this->pointY,$this->array_th[$i]);
			else
			{
				$this->txt_error=0;
			}
			//ตรวจสอบการใส่เลขหน้า
			if($this->array_th[$i]=='{'&&$this->array_th[$i+1]=='n'&&$this->array_th[$i+2]=='b'&&$this->array_th[$i+3]=='}')
				$i=$i+3;
			//เลื่อนตำแหน่ง x ไปที่ตัวที่จะพิมพ์ถัดไป
			$x=$x+$this->GetStringWidth($this->array_th[$i]);
			$i++;
		}
		$this->_out($this->s_th);
	}
	else
		//นำค่าไปแสดงเมื่อไม่มีข้อความ
		$this->_out($this->s_th);

	$this->lasth=$h;
	//ตรวจสอบการวางตำแหน่งของเซลล์ถัดไป
	if($ln>0)
	{
		//ขึ้นบรรทัดใหม่
		$this->y+=$h;
		if($ln==1)
			$this->x=$this->lMargin;
	}
	else
		$this->x+=$w;
}
//End of class
}

?>
