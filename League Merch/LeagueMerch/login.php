<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once("db.php");


// Define variables to hold error messages
$usernameError = "";
$passwordError = "";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_get_user_data = "SELECT * FROM `users` WHERE `username` = ? AND `password` = ?";
    $stmt = mysqli_prepare($conn, $sql_get_user_data);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    // Execute the statement
    mysqli_stmt_execute($stmt);
    $user_result = mysqli_stmt_get_result($stmt);

    if ($user_result === false) {
        die("Database query error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($user_result) > 0) {
        // Fetch user data
        $row = mysqli_fetch_assoc($user_result);

        // Set the user_id in the session variable
        $_SESSION['user_id'] = $row['user_id'];

        
        // Redirect users based on their type
        if ($row['user_type'] == 'A') {
            header("Location: admin/admin_dashboard.php");
            exit;
        } elseif ($row['user_type'] == 'U') {
            header("Location: users/home.php"); // Redirect to home page
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    } else {
        // Check if the username exists
        $sql_check_username = "SELECT * FROM `users` WHERE `username` = ?";
        $stmt_check_username = mysqli_prepare($conn, $sql_check_username);
        mysqli_stmt_bind_param($stmt_check_username, "s", $username);
        mysqli_stmt_execute($stmt_check_username);
        $result_check_username = mysqli_stmt_get_result($stmt_check_username);

        if (mysqli_num_rows($result_check_username) > 0) {
            // Password is incorrect
            $passwordError = "The password is incorrect. Please try again.";
        } else {
            // Username is incorrect
            $usernameError = "The username is not registered. Please create an account.";
        }
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .login-form {
            background-color: rgba(255, 255, 255, 0.9);
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            margin-top: 100px;
            text-align: justify;
        }

        .login-form h2 {
            text-align: center;
        }
        
         
    </style>
</head>
<body>

<div class="col-md-4">
    <div class="login-form">
        <h2>Login</h2>
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter your username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
            <p class="text-center">
                <?php
                if (!empty($usernameError)) {
                    echo '<div class="alert alert-danger" role="alert">' . $usernameError . '</div>';
                }
                if (!empty($passwordError)) {
                    echo '<div class="alert alert-danger" role="alert">' . $passwordError . '</div>';
                }
                ?>
            </p>
        </form>
        <p class="text-center">Don't have an account? <a href="registration.php">Create a New Account</a></p>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>