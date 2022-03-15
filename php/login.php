<?php
include_once "dbconn.php";

if ($_POST) {
    echo "<html>
    <head>
    </head>
    <body>
    <table>
    <thead>
        <th scope='col'>User ID</th>
        <th scope='col'>Name</th>
        <th scope='col'>Email</th>
        <th scope='col'>Mobile</th>
    </thead>
    <tbody>";
    $un = $_POST['uname'];
    $pass = $_POST['pass'];

    echo $un;
    echo $pass;

    $sql = "SELECT * FROM users WHERE username='$un' AND passwords='$pass'";

    // if ($conn->query($sql)) {
    //     echo "Login success!";

    // } else {
    //     echo "there is an error" . $conn->error;
    // }

        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $uid = $row["userid"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $email = $row["email"];
                $mob = $row["mob"];

                echo "<tr>
                <td>$uid</td>
                <td>$fname$lname</td>
                <td>$email</td>
                <td>$mob</td>
            </tr>
        </tbody>
    </table>
    </body>
    </html>";
            }
        }
}


/*$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rl = $row["roll"];
                $fname = $row["fname"];
                $lname = $row["lname"];

                echo "<tr>
                        <th scope='row'>$rl</th>
                        <td>$fname$lname</td>
                        ";
            }
        } */
