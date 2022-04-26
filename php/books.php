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
        <title>Add or Remove Books - Urban Chapters</title>
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
        <nav class="navbar">
            <ul>
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>

        <form class="frm" action="" method="post">
            <label>ISBN : </label><input type="text" name="isbn"><br>
            <br>
            <label>Publisher Name : </label><input type="text" name="pname"><br>
            <br>
            <label>Book Name : </label><input type="text" name="bname"><br>
            <br>
            <label>Author Name : </label><input type="text" name="aname"><br>
            <br>
            <label>Quantity : </label><input type="number" name="qty"><br>
            <br>
            <label>Price : </label></label><input type="text" name="price" placeholder="0000.00"><br>
            <br>
            <label>Rating : </label><input type="text" name="rating" placeholder="00.00"><br>
            <br>
            <label>Pages : </label><input type="number" name="pages"><br>
            <br>
            <label>Published Date : </label><input type="date" name="pdate"><br>
            <br>
            <label>Genre : </label><input type="checkbox" name="genre[]" value="genre1"><span style="color: aqua;">Genre 1</span>
            <input type="checkbox" name="genre[]" value="genre2"><span style="color: aqua;">Genre 2</span>
            <input type="checkbox" name="genre[]" value="genre3"><span style="color: aqua;">Genre 3</span>
            <br><br>
            <br><br>
            <input type="submit" value="Submit">
        </form>

        <hr>
        <hr>
        <table>
            <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sqll = "SELECT * FROM books";
                $res = $conn->query($sqll);
                while ($row = $res->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row["book_name"]; ?></td>
                        <td><?php echo $row["quantity"]; ?></td>
                        <td>
                            <form action="adBook.php" method="post">
                                <input type="text" name="bid" value="<?php echo $row["bid"]; ?>" readonly style="display: none;">
                                <input type="text" name="qty" value="<?php echo $row["quantity"]; ?>" readonly style="display: none;">
                                <input class="btn" type="submit" name="adB" value="Add">
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <script src="../js/script2.js"></script>
    </body>

    </html>

<?php

    if ($_POST) {
        $isbn = $_POST["isbn"];
        $pname = $_POST["pname"];
        $bname = $_POST["bname"];
        $aname = $_POST["aname"];
        $qty = $_POST["qty"];
        $price = $_POST["price"];
        $rating = $_POST["rating"];
        $pages = $_POST["pages"];
        $pdate = $_POST["pdate"];
        $ge = $_POST["genre"];
        $genre = "";
        foreach ($ge as $a) {
            $genre .= "$a ";
        }
        // echo $genre;

        $sql1 = "SELECT pid FROM publishers WHERE p_name='$pname'";
        $res = $conn->query($sql1);
        $row = $res->fetch_assoc();
        $pid = $row["pid"];

        $sql = "INSERT INTO books(pid, isbn, book_name, author_name, quantity, price, rating, pages, published_date, genre)
        VALUES('$pid', '$isbn', '$bname', '$aname', '$qty', '$price', '$rating', '$pages', '$pdate', '$genre')";

        if ($conn->query($sql)) {
            echo "<script> alert('Success!!!!')
            window.location = 'books.php'</script>";
        } else {
            echo "something went wrong!" . $conn->error;
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}

/**$g = $_POST['chkGen'];
$gen = "";
foreach ($g as $a) {
    $gen .= ", $a";
} */
