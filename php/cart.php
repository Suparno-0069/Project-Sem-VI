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
        <link rel="stylesheet" href="../css/dashb.css">
    </head>

    <body>
        <style>
            .buyNow {
                padding-top: 20px;
                padding-bottom: 20px;
                align-items: center;
                text-align: center;
            }

            .btn {
                background-color: rgb(255, 255, 255);
                display: inline-block;
                padding: 16px 30px;
                border-radius: 30px;
                border: 20px;
                color: rgb(8, 20, 129);
                width: 150px;
                text-align: center;
                /* margin-left: 110px;
                margin-bottom: 0px; */
                text-decoration: none;
                font-size: 16px;
                font-weight: 400;
            }

            .btn:hover {
                cursor: pointer;
                background-color: #73b1eb5b;
                color: aqua;
            }
        </style>
        <nav class="navbar">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>

        <section>
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

                    <div><img src="../image/book-1.png" alt="book 1" style="width:10%"></div>
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
            $sqlC = "SELECT * FROM cart";
            $resC = $conn->query($sqlC);
            if ($resC->num_rows > 0) {
                $rowC = $resC->fetch_assoc();
            ?>

                <button class="btn" onclick="window.location = 't_buyNow.php'">Buy Now</button>

            <?php
            }
            ?>
        </section>

        <script src="../js/script2.js"></script>
    </body>

    </html>

<?php

} else {
    header("Location: ../html/login.html");
}
