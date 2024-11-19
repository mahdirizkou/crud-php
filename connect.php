<?php
$sserv = "localhost";
$name = "root";
$pass = "";
$db = "cruud";
$conn = mysqli_connect($sserv, $name, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
