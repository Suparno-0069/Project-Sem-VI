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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/shopstyle.css">
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    </head>

    <body>
        <nav class="navbar">
            <ul>
                <li><a href="../php/dashboard.php">Home</a></li>
                <li><a href="../html/requestPage.html">Request a Book</a></li>
                <li><a href="../php/myOrders.php">My Orders</a></li>
                <li><a href="../php/shop.php">Shop</a></li>
                <a id="logout" class="loginbtn" href="../php/logout.php"><button><img src="../image/logos2/icons8-logout-66.png" alt="LOGOUT"></button></a>
            </ul>

        </nav>
        <section id="shopbooks">
            <div class="cards">
                <?php
                $sql = "SELECT * FROM ebooks";
                $res = $conn->query($sql);
                while ($row = $res->fetch_assoc()) {
                    // $b_id = $row["bid"];
                    // $qtty = $row["quantity"];
                ?>

                    <div class="card">
                        <img src="../uploads/ebThumbnail/<?php echo $row["eb_thumbnail"]; ?>" alt="book <?php echo $row["ebid"]; ?>" style="width:100%">
                        <h3><?php echo $row["eb_name"]; ?></h3>
                        <p class="price"><?php echo $row["price"]; ?></p>
                        <p>Author Name : <?php echo $row["eb_aname"]; ?></p>
                        <form action="eb_buyNow.php" method="post">
                            <input type="text" name="usid" value="<?php echo $uid; ?>" readonly style="display: none;">
                            <input type="text" name="ebid" value="<?php echo $row["ebid"]; ?>" readonly style="display: none;">
                            <input type="text" name="price" value="<?php echo $row["price"]; ?>" readonly style="display: none;">
                            <p><button type="submit" name="ebbuy">Buy</button></p>
                        </form>
                        <!-- <iframe src="view.php" class="view" frameborder="0"></iframe> -->
                    </div>
                <?php
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
