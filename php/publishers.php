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
        <title>Add Publishers -Uraban Chapters</title>
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/publishersstyle.css">
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
        <h1>Add Publishers</h1>
        <form class="frmm" action="" method="post">
            <label> Name : </label><input type="text" name="pname"><br>
            <br>
            <label>Website : </label><input type="url" name="website"><br>
            <br>
            <label>Address : </label><textarea name="addr" cols="50" rows="3"></textarea><br>
            <br>
            <label>Email : </label><input type="email" name="email">
            <br><br>
            <br><br>
            <input type="submit" value="Submit">
        </form>
        <br><br>
        <hr>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Publisher Name</th>
                    <th>Website </th>
                    <th>Address</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqll = "SELECT * FROM publishers";
                $res = $conn->query($sqll);
                while ($row = $res->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row["p_name"]; ?></td>
                        <td><?php echo $row["website"]; ?></td>
                        <td><?php echo $row["addresses"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td>
                            <form action="publisherDel.php" method="post">
                                <input type="text" name="pid" value="<?php echo $row["pid"] ?>" readonly style="display:none;">
                                <input type="submit" value="Delete" class="btn" name="pubDell">
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </body>

    </html>

<?php

    if ($_POST) {
        $pname = $_POST["pname"];
        $website = $_POST["website"];
        $addr = $_POST["addr"];
        $email = $_POST["email"];

        $sql = "INSERT INTO publishers(p_name, website, addresses, email)
        VALUES('$pname', '$website', '$addr', '$email')";

        if ($conn->query($sql)) {
            echo "<script> alert('Success!!!!')
            window.location = 'publishers.php'</script>";
        } else {
            echo "somthing went wrong!" . $conn->error;
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}
