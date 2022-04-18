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
        <title>Add or remove publishers -Uraban Chapters</title>
        <link rel="stylesheet" href="../css/dashb.css">
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Featured</a></li>
                <li><a href="#">Arrivals</a></li>
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
        <form action="" method="post">
            Publisher Name : <input type="text" name="pname"><br>
            <br>
            Website : <input type="url" name="website"><br>
            <br>
            Address : <textarea name="addr" cols="50" rows="3"></textarea><br>
            <br>
            Email : <input type="email" name="email">
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
