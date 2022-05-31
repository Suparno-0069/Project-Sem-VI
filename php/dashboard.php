<?php
session_start();
include "dbconn.php";
if ($_SESSION["logged"]) {

    $un = $_SESSION["sun"];

    $sql = "SELECT * FROM users WHERE uname='$un'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    if ($row) {
        $_SESSION["uid"] = $row["usrid"];

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User profile</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
            <link rel="stylesheet" href="../css/dashb.css">
            <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        </head>

        <body>
            <!-- nav-bar -->
            <nav>
                <ul>
                    <li><a href="updateProfile.php">Update Profile</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="../html/requestPage.html">Request a Book</a></li>
                    <li><a href="cart.php"><i class="fas fa-shopping-cart"></i></a></li>
                    <li><a href="myOrders.php">My Orders</a></li>
                    <li><a href="reviews.php">Review</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>

            </nav>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>dob</th>
                        <th>Mob</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Country</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row["fname"] . " " . $row["lname"]; ?></td>
                        <td><?php echo $row["gender"] ?></td>
                        <td><?php echo $row["dob"] ?></td>
                        <td><?php echo $row["mob"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                        <td><?php echo $row["addresses"] ?></td>
                        <td><?php echo $row["country"] ?></td>
                    </tr>
                </tbody>
            </table>
        </body>

        </html>

<?php
    }
} else {
    header("Location: ../html/login.html");
}

?>