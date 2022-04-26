<?php
$srvname = "localhost";
$usrname = "root";
$password = "";
$dbname = "urbanchaptars";

$conn = new mysqli($srvname, $usrname, $password, $dbname);

if($conn->connect_error){
    die("Connection failed : " . $conn->connect_error);
}