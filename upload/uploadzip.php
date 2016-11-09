<? 
//    include "../session.php";  
?>
 <html>
 <head>
  <!-- Include the javascript -->
 </head>
 <body bgcolor=#F4F4F4>

 <?
$id=$_GET['id'];
echo "$id";

?>
<center>Upload Zip File</center>
<center>
<table bgcolor=white><tr><td>
<center>
 <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
  codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" 
  width="600"
  height="370"
   id="fileUpload"
  align="middle">
 <param name="allowScriptAccess" value="sameDomain" />
 <param name="movie" value="FlashFileUpload.swf" />
 <param name="quality" value="high" />
 <param name="wmode" value="transparent">
 <param name="flashvars" value='
  &completeFunction=UploadComplete()
  &fileTypes=*.zip%3b+*.rar%3b+*.7z%3b+*.tar%3b+*.gz
  &fileTypeDescription=Compression
  &totalUploadSize=2097152000
  &fileSizeLimit=524288000

  
  &uploadPage=uploadfiles.php?id=<? echo ($id);?>'>
 <embed 
  src="FlashFileUpload.swf"
  flashvars='
   &completeFunction=UploadComplete()
   &fileTypes=*.zip%3b+*.rar%3b+*.7z%3b+*.tar%3b+*.gz
   &fileTypeDescription=Compression
   &totalUploadSize=2097152000
   &fileSizeLimit=524288000
   &uploadPage=uploadfiles.php?id=<? echo $id;?>'
  quality="high"
  wmode="transparent"
  width="600"
  height="370"
  name="fileUpload"
  align="middle"
  allowScriptAccess="sameDomain"
  type="application/x-shockwave-flash"
  pluginspage="http://www.macromedia.com/go/getflashplayer" />
 </object>
</center>
<center><img src=../image/upload.jpg></center>
</td></tr></table></center>
 <script language="javascript">
  function UploadComplete()
  {
   window.location = 'compleate.php';
  }
 </script>
 </body>
 </html>
