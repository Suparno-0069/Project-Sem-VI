<?php
include_once "dbconn.php";

if ($_POST) {

    $un = $_POST['uname'];
    $pass = $_POST['pass'];

    

    $sql = "SELECT * FROM users WHERE uname='$un' AND passwords='$pass'";

    // if ($conn->query($sql)) {
    //     echo "Login success!";
    //     header("Location: userProfile.php");

    // } else {
    //     echo "there is an error" . $conn->error;
    // }

    $res = $conn->query($sql);
    $row = $res->fetch_assoc();
    if ($row) {
        echo $un;
        echo $pass;
?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>abcd</title>
        </head>

        <body>
            <h1> <?php echo $row["fname"]; echo $row["lname"]; ?></h1>
        </body>

        </html>


<?php
    }
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