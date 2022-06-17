<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orders - Urban Chapters</title>
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/ordersstyle.css">
    </head>

    <body>
        <nav class="navbar">
            <ul>
                <li><a href="adminDashboard.php">DashBoard</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="publishers.php">Publishers</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="requests.php">Requests</a></li>
                <li><a href="orders.php">Orders</a></li>
                <a id="logout" class="loginbtn" href="logout.php"><button><img src="../image/logos2/icons8-logout-66.png"
                        alt="LOGOUT"></button></a>
            </ul>

        </nav>
        <div class="headbutton">
            <button class="btn" id="order-btn">Offline Orders</button>
        </div>
        
        <div id="online-orders" class="ordertable">
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
                        <th>Paymet Screenshot</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM orders WHERE p_type='online'";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()) {
                        $Obid = $row["bid"];
                        $Ouid = $row["usrid"];

                        $B_sql = "SELECT book_name FROM books WHERE bid='$Obid'";
                        $B_res = $conn->query($B_sql);
                        $B_row = $B_res->fetch_assoc();
                        $bname = $B_row["book_name"];

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
                            <td><img src="../uploads/payments/<?php echo $row["screenshots"]; ?>" alt="??" height="100px"></td>
                            <td>
                                <form action="" method="post">
                                    <input type="text" name="oid" value="<?php echo $row["odrid"]; ?>" readonly style="display: none;">
                                    <input type="submit" name="rmOrd" value="Delete" class="btn">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="offline-orders" class="ordertable">
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM orders WHERE p_type='offline'";
                    $res = $conn->query($sql);
                    while ($row = $res->fetch_assoc()) {
                        $Obid = $row["bid"];
                        $Ouid = $row["usrid"];

                        $B_sql = "SELECT book_name FROM books WHERE bid='$Obid'";
                        $B_res = $conn->query($B_sql);
                        $B_row = $B_res->fetch_assoc();
                        $bname = $B_row["book_name"];

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
                            <td>
                                <form action="" method="post">
                                    <input type="text" name="oid" value="<?php echo $row["odrid"]; ?>" readonly style="display: none;">
                                    <input type="submit" name="rmOrd" value="Delete" class="btn">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <script>
            const onOrd = document.getElementById('online-orders');
            const offOrd = document.getElementById('offline-orders');

            const btn = document.getElementById('order-btn');

            btn.addEventListener('click', function handleClick() {
                if (offOrd.style.display === 'none') {
                    offOrd.style.display = 'block';
                    onOrd.style.display = 'none';

                    btn.textContent = 'Online Orders';
                } else {
                    offOrd.style.display = 'none';
                    onOrd.style.display = 'block';

                    btn.textContent = 'Offline Orders';
                }
            })
        </script>
    </body>

    </html>

<?php
    if (isset($_POST['rmOrd'])) {
        $oid = $_POST["oid"];

        $sqql = "DELETE FROM orders WHERE odrid='$oid'";
        if ($conn->query($sqql)) {
            echo "<script>window.location = 'orders.php'</script>";
        } else {
            echo "something went wrong!" . $conn->error;
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}
