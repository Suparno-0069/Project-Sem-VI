<?php
session_start();
include_once "dbconn.php";

if ($_POST) {

    $un = $_POST['uname'];
    $pass = $_POST['pass'];
    $_SESSION["sun"] = $un;


    $sql = "SELECT * FROM users WHERE uname='$un' AND passwords='$pass'";

    if ($conn->query($sql)) {
        // echo "Login success!";
        $_SESSION["logged"] = true;
        header("Location: dashboard.php");
    } else {
        session_unset();
        session_destroy();
        echo "there is an error" . $conn->error;
    }

    // $res = $conn->query($sql);
    // $row = $res->fetch_assoc();
    // if ($row) {
    //     echo $un;
    //     echo $pass;

    // }
}

?>


























<?php
// echo "<html>
// <head>
// </head>
// <body>
// <table>
// <thead>
//     <th scope='col'>User ID</th>
//     <th scope='col'>Name</th>
//     <th scope='col'>Email</th>
//     <th scope='col'>Mobile</th>
// </thead>
// <tbody>";
//     $uid = $row["userid"];
//     $fname = $row["fname"];
//     $lname = $row["lname"];
//     $email = $row["email"];
//     $mob = $row["mob"];

//     echo "<tr>
//             <td>$uid</td>
//             <td>$fname$lname</td>
//             <td>$email</td>
//             <td>$mob</td>
//         </tr>
//     </tbody>
// </table>
// </body>
// </html>";

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
?>