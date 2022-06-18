<?php
session_start();
include "../php/dbconn.php";

if ($_SESSION["adlogged"]) {
    if (isset($_POST['ebSubmit']) && isset($_FILES['ebImg'])) {
        $ebname = $_POST["ebname"];
        $ebaname = $_POST["ebaname"];
        $eburl = $_POST["eburl"];

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

                    $sql = "INSERT INTO ebooks(eb_name, eb_aname, eb_url, eb_thumbnail)
                    VALUES('$ebname', '$ebaname', '$eburl', '$new_img_name')";
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
    }
} else {
    header("Location: ../html/adminLogin.html");
}
