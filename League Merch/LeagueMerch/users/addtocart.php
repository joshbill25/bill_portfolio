<?php
include_once('db.php');
session_start();

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
    <!-- Your existing meta tags and CSS link -->
</head>
<body>

<?php
include('header_merch.php');
?>

<div class="container">
    <div class="header">
        <h1>Welcome to the League of Legends Merchandise</h1>
        <p>Discover a world of in-game posters, apparel, and more.</p>
    </div>

    <!-- Display items based on categories -->
    <?php foreach ($categories as $categoryName => $categoryId): ?>
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-left mb-3"><?php echo $categoryName; ?></h2>
            </div>

            <?php
            // Fetch items for the current category
            $sql_get_items = "SELECT items.item_id, items.item_name, items.item_price, items.stock_qty, item_images.image_url 
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
                                <div class="image-container d-flex justify-content-center align-items-center">
                                    <img src="items/<?php echo $row['image_url']; ?>" class="card-img-top centered-image" alt="Product Image">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['item_name']; ?></h5>
                                    <p class="card-text">Php <?php echo number_format($row['item_price'], 2); ?></p>
                                    <p class="card-text">Stock: <?php echo $row['stock_qty']; ?></p>
                                    <!-- Cart icon to add item to the cart -->
                                    <button class="btn btn-primary add-to-cart" data-itemid="<?php echo $row['item_id']; ?>">Add to Cart</button>
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

<script>
    // JavaScript to handle adding items to the cart
    document.addEventListener('DOMContentLoaded', function() {
        const addToCartButtons = document.querySelectorAll('.add-to-cart');

        addToCartButtons.forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-itemid');

                // You can use JavaScript to send an AJAX request or form submission
                // Here's an example using fetch to send the itemId to the backend (handle_backend.php)
                fetch('handle_backend.php', {
                    method: 'POST',
                    body: JSON.stringify({ item_id: itemId }), // Sending item_id to backend
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

</body>
</html>