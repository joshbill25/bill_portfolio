<?php
session_start(); // Initialize the session

include_once('db.php');

// Check if user is logged in before accessing session data
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle unauthenticated users
    header("Location: ../index.php"); // Replace 'index.php' with your login page
    exit();
}

// Fetch items from the cart for the logged-in user
$userId = $_SESSION['user_id']; // Get the actual user ID from the session
$sql_fetch_cart_items = "SELECT c.cart_id, c.item_id, c.cart_qty, c.cart_price, i.item_name, i.item_price, im.image_url 
                         FROM cart c
                         JOIN items i ON c.item_id = i.item_id
                         JOIN item_images im ON i.item_id = im.item_id
                         WHERE c.user_id = '$userId'";
$cart_items_result = mysqli_query($conn, $sql_fetch_cart_items);

// Record the chosen item from the cart in the orders table after successful checkout
if (isset($_POST['cart_id'])) {
    $chosenCartId = $_POST['cart_id'];

    // Insert checked-out item into the order table
    $sql_insert_order = "INSERT INTO orders (item_id, user_id, price, order_qty, date_ordered, order_status) 
                        SELECT item_id, user_id, cart_price, cart_qty, NOW(), 'Pending' 
                        FROM cart 
                        WHERE cart_id = '$chosenCartId'";
    $insert_order_result = mysqli_query($conn, $sql_insert_order);

    if ($insert_order_result) {
        // Remove the checked-out item from the cart
        $sql_remove_from_cart = "DELETE FROM cart WHERE cart_id = '$chosenCartId'";
        $remove_from_cart_result = mysqli_query($conn, $sql_remove_from_cart);

        if ($remove_from_cart_result) {
            // Item added to the order table and removed from cart successfully
            // You can redirect or display a success message here
            header("Location: checkout_success.php"); 
            exit();
        } else {
            // Handle cart removal failure
            echo "Failed to remove the item from the cart.";
        }
    } else {
        // Handle order insertion failure
        echo "Failed to add the checked-out item to the order table.";
    }
} else {
    // Handle case where cart_id is not received through POST method
    echo "No item selected for checkout.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Checkout - League of Legends Shop</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<?php include('header_merch.php'); ?>

<div class="container mt-4">
    <h1>Checkout</h1>
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($cart_items_result && mysqli_num_rows($cart_items_result) > 0) {
                echo "<h3>Order Summary:</h3>";
                while ($cart_item = mysqli_fetch_assoc($cart_items_result)) {
                    // Display items in the cart with their details
                    echo "<div class='card mb-3'>";
                    // ... Display item details (similar to the cart page) ...
                    echo "</div>";
                }

                // For the sake of demonstration, display a thank you message.
                echo "<div class='alert alert-success mt-3' role='alert'>Thank you for your purchase!</div>";
            } else {
                echo '<p>Your cart is empty. Please add items before proceeding to checkout.</p>';
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
