<?php
session_start();
include "dbconn.php";

if($_SESSION["logged"]){

    if ($_POST) {
        $un = $_SESSION["sun"];
        $sql = "SELECT * FROM users WHERE uname='$un'";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();
        if($row){
            $uid = $row["usrid"];
        }
        // $uid = ;
        $aname = $_POST["aname"];
        $bname = $_POST["bname"];
        $pname = $_POST["pname"];
        $msg = $_POST["msg"];
    
        // $pid = getIdStr(6);
    
        $sql = "INSERT INTO requests(usrid, book_name, author_name, publisher_name, descriptions)
        VALUE('$uid', '$bname', '$aname', '$pname', '$msg')";
    
        if($conn->query($sql)){
            $_SESSION["requested"] = true;
            header("Location: rqstSuccess.php");
            // echo "Data Inserted Successfully!";
    
        }else {
            echo "something went wrong" . $conn->error;
        }
    // $sql = "INSERT INTO users(fname, lname, gender, dob, mob, email, addresses, country, uname, passwords)
    // VALUE('$fn', '$ln', '$gen', '$dob', '$mob', '$em', '$addr', '$cn', '$un', '$pass')";
    
    
    }
}else {
    header("Location: ../html/login.html");
}
