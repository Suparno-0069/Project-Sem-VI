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
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/booksstyle.css">
    </head>

    <body>
        <nav class="navbar">
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
        <br>
        <h1>Add Books</h1>
        <div class="showbutton">
            <button class="showbtn" id="show-form">Hide Form</button>
            <br><br><br>
            <button class="showbtn" id="detailed-view">Detailed View</button>
            <br><br><br>
            <button class="showbtn" id="book-type">Add E-books</button>
        </div>
        
        <div id="book-form" style="display: block;">

            <form class="frmm" action="" method="post">
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
                <label>Genre : </label><input type="checkbox" name="genre[]" value="genre1"><span style="color: aqua;">Fantasy</span>
                <input type="checkbox" name="genre[]" value="genre2"><span style="color: aqua;">Science Fiction</span>
                <input type="checkbox" name="genre[]" value="genre3"><span style="color: aqua;">Adventure</span>
                <input type="checkbox" name="genre[]" value="genre4"><span style="color: aqua;">Romance</span>
                <input type="checkbox" name="genre[]" value="genre5"><span style="color: aqua;">Mystery</span>
                <input type="checkbox" name="genre[]" value="genre6"><span style="color: aqua;">Horror</span>
                <input type="checkbox" name="genre[]" value="genre7"><span style="color: aqua;">Thriller</span>
                <input type="checkbox" name="genre[]" value="genre8"><span style="color: aqua;">Memoir & Autobiography</span>
                <input type="checkbox" name="genre[]" value="genre9"><span style="color: aqua;">Business & Money</span>
                <input type="checkbox" name="genre[]" value="genre10"><span style="color: aqua;">Educational</span>
                <br><br>
                <br><br>
                <input type="submit" value="Submit">
                <input type="reset" value="Clear" class="btn" style="margin-left: 110px;margin-bottom: 0px;">
            </form>
        </div>

        <div id="book-table-compact">
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Quantity</th>
                        <th></th>
                        <th>Image</th>
                        <th></th>
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
                                    <input class="btn" type="submit" name="rmBB" value="-">
                                    <input class="btn" type="submit" name="adB" value="+">
                                </form>
                            </td>
                            <td>
                                <?php
                                if ($row["thumbnail"] == null) {
                                ?>
                                    <form action="uploadImg.php" method="post" enctype="multipart/form-data">
                                        <input type="text" name="bid" value="<?php echo $row["bid"]; ?>" readonly style="display: none;">
                                        <input type="file" name="thumbnail">
                                        <input type="submit" name="uploadImg" value="Upload" class="btn">
                                    </form>
                                <?php
                                } else {

                                ?>
                                    <img src="../uploads/thumbnails/<?php echo $row["thumbnail"]; ?>" alt="??" height="70px">
                                <?php
                                }
                                ?>

                            </td>
                            <td>
                                <?php
                                if ($row["thumbnail"] != null) {
                                ?>
                                    <form action="removeImg.php" method="post">
                                        <input type="text" name="bid" value="<?php echo $row["bid"]; ?>" readonly style="display: none;">
                                        <input class="btn" type="submit" name="rmBT" value="Remove Image">
                                    </form>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <form action="rmvBook.php" method="post">
                                    <input type="text" name="bid" value="<?php echo $row["bid"]; ?>" readonly style="display:none;">
                                    <input type="submit" value="Delete" name="rmbBokk" class="btn">
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>

        <div id="book-table-detailed" style="display: none;">
            <table>
                <thead>
                    <tr>
                        <th>Book Name</th>
                        <th>Author Name</th>
                        <th>Publisher Name</th>
                        <th>Price</th>
                        <th>Pages</th>
                        <th>Publish Date</th>
                        <th>Genre</th>
                        <th>Thumbnail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $BtD_sql = "SELECT * FROM books";
                    $BtD_res = $conn->query($BtD_sql);
                    while ($BtD_row = $BtD_res->fetch_assoc()) {
                        $pub = $BtD_row["pid"];
                        $sql2 = "SELECT p_name FROM publishers WHERE pid='$pub'";
                        $QQ_res = $conn->query($sql2);
                        $QQ_row = $QQ_res->fetch_assoc();
                        $pubname = $QQ_row["p_name"];
                    ?>
                        <tr>
                            <td><?php echo $BtD_row["book_name"]; ?></td>
                            <td><?php echo $BtD_row["author_name"]; ?></td>
                            <td><?php echo $pubname; ?></td>
                            <td><?php echo $BtD_row["price"]; ?></td>
                            <td><?php echo $BtD_row["pages"]; ?></td>
                            <td><?php echo $BtD_row["published_date"]; ?></td>
                            <td><?php echo $BtD_row["genre"]; ?></td>
                            <td><img src="../uploads/<?php echo $BtD_row["thumbnail"]; ?>" alt="??" height="100px"></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="e-books" style="display: none;">
            <div id="ebooks-form">
                <form action="../pdf-reader/ebooks-add.php" method="post" class="frm" enctype="multipart/form-data">
                    <label>E-book Name: </label> <input type="text" name="ebname"><br>
                    <br>
                    <label>E-book Author Name: </label> <input type="text" name="ebaname"><br>
                    <br>
                    <label>E-book URL:</label> <input type="text" name="eburl"><br>
                    <br>
                    <label>Thumbnail : </label> <input type="file" name="ebImg"><br>
                    <br><br>
                    <br><br>

                    <input type="submit" name="ebSubmit" value="Submit">
                </form>
            </div>
            <div id="ebooks-table"></div>
        </div>

        <script>
            const form_box = document.getElementById('book-form');
            const compact_table = document.getElementById('book-table-compact');
            const detailed_table = document.getElementById('book-table-detailed');
            const ebook_div = document.getElementById('e-books');

            const btn_frm = document.getElementById('show-form');
            const btn_tbl = document.getElementById('detailed-view');
            const btn_ebook = document.getElementById('book-type');

            btn_frm.addEventListener('click', function handleClick() {
                if (form_box.style.display === 'block') {
                    form_box.style.display = 'none';

                    btn_frm.textContent = 'Show Form';
                } else {
                    form_box.style.display = 'block';

                    btn_frm.textContent = 'Hide Form';
                }
            });

            btn_tbl.addEventListener('click', function handleClick() {
                if (detailed_table.style.display === 'none') {
                    detailed_table.style.display = 'block';
                    compact_table.style.display = 'none';

                    btn_tbl.textContent = 'Compact View';
                } else {
                    detailed_table.style.display = 'none';
                    compact_table.style.display = 'block';

                    btn_tbl.textContent = 'Detailed View';
                }
            });

            btn_ebook.addEventListener('click', function handleClick() {
                if (ebook_div.style.display === 'none') {
                    form_box.style.display = 'none';
                    compact_table.style.display = 'none';
                    detailed_table.style.display = 'none';

                    ebook_div.style.display = 'block'


                    btn_ebook.textContent = 'Add Books';
                } else {
                    form_box.style.display = 'block';
                    compact_table.style.display = 'block';
                    detailed_table.style.display = 'block';

                    ebook_div.style.display = 'none'

                    btn_ebook.textContent = 'Add E-books';
                }
            });
        </script>
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
