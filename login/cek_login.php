<?php
if (isset($_POST['username']) && isset($_POST['password'])) 
{
    include("../options/config.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$username = AvoidSI($username);
	$password = AvoidSI($password);
	
	$query="SELECT * FROM tblmember WHERE mbr_username='$username' AND mbr_password='$password'";
	$hasil = mysql_query($query);
	$data = mysql_fetch_array($hasil);
	
	$count = mysql_num_rows($hasil);
	
	if ($count == 1)
	{
		$_SESSION['userId'] = $data["mbr_id"];
		$_SESSION['username'] = $username;
		$_SESSION['nama'] = $data["mbr_name"];
		$_SESSION['modeUser'] = $data["mbr_mode"];
		
		header("location:../home?success=1");
	}
	else header("location:../login/?status=0");
}
?>