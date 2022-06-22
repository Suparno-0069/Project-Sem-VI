<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {
    $un = $_SESSION["sun"];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reviews - Urban Chapters</title>
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/reviewstyle.css">
    </head>

    <body>
        <nav>
            <ul>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="../html/requestPage.html">Request a Book</a></li>
                    <li><a href="myOrders.php">My Orders</a></li>
                    <li><a href="../pdf-reader/myEbooks.php">My E-Books</a></li>
                    <?php
                    $RCsql = "SELECT * FROM reviews WHERE uname='$un'";
                    $RCres = $conn->query($RCsql);
                    if ($RCres->num_rows > 0) {
                    ?>
                    <?php
                    } else {
                    ?>
                        <li><a href="reviews.php">Review</a></li>
                    <?php
                    }
                    ?>
                    <a id="logout" class="loginbtn" href="logout.php"><button><img src="../image/logos2/icons8-logout-66.png" alt="LOGOUT"></button></a>

            </ul>

        </nav>
        <h1>Add Review</h1>
        <form action="" method="post" class="frm">
            <?php
            $R_sql = "SELECT * FROM users WHERE uname='$un'";
            $R_res = $conn->query($R_sql);
            $R_row = $R_res->fetch_assoc();

            ?>
            <span>User Name:</span>
            <input type="text" name="uname" value="<?php echo $R_row["uname"]; ?>" readonly> <br> <br>
            <span>Write your Review:</span>
            <textarea name="desc" cols="50" rows="3"></textarea> <br>
            <input type="reset" value="Reset" class="btn">
            <input type="submit" value="Submit">
        </form>

    </body>

    </html>
<?php

    if ($_POST) {
        $uname = $_POST["uname"];
        $desc = $_POST["desc"];

        $sql_R = "INSERT INTO reviews(uname, descriptions)
        VALUES('$uname', '$desc')";

        if ($conn->query($sql_R)) {
            echo "<script> alert('Thanks for your valuable review');
        window.location = 'dashboard.php'; </script>";
        } else {
            echo "Something went wrong!! " . $conn->error;
        }
    }
} else {
    header("Location: ../html/login.html");
}
