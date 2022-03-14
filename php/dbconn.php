<?php
$srvname = "localhost";
$usrname = "ucAdmin";
$password = "asd123";
$dbname = "uclogin";

$conn = new mysqli($srvname, $usrname, $password, $dbname);

if($conn->connect_error){
    die("Connection failed : " . $conn->connect_error);
}