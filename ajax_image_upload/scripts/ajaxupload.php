<?php

include ("../../session.php");
include ("../../connectdb.php");


	function uploadImage($fileName, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH = null){
		$folder = $relPath;
		$maxlimit = $maxSize;
		//$allowed_ext = "jpg,jpeg,gif,png,bmp";
		$allowed_ext = "jpg";
		$match = "";
		$filesize = $_FILES[$fileName]['size'];
		if($filesize > 0){	
			$filename = strtolower($_FILES[$fileName]['name']);
			$filename = preg_replace('/\s/', '_', $filename);
			//$filename = $userid;
		   	if($filesize < 1){ 
				$errorList[] = "File size is empty.";
			}
			if($filesize > $maxlimit){ 
				$errorList[] = "File size is too big.";
			}
			if(count($errorList)<1){
				$file_ext = preg_split("/\./",$filename);
				$allowed_ext = preg_split("/\,/",$allowed_ext);
				foreach($allowed_ext as $ext){
					if($ext==end($file_ext)){
						$match = "1"; // File is allowed
						$NUM = time();
						$front_name = substr($file_ext[0], 0, 15);
						$newfilename = $front_name."_".$NUM.".".end($file_ext);
						$filetype = end($file_ext);
						$save = $folder.$newfilename;
						if(!file_exists($save)){
							list($width_orig, $height_orig) = getimagesize($_FILES[$fileName]['tmp_name']);
							if($maxH == null){
								if($width_orig < $maxW){
									$fwidth = $width_orig;
								}else{
									$fwidth = $maxW;
								}
								$ratio_orig = $width_orig/$height_orig;
								$fheight = $fwidth/$ratio_orig;
								
								$blank_height = $fheight;
								$top_offset = 0;
									
							}else{
								if($width_orig <= $maxW && $height_orig <= $maxH){
									$fheight = $height_orig;
									$fwidth = $width_orig;
								}else{
									if($width_orig > $maxW){
										$ratio = ($width_orig / $maxW);
										$fwidth = $maxW;
										$fheight = ($height_orig / $ratio);
										if($fheight > $maxH){
											$ratio = ($fheight / $maxH);
											$fheight = $maxH;
											$fwidth = ($fwidth / $ratio);
										}
									}
									if($height_orig > $maxH){
										$ratio = ($height_orig / $maxH);
										$fheight = $maxH;
										$fwidth = ($width_orig / $ratio);
										if($fwidth > $maxW){
											$ratio = ($fwidth / $maxW);
											$fwidth = $maxW;
											$fheight = ($fheight / $ratio);
										}
									}
								}
								if($fheight == 0 || $fwidth == 0 || $height_orig == 0 || $width_orig == 0){
									die("FATAL ERROR REPORT ERROR CODE [add-pic-line-67-orig] to <a href='http://www.thairis.net'>AT WEB RESULTS</a>");
								}
								if($fheight < 45){
									$blank_height = 45;
									$top_offset = round(($blank_height - $fheight)/2);
								}else{
									$blank_height = $fheight;
								}
							}
							$image_p = imagecreatetruecolor($fwidth, $blank_height);
							$white = imagecolorallocate($image_p, $colorR, $colorG, $colorB);
							imagefill($image_p, 0, 0, $white);
							switch($filetype){
								case "gif":
									$image = @imagecreatefromgif($_FILES[$fileName]['tmp_name']);
								break;
								case "jpg":
									$image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
								break;
								case "jpeg":
									$image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
								break;
								case "png":
									$image = @imagecreatefrompng($_FILES[$fileName]['tmp_name']);
								break;
							}
							@imagecopyresampled($image_p, $image, 0, $top_offset, 0, 0, $fwidth, $fheight, $width_orig, $height_orig);
							switch($filetype){
								case "gif":
									if(!@imagegif($image_p, $save)){
										$errorList[]= "PERMISSION DENIED [GIF]";
									}
								break;
								case "jpg":
									if(!@imagejpeg($image_p, $save, 100)){
										$errorList[]= "PERMISSION DENIED [JPG]";
									}
								break;
								case "jpeg":
									if(!@imagejpeg($image_p, $save, 100)){
										$errorList[]= "PERMISSION DENIED [JPEG]";
									}
								break;
								case "png":
									if(!@imagepng($image_p, $save, 0)){
										$errorList[]= "PERMISSION DENIED [PNG]";
									}
								break;
							}
							@imagedestroy($filename);
						}else{
							$errorList[]= "CANNOT MAKE IMAGE IT ALREADY EXISTS";
						}	
					}
				}		
			}
		}else{
			$errorList[]= "NO FILE SELECTED";
		}
		if(!$match){
		   	$errorList[]= "File type isn't allowed: $filename";
		}
		if(sizeof($errorList) == 0){
			return $fullPath.$newfilename;
		}else{
			$eMessage = array();
			for ($x=0; $x<sizeof($errorList); $x++){
				$eMessage[] = $errorList[$x];
			}
		   	return $eMessage;
		}
	}
	
	$filename = strip_tags($_REQUEST['filename']);
//	$filename = $userid;
	$maxSize = strip_tags($_REQUEST['maxSize']);
	$maxW = strip_tags($_REQUEST['maxW']);
	$fullPath = strip_tags($_REQUEST['fullPath']);
	$relPath = strip_tags($_REQUEST['relPath']);
	$colorR = strip_tags($_REQUEST['colorR']);
	$colorG = strip_tags($_REQUEST['colorG']);
	$colorB = strip_tags($_REQUEST['colorB']);
	$maxH = strip_tags($_REQUEST['maxH']);
	$filesize_image = $_FILES[$filename]['size'];
	if($filesize_image > 0){
		$upload_image = uploadImage($filename, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH);
		if(is_array($upload_image)){
			foreach($upload_image as $key => $value) {
				if($value == "-ERROR-") {
					unset($upload_image[$key]);
				}
			}
			$document = array_values($upload_image);
			for ($x=0; $x<sizeof($document); $x++){
				$errorList[] = $document[$x];
			}
			$imgUploaded = false;
		}else{
			$imgUploaded = true;
		}
	}else{
		$imgUploaded = false;
		$errorList[] = "File Size Empty";
	}
?>
<?php
	if($imgUploaded){
		echo '<img src="./images/success.gif" width="16" height="16" border="0" style="marin-bottom: -4px;" /> Success!<br /><img src="'.$upload_image.'" border="0" />';
 
 mysql_query("UPDATE xray_user SET SIGNATURE_FILE='$filename' WHERE xray_user.ID='$userid'");

 
	}else{
		echo '<img src="./images/error.gif" width="16" height="16px" border="0" style="marin-bottom: -3px;" /> Error(s) Found: ';
		foreach($errorList as $value){
	    		echo $value.', ';
		}
	}
?>