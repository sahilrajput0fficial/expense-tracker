<?php

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

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
