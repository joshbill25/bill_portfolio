<?php
// Start or resume the user's session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // Replace with your login page URL
    exit();
}

// Include your database connection script here (db.php)
$host = 'localhost';
$dbname = 'league_merch';
$user_name = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user_name, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Retrieve user information from the database based on the logged-in user's session (user_id)
$user_id = $_SESSION['user_id'];
$query = "SELECT user_id, full_name, email, username, shipping_address FROM users WHERE user_id = :user_id";

try {
    $stmt = $pdo->prepare($query);
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set the username from the retrieved user data
    $username = $user['username'];
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome, [Username]</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your CSS for custom styling -->
    <style>
        /* Custom CSS for League of Legends theme */
        body {
            background-image: url('../background%20images/banner.jpg'); /* Set your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            color: white; /* Text color */
        }

        nav {
            background-color: #20232a; /* Dark background for the navigation bar */
            padding: 10px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: white; /* Link color */
        }

        .container {
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent dark background for content */
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
        }

        p {
            font-size: 18px;
        }

        /* Custom CSS for User Profile Content */
        .user-profile {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent dark background for user profile */
            padding: 20px;
            border-radius: 10px;
            text-align: left;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile_user.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders_user.php">Orders</a>
            </li>
        </ul>
    </nav>
        
    <div class="container mt-4">
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <p>Here, you can access your profile and view/edit your information.</p>
        
        <!-- User Profile Content -->
        <div class="user-profile">
            <h2>Your Profile Information</h2>
            <form method="post" action="update_profile.php">
                <p>Name: <input type="text" name="full_name" value="<?php echo $user['full_name']; ?>">
                    <button type="button" class="btn btn-sm btn-primary edit-btn" data-field="full_name">Edit</button>
                </p>
                <p>Email: <input type="email" name="email" value="<?php echo $user['email']; ?>">
                    <button type="button" class="btn btn-sm btn-primary edit-btn" data-field="email">Edit</button>
                </p>
                <p>Username: <?php echo $user['username']; ?>
                </p>
                <p>Shipping Address: <textarea name="shipping_address"><?php echo $user['shipping_address']; ?></textarea>
                    <button type="button" class="btn btn-sm btn-primary edit-btn" data-field="shipping_address">Edit</button>
                </p>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>
    </div>

    <!-- Include your JavaScript if needed -->
    <script>
        // JavaScript to handle editing fields
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-btn');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const field = this.dataset.field;
                    const inputField = document.querySelector(`[name="${field}"]`);
                    
                    if (inputField) {
                        inputField.removeAttribute('readonly');
                        inputField.removeAttribute('disabled');
                    }
                });
            });
        });
    </script>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>