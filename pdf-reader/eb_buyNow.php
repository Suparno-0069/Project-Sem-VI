<?php
session_start();
include "../php/dbconn.php";
if ($_SESSION["logged"]) {
    if (isset($_POST['ebbuy'])) {
        $usid = $_POST["usid"];
        $ebid = $_POST["ebid"];
        $price = $_POST["price"];
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Buy - Urban Chapters</title>
            <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="../css/paymentpage.css">
        </head>

        <body>
            <div class="online" id="online">
                <div class="container">
                    <form action="redBuyEb.php" method="post" enctype="multipart/form-data">
                        <h3 class="title">billing address</h3>
                        <span>Full Name:</span>
                        <input type="text" name="flname" placeholder="Myra deo">
                        <span>Mob :</span>
                        <input type="tel" name="mob" placeholder="0123456789">
                        <span>Email :</span>
                        <input type="email" name="email" placeholder="example@example.com">
                        <span>Address:</span>
                        <input type="text" name="addr" placeholder="room - street - locality">
                        <input type="text" name="ptype" value="online" readonly style="display: none;">
                        <input type="text" name="usid" value="<?php echo $usid; ?>" readonly style="display: none;">
                        <input type="text" name="ebid" value="<?php echo $ebid; ?>" readonly style="display: none;">
                        <input type="text" name="price" value="<?php echo $price; ?>" readonly style="display: none;">


                        <h3 class="title">Payment</h3>
                        <span>ss of payment:</span>
                        <input type="file" name="myFile" onchange="myFnc()">
                        <input type="submit" name="chkOutOnline" value="proceed to checkout" class="submit-btn" id="chkOutOnline" disabled>
                    </form>
                </div>
            </div>

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
    }
} else {
    header("Location: ../html/login.html");
}
