<?php
session_start();
include "../php/dbconn.php";

if ($_SESSION["adlogged"]) {
    if (isset($_POST['ebSubmit']) && isset($_FILES['ebImg'])) {
        $isbn = $_POST["isbn"];
        $pname = $_POST["pname"];
        $ebname = $_POST["ebname"];
        $ebaname = $_POST["ebaname"];
        $qty = $_POST["qty"];
        $price = $_POST["price"];
        $rating = $_POST["rating"];
        $pages = $_POST["pages"];
        $pdate = $_POST["pdate"];
        $ge = $_POST["genre"];
        $eburl = $_POST["eburl"];
        $genre = "";
        foreach ($ge as $a) {
            $genre .= "$a ";
        }
        // echo $genre;

        $sqqll = "SELECT pid FROM publishers WHERE p_name='$pname'";
        $rrss = $conn->query($sqqll);
        $rrww = $rrss->fetch_assoc();
        $pid = $rrww["pid"];

        $img_name = $_FILES['ebImg']['name'];
        $img_size = $_FILES['ebImg']['size'];
        $tmp_name = $_FILES['ebImg']['tmp_name'];
        $error = $_FILES['ebImg']['error'];

        if ($error === 0) {
            if ($img_size > 1000000) {
                echo "<script>alert('Sorry, your file is too large');
                window.location = '../php/books.php';</script>";
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = '../uploads/ebThumbnail/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $sql = "INSERT INTO ebooks(eb_name, eb_aname, pid, isbn, quantity, price, rating, pages, publish_date, genre, eb_url, eb_thumbnail)
                    VALUES('$ebname', '$ebaname', '$pid', '$isbn', '$qty', '$price', '$rating', '$pages', '$pdate', '$genre', '$eburl', '$new_img_name')";
                    if ($conn->query($sql)) {
                        echo "<script>alert('Successfully entered the ebook!');
                        window.location = '../php/books.php';</script>";
                    } else {
                        echo "Something went wrong! " . $conn->error;
                    }
                } else {
                    echo "<script>alert('Sorry, You can't upload files of this type');
                window.location = '../php/books.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Sorry, Some unknown error occured!');
                window.location = '../php/books.php';</script>";
        }
    } else {
        echo "<pre>";
        echo "<p>Something went wrong '" . $conn->error . "'</p>";
        echo "</pre>";
    }
} else {
    header("Location: ../html/adminLogin.html");
}
