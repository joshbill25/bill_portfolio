<?php
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // If not logged in, return an error message or handle it according to your application's logic
        $response = array('success' => false, 'message' => 'User not logged in');
        echo json_encode($response);
        exit();
    }

    // Assuming db.php contains your database connection logic
    include_once('db.php');

    // Retrieve item_id and quantity sent from the frontend
    $data = json_decode(file_get_contents('php://input'), true);

    $item_id = $data['item_id'];
    $quantity = $data['quantity'];

    // Fetch item details from the database to calculate cart_price and update total_price
    $sql_fetch_item = "SELECT item_price FROM items WHERE item_id = '$item_id'";
    $item_result = mysqli_query($conn, $sql_fetch_item);

    if ($item_result && mysqli_num_rows($item_result) > 0) {
        $item_row = mysqli_fetch_assoc($item_result);
        $item_price = $item_row['item_price'];

        // Calculate cart_price and total_price
        $cart_price = $item_price * $quantity;

        // Get the current timestamp
        $timestamp = date('Y-m-d H:i:s');

        // Insert item into cart table
        $user_id = $_SESSION['user_id'];
        $sql_add_to_cart = "INSERT INTO cart (user_id, item_id, cart_qty, cart_price, total_price, created_at, updated_at)
                            VALUES ('$user_id', '$item_id', '$quantity', '$cart_price', '$cart_price', '$timestamp', '$timestamp')";
        $result = mysqli_query($conn, $sql_add_to_cart);

        // Check if the insertion was successful
        if ($result) {
            $response = array('success' => true, 'message' => 'Item added to cart successfully');
            echo json_encode($response);
            exit();
        } else {
            $response = array('success' => false, 'message' => 'Failed to add item to cart');
            echo json_encode($response);
            exit();
        }
    } else {
        // Handle if the item details couldn't be retrieved
        $response = array('success' => false, 'message' => 'Failed to fetch item details');
        echo json_encode($response);
        exit();
    }
} else {
    // If the request is not a POST request, return an error
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
    exit();
}
?>