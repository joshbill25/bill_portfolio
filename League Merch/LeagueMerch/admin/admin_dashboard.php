<?php
$host = 'localhost';
$dbname = 'league_merch'; // Assuming this is your database name
$user_name = 'root';
$db_password = '';

// Create connection
$conn = mysqli_connect($host, $user_name, $db_password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data for the dashboard
$totalUsers = 0;
$totalAdmins = 0;
$totalProducts = 0;
$adminUsername = 'Admin'; // Default value

// Fetch total users, excluding ADMIN
$userResult = mysqli_query($conn, "SELECT COUNT(*) AS totalUsers FROM users WHERE user_type = 'U'");
if ($userResult) {
    $userData = mysqli_fetch_assoc($userResult);
    $totalUsers = $userData['totalUsers'];
}

// Fetch total admin users
$adminResult = mysqli_query($conn, "SELECT COUNT(*) AS totalAdmins FROM users WHERE user_type = 'A'");
if ($adminResult) {
    $adminData = mysqli_fetch_assoc($adminResult);
    $totalAdmins = $adminData['totalAdmins'];
}

// Assuming you have a session variable storing the admin's username
session_start();
if (isset($_SESSION['username'])) {
    $adminUsername = $_SESSION['username'];
}

// Fetch total products (replace 'products' with your actual table name)
$productResult = mysqli_query($conn, "SELECT COUNT(*) AS totalProducts FROM items");
if ($productResult) {
    $productData = mysqli_fetch_assoc($productResult);
    $totalProducts = $productData['totalProducts'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Admin Control Panel</title>
    <!-- Include Bootstrap for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add 'active' class to the clicked navigation item and remove it from others
            $('.nav-item').on('click', function() {
                $('.nav-item').removeClass('active');
                $(this).addClass('active');
            });
        });
    </script>
</head>
<body>

<header class="bg-success text-white text-center py-4">
    <h1>Admin Control Panel</h1>
</header>

<div class="container-fluid bg-dark py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
    <h2 class="text-white">Welcome, <?php echo $adminUsername; ?>!</h2>
    <p class="text-white">Here, you can manage orders, users, products, and access the admin dashboard.</p>
            </div>
            <div class="col-md-6">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_users.php">Manage Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_products.php">Manage Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_orders.php">Manage Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>

                </nav>
            </div>
        </div>
    </div>
</div>


<div class="container mt-4">
    <h1>Dashboard</h1>
    

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Users</h5>
                <p class="card-text">There are currently <?php echo $totalUsers; ?> registered users.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Admins</h5>
                <p class="card-text">There are <?php echo $totalAdmins; ?> admin users.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Total Products</h5>
                <p class="card-text">You have <?php echo $totalProducts; ?> products in your inventory.</p>
            </div>
        </div>
    </div>
</div>
    <!-- Add more widgets or information as needed -->

</div>

<!-- Include your JavaScript if needed -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
