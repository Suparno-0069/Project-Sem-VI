<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {
    $uid = $_SESSION["uid"];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart - Urban Chapters</title>
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/cartstyle.css">
    </head>

    <body>
        <nav class="navbar">
            <ul>
                <li><a href="shop.php">Shop</a></li>
                
                <li><a href="../html/requestPage.html">Request a Book</a></li>
                <li><a href="dashboard.php">My profile</a></li>
                <li><a href="myOrders.php">My Orders</a></li>
                <a id="logout" class="loginbtn" href="logout.php"><button><img src="../image/logos2/icons8-logout-66.png"
                        alt="LOGOUT"></button></a>
            </ul>

        </nav>
        <h1 id="myorder">Cart <img src="../image/logos2/cart.jpg" alt=""></h1>
        <section class="karttable">
            <?php
            $sql = "SELECT * FROM cart WHERE usrid='$uid'";
            $res = $conn->query($sql);
            while ($row = $res->fetch_assoc()) {
                $bid = $row["bid"];

                $sqll = "SELECT * FROM books WHERE bid='$bid'";
                $ress = $conn->query($sqll);
                $rw = $ress->fetch_assoc();

                if ($rw) {
                    $pid = $rw["pid"];
                    $que = "SELECT p_name FROM publishers WHERE pid='$pid'";
                    $r = $conn->query($que);
                    $rr = $r->fetch_assoc();
                    $pname = $rr["p_name"];
            ?>

                    <div><img src="../uploads/<?php echo $rw["thumbnail"]; ?>" alt="book <?php echo $rw["bid"]; ?>" style="width:10%"></div>
                    <table>
                        <thead>
                            <tr>
                                <th>Book Name</th>
                                <th>Author Name</th>
                                <th>Publisher Name</th>
                                <th>Price</th>
                                <th>ISBN</th>
                                <th>Pages</th>
                                <th>Rating</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $rw["book_name"]; ?></td>
                                <td><?php echo $rw["author_name"]; ?></td>
                                <td><?php echo $pname; ?></td>
                                <td><?php echo $rw["price"]; ?></td>
                                <td><?php echo $rw["isbn"]; ?></td>
                                <td><?php echo $rw["pages"]; ?></td>
                                <td><?php echo $rw["rating"]; ?></td>
                                <td>
                                    <form action="delFrmCart.php" method="post">
                                        <input type="text" name="cid" value="<?php echo $row["c_id"]; ?>" readonly style="display: none;">
                                        <input type="text" name="qtyy" value="<?php echo $rw["quantity"] ?>" readonly style="display: none;">
                                        <input type="text" name="bid" value="<?php echo $rw["bid"] ?>" readonly style="display: none;">
                                        <input class="btn" type="submit" value="Remove" name="cartRem">
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <hr>

            <?php
                }
            }
            ?>
        </section>

        <section class="buyNow">
            <?php
            $sqlC = "SELECT * FROM cart WHERE usrid='$uid'";
            $resC = $conn->query($sqlC);
            if ($resC->num_rows > 0) {

            ?>
                <button onclick="window.location = 'buyNow.php'" class="btn">Buy Now</button>
            <?php
            } else {
            ?>
                <div class="instraction">There is nothing in the cart, <a href="shop.php">Add something to cart.</a></div>
            <?php
            }
            ?>
        </section>

    </body>

    </html>

<?php

} else {
    header("Location: ../html/login.html");
}
