<?php
session_start();
include "dbconn.php";
if ($_SESSION["logged"]) {
    $un = $_SESSION["sun"];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UPDATE</title>
        <link rel="stylesheet" href="../css/dashb.css">
    </head>

    <body>
        <style>
            .frm {
                align-items: center;
                background-image: url("../image/logos2/tumblr_pu0ndkstCx1uzwgsuo1_400.gif");
                background-size: cover;
                margin-top: 100px;
                margin-left: 200px;
                margin-right: 600px;
            }

            .frm label {
                font-size: large;
                color: aqua;
                padding: 7px;
            }

            .frm input[type=submit],
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

            .frm input[type=submit]:hover,
            .btn:hover {
                cursor: pointer;
                background-color: #73b1eb5b;
                color: aqua;
            }
        </style>
        <nav>
            <ul>
                <li><a href="dashboard.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>
        <form class="frm" method="post" action="">
            <?php
            $sql = "SELECT * FROM users WHERE uname='$un'";
            $res = $conn->query($sql);
            $row = $res->fetch_assoc();
            ?>
            <label><b>First Name</b></label>
            <br>
            <input type="text" name="fname" id="fname" value="<?php echo $row["fname"]; ?>" style="width: 300px;">
            <br><br>
            <label><b>Last Name</b></label>
            <br>
            <input type="text" name="lname" id="lname" value="<?php echo $row["lname"]; ?>" style="width: 300px;">
            <br><br>
            <label>Enter DOB :</label>
            <input type="date" name="dob" id="dob" value="<?php echo $row["dob"]; ?>">
            <br><br>
            <label>Enter Mobile Number :</label>
            <input type="tel" name="mno" id="mno" value="<?php echo $row["mob"]; ?>">
            <br><br>
            <label>Enter Email :</label>
            <input type="email" name="email" id="email" value="<?php echo $row["email"]; ?>" style="width: 300px;">
            <br><br>
            <label>Enter Address :</label><br>
            <textarea name="addr" id="addr" cols="50" rows="3"><?php echo $row["addresses"]; ?></textarea>
            <input type="text" name="uid" value="<?php echo $row["usrid"] ?>" readonly style="display: none;">
            <br><br>
            <br><br>
            <input type="submit" name="submitUpdate" value="Upadate">
            <input type="reset" class="btn" value="Reset">
        </form>
    </body>

    </html>

<?php
    if (isset($_POST['submitUpdate'])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $dob = $_POST["dob"];
        $mno = $_POST["mno"];
        $email = $_POST["email"];
        $addr = $_POST["addr"];
        $uid = $_POST["uid"];

        $upSql = "UPDATE users
    SET fname='$fname', lname='$lname', dob='$dob', mob='$mno', email='$email', addresses='$addr'
    WHERE usrid='$uid'";

        if ($conn->query($upSql)) {
            header("Location: updateProfile.php");
        } else {
            echo "Something went wrong!" . $conn->error;
        }
    }
} else {
    header("Location: ../html/login.html");
}
