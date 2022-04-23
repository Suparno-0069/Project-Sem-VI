<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {
    if (isset($_POST['cartRem'])) {
        $bid = $_POST["bid"];
        $cid = $_POST["cid"];
        $qtyy = $_POST["qtyy"];
        $qtyy += 1;

        $sql = "DELETE FROM cart WHERE c_id='$cid'";
        if ($conn->query($sql)) {
            $sqlK = "UPDATE books
            SET quantity='$qtyy'
            WHERE bid='$bid'";
            $conn->query($sqlK);
            header("Location: cart.php");
        } else {
            echo "Something went wrong!!" . $conn->error;
        }
    }
} else {
    header("Location: ../html/login.html");
}
