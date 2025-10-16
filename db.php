<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['SERVER_NAME'] == 'localhost' || $_SERVER['SERVER_NAME'] == '127.0.0.1') {
    $host = "localhost";
    $user = "root";
    $pass = ""; 
    $db   = "expense"; 
} else {
    $host = "sql300.infinityfree.com";         
    $user = "if0_39503733";             
    $pass = "sahilrajput0ffi";             
    $db   = "if0_39503733_expense";     
}

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
