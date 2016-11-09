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
//  Create source image and dimensions
$src_img = imagecreatefromgif($_GET['image']);
$srcsize = getimagesize($_GET['image']);

$dest_x = 900;
$dest_y = (1272 / $srcsize[0]) * $srcsize[1];


//620-876, 800-1130, 850-1201, 900-1272, 950-1342, 1200-1965
$dst_img = imagecreatetruecolor($dest_x, $dest_y);
 
//  Resize image
imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_x, $dest_y, $srcsize[0], $srcsize[1]);

 
//  Output image
header("content-type: image/gif");
imagegif($dst_img);
 
//  Deletes images
imagedestroy($src_img);
imagedestroy($dst_img);

?>