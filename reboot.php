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
include "session.php";

//echo $usertype.$superadmin;
if (($usertype !== 'ADMIN') AND ($superadmin == 0) AND ($admin == 0))
	{
		echo "You Can't do reboot the system";
		exit;
	}
	
exec("su -u root /sbin/shutdown -r now");
//echo "Rebooting...";
?>
