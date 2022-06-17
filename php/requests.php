<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {

    // $un = $_SESSION["aun"];

    $sql = "SELECT * FROM requests ORDER BY rq_date_time DESC";
    $res = $conn->query($sql);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Requests - Urbn Chapters</title>
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/requestsstyle.css">
    </head>

    <body>
        <nav>
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
        <br>
        <h1>Requests Received</h1>

        <div class="instraction">
            <h6>How to resolve a request:</h6>

            First Add the publisher in the <a href="publishers.php">Publishers Page</a>,<br>
            Then Add The book in the <a href="books.php">Books Page</a>.
        </div>

        <table>
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Publisher Name</th>
                    <th>User Name</th>
                    <th>Description</th>
                    <th>Timestamp</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $res->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row["book_name"]; ?></td>
                        <td><?php echo $row["author_name"]; ?></td>
                        <td><?php echo $row["publisher_name"]; ?></td>
                        <?php
                        $uid = $row["usrid"];
                        $sql_uid = "SELECT fname, lname FROM users WHERE usrid='$uid'";
                        $res_uid = $conn->query($sql_uid);
                        $row_uid = $res_uid->fetch_assoc();
                        if ($row_uid) {
                            $uname = $row_uid["fname"] . " " . $row_uid["lname"];
                        }
                        ?>
                        <td><?php echo $uname; ?></td>
                        <td><?php echo $row["descriptions"]; ?></td>
                        <td><?php echo $row["rq_date_time"]; ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="text" name="rid" value="<?php echo $row["rqid"]; ?>" readonly style="display: none;">
                                <input type="submit" name="rqDel" value="Delete" class="btn">
                            </form>
                        </td>
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </body>

    </html>

<?php

    if (isset($_POST['rqDel'])) {
        $rid = $_POST["rid"];

        $D_sql = "DELETE FROM requests WHERE rqid='$rid'";
        if ($conn->query($D_sql)) {
            echo "<script>window.location = 'requests.php';</script>";
        } else {
            echo "Something went wrong" . $conn->error;
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}
