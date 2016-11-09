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
include ("session.php");
if(is_array($_FILES)) 
	{
		if(is_uploaded_file($_FILES['userImage']['tmp_name'])) 
			{
				$sourcePath = $_FILES['userImage']['tmp_name'];
				//$targetPath = "images/user/".$_FILES['userImage']['name'];

				$ext=end(explode(".", $_FILES['userImage']['name']));//gets extension
				$targetPath = "images/user/".$userid.".".$ext;
				move_uploaded_file($sourecPath,"/images/user/".$userid.".".$ext);
				

				if(move_uploaded_file($sourcePath,$targetPath)) 
						{
							echo "<img src=".$targetPath." width=\"100px\" height=\"100px\" />";
						}
			}
	}
?>
