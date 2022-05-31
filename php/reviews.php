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
    </head>

    <body>
        <style>
            .frm {
                align-items: center;
                background-image: url("../image/logos2/tumblr_pu0ndkstCx1uzwgsuo1_400.gif");
                background-size: cover;
                margin-top: 100px;
                margin-left: 200px;
                margin-right: 600px;
            }

            .frm span {
                font-size: large;
                color: aqua;
                padding: 7px;
            }

            .frm input[type=submit],
            .btn {
                background-color: rgb(255, 255, 255);
                display: inline-block;
                padding: 16px 30px;
                border-radius: 30px;
                border: 20px;
                color: rgb(8, 20, 129);
                width: 150px;
                text-align: center;
                margin-left: 110px;
                margin-bottom: 0px;
                text-decoration: none;
                font-size: 16px;
                font-weight: 400;
            }

            .frm input[type=submit]:hover,
            .btn:hover {
                cursor: pointer;
                background-color: #73b1eb5b;
                color: aqua;
            }
        </style>
        <nav>
            <ul>
                <li><a href="dashboard.php">Back To dash</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
        <form action="" method="post" class="frm">
            <?php
            $R_sql = "SELECT * FROM users WHERE uname='$un'";
            $R_res = $conn->query($R_sql);
            $R_row = $R_res->fetch_assoc();

            ?>
            <span>Full Name:</span>
            <input type="text" value="<?php echo $R_row["fname"] . $R_row["lname"]; ?>" readonly> <br> <br>
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

if($_POST){
    $uname = $_POST["uname"];
    $desc = $_POST["desc"];

    $sql_R = "INSERT INTO reviews(uname)";
}

} else {
    header("Location: ../html/login.html");
}
