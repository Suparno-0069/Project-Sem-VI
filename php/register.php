<?php
include_once "dbconn.php";

if ($_POST) {
    $fn = $_POST['fname'];
    $ln = $_POST['lname'];
    $g = $_POST['chkGen'];
    $gen = "";
    foreach ($g as $a) {
        $gen = $a;
    }
    $dob = $_POST['dob'];
    $mob = $_POST['mno'];
    $em = $_POST['email'];
    $addr = $_POST['addr'];
    $cn = $_POST['country'];
    $un = $_POST['uname'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE uname='$un'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    if ($row) {
        echo "<script> alert('the username $un already exists');
        window.location = '../html/register.html'</script>";
        // header("Location: ../html/register.html");
    } else {
        $sql = "INSERT INTO users(fname, lname, gender, dob, mob, email, addresses, country, uname, passwords)
VALUE('$fn', '$ln', '$gen', '$dob', '$mob', '$em', '$addr', '$cn', '$un', '$pass')";

        if ($conn->query($sql)) {
            header("Location: ../html/login.html");
            // echo "Data entry successful";
        } else {
            echo "There is an Error" . $conn->error;
        }
    }
}

// $sql = "INSERT INTO users(fname, lname, gender, dob, mob, email, addresses, country, uname, passwords)
// VALUE('$fn', '$ln', '$gen', '$dob', '$mob', '$em', '$addr', '$cn', '$un', '$pass')";

// if($conn->query($sql)){
//     header("Location: ../html/login.html");
//     // echo "Data entry successful";
// }else {
//     echo "There is an Error" . $conn->error;
// } 
