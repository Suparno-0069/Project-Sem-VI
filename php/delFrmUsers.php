<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {
    if (isset($_POST['usrRem'])) {
        $uid = $_POST["uid"];

        $sql = "DELETE FROM users WHERE usrid='$uid'";
        if ($conn->query($sql)) {
            echo "<script>window.location = 'users.php';</script>";
        } else {
            echo "Something went wrong" . $conn->error;
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}
