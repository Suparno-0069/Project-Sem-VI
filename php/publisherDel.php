<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {
    if (isset($_POST['pubDell'])) {
        $pid = $_POST["pid"];

        $dSql = "DELETE FROM publishers WHERE pid='$pid'";

        if ($conn->query($dSql)) {
            echo "<script> alert('Deleted Successfully!');
            window.location = 'publishers.php'; </script>";
        } else {
            echo "Something went wrong!! " . $conn->error;
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}
