<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {
    if (isset($_POST['uploadImg']) && isset($_FILES['thumbnail'])) {
        // echo "<pre>";
        // print_r($_FILES['thumbnail']);
        // echo "</pre>";

        $bid = $_POST["bid"];

        $img_name = $_FILES['thumbnail']['name'];
        $img_size = $_FILES['thumbnail']['size'];
        $tmp_name = $_FILES['thumbnail']['tmp_name'];
        $error = $_FILES['thumbnail']['error'];

        if ($error === 0) {
            if ($img_size > 1000000) {
                echo "<script>alert('Sorry, your file is too large');
                window.location = 'books.php';</script>";
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png");

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                    $img_upload_path = '../uploads/thumbnails/' . $new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    $sql = "UPDATE books
                    SET thumbnail='$new_img_name'
                    WHERE bid='$bid'";
                    if ($conn->query($sql)) {
                        echo "<script>alert('Success!!! Photo uploded')";
                        header("Location: books.php");
                    } else {
                        echo "something went wrong!" . $conn->error;
                    }
                } else {
                    echo "<script>alert('Sorry, You can't upload files of this type');
                window.location = 'books.php';</script>";
                }
            }
        } else {
            echo "<script>alert('Sorry, Some unknown error occured!');
                window.location = 'books.php';</script>";
        }
    }
} else {
    header("Location: ../html/adminLogin.html");
}

// if (isset($_POST['submit']) && isset($_FILES['thumbnail'])) {
	

// 	echo "<pre>";
// 	print_r($_FILES['thumbnail']);
// 	echo "</pre>";

// 	$img_name = $_FILES['thumbnail']['name'];
// 	$img_size = $_FILES['thumbnail']['size'];
// 	$tmp_name = $_FILES['thumbnail']['tmp_name'];
// 	$error = $_FILES['thumbnail']['error'];

// 	if ($error === 0) {
// 		if ($img_size > 125000) {
// 			$em = "Sorry, your file is too large.";
// 		    header("Location: index.php?error=$em");
// 		}else {
// 			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
// 			$img_ex_lc = strtolower($img_ex);

// 			$allowed_exs = array("jpg", "jpeg", "png"); 

// 			if (in_array($img_ex_lc, $allowed_exs)) {
// 				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
// 				$img_upload_path = 'uploads/'.$new_img_name;
// 				move_uploaded_file($tmp_name, $img_upload_path);

// 				// Insert into Database
// 				$sql = "INSERT INTO images(image_url) 
// 				        VALUES('$new_img_name')";
// 				mysqli_query($conn, $sql);
// 				header("Location: view.php");
// 			}else {
// 				$em = "You can't upload files of this type";
// 		        header("Location: index.php?error=$em");
// 			}
// 		}
// 	}else {
// 		$em = "unknown error occurred!";
// 		header("Location: index.php?error=$em");
// 	}

// }
