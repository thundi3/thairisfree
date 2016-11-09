<?php
# ThaiRIS (Thai Radiology Information System)
# Version: 1.0
# File last modified: 18 AUG 2013
# File name: config.php
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
// Automatic create request number 0=NO, 1=Yes;
$auto_request_no = 1;
$CREATELOG_FILE=1;
$TIME_EDIT_REPORT = 60; // minute
//This for optional don't change application will not work//
$auto_print_request = 0;
$auto_print_report = 0;
$CREATEHL7=1;
$CREATEHL7_ADT=1;
$CREATEHL7_ORU=1;
$CREATEHL7_ORM=0;
$CREATEHL7_XML=0;
//  Language
$LANGUAGE = "english";
include "language/".$LANGUAGE.".php";

?>