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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/shopstyle.css">
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="#">Featured</a></li>
                <li><a href="#">Arrivals</a></li>
                <li><a href="../html/requestPage.html">Request a Book</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                <li><a href="myOrders.php">My Orders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>

        <section id="featured">
            <?php
            $sql = "SELECT * FROM books";
            $res = $conn->query($sql);
            while ($row = $res->fetch_assoc()) {
                // $b_id = $row["bid"];
                // $qtty = $row["quantity"];
            ?>

                <div class="cards">
                    <div class="card" style="width: 12%;">
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
                            <p><button type="submit" name="cart">Add to Cart</button></p>
                        </form>
                        <!-- <iframe src="view.php" class="view" frameborder="0"></iframe> -->
                    </div>
                </div>
            <?php
            }
            ?>
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
