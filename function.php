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
function ThaiEachDate($vardate) 
	{   
		$_month_name = array("01"=>"มกราคม",  "02"=>"กุมภาพันธ์",  "03"=>"มีนาคม",    
		"04"=>"เมษายน",  "05"=>"พฤษภาคม",  "06"=>"มิถุนายน",    
		"07"=>"กรกฎาคม",  "08"=>"สิงหาคม",  "09"=>"กันยายน",    
		"10"=>"ตุลาคม", "11"=>"พฤศจิกายน",  "12"=>"ธันวาคม");  
		$yy =substr($vardate,0,4);$mm =substr($vardate,5,2);$dd =substr($vardate,8,2);  
		$yy += 543;  
		if ($yy==543)
			{  
				$dateT = "-";  
			}
		else
			{  
				$dateT=$dd ." ".$_month_name[$mm]."  ".$yy;  
			}  
		return $dateT;  
	}  

function ThaiEachDate2($vardate) 
	{   
		$_month_name = array("01"=>"มค.",  "02"=>"กพ.",  "03"=>"มีค.",    
		"04"=>"เมย.",  "05"=>"พค.",  "06"=>"มิย.",    
		"07"=>"กค.",  "08"=>"สค.",  "09"=>"กย.",    
		"10"=>"ตค.", "11"=>"พย.",  "12"=>"ธค.");  
		$yy =substr($vardate,0,4);$mm =substr($vardate,5,2);$dd =substr($vardate,8,2);  
		$yy += 543;  
		if ($yy==543)
			{  
				$dateT = "-";  
			}
		else
			{  
				$dateT=$dd ." ".$_month_name[$mm]."  ".$yy;  
			}  
		return $dateT;  
	}  	
	
function EngEachDate($vardate) 
	{   
		$_month_name = array("01"=>"Jan",  "02"=>"Feb",  "03"=>"Mar",    
		"04"=>"Api",  "05"=>"May",  "06"=>"Jun",    
		"07"=>"Jul",  "08"=>"Aug",  "09"=>"Sep",    
		"10"=>"Oct", "11"=>"Nov",  "12"=>"Dec");  
		$yy =substr($vardate,0,4);$mm =substr($vardate,5,2);$dd =substr($vardate,8,2);  
		//$yy += 543;  
		if ($yy==543)
			{  
				$dateT = "-";  
			}
		else
			{  
				$dateT=$dd ." ".$_month_name[$mm]."  ".$yy;  
			}  
		return $dateT;  
	}      
//echo ThaiEachDate("2008-05-19");  

function Date2MySQL($date)
	{
		$date=split("/",$date);
		$date=$date[2]."-".$date[1]."-".$date[0];
		return $date;
	}

//$date=split("/",$_POST['date']);
// where the $_POST['date'] is a value posted by form in mm/dd/yy format
// The string dated is now in yyyy-mm-dd format
//echo $dated;


function AgeCal($birthday)

	{
		$monthText ='';
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
		$YearText = '';
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

//$birthday = "21/12/2009";
//$birthday = AgeCal($birthday);
//echo $birthday;
/// PAGE ///

function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){     
    global $urlquery_str;  
    $pPrev=$chk_page-1;  
    $pPrev=($pPrev>=0)?$pPrev:0;  
    $pNext=$chk_page+1;  
    $pNext=($pNext>=$total_p)?$total_p-1:$pNext;       
    $lt_page=$total_p-4;  
    if($chk_page>0){    
        echo "<a  href='?s_page=$pPrev&urlquery_str=".$urlquery_str."' class='naviPN'>Prev</a>";  
    }  
    if($total_p>=11){  
        if($chk_page>=4){  
            echo "<a $nClass href='?s_page=0&urlquery_str=".$urlquery_str."'>1</a><a class='SpaceC'>. . .</a>";     
        }  
        if($chk_page<4){  
            for($i=0;$i<$total_p;$i++){    
                $nClass=($chk_page==$i)?"class='selectPage'":"";  
                if($i<=4){  
                echo "<a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }  
                if($i==$total_p-1 ){   
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }         
            }  
        }  
        if($chk_page>=4 && $chk_page<$lt_page){  
            $st_page=$chk_page-3;  
            for($i=1;$i<=5;$i++){  
                $nClass=($chk_page==($st_page+$i))?"class='selectPage'":"";  
                echo "<a $nClass href='?s_page=".intval($st_page+$i)."'>".intval($st_page+$i+1)."</a> ";      
            }  
            for($i=0;$i<$total_p;$i++){    
                if($i==$total_p-1 ){   
                $nClass=($chk_page==$i)?"class='selectPage'":"";  
                echo "<a class='SpaceC'>. . .</a><a $nClass href='?s_page=$i&urlquery_str=".$urlquery_str."'>".intval($i+1)."</a> ";     
                }         
            }                                     
        }     
        if($chk_page>=$lt_page){  
            for($i=0;$i<=4;$i++){  
                $nClass=($chk_page==($lt_page+$i-1))?"class='selectPage'":"";  
                echo "<a $nClass href='?s_page=".intval($lt_page+$i-1)."'>".intval($lt_page+$i)."</a> ";     
            }  
        }          
    }else{  
        for($i=0;$i<$total_p;$i++){    
            $nClass=($chk_page==$i)?"class='selectPage'":"";  
            echo "<a href='?s_page=$i&urlquery_str=".$urlquery_str."' $nClass  >".intval($i+1)."</a> ";     
        }         
    }     
    if($chk_page<$total_p-1){  
        echo "<a href='?s_page=$pNext&urlquery_str=".$urlquery_str."'  class='naviPN'>Next</a>";  
    }  
} 



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

function DateThai3($strDate) // show auto save at dictate.php
{
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];
	return "$strHour:$strMinute:$strSeconds";
}

//$strDate = "2008-08-14 13:42:44";
//echo "ThaiCreate.Com Time now : ".DateThai($strDate);
?>   




