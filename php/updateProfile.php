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
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/updateProfile.css">
    </head>

    <body>
        <nav>
            <ul>
                <li><a href="dashboard.php">My Profile</a></li>
                <a id="logout" class="loginbtn" href="logout.php"><button><img src="../image/logos2/icons8-logout-66.png" alt="LOGOUT"></button></a>
            </ul>

        </nav>
        <?php
        $sql = "SELECT * FROM users WHERE uname='$un'";
        $res = $conn->query($sql);
        $row = $res->fetch_assoc();
        ?>
        <form class="frm" method="post" action="">
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
            <input type="submit" class="btn" name="submitUpdate" value="Update">
            <input type="reset" class="btn" value="Reset">
        </form>

        <form class="frm" action="" method="post" enctype="multipart/form-data">
            <input type="file" name="profilePic">
            <input type="text" name="uid" value="<?php echo $row["usrid"] ?>" readonly style="display: none;">
            <input type="submit" value="Upload" name="updateImg">
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
    } elseif (isset($_POST['updateImg'])) {
        if (isset($_FILES['profilePic'])) {
            $uid = $_POST["uid"];

            $img_name = $_FILES['profilePic']['name'];
            $img_size = $_FILES['profilePic']['size'];
            $tmp_name = $_FILES['profilePic']['tmp_name'];
            $error = $_FILES['profilePic']['error'];

            if ($error === 0) {
                if ($img_size > 1000000) {
                    echo "<script>alert('Sorry, your file is too large');
                    window.location = 'updateProfile.php';</script>";
                } else {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_lc = strtolower($img_ex);

                    $allowed_exs = array("jpg", "jpeg", "png");

                    if (in_array($img_ex_lc, $allowed_exs)) {
                        $new_img_name = uniqid("PIC-", true) . '.' . $img_ex_lc;
                        $img_upload_path = '../uploads/profilePics/' . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);

                        $upISql = "UPDATE users
                        SET profile_pic='$new_img_name'
                        WHERE usrid='$uid'";

                        if ($conn->query($upISql)) {
                            echo "<script>alert('Success!! File updated');
                    window.location = 'updateProfile.php';</script>";
                        } else {
                            echo "Something went wrong!" . $conn->error;
                        }
                    } else {
                        echo "<script>alert('Sorry, You can't upload files of this type');
                    window.location = 'updateProfile.php';</script>";
                    }
                }
            }
        }
    }
} else {
    header("Location: ../html/login.html");
}
