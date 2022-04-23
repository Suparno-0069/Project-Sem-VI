<?php
session_start();
include "dbconn.php";


if ($_SESSION["adlogged"]) {

    if (isset($_POST['adB'])) {

        $bid = $_POST["bid"];
        $qty = $_POST["qty"];
        $qty += 1;

        $sql = "UPDATE books
        SET quantity='$qty'
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
