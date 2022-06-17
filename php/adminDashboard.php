<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {

    $un = $_SESSION["aun"];

    $sql = "SELECT * FROM admins WHERE usrname='$un'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    if ($row) {

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin profile</title>
            <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="../css/dashb.css">
            <link rel="stylesheet" href="../css/adminDashboardstyle.css">
        </head>

        <body>
            <!-- nav-bar -->
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
            <div class="admindetails">
                <h2><?php echo $row["usrname"]; ?></h2>
                <br>
                <img src="../image/logos2/account1.png" alt="Admin picture">
                <br><br>
                <h4><?php echo $row["admin_name"]; ?></h4>
                <br>
                <span><b>Contact No. -</b>     <?php echo $row["mob"] ?></span>
                <br>
                <span><b>Email -</b>       <?php echo $row["email"] ?></span>
            </div>

            
        </body>

        </html>

<?php
    }
} else {
    header("Location: ../html/adminLogin.html");
}

?>