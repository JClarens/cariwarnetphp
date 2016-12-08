<?php
$prefix = "http://" . $_SERVER['HTTP_HOST'] . "/cariwarnet/";

$isLogin = !empty($sessionUsername);

$curId = "";
if (!empty($_GET["id"])) {
	$curId = $_GET["id"];
}
$userId = $curId;
$editId = "";
$userName = "";
$userEmail = "";
$userTempatLahir = "";
$userTanggalLahir = "";
$userTelepon = "";
$userMode = "";
$userImage = "";
$userImageName = "";
$userMode = "";
$isEdit = FALSE;

// if (!$isLogin) {
// 	header("location:../home");
// }
// else {
    if (isset($_POST["id"])
        && isset($_POST["name"])
        && isset($_POST["tempatLahir"])
        && isset($_POST["dateLahir"])
        && isset($_POST["email"])
        && isset($_POST["mode"])
        ) {
        $image = "NULL";
        $image_nm = "";
        $filename = "";
        
        if(!empty($_FILES['gambar'])) {
        	try {
        		if (is_uploaded_file($_FILES['gambar']['tmp_name']) && getimagesize($_FILES['gambar']['tmp_name']) != false) {
        			$size = getimagesize($_FILES['gambar']['tmp_name']);
                    $filename = $_FILES['gambar']['tmp_name'];
        			/*** assign our variables ***/
        			$type = $size['mime'];
        			// $image = "'" . fopen($_FILES['gambar']['tmp_name'], 'rb') . "'";
                    $image = "'" . file_get_contents($filename) . "'";
                    // echo $image;
        			$dimension = $size[3];
        			$image_nm = $_FILES['gambar']['name'];
        			$maxsize = 2097152;
        			
        			 /***  check the file is less than the maximum file size ***/
        			if($_FILES['gambar']['size'] < $maxsize ) {
        				
                    }
        			else {
        				/*** throw an exception is image is not of type ***/
        				throw new Exception("File Size Error");
        			}
        		}
        		else {
        			// if the file is not less than the maximum allowed, print an error
        			throw new Exception("Unsupported Image Format!");
        		}
        	}
        	catch(Exception $e) {
        		echo $e->getMessage();
        		echo 'Sorry, could not upload file';
        	}
        }
        
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $tempatLahir = $_POST['tempatLahir'];
        $dateLahir = $_POST['dateLahir'];
        $phone = $_POST['phone'];
        $mode = $_POST['mode'];
        
        $id = AvoidSI($id);
        $name = AvoidSI($name);
        $email = AvoidSI($email);
        $tempatLahir = AvoidSI($tempatLahir);
        $dateLahir = AvoidSI($dateLahir);
        $phone = AvoidSI($phone);
        $mode = AvoidSI($mode);
        $image_nm = AvoidSI($image_nm);
        
        $dateLahir = strtotime($dateLahir);
        $dateCheck = true;
        $dateCheck = $dateCheck && !empty($dateLahir);
        if($dateCheck) {
            $dateLahir = date("Y-m-d", $dateLahir);
            $dateCheck = !empty($dateLahir);
        }
        // console_log($id . "\n"
        //             . $name . "\n"
        //             . $email . "\n"
        //             . $tempatLahir . "\n"
        //             . $dateLahir . "\n"
        //             . $phone . "\n"
        //             . $image . "\n"
        //             . $image_nm . "\n"
        //             );            
        
        if($dateCheck) {
		    include("../options/config.php");
            $query = "UPDATE cariwarnet.tblmember SET " .
                        "mbr_name = '$name', " . 
                        "mbr_email = '$email', " .
                        "mbr_tempat_lhr = '$tempatLahir', " . 
                        "mbr_tgl_lhr = '$dateLahir', " .
                        "mbr_phone = '$phone', " .  
                        "mbr_img = " . (empty($filename) ? "NULL" : "'".  mysql_escape_string(file_get_contents($filename)) . "'") . ", " . 
                        "mbr_img_nm = '$image_nm', " . 
                        "mbr_mode = '$mode' " .
                        "WHERE mbr_id = $id";
            $sql = mysql_query($query);
            if ($sql) {
                $sessionName = $name;
                header("location:../profile?id=$id&success=1");
            }
            else header("location:../profile?id=$id&success=2");
        }
        else header("location:../profile?id=$id&success=3");
    }
	else if (!empty($_GET["id"])) {
		include("../options/config.php");
        $isEdit = !empty($_GET["edit"]) && $curId == $sessionId;
		$query="SELECT * FROM tblmember WHERE mbr_id='$userId'";
		$hasil = mysql_query($query);
		$data = mysql_fetch_array($hasil);
		
		$count = mysql_num_rows($hasil);
		
		if ($count == 1)
		{
			$userName = $data["mbr_name"];
			$userEmail = $data["mbr_email"];
			$userTempatLahir = $data["mbr_tempat_lhr"];
			$userTanggalLahir = date("Y-m-d", strtotime($data["mbr_tgl_lhr"]));
			$userTelepon = $data["mbr_phone"];
			$userImageName = $data["mbr_img_nm"];
			$userMode = $data["mbr_mode"];
		}
	}
	// else if (!empty($_GET["edit"])) {
    //     console_log("hello2");
	// 	$editId = $_GET["edit"];
	// 	$isEdit = $editId == $sessionId;
	// 	
	// 	include("../options/config.php");
	// 	$query="SELECT * FROM tblmember WHERE mbr_id='$editId'";
	// 	$hasil = mysql_query($query);
	// 	$data = mysql_fetch_array($hasil);
	// 	
	// 	$count = mysql_num_rows($hasil);
	// 	
	// 	if ($count == 1)
	// 	{
	// 		$userName = $data["mbr_name"];
	// 		$userEmail = $data["mbr_email"];
	// 		$userTempatLahir = $data["mbr_tempat_lhr"];
	// 		$userTanggalLahir = date("Y-m-d", strtotime($data["mbr_tgl_lhr"]));
	// 		$userTelepon = $data["mbr_phone"];
	// 		$userMode = $data["mbr_mode"];
	// 	}
	// }
	else {
        if (empty($sessionId)) header("location:../");  
        else header("location:../profile?id=$sessionId");
    }
// }

?>