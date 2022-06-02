<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {
    if (isset($_POST['rmbBokk'])) {
        $bid = $_POST["bid"];

        $sql = "DELETE FROM books WHERE bid='$bid'";

        if ($conn->query($sql)) {
            echo "<script> alert('Deleted Successfully!');
            window.location = 'books.php'; </script>";
        } else {
            echo "Something went wrong!! " . $conn->error;
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}
