<?php
session_start();
include "dbconn.php";
if ($_SESSION["adlogged"]) {

    $un = $_SESSION["aun"];

    $sql = "SELECT * FROM admins WHERE usrname='$un'";
    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    if ($row) {

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Admin profile</title>
            <link rel="stylesheet" href="../css/dashb.css">
        </head>

        <body>
            <!-- nav-bar -->
            <nav>
                <ul>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="publishers.php">Publishers</a></li>
                    <li><a href="books.php">Books</a></li>
                    <li><a href="requests.php">Requests</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>

            </nav>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mob</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row["admin_name"]; ?></td>
                        <td><?php echo $row["mob"] ?></td>
                        <td><?php echo $row["email"] ?></td>

                    </tr>
                </tbody>
            </table>
        </body>

        </html>

<?php
    }
} else {
    header("Location: ../html/adminLogin.html");
}

?>