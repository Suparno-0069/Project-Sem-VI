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
        <style>
            .frmm {
                align-items: center;
                background-image: url("../image/logos2/tumblr_pu0ndkstCx1uzwgsuo1_400.gif");
                background-size: cover;
                margin-top: 100px;
                margin-left: 200px;
                margin-right: 600px;
            }

            .frmm label {
                font-size: large;
                color: aqua;
                padding: 7px;
            }

            .frmm input[type=submit],
            .btn {
                background-color: rgb(255, 255, 255);
                display: inline-block;
                padding: 16px 30px;
                border-radius: 30px;
                border: 20px;
                color: rgb(8, 20, 129);
                width: 150px;
                text-align: center;
                margin-left: 110px;
                margin-bottom: 0px;
                text-decoration: none;
                font-size: 16px;
                font-weight: 400;
            }

            .frmm input[type=submit]:hover,
            .btn:hover {
                cursor: pointer;
                background-color: #73b1eb5b;
                color: aqua;
            }
        </style>
        <nav>
            <ul>
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
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
