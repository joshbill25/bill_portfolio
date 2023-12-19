<?php
session_start(); // Initialize the session

include_once('db.php');

// Check if user is logged in before accessing session data
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle unauthenticated users
    header("Location: ../index.php"); // Replace 'index.php' with your login page
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id']) && isset($_POST['quantity'])) {
    $cartId = $_POST['cart_id'];
    $newQuantity = $_POST['quantity'];
    $userId = $_SESSION['user_id']; // Get the actual user ID from the session

    // Update the quantity of the item in the cart for the logged-in user
    $sql_update_cart_item_quantity = "UPDATE cart SET cart_qty = '$newQuantity' WHERE cart_id = '$cartId' AND user_id = '$userId'";
    $update_result = mysqli_query($conn, $sql_update_cart_item_quantity);

    if ($update_result) {
        // Quantity updated successfully
        header("Location: cart.php"); // Redirect back to the cart page
        exit();
    } else {
        // Handle update failure (you can customize this based on your needs)
        echo "Failed to update quantity for the item in the cart.";
    }
} else {
    // If cart_id or quantity is not received through POST method, handle accordingly
    echo "Invalid request to update quantity for the item in the cart.";
}
?>
