<?php
session_start(); // Initialize the session

include_once('db.php');

// Check if user is logged in before accessing session data
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle unauthenticated users
    header("Location: ../index.php"); // Replace 'index.php' with your login page
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];
    $userId = $_SESSION['user_id']; // Get the actual user ID from the session

    // Delete the item from the cart for the logged-in user
    $sql_delete_cart_item = "DELETE FROM cart WHERE cart_id = '$cartId' AND user_id = '$userId'";
    $delete_result = mysqli_query($conn, $sql_delete_cart_item);

    if ($delete_result) {
        // Item successfully removed from the cart
        header("Location: cart.php"); // Redirect back to the cart page
        exit();
    } else {
        // Handle deletion failure (you can customize this based on your needs)
        echo "Failed to remove item from the cart.";
    }
} else {
    // If cart_id is not received through POST method, handle accordingly
    echo "Invalid request to remove item from the cart.";
}
?>
