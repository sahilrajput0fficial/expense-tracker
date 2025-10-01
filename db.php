<?php
$host = "ftpupload.net";      
$user = "if0_39503733";          
$pass = "sahilrajput0ffi";          
$db   = "if0_39503733_expense";  

$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>