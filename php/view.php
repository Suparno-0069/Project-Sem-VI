<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {

    if (isset($_POST['view'])) {
        $bid = $_POST["bid"];
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book - Urban Chapters</title>
        <link rel="stylesheet" href="../css/dashb.css">
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="shop.php">Back to Shop</a></li>
                <li><a href="../html/requestPage.html">Request a Book</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
        <?php
        $sql = "SELECT * FROM books WHERE bid='$bid'";
        $res = $conn->query($sql);
        ?>
        <table>
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Author Name</th>
                    <th>Publisher Name</th>
                    <th>Price</th>
                    <th>Rating</th>
                    <th>Genre</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $res->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row["book_name"]; ?></td>
                        <td><?php echo $row["author_name"]; ?></td>
                        <?php
                        $pid = $row["pid"];
                        $sql2 = "SELECT p_name FROM publishers WHERE pid='$pid'";
                        $res2 = $conn->query($sql2);
                        $rPid = $res2->fetch_assoc();
                        $pname = $rPid["p_name"]
                        ?>
                        <td><?php echo $pname; ?></td>
                        <td><?php echo $row["price"]; ?></td>
                        <td><?php echo $row["rating"]; ?></td>
                        <td><?php echo $row["genre"]; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </body>

    </html>

<?php

} else {
    header("Location: ../html/login.html");
}
