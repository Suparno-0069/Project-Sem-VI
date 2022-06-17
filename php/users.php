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
        <title>Users - Urbn Chapters</title>
        <link rel="shortcut icon" href="../image/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/dashb.css">
        <link rel="stylesheet" href="../css/userspagestyle.css">
    </head>

    <body>
        <nav>
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
        
        <button class="btn" id="show-more">Detailed View</button><br>
        <h1>USER DETAILS</h1>
        <section class="content">

            <?php
            $sql = "SELECT * FROM users";
            $res = $conn->query($sql);


            ?>

            <div id="less-item">
                <table>
                    <thead>
                        <tr>
                            <th>U-name</th>
                            <th>U-pass</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $res->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $row["uname"]; ?></td>
                                <td><?php echo $row["passwords"]; ?></td>
                                <td>
                                    <form action="delFrmUsers.php" method="post">
                                        <input type="text" name="uid" value="<?php echo $row["usrid"]; ?>" readonly style="display: none;">
                                        <input type="submit" name="usrRem" value="Delete User" class="btn">
                                    </form>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <div id="more-item" style="display: none;">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>dob</th>
                            <th>Mob</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $ress = $conn->query($sql);
                        while ($roww = $ress->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $roww["fname"] . " " . $roww["lname"]; ?></td>
                                <td><?php echo $roww["gender"] ?></td>
                                <td><?php echo $roww["dob"] ?></td>
                                <td><?php echo $roww["mob"] ?></td>
                                <td><?php echo $roww["email"] ?></td>
                                <td><?php echo $roww["addresses"] ?></td>
                                <td><?php echo $roww["country"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </section>


        <script>
            const more_box = document.getElementById('more-item');

            const less_box = document.getElementById('less-item');

            const btn = document.getElementById('show-more');

            btn.addEventListener('click', function handleClick() {
                if (more_box.style.display === 'none') {
                    more_box.style.display = 'block';
                    less_box.style.display = 'none';

                    btn.textContent = 'Compact View';
                } else {
                    more_box.style.display = 'none';
                    less_box.style.display = 'block';

                    btn.textContent = 'Detailed View';
                }
            });
        </script>
    </body>

    </html>


<?php

} else {
    header("Location: ../html/adminLogin.html");
}
