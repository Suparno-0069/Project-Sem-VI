<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {
    $uid = $_SESSION["uid"];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment - Urban Chapters</title>
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/paymentpage.css">
    </head>

    <body>
        <h1>Payment</h1>

        <form id="choosemethod" action="" method="post">
            <label for="cod">COD</label>
            <input type="radio" name="payMethod" id="cod" value="cod"><br><br>
            <label for="online">Online</label>
            <input type="radio" name="payMethod" id="online" value="online"><br><br>
            <input class="submit-btn" type="submit" name="paySub" value="Submit">
        </form>
        <a id="backtocart" href="cart.php">Cancel payment and return to Cart</a>

        <?php
        if (isset($_POST['paySub'])) {
            $payMethod = $_POST["payMethod"];
            if ($payMethod == "cod") {
        ?>

                <div id="cod" class="cod">
                    <form class="finaldetails" action="checkout.php" method="post">
                        <h3 class="title">Offline Billing Address</h3>
                        <span>Full Name:</span>
                        <input type="text" name="flname" placeholder="Myra deo">
                        <span>Mob :</span>
                        <input type="tel" name="mob" placeholder="0123456789">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="example@example.com">
                        <span>Address:</span>
                        <input type="text" name="addr" placeholder="room - street - locality">
                        <input type="text" name="ptype" value="offline" readonly style="display: none;">
                        <br><br>
                        <input type="submit" name="chkOutCash" value="Proceed to Checkout" class="submit-btn">
                    </form>
                </div>

            <?php
            } elseif ($payMethod == "online") {
            ?>
                <div class="online" id="online">
                    <div class="container">
                        <form class="finaldetails" action="checkout.php" method="post" enctype="multipart/form-data">
                            <h3 class="title">Online Billing Address</h3>
                            <span>Full Name:</span>
                            <input type="text" name="flname" placeholder="Myra deo">
                            <span>Mob :</span>
                            <input type="tel" name="mob" placeholder="0123456789">
                            <span>Email :</span>
                            <input type="email" name="email" placeholder="example@example.com">
                            <span>Address:</span>
                            <input type="text" name="addr" placeholder="room - street - locality">
                            <input type="text" name="ptype" value="online" readonly style="display: none;">
                            <h3 class="title">Payment</h3>
                            <span>ScreenShot of Payment:</span>
                            <input type="file" name="myFile" onchange="myFnc()">
                            <input type="submit" name="chkOutOnline" value="Proceed to Checkout" class="submit-btn" id="chkOutOnline" disabled>
                        </form>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <script>
            function myFnc() {
                const val = document.querySelector('input').value;
                const btn = document.getElementById('chkOutOnline');

                if (val != null) {
                    btn.disabled = false;
                }
            }
        </script>
    </body>

    </html>

<?php

} else {
    header("Location: ../html/login.html");
}
