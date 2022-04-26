<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"] && $_SESSION["requested"]) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Success!!!!</title>
    </head>

    <body>
        <style>
            body {
                background-image: url("../image/logos2/Untitled.png");
                background-size: cover;
            }

            p {
                text-align: center;
                font-size: xx-large;
                font-weight: 700;
                color: rgb(19, 120, 10);
            }

            a .bkBtn {
                margin-left: 45%;
                margin-top: 12%;
                background-color: rgb(255, 255, 255);
                display: inline-block;
                padding: 16px 30px;
                border-radius: 30px;
                border: 20px;
                color: rgb(8, 20, 129);
                text-decoration: none;
                text-align: center;
            }

            a .bkBtn:hover {
                cursor: pointer;
                background-color: #73b1eb5b;
                color: aqua;
            }
        </style>
        <p>You have requested the book successfully!! </p>
        <br>
        <br>

        <a href="dashboard.php"><button class="bkBtn">Go back to Dashboard</button></a>

    </body>

    </html>

<?php

} else {
    header("Location: ../html/login.html");
}
