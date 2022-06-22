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
        <title>My Orders - Urban Chapters</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/myOrdersstyle.css">
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
        <h1 id="myorder">My Orders</h1>


        <div id="online-orders">
            <table>
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>User Name</th>
                        <th>Odered Book</th>
                        <th>Book Price</th>
                        <th>Reciver's Name</th>
                        <th>Reciver's Address</th>
                        <th>Reciver's Mob</th>
                        <th>Reciver's Email</th>
                        <th>Payment Type</th>
                        <th>Paymet Screenshot</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM orders WHERE usrid='$uid'";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()) {
                        $Obid = $row["bid"];
                        $Ouid = $row["usrid"];

                        $btype = $row["book_type"];
                        $bname = "";

                        if ($btype == "book") {

                            $B_sql = "SELECT book_name FROM books WHERE bid='$Obid'";
                            $B_res = $conn->query($B_sql);
                            if ($B_res->num_rows > 0) {
                                $B_row = $B_res->fetch_assoc();
                                $bname = $B_row["book_name"];
                            }
                        } elseif ($btype == "ebook") {

                            $B_sqll = "SELECT eb_name FROM ebooks WHERE ebid='$Obid'";
                            $B_resl = $conn->query($B_sqll);
                            if ($B_resl->num_rows > 0) {
                                $B_rowl = $B_resl->fetch_assoc();
                                $bname = $B_rowl["eb_name"];
                            }
                        }


                        $U_sql = "SELECT fname, lname FROM users WHERE usrid='$Ouid'";
                        $U_res = $conn->query($U_sql);
                        $U_row = $U_res->fetch_assoc();
                        $uname = $U_row["fname"] . $U_row["lname"];
                    ?>
                        <tr>
                            <td><?php echo $row["odrid"]; ?></td>
                            <td><?php echo $uname; ?></td>
                            <td><?php echo $bname ?></td>
                            <td><?php echo $row["price"]; ?></td>
                            <td><?php echo $row["full_name"]; ?></td>
                            <td><?php echo $row["order_address"]; ?></td>
                            <td><?php echo $row["mob"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["p_type"]; ?></td>

                            <td>
                                <?php
                                if ($row["p_type"] == "online") {
                                ?>
                                    <img src="../uploads/payments/<?php echo $row["screenshots"]; ?>" alt="??" height="100px">
                                <?php
                                } else {
                                    echo $row["screenshots"];
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>

    </html>
<?php
} else {
    header("Location: ../html/login.html");
}
