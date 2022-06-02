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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
    <title>Review page</title>
</head>

<body>
    <style>
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgb(44, 191, 218);
            height: 20px;
            padding: 30px 2%;
        }

        .actual {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
        }

        .nav_links li {
            margin-left: 40px;
            display: inline-flex;
            padding: 10px 20px;
            background-color: aliceblue;
            border-radius: 15px;
        }

        .nav_links li a {
            transition: all 0.3s ease 0s;
            text-decoration: none;
            text-transform: uppercase;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-weight: bold;
            color: rgb(10, 55, 85);
        }

        .nav_links li a:hover {
            color: rgb(10, 37, 126);
            padding: 5px;
            cursor: pointer;
        }

        .loginbtn button {
            background-color: rgb(44, 191, 218);
            border-radius: 50px;
        }

        .loginbtn img {
            cursor: pointer;
            height: 60px;
            border: none;
            transition: all 0.2s ease 0s;
        }

        .loginbtn img:hover {
            padding: 5px;
        }
    </style>
    <nav class="navbar">
        <ul class="nav_links">
            <li><a class="active" href="../html/index.html">Home</a></li>
            <li><a href="../html/our-team/index.html">About us</a></li>
        </ul>
        <a class="loginbtn" href="../html/loginSelector.html"><button><img src="../image/logos2/login-icon-3047-Windows.ico" alt="LOGIN"></button></a>
    </nav>
    <!--reviews-->
    <section id="review">
        <!--heading-->
        <div class="review-heading">
            <h1>Reviews</h1>
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