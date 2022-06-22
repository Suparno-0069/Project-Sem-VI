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
                            <img src="../uploads/ebThumbnail/<?php echo $row["eb_thumbnail"]; ?>" alt="book <?php echo $row["ebid"]; ?>" style="width:100%">
                            <a href="../pdf-reader/<?php echo $row["eb_url"]; ?> " target="_blank"> <i class="fas fa-download"></i> </a>
                            <h3><?php echo $row["eb_name"]; ?></h3>
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
