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
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Featured</a></li>
                <li><a href="#">Arrivals</a></li>
                <li><a href="adminDashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>

        </nav>

        <form action="" method="post">
            ISBN : <input type="text" name="isbn"><br>
            <br>
            Publisher Name : <input type="text" name="pname"><br>
            <br>
            Book Name : <input type="text" name="bname"><br>
            <br>
            Author Name : <input type="text" name="aname"><br>
            <br>
            Quantity : <input type="number" name="qty"><br>
            <br>
            Price : <input type="text" name="price" placeholder="0000.00"><br>
            <br>
            Rating : <input type="text" name="rating" placeholder="00.00"><br>
            <br>
            Pages : <input type="number" name="pages"><br>
            <br>
            Published Date : <input type="date" name="pdate"><br>
            <br>
            Genre : <input type="checkbox" name="genre[]" value="genre1">Genre 1
            <input type="checkbox" name="genre[]" value="genre2"> Genre 2
            <input type="checkbox" name="genre[]" value="genre3"> Genre 3
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

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
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
