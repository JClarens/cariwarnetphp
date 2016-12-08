<?php
$host="localhost";
$user="root";
$pw="";
$db="cariwarnet";
$link = mysql_connect($host,$user,$pw);
mysql_select_db($db);

if (!$link) {
    die('Could not connect: ' . mysql_error());
}
?>