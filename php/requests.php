<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {

    // $un = $_SESSION["aun"];

    $sql = "SELECT * FROM requests";
    $res = $conn->query($sql);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Requests</title>
        <link rel="stylesheet" href="../css/dashb.css">
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="adminDashboard.php">DashBoard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
        <table>
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Publisher Name</th>
                    <th>User Name</th>
                    <th>Description</th>
                    <th>Timestamp</th>
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
                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
    </body>

    </html>

<?php

} else {
    header("Location: ../html/adminLogin.html");
}
