<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: ../index.php");
    exit();
}

include_once('db.php');

// Fetch items for each category
$categories = array(
    'Figurine' => 1,
    'Funko Pop' => 2,
    'T-Shirts' => 3,
    'Mouse Pad' => 4,
    'Hoodie' => 5,
    'Poster' => 6
);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>League of Legends Shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       /* New style for the hover effect */
       .product:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Change the shadow as needed */
        }

        /* Styles for the modal */
        .modal-content {
            background-color: #f8f9fa; /* Change the background color as needed */
            border-radius: 10px;
        }

        .modal-header {
            background-color: #343a40; /* Change the header background color as needed */
            color: white; /* Change the header text color as needed */
            border-bottom: none; /* Remove the bottom border */
        }

        .modal-title {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-dialog {
            max-width: 300px; /* Adjust the maximum width of the modal as needed */
            margin: 20px auto; /* Center the modal horizontally */
        }

        /* Close button */
        .close {
            color: white; /* Change the close button color as needed */
            opacity: 1; /* Ensure the close button is visible */
        }

        /* Product image in modal */
        #productImage {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
            background-color: #000000;
        }

        /* Product details in modal */
        #productName {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 10px;
        }

        #productDescription {
            margin-top: 10px;
        }

        #productPrice {
            margin-top: 10px;
            font-weight: bold;
        }

        /* Quantity controls */
        .quantity-input {
            text-align: center;
        }

        .quantity-controls .btn {
            width: 30px;
            height: 30px;
            font-size: 1rem;
        }

        .variation-btn {
            margin-right: 5px;
            margin-top: 5px;
        }

        /* Add to cart button */
        #addToCartBtn {
            margin-top: 10px;
        }

        /* Container to limit the max-width of the image */
        .image-container {
            max-width: 1600px; /* Set your desired max-width value */
            margin: 0 auto; /* Center the container */
        }

        /* Image style */
        .header-image {
            width: 100%; /* Ensure the image fills the container width */
            height: auto; /* Maintain aspect ratio */
            border-radius: 0px; /* Add a curved border if needed */
        }

        .header h1 {
            margin-top: 20px;
        }
    </style>
</head>
<body>


<?php
include('header_merch.php');
?>

    
<div class="image-container">
    <img src="header FINAL.png" alt="Product Image" class="header-image">
</div>

<div class="container">
    <div class="header">
        <h1>Welcome to the League of Legends Merchandise</h1>
        <p>Discover a world of in-game posters, apparel, and more.</p>
    </div>

    <!-- Display items based on categories -->
    <?php foreach ($categories as $categoryName => $categoryId): ?>
        <div id="<?php echo strtolower(str_replace(' ', '', $categoryName)); ?>">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-left mb-3"><?php echo $categoryName; ?></h2>
            </div>

            <?php
            // Fetch items for the current category
            $sql_get_items = "SELECT items.item_id, items.item_name, items.item_description, items.item_price, items.stock_qty, item_images.image_url 
                              FROM items 
                              INNER JOIN item_images ON items.item_id = item_images.item_id
                              WHERE items.category_id = $categoryId";

            $get_items_result = mysqli_query($conn, $sql_get_items);

            if ($get_items_result && mysqli_num_rows($get_items_result) > 0) {
                while ($row = mysqli_fetch_assoc($get_items_result)) {
                    ?>
                    <div class="col-md-3 mb-4">
                        <div class="product">
                            <div class="card">
                                <div class="image-container d-flex justify-content-center align-items-center" style="background-color: lightgray;">
                                    <!-- Ensure that data-toggle and data-target attributes are correctly added -->
                                    <img src="items/<?php echo $row['image_url']; ?>" class="card-img-top centered-image" alt="Product Image" data-toggle="modal" data-target="#productModal_<?php echo $row['item_id']; ?>">
                                </div>
                                <div class="card-body" style="background-color: darkgray;">
                                    <h5 class="card-title"><?php echo $row['item_name']; ?></h5>
                                    <p class="card-text">Php <?php echo number_format($row['item_price'], 2); ?></p>
                                    <p class="card-text">Stock: <?php echo $row['stock_qty']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for displaying item details -->
                        <div class="modal fade" id="productModal_<?php echo $row['item_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="productModalLabel"><?php echo $row['item_name']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body row">
                                        <div class="col-lg-6">
                                            <img src="items/<?php echo $row['image_url']; ?>" class="img-fluid" alt="Product Image">
                                        </div>
                                        <div class="col-lg-6">
                                            <h5><?php echo $row['item_name']; ?></h5>
                                            <p>Price: Php <?php echo number_format($row['item_price'], 2); ?></p>
                                            <p>Stock: <?php echo $row['stock_qty']; ?></p>
                                            <p> <?php echo $row['item_description']; ?></p>
                                            <!-- Quantity input -->
                                            <label for="quantity">Quantity:</label>
                                            <input type="number" id="quantity_<?php echo $row['item_id']; ?>" value="1">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary add-to-cart" data-itemid="<?php echo $row['item_id']; ?>">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                }
            }
            ?>
        </div>
    <?php endforeach; ?>
</div>

</div> <!-- Closing tag for <div class="container"> -->

<?php include('../footer.php'); ?>

<script>
    // JavaScript to handle adding items to the cart
    document.addEventListener('DOMContentLoaded', function() {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-itemid');
                const quantity = document.getElementById('quantity_' + itemId).value;

                // You can use JavaScript to send an AJAX request or form submission
                // Here's an example using fetch to send the itemId and quantity to the backend (handle_backend.php)
                fetch('handle_backend.php', {
                    method: 'POST',
                    body: JSON.stringify({ item_id: itemId, quantity: quantity }), // Sending item_id and quantity to backend
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Handle response from the backend (e.g., success message, error handling)
                    console.log(data); // Log the response for demonstration
                    alert('Item added to cart!'); // Show a simple alert for demonstration
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Failed to add item to cart!');
                });
            });
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
