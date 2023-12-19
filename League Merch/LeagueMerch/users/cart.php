<?php
session_start(); // Initialize the session

include_once('db.php');

// Check if user is logged in before accessing session data
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle unauthenticated users
    header("Location: ../index.php"); // Replace 'login.php' with your login page
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cart - League of Legends Shop</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>

<?php include('header_merch.php'); ?>

<div class="container mt-4">
    <h1>Your Cart</h1>
    <div class="row">
        <div class="col-md-12">
            <?php
            if ($cart_items_result && mysqli_num_rows($cart_items_result) > 0) {
                while ($cart_item = mysqli_fetch_assoc($cart_items_result)) {
                    ?>
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="items/<?php echo $cart_item['image_url']; ?>" class="card-img" alt="Product Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $cart_item['item_name']; ?></h5>
                                    <p class="card-text">
                                        Quantity:
                                        <form method="POST" action="update_quantity.php">
                                            <input type="hidden" name="cart_id" value="<?php echo $cart_item['cart_id']; ?>">
                                            <input type="number" name="quantity" value="<?php echo $cart_item['cart_qty']; ?>" min="1">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </p>
                                    <p class="card-text">Price: Php <?php echo number_format($cart_item['cart_price'], 2); ?></p>
                                    <!-- Remove button -->
                                    <form method="POST" action="remove_item.php">
                                        <input type="hidden" name="cart_id" value="<?php echo $cart_item['cart_id']; ?>">
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                    <!-- Checkout button for each item -->
                                    <div class="text-center mt-2">
                                        <form method="POST" action="checkout.php"> 
                                            <input type="hidden" name="cart_id" value="<?php echo $cart_item['cart_id']; ?>">
                                            <button type="submit" class="btn btn-success">Checkout</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
            
        </div>
    </div>
</div>

</body>
</html>
