<?php
if (session_status() == PHP_SESSION_NONE) session_start();

$sessionId = "";
$sessionUsername = "";
$sessionName = "";
$sessionModeUser = "";

if (!empty($_SESSION["userId"])) $sessionId = $_SESSION["userId"];
if (!empty($_SESSION["username"])) $sessionUsername = $_SESSION["username"];
if (!empty($_SESSION["nama"])) $sessionName = $_SESSION["nama"];
if (!empty($_SESSION["modeUser"])) $sessionModeUser = $_SESSION["modeUser"];

// Avoid SQL Injection
function AvoidSI($string) {
	return mysql_real_escape_string(stripslashes($string));
}

function console_log($data) {
  echo '<script>';
  echo 'console.log('. json_encode($data) .')';
  echo '</script>';
}

function trim_value(&$value) 
{ 
    $value = trim($value); 
}
?>