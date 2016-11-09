<?php
error_reporting(E_ERROR);
$ACCESSION = $_POST['ACCESSION'];
$MRN = $_POST['MRN'];
$ORDERID = $_POST['ORDERID'];

echo "<body bgcolor=#E8E8E8 >";
echo "MRN =".$MRN;
echo "<br />Accession : ".$ACCESSION;
//echo "Order ID = ".$ORDERID;


echo "<br />";
echo "<br /><b>Preview Image</b><br />";

echo "<img src=../icons/arrow-turn-180-left.png> <a href=../qc.php?ACCESSION=$ACCESSION&ORDERID=$ORDERID&MRN=$MRN>BACK TO QC</a> <br />";
echo "<img src=../icons/image--minus.png> Delete this images <br /><br />";


if (!file_exists("uploads/".$ACCESSION)) {
    mkdir("uploads/".$ACCESSION, 0777, true);
}

$valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
//$max_size = 200 * 1024; // max file size
$max_size = 10240 * 10240; // max file size
$path = "uploads/".$ACCESSION."/"; // upload directory



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if( ! empty($_FILES['image']) ) {
		// get uploaded file extension
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		// looking for format and size validity
		if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size) {
			$path = $path . uniqid(). '.' .$ext;
			// move uploaded file from temp to uploads directory
			if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {
				echo "<img src='$path' height=450/>";
			}
		} else {
			echo 'Invalid file! Please upload file type: jpdf, jpg, png, gif';
		}
	} else {
		echo 'File not uploaded! Please Re-size your image then upload again.';
	}
} else {
	echo 'Bad request!';
}

?>