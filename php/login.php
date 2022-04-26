<?php
session_start();
include_once "dbconn.php";


if ($_POST) {

    $un = $_POST['uname'];
    $pass = $_POST['pass'];
    $_SESSION["sun"] = $un;


    $sql = "SELECT * FROM users WHERE uname='$un' AND passwords='$pass'";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {
        // echo "Login success!";
        $_SESSION["logged"] = true;
        header("Location: dashboard.php");
    } else {
        session_unset();
        session_destroy();
        echo "there is an error" . $conn->error;
    }

    // $res = $conn->query($sql);
    // $row = $res->fetch_assoc();
    // if ($row) {
    //     echo $un;
    //     echo $pass;

    // }
}
