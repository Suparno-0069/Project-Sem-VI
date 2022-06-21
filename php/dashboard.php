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
            <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
            <link rel="stylesheet" href="../font-awesome/css/all.min.css">
            <link rel="stylesheet" href="../css/dashb.css">
            <link rel="stylesheet" href="../css/dashboardstyle.css">
            <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        </head>

        <body>
            <!-- nav-bar -->
            <nav id="navbar">
                <ul>

                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="../html/requestPage.html">Request a Book</a></li>
                    <li><a href="myOrders.php">My Orders</a></li>
                    <li><a href="../pdf-reader/myEbooks.php">My E-Books</a></li>
                    <?php
                    $RCsql = "SELECT * FROM reviews WHERE uname='$un'";
                    $RCres = $conn->query($RCsql);
                    if ($RCres->num_rows > 0) {
                    ?>
                    <?php
                    } else {
                    ?>
                        <li><a href="reviews.php">Review</a></li>
                    <?php
                    }
                    ?>
                    <a id="logout" class="loginbtn" href="logout.php"><button><img src="../image/logos2/icons8-logout-66.png" alt="LOGOUT"></button></a>
                </ul>

            </nav>


            <div id="profilecard" class="cards">
                <div>
                    <img src="../uploads/profilePics/<?php echo $row["profile_pic"]; ?>" alt="profile_image">
                </div>
                <div id="name_head">
                    <h1>
                        <?php echo $row["fname"] . " " . $row["lname"]; ?>
                        <br><br>
                    </h1>
                    <div id="details">
                        <h4>Gender </h4><?php echo $row["gender"] ?>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <h4>DOB </h4><?php echo $row["dob"] ?>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <h4>Contact </h4><?php echo $row["mob"] ?>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <h4>Email </h4><?php echo $row["email"] ?>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <h4>Address </h4><?php echo $row["addresses"] ?>
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <h4>Country </h4><?php echo $row["country"] ?>
                        <br><br>
                        <li><a href="updateProfile.php">Update Profile</a></li>
                    </div>
                </div>
                <a id="kart" href="cart.php"><i class="fas fa-shopping-cart fa-4x"></i></a>
            </div>


        </body>

        </html>

<?php
    }
} else {
    header("Location: ../html/login.html");
}

?>