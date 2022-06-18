<?php
session_start();
include "../php/dbconn.php";
if ($_SESSION["logged"]) {
    if (isset($_POST['chkOutOnline'])) {
        if (isset($_FILES['myFile'])) {

            $ordFlname = $_POST["flname"];
            $ordMob = $_POST["mob"];
            $ordEmail = $_POST["email"];
            $ordAddr = $_POST["addr"];
            $ordPtype = $_POST["ptype"];
            $usid = $_POST["usid"];
            $price = $_POST["price"];
            $ebid = $_POST["ebid"];

            $img_name = $_FILES['myFile']['name'];
            $img_size = $_FILES['myFile']['size'];
            $tmp_name = $_FILES['myFile']['tmp_name'];
            $error = $_FILES['myFile']['error'];

            if ($error === 0) {
                if ($img_size > 1000000) {
                    echo "<script>alert('Sorry, your file is too large');
                    window.location = 'eb_buyNow.php';</script>";
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("PAY-", true) . '.' . $img_ex_lc;
                        $img_upload_path = '../uploads/payments/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $OrdOn_sql = "INSERT INTO orders(bid, usrid, full_name, order_address, mob, email, price, p_type, screenshots)
                        VALUES('$ebid', '$usid', '$ordFlname', '$ordAddr', '$ordMob', '$ordEmail', '$price', '$ordPtype', '$new_img_name')";
                        if ($conn->query($OrdOn_sql)) {
                            $SSql = "INSERT INTO ebusers(usrid, ebid)
                            VALUES('$usid', '$ebid')";

                            if ($conn->query($SSql)) {
                                echo "<script> alert('Thanks for buying');
                                window.location = 'ebooks.php'</script>";
                            } else {
                                echo "something went wrong!" . $conn->error;
                            }
                            echo "<script>window.location = 'ebooks.php';</script>";
                        } else {
                            echo "Something went wrong!!" . $conn->error;
                        }
                    } else {
                        echo "<script>alert('Sorry, You can't upload files of this type');
                        window.location = 'eb_buyNow.php';</script>";
                    }
                }
            }
        } else {
            echo "<br>";
            echo "<p>Some unknown error occured!!
            <a href='ebooks.php'><button>go back to e-book shop page</button></a>
            </p>";
            echo "<br>";
        }
    }
} else {
    header("Location: ../html/login.html");
}
