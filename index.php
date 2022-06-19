<?php
session_start();
include "./php/dbconn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
    <link rel="stylesheet" href="./font-awesome/css/all.min.css">
    <link rel="stylesheet" href="./css/indexstyle.css">
    <link rel="shortcut icon" href="./image/favicon.ico" type="image/x-icon">
    <title>URBAN CHAPTERS</title>
</head>

<body>
    <header class="header">
        <img id="logo" src="./image/logos/Logo_cyan.png" alt="logo">
        <img id="uctxt" src="./image/logos/Urban_Chapters (1).png" alt="UCtxt">
    </header>

    <nav class="navbar">
        <ul class="nav_links">
            <li><a class="active" href="#">Home</a></li>
            <li><a href="#featured">Featured</a></li>
            <li><a href="#arrivals">Arrivals</a></li>
            <li><a href="./html/about_us.html" target="_blank">About Us</a></li>
            <li><a href="./php/reviewPage.php" target="_blank">Reviews</a></li>
        </ul>
        <?php
        if (isset($_SESSION["logged"])) {
        ?>
            <div class="dropdown">
                <!-- <button class="dropbtn"><i class="fas fa-chevron-circle-down"></i></button> -->
                <button class="dropbtn"><i class="fas fa-user-circle fa-3x"></i></button>
                <div class="dropdown-content">
                    <a href="./php/dashboard.php"><i class="fas fa-user" title="Dashboard"></i></a>
                    <a href="./php/shop.php"><i class="fas fa-store" title="Shop"></i></a>
                    <a href="./php/logout.php"><i class="fas fa-sign-out-alt" title="LogOut"></i></a>
                </div>
            </div>
            <!-- <a href="./php/dashboard.php"><i class="fas fa-user"></i></a> -->
        <?php
        } else {
            session_unset();
            session_destroy();

        ?>

            <ul class="nav_links">
                <li><a href="./html/loginSelector.html">LOGIN</a></li>
            </ul>
            <!-- <a class="loginbtn" href="./html/loginSelector.html">
                <button>
                    <img src="./image/logos2/login-icon-3047-Windows.ico" alt="LOGIN">
                </button>
            </a> -->
        <?php
        }
        ?>
    </nav>

    <section id="featured">
        <h2>Featured</h2>
        <?php
        $sql = "SELECT * FROM books";
        $res = $conn->query($sql);
        ?>
        <div class="cards">
            <?php
            while ($row = $res->fetch_assoc()) {
            ?>
                <div class="card">
                    <img src="./uploads/thumbnails/<?php echo $row["thumbnail"]; ?>" alt="book 1">
                    <h3><?php echo $row["book_name"]; ?></h3>
                    <p>Author: <?php echo $row["author_name"]; ?></p>
                </div>
            <?php
            }
            ?>
        </div>
    </section>


    <section id="arrivals">
        <h2>Arrivals</h2>
        <?php
        $sql2 = "SELECT * FROM books ORDER BY bid DESC LIMIT 2";
        $res2 = $conn->query($sql2);
        ?>
        <?php

        while ($row2 = $res2->fetch_assoc()) {
        ?>
            <div class="card">
                <img src="./uploads/thumbnails/<?php echo $row2["thumbnail"]; ?>" alt="book 1">
                <h3><?php echo $row2["book_name"]; ?></h3>
                <p>Author: <?php echo $row2["author_name"]; ?></p>
            </div>
        <?php
        }

        ?>


    </section>

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>Follow Us</h3>
                <a href="https://www.facebook.com"> <i class="fab fa-facebook-f"></i></a>
                <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com"> <i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com"> <i class="fab fa-linkedin"></i></a>
                <a href="https://www.pintrest.com"> <i class="fab fa-pinterest"></i></a>
            </div>

            <div class="box">
                <h3>Quick Links</h3>
                <a href="#"> <i class="fas fa-arrow-right"></i> Home </a>
                <a href="#featured"> <i class="fas fa-arrow-right"></i> Featured </a>
                <a href="#arrivals"> <i class="fas fa-arrow-right"></i> Arrivals </a>
                <a href="./php/reviewPage.php"> <i class="fas fa-arrow-right"></i> Reviews </a>
            </div>

            <div class="box">
                <a href="./html/our-team/"> <i class="fas fa-arrow-right"></i> About Us </a>
                <a href="./php/reviews.php"> <i class="fas fa-arrow-right"></i> Review </a>
                <a href="#"> <i class="fas fa-arrow-right"></i> About Page </a>
            </div>

        </div>



    </section>

    <script src="./js/script2.js"></script>
</body>

</html>