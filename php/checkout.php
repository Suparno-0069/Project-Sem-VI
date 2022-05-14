<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {
    $uid = $_SESSION["uid"];
    print_r($_SESSION);
    echo "<br>";
    if (isset($_POST['chkOutOnline'])) {
        print_r($_POST);
        echo "<br>";
        echo "<a href='cart.php'><button>go back to cart</button></a>";
    } elseif (isset($_POST['chkOutCash'])) {
        $ordFlname = $_POST["flname"];
        $ordMob = $_POST["mob"];
        $ordEmail = $_POST["email"];
        $ordAddr = $_POST["addr"];

        $CartOut_sql = "SELECT * FROM cart WHERE usrid='$uid'";
        $CartOut_res = $conn->query($CartOut_sql);
        // $CartOut_row = $CartOut_res->fetch_assoc();
        while ($CartOut_row = $CartOut_res->fetch_assoc()) {
            $ordUid = $CartOut_row["usrid"];
            $ordBid = $CartOut_row["bid"];
            $ordPrice = $CartOut_row["price"];

            $OrdIn_sql = "INSERT INTO orders(bid, usrid, full_name, order_address, mob, email, price)
            VALUES('$ordBid', '$ordUid', '$ordFlname', '$ordAddr', '$ordMob', '$ordEmail', '$ordPrice')";
            if ($conn->query($OrdIn_sql)) {
                $cartDel_sql = "DELETE FROM cart WHERE usrid='$ordUid'";
                if ($conn->query($cartDel_sql)) {
                    echo "<script>window.location = 'shop.php';</script>";
                } else {
                    echo "Something went wrong!!" . $conn->error;
                }
            } else {
                echo "Something went wrong!!" . $conn->error;
            }
        }
        echo "<a href='cart.php'><button>go back to cart</button></a>";
        echo "<p>Thanks for shopping with cash!</p>";
    }
} else {
    header("Location: ../html/login.html");
}
