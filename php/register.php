<?php
include_once "dbconn.php";

if($_POST['submitReg']){
    $fn = $_POST['fname'];
    $ln = $_POST['lname'];
    $g = $_POST['chkGen'];
    $gen = "";
    foreach($g as $a){
        $gen = $a;
    }
    $dob = $_POST['dob'];
    $mob = $_POST['mno'];
    $em = $_POST['email'];
    $cn = $_POST['country'];
    $un = $_POST['uname'];
    $pass = $_POST['pass'];
}

$sql = "INSERT INTO users(fname, lname, gender, dob, mob, email, country, username, passwords)
VALUE('$fn', '$ln', '$gen', '$dob', '$mob', '$em', '$cn', '$un', '$pass')";

if($conn->query($sql)){
    echo "Data entry successful";
}else {
    echo "There is an Error" . $conn->error;
} 