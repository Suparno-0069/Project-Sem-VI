<?php
include "dbconn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/review.css">
    <link rel="stylesheet" href="../css/dashb.css">
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <title>Reviews</title>
</head>

<body>
    
    <nav class="navbar">
        <ul class="nav_links">
            <li><a class="active" href="../">Home</a></li>
            <li><a href="../html/about_us.html" target="_blank">About us</a></li>
        </ul>
    </nav>


    
    <!--reviews-->
    <section id="review">
        <!--heading-->
        <div class="review-heading">
            <h1>User Reviews</h1>
        </div>
        <!--review box container-->
        <div class="review-box-container">
            <!--Box-1-->
            <?php
            $sql_rw = "SELECT * FROM reviews";
            $res_rw = $conn->query($sql_rw);

            while ($row_rw = $res_rw->fetch_assoc()) {
                $uname = $row_rw["uname"];
                $un_sql = "SELECT fname, lname, profile_pic FROM users WHERE uname='$uname'";
                $un_res = $conn->query($un_sql);
                $un_row = $un_res->fetch_assoc();
                $fname = $un_row["fname"] . $un_row["lname"];
            ?>

                <div class="review-box">
                    <!--top-->
                    <div class="box-top">
                        <!--profile-->
                        <div class="profile">
                            <!--image-->
                            <div class="profile-iamge">
                                <img src="../uploads/profilePics/<?php echo $un_row["profile_pic"]; ?>" width="75px">
                            </div>
                            <!--name and user name-->
                            <div class="name-user">
                                <strong><?php echo $fname; ?></strong>
                                <span>@<?php echo $row_rw["uname"]; ?></span>
                            </div>

                        </div>
                    </div>
                    <!--comments-->
                    <div class="client-comment">
                        <p> <?php echo $row_rw["descriptions"]; ?> </p>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </section>
</body>

</html>