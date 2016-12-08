<?php
$prefix = "http://" . $_SERVER['HTTP_HOST'] . "/cariwarnet/";

$isLogin = !empty($sessionUsername);
$hasil = "";
$hasilKomen = "";
$hasilPC = "";
$hasilFsl = "";
$totalPC = 0;
$curId = "";
$isDetail = !empty($_GET["id"]);
if ($isDetail) {
	$curId = $_GET["id"];
}

$allowEdit = FALSE;
$netId = $curId;
$editId = "";
$netName = "";
$netOwner = "";
$netOwnerName = "";
$netKota = "";
$netAlamat = "";
$netImage = "";
$netImageNm = "";
$netPhone = "";
$netRate = "";

$netPrinter = "";
$netPulsa = "";
$netGame = "";
$netKetik = "";
$netAcc = "";
$netOtr = "";

$komentar = "";
$userK = $sessionName;
$userKId = $sessionId;
$rating = "1";
$isEdit = FALSE;
$isFilter = FALSE;

if (!$isLogin) {
    if ($isDetail) {
        include("../options/config.php");
        $query = "SELECT tblwarnet.*, mbr_name AS wrnet_owner_nm,
                    AVG(IFNULL(com_rate, 0)) AS wrnet_rate
                    FROM tblwarnet 
                    LEFT JOIN tblmember 
                    ON tblmember.mbr_id = tblwarnet.wrnet_owner
                    LEFT JOIN tblcomment
                    ON tblcomment.com_warnet_id = tblwarnet.wrnet_id
                    WHERE wrnet_id = '$netId'
                    GROUP BY wrnet_id ";
                    
		$hasil = mysql_query($query);
		$data = mysql_fetch_array($hasil);
		
		$count = mysql_num_rows($hasil);
		
		if ($count == 1)
		{
			$netName = $data["wrnet_name"];
			$netKota = $data["wrnet_kota"];
            $netOwner = $data["wrnet_owner"];
            $netOwnerName = $data["wrnet_owner_nm"];
            $netPhone = $data["wrnet_phone"];
			$netAlamat = $data["wrnet_alamat"];
			$netImageNm = $data["wrnet_img_nm"];
            $netRate = $data["wrnet_rate"];
            
            $netPrinter = !empty($data["wrnet_f_printer"]);
            $netPulsa = !empty($data["wrnet_f_pulsa"]);
            $netGame = !empty($data["wrnet_f_game"]);
            $netKetik = !empty($data["wrnet_f_ketik"]);
            $netAcc = !empty($data["wrnet_f_acc"]);
            $netOtr = !empty($data["wrnet_f_otr"]);
		}
        
        $query = "SELECT *, mbr_name AS com_mbr_nm FROM tblcomment LEFT JOIN tblmember ON tblmember.mbr_id = tblcomment.com_mbr_id WHERE com_warnet_id = '$netId' ORDER BY com_dt DESC";
        $hasilKomen = mysql_query($query);
    }
    else header("location:../home");
}
else {
    if (isset($_POST["name"])
        && isset($_POST["kota"])
        && isset($_POST["alamat"])
        && isset($_POST["phone"])
        ) {
        $errorMsg = "Upload Gagal :<br>";
        $netImage = "NULL";
        $netImageNm = "";
        $filename = "";
        $dateCheck = TRUE;
        
        if(!empty($_FILES['gambar']) && !empty($_FILES['gambar']['name'])) {
        	try {
        		if (is_uploaded_file($_FILES['gambar']['tmp_name']) && getimagesize($_FILES['gambar']['tmp_name']) != false) {
        			$size = getimagesize($_FILES['gambar']['tmp_name']);
                    $filename = $_FILES['gambar']['tmp_name'];
        			/*** assign our variables ***/
        			$type = $size['mime'];
        			// $image = "'" . fopen($_FILES['gambar']['tmp_name'], 'rb') . "'";
                    $netImage = "'" . file_get_contents($filename) . "'";
                    // echo $image;
        			$dimension = $size[3];
        			$netImageNm = $_FILES['gambar']['name'];
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
        		$errorMsg .= $e->getMessage();
                $dateCheck = FALSE;
        	}
        }
        
        $id = $_POST['id'];
        $isUpdate = !empty($id);
         
        $netName = $_POST['name'];
        $netKota = $_POST['kota'];
        $netAlamat = $_POST['alamat'];
        $netPhone = $_POST['phone'];
        
        $netPrinter = $_POST['printer'];
        $netPulsa = $_POST['pulsa'];
        $netGame = $_POST['game'];
        $netKetik = $_POST['ketik'];
        $netAcc = $_POST['acc'];
        $netOtr = $_POST['otr'];
        
        $netPrinter = !empty($netPrinter);
        $netPulsa = !empty($netPulsa);
        $netGame = !empty($netGame);
        $netKetik = !empty($netKetik);
        $netAcc = !empty($netAcc);
        $netOtr = !empty($netOtr);
        
        $id = AvoidSI($id);
        $netName = AvoidSI($netName);
        $netKota = AvoidSI($netKota);
        $netAlamat = AvoidSI($netAlamat);
        $netImageNm = AvoidSI($netImageNm);
        $netPhone = AvoidSI($netPhone);
        
        // $dateLahir = strtotime($dateLahir);
        // $dateCheck = true;
        // $dateCheck = $dateCheck && !empty($dateLahir);
        // if($dateCheck) {
        //     $dateLahir = date("Y-m-d", $dateLahir);
        //     $dateCheck = !empty($dateLahir);
        // }
        
        if($dateCheck) {
		    include("../options/config.php");
            $query = "";
            if ($isUpdate) {
                $query = "UPDATE cariwarnet.tblwarnet SET " .
                            "wrnet_name = '$netName', " . 
                            "wrnet_kota = '$netKota', " .
                            "wrnet_alamat = '$netAlamat', " . 
                            "wrnet_img = " . (empty($filename) ? "NULL" : "'".  mysql_escape_string(file_get_contents($filename)) . "'") . ", " . 
                            "wrnet_img_nm = '$netImageNm', " . 
                            "wrnet_phone = '$netPhone', " . 
                            "wrnet_f_printer = '$netPrinter', " . 
                            "wrnet_f_pulsa = '$netPulsa', " . 
                            "wrnet_f_game = '$netGame', " . 
                            "wrnet_f_ketik = '$netKetik', " . 
                            "wrnet_f_acc = '$netAcc', " . 
                            "wrnet_f_otr = '$netOtr' " . 
                            "WHERE wrnet_id = $id";
            }
            else {
                $query = "INSERT INTO cariwarnet.tblwarnet (wrnet_id, wrnet_name, wrnet_kota, wrnet_alamat, wrnet_owner, wrnet_img, wrnet_img_nm, wrnet_phone, wrnet_add, wrnet_f_printer, wrnet_f_pulsa, wrnet_f_game, wrnet_f_ketik, wrnet_f_acc, wrnet_f_otr) " .
					 "VALUES (NULL, '$netName', '$netKota', '$netAlamat', '$sessionId'," . (empty($filename) ? "NULL" : "'".  mysql_escape_string(file_get_contents($filename)) . "'") . ", '$netImageNm', '$netPhone', NOW(), '$netPrinter', '$netPulsa', '$netGame', '$netKetik', '$netAcc', '$netOtr')";
            }
            
            $sql = mysql_query($query);
            if ($sql) {
                header("location:../warnet?id=$id&success=1");
            }
            else header("location:../warnet?id=$id&success=2");
        }
        else header("location:../warnet?id=$id&success=3&errMsg=$errorMsg");
    }
    else if (isset($_POST["komentar"])) {
        include("../options/config.php");
        $netId = $_POST["netId"]; 
        $komentar = $_POST['komentar'];
        $rating = $_POST['rating'];
        $komentar = AvoidSI($komentar);
        include("../options/config.php");
        $query = "INSERT INTO cariwarnet.tblcomment (com_id, com_warnet_id, com_mbr_id, com_desc, com_rate, com_dt) " .
                    "VALUES (NULL, '$netId', '$sessionId', '$komentar', $rating, NOW())";
        $sql = mysql_query($query);
        if ($sql) header("location:../warnet?id=$netId&success=6");
        else header("location:../warnet?id=$netId&success=7");
    }
    else if (!empty($_GET["add"])) {
        $isEdit = TRUE;
        $isDetail = TRUE;
        $netOwnerName = $sessionName;
    }
	else if ($isDetail) {
		include("../options/config.php");
        if (!empty($_GET["del"])) {
            $query = "DELETE FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner WHERE wrnet_id = '$netId' AND wrnet_owner = '$sessionId' ";
            $hasil = mysql_query($query);
            if ($hasil) header("location:../warnet?id=$id&success=4");
            else header("location:../warnet?id=$id&success=5");
        }
        else {
            $isEdit = !empty($_GET["edit"]);
            if ($isEdit) 
                $query = "SELECT *, mbr_name AS wrnet_owner_nm FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner WHERE wrnet_id = '$netId'";
            else {
                $query = "SELECT tblwarnet.*, mbr_name AS wrnet_owner_nm,
                    AVG(IFNULL(com_rate, 0)) AS wrnet_rate
                    FROM tblwarnet 
                    LEFT JOIN tblmember 
                    ON tblmember.mbr_id = tblwarnet.wrnet_owner
                    LEFT JOIN tblcomment
                    ON tblcomment.com_warnet_id = tblwarnet.wrnet_id
                    WHERE wrnet_id = '$netId'
                    GROUP BY wrnet_id ";
            }
            $hasil = mysql_query($query);
            $data = mysql_fetch_array($hasil);
            
            $count = mysql_num_rows($hasil);
            
            if ($count == 1)
            {
                $netName = $data["wrnet_name"];
                $netKota = $data["wrnet_kota"];
                $netOwner = $data["wrnet_owner"];
                $netOwnerName = $data["wrnet_owner_nm"];
                $netAlamat = $data["wrnet_alamat"];
                $netImageNm = $data["wrnet_img_nm"];
                $netPhone = $data["wrnet_phone"];
                
                $netPrinter = !empty($data["wrnet_f_printer"]);
                $netPulsa = !empty($data["wrnet_f_pulsa"]);
                $netGame = !empty($data["wrnet_f_game"]);
                $netKetik = !empty($data["wrnet_f_ketik"]);
                $netAcc = !empty($data["wrnet_f_acc"]);
                $netOtr = !empty($data["wrnet_f_otr"]);
                
                $allowEdit = $netOwner == $sessionId;
                
                $query = "SELECT *, mbr_name AS com_mbr_nm FROM tblcomment LEFT JOIN tblmember ON tblmember.mbr_id = tblcomment.com_mbr_id WHERE com_warnet_id = '$netId' ORDER BY com_dt DESC";
                $hasilKomen = mysql_query($query);
                
                $query = "SELECT * FROM tblpc WHERE pc_warnet_id = '$netId' ";
                $hasilPC = mysql_query($query);
                $totalPC = mysql_num_rows($hasilPC);             
            }
            else header("location:../");
        }
	}
	else {
        include("../options/config.php");
        $parByName = "";
        $parByKota = "";
        $parByAlamat = "";
        $parCari = "";
        
        $isFilter = !empty($_GET["cariWarnet"]);
        if ($isFilter) {
            $pars = explode(",", $_GET["cariWarnet"]);
            $cLoop = 0;
            $lPars = count($pars);
            array_walk($pars, "trim_value");
            foreach($pars as &$val) {
                $parByName .= "wrnet_name LIKE '%" . $val . "%'";
                $parByKota .= "wrnet_kota LIKE '%" . $val . "%'";
                $parByAlamat .= "wrnet_alamat LIKE '%" . $val . "%'";
                $cLoop++;
                if ($cLoop != $lPars) {
                    $parByName .= " OR ";
                    $parByKota .= " OR ";
                    $parByAlamat .= " OR ";
                }
            }
            $parCari = implode(", ", $pars);
        }
        $query = "SELECT *, mbr_name AS wrnet_owner_nm FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner WHERE wrnet_owner = '$sessionId' ";
        if ($isFilter) {
            $query .= "AND " . $parByName . " OR " . $parByKota . " OR " . $parByAlamat;
        }
		$hasil = mysql_query($query);
    }
}
?>