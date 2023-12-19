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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $orderId = $_POST['order_id'];

    // Update the order status to 'completed'
    $updateQuery = mysqli_query($conn, "UPDATE orders SET order_status = 'completed' WHERE order_id = $orderId");

    if ($updateQuery) {
        // Redirect the user back to orders_user.php
        header("Location: orders_user.php");
        exit();
    } else {
        http_response_code(500);
        echo 'Error marking order as delivered.';
    }
} else {
    http_response_code(400);
    echo 'Bad Request';
}

mysqli_close($conn);
?>
