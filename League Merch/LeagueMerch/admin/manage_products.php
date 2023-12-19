<?php
$host = 'localhost';
$dbname = 'league_merch'; // Assuming this is your database name
$user_name = 'root';
$db_password = '';

// Create connection
$conn = mysqli_connect($host, $user_name, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data for the dashboard
$totalUsers = 0;
$totalAdmins = 0;
$totalProducts = 0;
$adminUsername = 'Admin'; // Default value

// Assuming you have a session variable storing the admin's username
session_start();
if (isset($_SESSION['username'])) {
    $adminUsername = $_SESSION['username'];
}

// Function to fetch products from the database
function getProducts($conn) {
    $sql = "SELECT * FROM items";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the "add" button is clicked
    if (isset($_POST["add_product"])) {
        // Get the product name, stock_quantity, and item_price to add
        $product_name = $_POST["product_name"];
        $stock_quantity = $_POST["stock_qty"];
        $item_price = $_POST["item_price"];
        $availability = $_POST["availability"];
        
        // Check if the product name already exists in the database
        $check_query = "SELECT * FROM items WHERE item_name = '$product_name'";
        $check_result = mysqli_query($conn, $check_query);

        if ($check_result->num_rows > 0) {
            // Product with the same name already exists
            echo "Error adding product: Product with the same name already exists.";
        } else {
            // Perform the insertion
            $insert_query = "INSERT INTO items (item_name, stock_qty, item_price) VALUES ('$product_name', '$stock_quantity', '$item_price')";
            $insert_result = mysqli_query($conn, $insert_query);

            if ($insert_result) {
                // Redirect to the same page after insertion
                header("Location: manage_products.php");
                exit;
            } else {
                echo "Error adding product: " . mysqli_error($conn);
            }
        }
    }

   // Check if the "delete" button is clicked
    if (isset($_POST["delete_product"])) {
        // Get the product ID to delete
        $product_id_to_delete = $_POST["product_id"];

        // Perform the deletion
        $delete_query = "DELETE FROM items WHERE item_id = $product_id_to_delete";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($delete_result) {
            // Redirect to the same page after deletion
            header("Location: manage_products.php");
            exit;
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    }
    
     // Check if the "edit" button is clicked
    if (isset($_POST["edit_product"])) {
        // Get the product ID, updated product name, stock_quantity, and item_price
        $product_id_to_edit = $_POST["product_id"];
        $updated_product_name = $_POST["updated_product_name"];
        $updated_stock_quantity = $_POST["updated_stock_qty"];
        $updated_item_price = $_POST["updated_item_price"];
        $updated_availability = $_POST["updated_availability"];

        // Perform the update
        $update_query = "UPDATE items SET item_name='$updated_product_name', stock_qty='$updated_stock_quantity', item_price='$updated_item_price', availability='$updated_availability' WHERE item_id = $product_id_to_edit";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            // Redirect to the same page after update
            header("Location: manage_products.php");
            exit;
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    }
}

// Fetch product data from the database
$products = getProducts($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Products - Admin Control Panel</title>
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
                        <li class="nav-item"><a class="nav-link" href="manage_users.php">Manage Users</a></li>
                        <li class="nav-item active"><a class="nav-link" href="manage_products.php">Manage Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="manage_orders.php">Manage Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <h1>Manage Products</h1>

    <!-- Table form for managing products -->
    <form action="manage_products.php" method="post">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Stock Quantity</th>
                    <th>Item Price</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo $product['item_id']; ?></td>
                        <td><?php echo $product['item_name']; ?></td>
                        <td><?php echo $product['stock_qty']; ?></td>
                        <td><?php echo $product['item_price']; ?></td>
                        <td><?php echo $product['availability']; ?></td>
                    <td>
                            <!-- Add a form with "edit" and "delete" buttons -->
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product['item_id']; ?>">
                                <input type="text" name="updated_product_name" value="<?php echo isset($product['item_name']) ? $product['item_name'] : ''; ?>" required>
                                <input type="number" name="updated_stock_qty" value="<?php echo isset($product['stock_qty']) ? $product['stock_qty'] : 0; ?>" required>
                                <input type="number" name="updated_item_price" value="<?php echo isset($product['item_price']) ? $product['item_price'] : 0; ?>" required>
                                <input type="text" name="updated_availability" value="<?php echo isset($product['availability']) ? $product['availability'] : 'IS'; ?>" required>
                                <button type="submit" class="btn btn-info" name="edit_product">Update</button>
                            </form>

                            <form method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                <input type="hidden" name="product_id" value="<?php echo $product['item_id']; ?>">
                                <button type="submit" class="btn btn-danger" name="delete_product">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

     <!-- Form for adding a new product -->
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>
        <label for="stock_qty">Stock Quantity:</label>
        <input type="number" name="stock_qty" required>
        <label for="item_price">Item Price:</label>
        <input type="number" name="item_price" required>
        <label for="availability">Availability (IS/OS):</label>
        <input type="text" name="availability" required>
        <button type="submit" name="add_product">Add Product</button>
    </form>
</div>

<!-- Include your JavaScript if needed -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
