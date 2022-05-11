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
    </head>

    <body>

        <form action="" method="post">
            <label for="cod">COD</label>
            <input type="radio" name="payMethod" id="cod" value="cod"><br><br>
            <label for="online">Online</label>
            <input type="radio" name="payMethod" id="online" value="online"><br><br>
            <input type="submit" name="paySub" value="Submit">
        </form>
        <a href="cart.php"><button>Back to cart</button></a>

        <?php
        if (isset($_POST['paySub'])) {
            $payMethod = $_POST["payMethod"];
            if ($payMethod == "cod") {
        ?>

                <div id="cod" class="cod">
                    <form action="checkout.php" method="post">
                        <h3 class="title">billing address</h3>
                        <span>Full Name:</span>
                        <input type="text" name="flname" placeholder="Myra deo">
                        <span>Mob :</span>
                        <input type="tel" name="mob" placeholder="0123456789">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="example@example.com">
                        <span>Address:</span>
                        <input type="text" name="addr" placeholder="room - street - locality">
                        <input type="submit" name="chkOutCash" value="proceed to checkout" class="submit-btn">
                    </form>
                </div>

            <?php
            } elseif ($payMethod == "online") {
            ?>
                <div class="online" id="online">
                    <div class="container">
                        <form action="checkout.php" method="post">
                            <h3 class="title">billing address</h3>
                            <span>Full Name:</span>
                            <input type="text" name="flname" placeholder="Myra deo">
                            <span>Mob :</span>
                            <input type="tel" name="mob" placeholder="0123456789">
                            <span>Email :</span>
                            <input type="email" name="email" placeholder="example@example.com">
                            <span>Address:</span>
                            <input type="text" name="addr" placeholder="room - street - locality">


                            <h3 class="title">Payment</h3>
                            <span>Name on Card:</span>
                            <input type="text" name="cname" placeholder="mr.Myra deo">
                            <span>Card No:</span>
                            <input type="number" name="cnum" placeholder="1111-2222-3333-4444">
                            <span>exp month:</span>
                            <input type="text" name="expm" placeholder="january">
                            <span>exp year:</span>
                            <input type="number" name="expy" placeholder="2022">
                            <span>CVV:</span>
                            <input type="text" name="cvv" placeholder="1234">
                            <input type="submit" name="chkOutOnline" value="proceed to checkout" class="submit-btn">
                        </form>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </body>

    </html>

<?php

} else {
    header("Location: ../html/login.html");
}
