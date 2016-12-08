<?php
include("../options/myLib.php");
$prefix = "http://" . $_SERVER['HTTP_HOST'] . "/cariwarnet/";
$default = $prefix . "img/empty_computer.jpg";

function _showDefault($default) {
    $tag = fopen($default, 'rb');
    if ($tag) {
        header('Content-Type: image/jpeg');
        fpassthru($tag);
    }
}

if (!empty($_GET["id"])) {
	include("../options/config.php");
	$id = $_GET['id'];
	$id = AvoidSI($id);

	$query="SELECT wrnet_img FROM tblwarnet WHERE wrnet_id='$id'";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
	
	$img = ($data["wrnet_img"]);
	if (empty($img)) _showDefault($default);
	else {
        header('Content-Type: image/jpg');
		echo $img;
	}
}
else {
	_showDefault($default);
}
?>