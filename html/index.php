<?php
session_start();
if (isset($_SESSION["logged"])) {
    echo "<script>alert('Access denied!');
    window.location = '../php/dashboard.php'</script>";
} elseif (isset($_SESSION["adlogged"])) {
    echo "<script>alert('Access denied!');
    window.location = '../php/adminDashboard.php'</script>";
} else {
    session_unset();
    session_destroy();
    echo "<script>alert('Access denied!');
    window.location = '../'</script>";
}
