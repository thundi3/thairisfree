<?php // content="text/plain; charset=utf-8"
############################################
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 8 Nov 2016
# File name: 
# Description :  
# http://www.thairis.net
# Email : info.xraythai@gmail.com
############################################
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_pie.php');
require_once ('jpgraph/jpgraph_pie3d.php');
include ("connectdb.php");
//$gJpgBrandTiming=true;

// Some data

 $sql = "SELECT xray_request_detail.ID, xray_code.XRAY_TYPE_CODE FROM xray_request_detail 
			LEFT JOIN xray_code ON xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE 
			WHERE XRAY_TYPE_CODE= 'XRAY' AND xray_request_detail.REQUEST_DATE = DATE(NOW())";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	$XRAY = $num_rows;

 $sql = "SELECT xray_request_detail.ID, xray_code.XRAY_TYPE_CODE FROM xray_request_detail 
			LEFT JOIN xray_code ON xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE 
			WHERE XRAY_TYPE_CODE= 'US' AND xray_request_detail.REQUEST_DATE = DATE(NOW())";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	$US = $num_rows;	
	
 $sql = "SELECT xray_request_detail.ID, xray_code.XRAY_TYPE_CODE FROM xray_request_detail 
			LEFT JOIN xray_code ON xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE 
			WHERE XRAY_TYPE_CODE= 'MRI' AND xray_request_detail.REQUEST_DATE = DATE(NOW())";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	$MRI = $num_rows;

 $sql = "SELECT xray_request_detail.ID, xray_code.XRAY_TYPE_CODE FROM xray_request_detail 
			LEFT JOIN xray_code ON xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE 
			WHERE XRAY_TYPE_CODE= 'MAMMO' AND xray_request_detail.REQUEST_DATE = DATE(NOW())";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	$MAMMO = $num_rows;

 $sql = "SELECT xray_request_detail.ID, xray_code.XRAY_TYPE_CODE FROM xray_request_detail 
			LEFT JOIN xray_code ON xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE 
			WHERE XRAY_TYPE_CODE= 'BMD' AND xray_request_detail.REQUEST_DATE = DATE(NOW())";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	$BMD = $num_rows;
	
 $sql = "SELECT xray_request_detail.ID, xray_code.XRAY_TYPE_CODE FROM xray_request_detail 
			LEFT JOIN xray_code ON xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE 
			WHERE XRAY_TYPE_CODE= 'FLURO' AND xray_request_detail.REQUEST_DATE = DATE(NOW())";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	$FLURO = $num_rows;	
	
 $sql = "SELECT xray_request_detail.ID, xray_code.XRAY_TYPE_CODE FROM xray_request_detail 
			LEFT JOIN xray_code ON xray_request_detail.XRAY_CODE = xray_code.XRAY_CODE 
			WHERE XRAY_TYPE_CODE= 'CT' AND xray_request_detail.REQUEST_DATE = DATE(NOW())";
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	$CT = $num_rows;
	
$today = date("d-F-Y : H:i");
$total = $CT+$MRI+$MAMMO+$US+$FLURO+$BMD+$XRAY;
	
if ($XRAY == 0)
	{
		//exit;
		$XRAY =1;
	}
$data = array($CT,$MRI,$MAMMO,$US,$FLURO,$BMD,$XRAY);

// Create the Pie Graph. 
$graph = new PieGraph(400,300,'auto');
$graph->SetShadow();

// Set A title for the plot
$graph->title->Set("$total Studies Today ($today)");
$graph->title->SetFont(FF_FONT1,FS_BOLD);

// Create
$p1 = new PiePlot3D($data);
$p1->SetLegends(array("CT (%d)","MRI (%d)","MAMMO (%d)","US (%d)","FLURO (%d)","BMD (%d)","XRAY (%d)"));
$targ=array("pie3d_csimex1.php?v=1","pie3d_csimex1.php?v=2","pie3d_csimex1.php?v=3",
            "pie3d_csimex1.php?v=4","pie3d_csimex1.php?v=5","pie3d_csimex1.php?v=6");
			
//$p1->SetLegends(array("CT (%d)","MRI","MAMMO","XRAY","BMD","FLURO","US"));
//$targ=array("pie3d_csimex1.php?v=1","pie3d_csimex1.php?v=2","pie3d_csimex1.php?v=3",
//            "pie3d_csimex1.php?v=4","pie3d_csimex1.php?v=5","pie3d_csimex1.php?v=6");
			
$alts=array("val=%d","val=%d","val=%d","val=%d","val=%d","val=%d");
$p1->SetCSIMTargets($targ,$alts);

// Use absolute labels
$p1->SetLabelType(1);
$p1->value->SetFormat("%d ");

// Move the pie slightly to the left
$p1->SetCenter(0.5,0.4);

$graph->Add($p1);


// Send back the HTML page which will call this script again
// to retrieve the image.
$graph->StrokeCSIM();

?>

