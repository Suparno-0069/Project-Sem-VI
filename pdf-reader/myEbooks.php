<?php
session_start();
include "../php/dbconn.php";
if ($_SESSION["logged"]) {
    $uid  = $_SESSION["uid"];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>E-books - Urban chapters</title>
        <link rel="stylesheet" href="../font-awesome/css/all.min.css">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/shopstyle.css">
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="../php/dashboard.php">Home</a></li>
                <li><a href="../html/requestPage.html">Request a Book</a></li>
                <li><a href="../php/cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                <li><a href="../php/myOrders.php">My Orders</a></li>
                <li><a href="../php/shop.php">Shop</a></li>
                <li><a href="../php/logout.php">Logout</a></li>
            </ul>

        </nav>
        <section id="featured">
            <div class="cards">
                <?php
                $preSQl = "SELECT ebid FROM ebusers WHERE usrid='$uid'";
                $preREs = $conn->query($preSQl);
                while ($preROw = $preREs->fetch_assoc()) {

                    $eid = $preROw["ebid"];

                    $sql = "SELECT * FROM ebooks WHERE ebid='$eid'";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()) {

                ?>

                        <div class="card">
                            <!-- <img src="../uploads/thumbnails/ echo $row["thumbnail"]; ?>" alt="book  echo $row["bid"]; ?>" style="width:100%"> -->
                            <h3><?php echo $row["eb_name"]; ?></h3>
                            <p class="price">₹500.00</p>
                            <p>Author Name : <?php echo $row["eb_aname"]; ?></p>
                            <form action="../pdf-reader/reader.php" method="post">
                                <input type="text" name="url" value="<?php echo $row["eb_url"] ?>" readonly style="display: none;">
                                <p><button type="submit" name="ebread">Read</button></p>
                            </form>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </body>

    </html>
<?php
} else {
    header("Location: ../html/login.html");
}
