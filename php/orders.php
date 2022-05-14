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
        <link rel="stylesheet" href="../css/dashb.css">
    </head>

    <body>
        <style>
            .btn {
                background-color: rgb(255, 255, 255);
                display: inline-block;
                padding: 16px 30px;
                border-radius: 30px;
                border: 20px;
                color: rgb(8, 20, 129);
                width: 150px;
                text-align: center;
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
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
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
                $sql = "SELECT * FROM orders";
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

        <script src="../js/script2.js"></script>
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
