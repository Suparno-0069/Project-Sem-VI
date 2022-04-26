<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {

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
        <?php
        if (isset($_POST['paySub'])) {
            $payMethod = $_POST["payMethod"];
            if ($payMethod == "cod") {
        ?>

                <div id="cod" class="cod">
                    <p>Pay when the Book Arrives....</p>
                </div>

            <?php
            } elseif ($payMethod == "online") {
            ?>
                <div class="online" id="online">
                    <div class="container">
                        <form action="">
                            <div class="row">
                                <div class="col">
                                    <h3 class="title">billing address</h3>
                                    <div class="inputbox">
                                        <span>Full Name:</span>
                                        <input type="text" placeholder="Myra deo">
                                    </div>
                                    <div class="inputbox">
                                        <span>Email :</span>
                                        <input type="email" placeholder="example@example.com">
                                    </div>
                                    <div class="inputbox">
                                        <span>Address:</span>
                                        <input type="text" placeholder="room - street - locality">
                                    </div>
                                    <div class="inputbox">
                                        <span>City:</span>
                                        <input type="text" placeholder="Mumbai">
                                    </div>
                                    <div class="flex">
                                        <div class="inputbox">
                                            <span>State:</span>
                                            <input type="text" placeholder="India">
                                        </div>
                                        <div class="inputbox">
                                            <span>Zip code:</span>
                                            <input type="text" placeholder="123 456">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <h3 class="title">Payment</h3>

                                    <div class="inputbox">
                                        <span>Name on Card:</span>
                                        <input type="text" placeholder="mr.Myra deo">
                                    </div>

                                    <div class="inputbox">
                                        <span>Crdit Card No:</span>
                                        <input type="number" placeholder="1111-2222-3333-4444">
                                    </div>
                                    <div class="inputbox">
                                        <span>exp month:</span>
                                        <input type="text" placeholder="january">
                                    </div>
                                    <div class="flex">
                                        <div class="inputbox">
                                            <span>exp year:</span>
                                            <input type="number" placeholder="2022">
                                        </div>
                                        <div class="inputbox">
                                            <span>CVV:</span>
                                            <input type="text" placeholder="1234">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="proceed to checkout" class="submit-btn">
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
