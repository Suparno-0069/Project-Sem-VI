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
    </head>

    <body>
        <form method="post" action="">
            <?php
            $sql = "SELECT * FROM users WHERE uname='$un'";
            $res = $conn->query($sql);
            $row = $res->fetch_assoc();
            ?>
            <label><b>First Name</b></label>
            <br>
            <input type="text" name="fname" id="fname" placeholder="<?php echo $row["fname"]; ?> " style="width: 300px;">
            <br><br>
            <label><b>Last Name</b></label>
            <br>
            <input type="text" name="lname" id="lname" placeholder="<?php echo $row["lname"]; ?>" style="width: 300px;">
            <br><br>
            <label>Enter DOB :</label>
            <input type="date" name="dob" id="dob" value="<?php echo $row["dob"]; ?>">
            <br><br>
            <label>Enter Mobile Number :</label>
            <input type="tel" name="mno" id="mno" placeholder="<?php echo $row["mob"]; ?>">
            <br><br>
            <label>Enter Email :</label>
            <input type="email" name="email" id="email" placeholder="<?php echo $row["email"]; ?>" style="width: 300px;">
            <br><br>
            <label>Enter Address :</label><br>
            <textarea name="addr" id="addr" cols="50" rows="3" placeholder="<?php echo $row["addresses"]; ?>"></textarea>
            <input type="text" name="uid" value="<?php echo $row["usrid"] ?>" readonly>
            <br><br>
            <br><br>
            <button type="submit" class="submit" name="submitUpdate">Upadate Your Profile</button>
        </form>
        <a href="dashboard.php"><button>Dashboard</button></a>
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
