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
      $dir = 'HL7/';
      foreach(glob($dir.'*.*') as $v){
      unlink($v);

      }
?>