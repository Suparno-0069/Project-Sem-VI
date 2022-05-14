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
        <title>Requests</title>
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
