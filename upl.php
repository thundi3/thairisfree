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
define('_MODULE_NAME', basename(dirname(__FILE__)));
define('UPLOAD_PATH', 'keyimage');

define ('_UPLOAD_DIR','Upload directory');
define ('_MUST_EXIST','must exist and have write permissions on the server');
define ('_MUST_LESS','Must be less than');
define ('_INVALID_F','Invalid image file, must be a valid image less than');
define ('_MOVE_ERR','Server error, failed to move file');

if ($_FILES) {
  if ( (!$_FILES['image']['error']) ) {

    $allow_ext = array('jpg','jpeg','png','gif','bmp');

    if(empty($id) || !is_numeric($id)) {
        error('Invalid Upload ID');
    }
    if(!is_dir(UPLOAD_PATH) || !is_writable(UPLOAD_PATH)) {
        error(_UPLOAD_DIR.' '.UPLOAD_PATH.' '._MUST_EXIST);
    }

    $file = $_FILES['image'];
    $image = $file['tmp_name'];

    $max_upload_size = ini_max_upload_size();
    if(!$file) {
        error(_MUST_LESS.' '.bytes_to_readable($max_upload_size));
    }

    $ext = strtolower(substr(strrchr($file['name'], '.'), 1));
    @$size = getimagesize($image);
    if(!$size || !in_array($ext, $allow_ext)) {
        error(_INVALID_F.' '.bytes_to_readable($max_upload_size));
    }

    $filename = $id.'.'.$ext;
    $path = UPLOAD_PATH.'/'.$filename;

    if(!move_uploaded_file($image, $path)) {
        error(_MOVE_ERR);
    }

    $status = array();
    $status['done'] = 1;
    $status['width'] = $size[0];
    $status['url'] = UPLOAD_PATH.'/'.$filename;

echo $path."<br>";
echo $status['url'];
    $script = '
        try {
            '.(($_SERVER['REQUEST_METHOD']=='POST') ? 'parent.' : '').'nicImageButton.statusCb("'.$path.'");
        } catch(e) { alert(e.message); }
    ';
    echo '<script>'.$script.'</script>';
  }
}

function error($e) {
    echo '<b style="color: #800">'.$e.'</b>';
    exit;
}

function ini_max_upload_size() {
    $post_size = ini_get('post_max_size');
    $upload_size = ini_get('upload_max_filesize');
    if(!$post_size) $post_size = '8M';
    if(!$upload_size) $upload_size = '2M';

    return min( ini_bytes_from_string($post_size), ini_bytes_from_string($upload_size) );
}

function ini_bytes_from_string($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }
    return $val;
}

function bytes_to_readable( $bytes ) {
    if ($bytes<=0)
        return '0 Byte';

    $convention=1000; //[1000->10^x|1024->2^x]
    $s=array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB');
    $e=floor(log($bytes,$convention));
    return round($bytes/pow($convention,$e),2).' '.$s[$e];
}

?>