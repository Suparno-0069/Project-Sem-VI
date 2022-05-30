<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {
    $uid = $_SESSION["uid"];
    print_r($_SESSION);
    echo "<br>";
    if (isset($_POST['chkOutOnline'])) {
        if (isset($_FILES['myFile'])) {

            $ordFlname = $_POST["flname"];
            $ordMob = $_POST["mob"];
            $ordEmail = $_POST["email"];
            $ordAddr = $_POST["addr"];
            $ordPtype = $_POST["ptype"];

            $img_name = $_FILES['myFile']['name'];
            $img_size = $_FILES['myFile']['size'];
            $tmp_name = $_FILES['myFile']['tmp_name'];
            $error = $_FILES['myFile']['error'];

            if ($error === 0) {
                if ($img_size > 1000000) {
                    echo "<script>alert('Sorry, your file is too large');
                    window.location = 't_buyNow.php';</script>";
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                        $img_upload_path = '../uploads/payments/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);


                        $CartOut_sqlO = "SELECT * FROM cart WHERE usrid='$uid'";
                        $CartOut_resO = $conn->query($CartOut_sqlO);
                        // $CartOut_row = $CartOut_res->fetch_assoc();
                        while ($CartOut_rowO = $CartOut_resO->fetch_assoc()) {
                            $ordUid = $CartOut_rowO["usrid"];
                            $ordBid = $CartOut_rowO["bid"];
                            $ordPrice = $CartOut_rowO["price"];

                            $OrdOn_sql = "INSERT INTO orders(bid, usrid, full_name, order_address, mob, email, price, p_type, screenshots)
                            VALUES('$ordBid', '$ordUid', '$ordFlname', '$ordAddr', '$ordMob', '$ordEmail', '$ordPrice', '$ordPtype', '$new_img_name')";
                            if ($conn->query($OrdOn_sql)) {
                                $cartDel_sqlO = "DELETE FROM cart WHERE usrid='$ordUid'";
                                if ($conn->query($cartDel_sqlO)) {
                                    echo "<script>window.location = 'shop.php';</script>";
                                } else {
                                    echo "Something went wrong!!" . $conn->error;
                                }
                            } else {
                                echo "Something went wrong!!" . $conn->error;
                            }
                        }
                    } else {
                        echo "<script>alert('Sorry, You can't upload files of this type');
                    window.location = 't_buyNow.php';</script>";
                    }
                }
            }
        } else {
            echo "<br>";
            echo "<p>Some unknown error occured!!
            <a href='cart.php'><button>go back to cart</button></a>
            </p>";
            echo "<br>";
        }
    } elseif (isset($_POST['chkOutCash'])) {
        $ordFlname = $_POST["flname"];
        $ordMob = $_POST["mob"];
        $ordEmail = $_POST["email"];
        $ordAddr = $_POST["addr"];
        $ordPtype = $_POST["ptype"];
        $ss = "N/A";

        $CartOut_sql = "SELECT * FROM cart WHERE usrid='$uid'";
        $CartOut_res = $conn->query($CartOut_sql);
        // $CartOut_row = $CartOut_res->fetch_assoc();
        while ($CartOut_row = $CartOut_res->fetch_assoc()) {
            $ordUid = $CartOut_row["usrid"];
            $ordBid = $CartOut_row["bid"];
            $ordPrice = $CartOut_row["price"];

            $OrdIn_sql = "INSERT INTO orders(bid, usrid, full_name, order_address, mob, email, price, p_type, screenshots)
            VALUES('$ordBid', '$ordUid', '$ordFlname', '$ordAddr', '$ordMob', '$ordEmail', '$ordPrice', '$ordPtype', '$ss')";
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
