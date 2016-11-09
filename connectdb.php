<?php
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 18 AUG 2013
# File name: connectdb.php
# http://www.thairis.net
# By ThaiRIS.Net
# Email : info.xraythai@gmail.com
##############################################################################
# COPYRIGHT NOTICE                                                           
# Copyright 2009-2017 ThaiRIS All Rights Reserved.              
#                                                                            
# This script may be used and modified free of charge by anyone so long as   
# this copyright notice and the comments above remain intact. By using this  
# code you agree to indemnify ThaiRIS.net from any liability that might
# arise from it's use.                                                       
#                                                                            
# You can use and modify if you need but can't sale                                              
#                                                                            
# This Copyright is in full effect in any country that has International     
##############################################################################
$host ="localhost";
$user ="root";
$password ="";
$dbname ="ris";
error_reporting(E_ERROR);
$dbconnect = mysql_connect($host,$user,$password);
if (!$dbconnect) 
	{
		echo "Can't connet to Server Please contect Admin";
		exit;
	}
MYSQL_SELECT_DB($dbname) OR DIE("Error".mysql_error());
mysql_query("SET NAMES UTF8");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
mysql_query("collation_connection =utf8");
mysql_query("collation_database =utf8");
mysql_query("collation_server =utf8");
date_default_timezone_set('Asia/Bangkok');
include ("config.php");
?>
