<?php
include("../options/config.php");

if (isset($_POST['username']) 
	&& isset($_POST['password'])
	&& isset($_POST['confPass'])
	&& isset($_POST['name'])
	&& isset($_POST['email'])
	&& isset($_POST['tempatLahir'])
	&& isset($_POST['dateLahir'])
	&& isset($_POST['phone'])
	) 
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$confPass = $_POST['confPass'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$tempatLahir = $_POST['tempatLahir'];
	$dateLahir = $_POST['dateLahir'];
	$phone = $_POST['phone'];
	
	$username = AvoidSI($username);
	$password = AvoidSI($password);
	$confPass = AvoidSI($confPass);
	$name = AvoidSI($name);
	$email = AvoidSI($email);
	$tempatLahir = AvoidSI($tempatLahir);
	$dateLahir = AvoidSI($dateLahir);
	$phone = AvoidSI($phone);
	
	$dateLahir = strtotime($dateLahir);
	$dateCheck = true;
	$dateCheck = $dateCheck && !empty($dateLahir);
	if($dateCheck) {
		$dateLahir = date("Y-m-d", $dateLahir);
		$dateCheck = !empty($dateLahir);
	}
	
	if($dateCheck) {
		$query = "INSERT INTO tblmember (mbr_id, mbr_username, mbr_password, mbr_name, mbr_email, mbr_tempat_lhr, mbr_tgl_lhr, mbr_phone) " .
					 "VALUES (NULL, '$username', '$password', '$name', '$email', '$tempatLahir', '$dateLahir', '$phone')";
		$sql = mysql_query($query);
	
		if ($sql) header("location:../register?success=1");
		else header("location:../register?success=2");
	}
	else header("location:../register?success=3");
}
?>