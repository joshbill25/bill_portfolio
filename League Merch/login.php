<?php
include_once("db.php");

$username = $_POST['uname'];
$password = $_POST['pass1'];

$sql_get_user_data = "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'";
$user_result = mysqli_query($conn, $sql_get_user_data);

if (mysqli_num_rows($user_result) > 0) {
    while ($row = mysqli_fetch_assoc($user_result)) {
        echo "<hr>";
        echo "<h3>Rows from the Database</h3>";
        echo "Fullname: " . $row['full_name'] . "<br>";
        echo "Username: " . $row['username'] . "<br>";
        echo "Password: " . $row['password'] . "<br>";
        echo "User Type [A = ADMIN / U = USER]: " . $row['user_type'] . "<br>";

        if ($row['user_type'] == 'A') {
            header("Location: admin.php");
            exit;
        } elseif ($row['user_type'] == 'U') {
            header("Location: home.php"); // Redirect to home page
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    }
} else {
    header("Location: index.php?error=404");
    exit;
}
?>