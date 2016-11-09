<?php
// session_start ();

$id1=$_GET["id"];

#     $dirname = $_POST["DirectoryName"];  
#     $filename = ("/folder/" . "$dirname" . "/");  
#    
#     if (file_exists($filename)) {  
#         echo "The directory $dirname exists";  
#     } else {  
#         mkdir("folder/" . "$dirname", 0777);  
#         echo "The directory $dirname was successfully created.";  
#     }  
////////////// 
#     $dirname = $_POST["DirectoryName"];    
#     $filename = "/folder/{$dirname}/";    
#      
#     if (file_exists($filename)) {    
#         echo "The directory {$dirname} exists";    
#     } else {    
#         mkdir("folder/{$dirname}", 0777);    
#         echo "The directory {$dirname} was successfully created.";    
#     }    

#
#include("include/session.php"); 
//note the ! before the file_exists
#if(!file_exists($session->username)) 
#{ 
#mkdir($session->username); 
#echo "made"; 
#} 
#else 
#{ 
#echo "already made"; 
#} 
 





list($id, $acc) = split('[=]', $id1);

mkdir("$id",0777);
	mkdir("$acc");
if ($id=='')
{
	$id ="temp";
	mkdir("$id");

}

  $uploaddir = dirname ( $_SERVER['SCRIPT_FILENAME'] ) ."/".$id."/";

 if ( count ( $_FILES ) > 0 )
 {
  $arrfile = pos($_FILES);
  $uploadfile = $uploaddir . basename ( $arrfile['name'] );
  $_SESSION['filelist'][] = $arrfile['name'];
  if ( move_uploaded_file ( $arrfile['tmp_name'], $uploadfile ) )
  

echo "UploadComplete();";

  
 }
 ?>