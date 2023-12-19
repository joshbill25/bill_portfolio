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

// Initialize adminUsername variable
$adminUsername = 'Admin'; // Default value if session data is not set

// Assuming you have a session variable storing the admin's username
session_start();
if (isset($_SESSION['username'])) {
    $adminUsername = $_SESSION['username'];
}

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "delete" button is clicked
    if (isset($_POST["delete_user"])) {
        // Get the user ID to delete
        $user_id_to_delete = $_POST["user_id"];

        // Perform the deletion
        $delete_query = "DELETE FROM users WHERE user_id = $user_id_to_delete";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            // Redirect to the same page after deletion
            header("Location: manage_users.php");
            exit;
        } else {
            echo "Error deleting user: " . mysqli_error($conn);
        }
    }
}

// Fetch user data from the database, excluding admin users
$users = [];
$result = mysqli_query($conn, "SELECT user_id, full_name, username, email, shipping_address FROM users WHERE user_type = 'U'");

// Check for query execution success
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Users - Admin Control Panel</title>
    <!-- Include Bootstrap for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
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
                        <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                        <li class="nav-item active"><a class="nav-link" href="manage_users.php">Manage Users</a></li>
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
    <h1>Manage Users</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['username']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['shipping_address']; ?></td>
                    <td>
                        <!-- Add a form with a "delete" button -->
                        <form method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                            <button type="submit" class="btn btn-danger" name="delete_user">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Include your JavaScript if needed -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
