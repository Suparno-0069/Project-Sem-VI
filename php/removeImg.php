<?php
session_start();
include "dbconn.php";


if ($_SESSION["adlogged"]) {

    if (isset($_POST['rmBT'])) {

        $bid = $_POST["bid"];

        $sql = "UPDATE books
        SET thumbnail=''
        WHERE bid='$bid'";

        if ($conn->query($sql)) {
            echo "<script>alert('Success!!!!'); </script>";
            header("Location: books.php");
        } else {
            echo "Somethig went wrong!!!" . $conn->error;
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}
