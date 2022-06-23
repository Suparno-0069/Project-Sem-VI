<?php
session_start();
include "dbconn.php";

if ($_SESSION["logged"]) {

    if (isset($_POST['view'])) {
        $bid = $_POST["bid"];
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Book - Urban Chapters</title>
        <link rel="stylesheet" href="../font-awesome/css/all.min.css">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/viewstyle.css">
    </head>

    <body>
        <nav id="navbar">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="../html/requestPage.html">Request a Book</a></li>
                <li><a href="dashboard.php">My Profile</a></li>
                
                <li><a href="myOrders.php">My Orders</a></li>

                <a id="logout" class="loginbtn" href="logout.php"><button><img src="../image/logos2/icons8-logout-66.png" alt="LOGOUT"></button></a>
            </ul>
        </nav>
        <a id="kart" href="cart.php"><i class="fas fa-shopping-cart fa-3x"></i></a>
        <?php
        $sql = "SELECT * FROM books WHERE bid='$bid'";
        $res = $conn->query($sql);
        ?>

        <section>
            <div class="card">
                <div class="classcontents">
                    <?php
                    while ($row = $res->fetch_assoc()) {
                    ?>
                            <div class="bookimage">
                                <img src="../uploads/thumbnails/<?php echo $row["thumbnail"]; ?>" alt="??" height="70px">
                            </div>
                            <div class="bookdetails">
                                <div class="bookname">
                                    <?php echo $row["book_name"]; ?>
                                </div>
                                <div class="authorname">
                                    <p>Author - </p><?php echo $row["author_name"]; ?>
                                </div>
                                <div>
                                    <?php
                                    $pid = $row["pid"];
                                    $sql2 = "SELECT p_name FROM publishers WHERE pid='$pid'";
                                    $res2 = $conn->query($sql2);
                                    $rPid = $res2->fetch_assoc();
                                    $pname = $rPid["p_name"]
                                    ?>
                                </div>                       
                                <div  class="publishername">
                                    <?php echo $pname; ?>
                                </div>
                                <div class="price">
                                    <h3>Rs .</h3><?php echo $row["price"]; ?>
                                </div>
                                <div class="rating">
                                    <p>Rating - </p><?php echo $row["rating"]; ?>
                                </div>
                                <br>
                                <div class="genre">
                                    <h3>Genre -</h3><?php echo $row["genre"]; ?>
                                </div>
                                <div class="buttons">
                                    <button type="submit" name="cart">Add to Cart</button>
                                </div>
                                
                            </div>
                            
                    <?php
                    }
                    ?>
                </div>
            </div>
                
        </section>

    </body>

    </html>

<?php

} else {
    header("Location: ../html/login.html");
}
