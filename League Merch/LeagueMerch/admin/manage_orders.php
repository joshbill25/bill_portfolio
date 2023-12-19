<?php
$host = 'localhost';
$dbname = 'league_merch'; 
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
$adminUsername = 'Admin'; 

session_start();
if (isset($_SESSION['username'])) {
    $adminUsername = $_SESSION['username'];
}

// Fetch user orders
$userOrders = array();
$userOrdersQuery = mysqli_query($conn, "SELECT * FROM orders WHERE order_status = 'completed'");
if ($userOrdersQuery) {
    while ($orderData = mysqli_fetch_assoc($userOrdersQuery)) {
        $userOrders[] = $orderData;
    }
}

// Fetch pending orders with user's full name
$pendingOrders = array();
$pendingOrdersQuery = mysqli_query($conn, "SELECT orders.order_id, orders.user_id, users.full_name, items.item_name, orders.order_qty, orders.price
                                          FROM orders 
                                          INNER JOIN users ON orders.user_id = users.user_id 
                                            INNER JOIN items ON orders.item_id = items.item_id 
                                          WHERE orders.order_status = 'pending'");

if ($pendingOrdersQuery) {
    while ($pendingOrderData = mysqli_fetch_assoc($pendingOrdersQuery)) {
        $pendingOrders[] = $pendingOrderData;
    }
}

$completedOrders = array();
$completedOrdersQuery = mysqli_query($conn, "SELECT orders.order_id, orders.user_id, users.full_name, items.item_name, orders.order_qty, orders.price
                                             FROM orders 
                                             INNER JOIN users ON orders.user_id = users.user_id 
                                             INNER JOIN items ON orders.item_id = items.item_id 
                                             WHERE orders.order_status = 'completed'");

if ($completedOrdersQuery) {
    while ($completedOrderData = mysqli_fetch_assoc($completedOrdersQuery)) {
        $completedOrders[] = $completedOrderData;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Orders - Admin Control Panel</title>
    <!-- Include Bootstrap for styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
          
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
                        <li class="nav-item"><a class="nav-link" href="manage_users.php">Manage Users</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_products.php">Manage Products</a></li>
                        <li class="nav-item active"><a class="nav-link" href="manage_orders.php">Manage Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <h1>Manage Orders</h1>

    <div class="col-md-6">
    <h5>Pending Orders</h5>
    <?php foreach ($pendingOrders as $order): ?>
        <p>
            Order ID: <?php echo $order['order_id']; ?> | 
            User ID: <?php echo $order['user_id']; ?> | 
            <span style="font-weight: bold;">Full Name: <?php echo $order['full_name']; ?></span> | 
            Item Name: <?php echo $order['item_name']; ?> | 
            Quantity: <?php echo $order['order_qty']; ?> | 
            Total Amount: Php <?php echo $order['price']; ?>
        </p>
    <?php endforeach; ?>
</div>

<!-- Display Completed Orders -->
<div class="col-md-6">
    <h5>Completed Orders</h5>
    <?php foreach ($completedOrders as $order): ?>
        <p>
            Order ID: <?php echo $order['order_id']; ?> | 
            User ID: <?php echo $order['user_id']; ?> | 
            <span style="font-weight: bold;">Full Name: <?php echo $order['full_name']; ?></span> | 
            Item Name: <?php echo $order['item_name']; ?> | 
            Quantity: <?php echo $order['order_qty']; ?> | 
            Total Amount: Php <?php echo $order['price']; ?>
        </p>
    <?php endforeach; ?>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script>
    $(document).ready(function () {
        // Add 'active' class to the clicked navigation item and remove it from others
        $('.nav-item').on('click', function () {
            $('.nav-item').removeClass('active');
            $(this).addClass('active');
        });

        // Handle click on "Mark Delivered" button
        $('.btn-mark-delivered').on('click', function () {
            var orderId = $(this).data('order-id');
            
            // Send Ajax request to mark the order as delivered
            $.ajax({
                type: 'POST',
                url: 'mark_delivered.php',
                data: { order_id: orderId },
                success: function (response) {
                    // Reload the page or update the order lists
                    location.reload();
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle the error as needed
                }
            });
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
