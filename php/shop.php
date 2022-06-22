<?php
session_start();
include "dbconn.php";
if ($_SESSION["logged"]) {
    $uid  = $_SESSION["uid"];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop - Urban Chapters</title>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
        <link rel="stylesheet" href="../font-awesome/css/all.min.css">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/shopstyle.css">
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <nav id="navbar">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="../html/requestPage.html">Request a Book</a></li>
                <li><a href="dashboard.php">My Profile</a></li>
                
                <li><a href="myOrders.php">My Orders</a></li>

                <a id="logout" class="loginbtn" href="logout.php"><button><img src="../image/logos2/icons8-logout-66.png" alt="LOGOUT"></button></a>
            </ul>
        </nav>
        <a id="kart" href="cart.php"><i class="fas fa-shopping-cart fa-3x"></i></a>
        <a id="ebookbutton" href="../pdf-reader/ebooks.php"><img src="../image/logos2/5aa3ae0b9fc609199d0ff243.png" alt="E-BOOKS"></a>
        <h1>SHOP</h1>
        <section>
            <form class="searchBox" action="" method="get">
                <input type="text" name="searchQue" placeholder="Search by book name...">
                <button type="submit" name="subSearch"><i class="fas fa-search"></i></button>
            </form>
        </section>
        <?php
        if (isset($_GET['subSearch'])) {
            $que = $_GET["searchQue"];
        ?>
            <section id="searched">
                <div class="cards">
                    <?php
                    $S_sql = "SELECT * FROM books WHERE book_name LIKE '%$que%'";
                    $S_res = $conn->query($S_sql);
                    while ($S_row = $S_res->fetch_assoc()) {
                    ?>

                        <div class="card">
                            <img src="../uploads/thumbnails/<?php echo $S_row["thumbnail"]; ?>" alt="book <?php echo $S_row["bid"]; ?>" style="width:100%">
                            <h3><?php echo $S_row["book_name"]; ?></h3>
                            <p class="price">₹<?php echo $S_row["price"]; ?></p>
                            <p>Author Name : <?php echo $S_row["author_name"]; ?></p>
                            <form action="view.php" method="post">
                                <input type="text" name="bid" value="<?php echo $S_row["bid"] ?>" readonly style="display: none;">
                                <p><button type="submit" name="view">View</button></p>
                            </form>
                            <form action="" method="post">
                                <input type="text" name="bid" value="<?php echo $S_row["bid"] ?>" readonly style="display: none;">
                                <input type="text" name="qtty" value="<?php echo $S_row["quantity"]; ?>" readonly style="display: none;">
                                <input type="text" name="price" value="<?php echo $S_row["price"] ?>" readonly style="display: none;">
                                <input type="text" name="uid" value="<?php echo $uid ?>" readonly style="display: none;">
                                <?php
                                if ($S_row["quantity"] == "0") {
                                ?>
                                    <p style="color: RED;">Out of stock</p>
                                <?php
                                } else {
                                ?>
                                    <p><button type="submit" name="cart">Add to Cart</button></p>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </section>
        <?php
        }
        ?>
        <section id="shopbooks">
            <div class="cards">
                <?php
                $sql = "SELECT * FROM books";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    // $b_id = $row["bid"];
                    // $qtty = $row["quantity"];
                ?>

                    <div class="card">
                        <!-- <img src="../image/book-1.png" alt="book 1" style="width:100%"> -->
                        <img src="../uploads/thumbnails/<?php echo $row["thumbnail"]; ?>" alt="book <?php echo $row["bid"]; ?>" style="width:100%">
                        <h3><?php echo $row["book_name"]; ?></h3>
                        <p class="price">₹<?php echo $row["price"]; ?></p>
                        <p>Author Name : <?php echo $row["author_name"]; ?></p>
                        <form action="view.php" method="post">
                            <input type="text" name="bid" value="<?php echo $row["bid"] ?>" readonly style="display: none;">
                            <p><button type="submit" name="view">View</button></p>
                        </form>
                        <form action="" method="post">
                            <input type="text" name="bid" value="<?php echo $row["bid"] ?>" readonly style="display: none;">
                            <input type="text" name="qtty" value="<?php echo $row["quantity"]; ?>" readonly style="display: none;">
                            <input type="text" name="price" value="<?php echo $row["price"] ?>" readonly style="display: none;">
                            <input type="text" name="uid" value="<?php echo $uid ?>" readonly style="display: none;">
                            <?php
                            if ($row["quantity"] == "0") {
                            ?>
                                <p style="color: RED;">Out of stock</p>
                            <?php
                            } else {
                            ?>
                                <p><button type="submit" name="cart">Add to Cart</button></p>
                            <?php
                            }
                            ?>
                        </form>
                        <!-- <iframe src="view.php" class="view" frameborder="0"></iframe> -->
                    </div>
                <?php
                }
                ?>
            </div>
        </section>

        <section class="footer">

            <div class="box-container">

                <div class="box">
                    <div class="social">
                        <h3>Follow Us</h3>
                        <br>
                        <a href="https://www.facebook.com"> <i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.twitter.com"> <i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com"> <i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com"> <i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
                <div class="box">
                    <h3>Quick Links</h3>
                    <a href="#"> <i class="fas fa-arrow-right"></i> Home </a>
                    <a href="#"> <i class="fas fa-arrow-right"></i> Featured </a>
                    <a href="#"> <i class="fas fa-arrow-right"></i> Arrivals </a>
                    <a href="#"> <i class="fas fa-arrow-right"></i> Reviews </a>
                </div>
                <div class="box">
                    <a href="#"> <i class="fas fa-arrow-right"></i> About Us </a>
                    <a href="reviewpage.html"> <i class="fas fa-arrow-right"></i> Review </a>
                    <a href="#"> <i class="fas fa-arrow-right"></i> About Page </a>
                </div>

            </div>
        </section>
    </body>

    </html>

<?php

    if (isset($_POST['cart'])) {
        $bid = $_POST["bid"];
        $uid = $_POST["uid"];
        $qtty = $_POST["qtty"];
        $price = $_POST["price"];


        $sqq = "INSERT INTO cart(usrid, bid, price)
        VALUES('$uid', '$bid', '$price')";

        if ($conn->query($sqq)) {
            $qtty -= 1;
            $bSql = "UPDATE books
            SET quantity='$qtty'
            WHERE bid='$bid'";
            $conn->query($bSql);
            // echo "<script>alert('Success!!!!'); </script>";
        } else {
            echo "something went wrong" . $conn->error;
        }
    }
} else {
    header("Location: ../html/login.html");
}
