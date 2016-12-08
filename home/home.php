<?php
include("../options/config.php");

$par = "";
$query = "SELECT *, mbr_name AS wrnet_owner_nm FROM tblwarnet LEFT JOIN tblmember ON tblmember.mbr_id = tblwarnet.wrnet_owner ";
$newQuery = "SELECT * FROM tblwarnet ORDER BY wrnet_add DESC LIMIT 5";
$topQuery = "SELECT wrnet_id, wrnet_name, COUNT(com_id) AS Total FROM tblwarnet LEFT JOIN tblcomment ON tblwarnet.wrnet_id = tblcomment.com_warnet_id GROUP BY wrnet_id, wrnet_name ORDER BY Total DESC LIMIT 5"; 
$hasilNew = "";
$hasilTop = "";
$jlhNew = 0;
$jlhTop = 0;

$isParExists = !empty($_GET["search"]);
if ($isParExists) {
	$par = $_GET["search"];
	$query .= "WHERE wrnet_name LIKE '%$par%' OR wrnet_kota LIKE '%$par%' OR wrnet_alamat LIKE '%$par%' ";
}
$hasilNew = mysql_query($newQuery);
$jlhNew = mysql_num_rows($hasilNew);

$hasilTop = mysql_query($topQuery);
$jlhTop = mysql_num_rows($hasilTop);     

$hasil = mysql_query($query);
$jumlah = mysql_num_rows($hasil);	
?>