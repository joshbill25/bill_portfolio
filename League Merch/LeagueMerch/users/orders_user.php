<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Your Orders, [Username]</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your CSS for custom styling -->
    <style>
        /* Custom CSS for League of Legends theme */
        body {
            background-image: url('../background%20images/banner.jpg'); /* Set your background image */
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            color: white; /* Text color */
        }

        nav {
            background-color: #20232a; /* Dark background for the navigation bar */
            padding: 10px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav li {
            display: inline;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: white; /* Link color */
        }

        .container {
            background-color: rgba(0, 0, 0, 0.6); /* Semi-transparent dark background for content */
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        h1 {
            font-size: 36px;
        }

        p {
            font-size: 18px;
        }

        /* Custom CSS for table */
        .table th, .table td {
            vertical-align: middle;
        }

        /* Custom CSS for cards */
        .card {
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent white background for cards */
            color: white;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile_user.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders_user.php">Orders</a>
            </li>
        </ul>
    </nav>

  
    <div class="container mt-4">
        <h1>Order Items</h1>
        <div class="row">

        <?php
// Include your database connection script here
$host = 'localhost';
$dbname = 'league_merch';
$user_name = 'root';
$db_password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user_name, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

$currentUserId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($currentUserId !== null) {

try {
    // Query to retrieve items from your database for the current user
    $query = "SELECT order_id, item_id, user_id, price, order_qty, date_ordered, order_status FROM orders WHERE user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $currentUserId, PDO::PARAM_INT);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        // Fetch item details based on item_id from the items table
        $itemQuery = "SELECT item_name FROM items WHERE item_id = :item_id";
        $itemStmt = $pdo->prepare($itemQuery);
        $itemStmt->bindParam(':item_id', $row['item_id'], PDO::PARAM_INT);
        $itemStmt->execute();
        $itemName = $itemStmt->fetchColumn();

        // Display each order using Bootstrap card
        ?>
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order ID: <?php echo $row['order_id']; ?></h5>
                    <p class="card-text">Item Name: <?php echo $itemName; ?></p>
                    <p class="card-text">Price: Php <?php echo $row['price']; ?></p>
                    <p class="card-text">Order Quantity: <?php echo $row['order_qty']; ?></p>
                    <p class="card-text">Date Ordered: <?php echo $row['date_ordered']; ?></p>
                    <p class="card-text">Order Status: <?php echo $row['order_status']; ?></p>
                    
                    <?php if ($row['order_status'] === 'completed') { ?>
                        <p class="text-success">Order Delivered</p>
                    <?php } else { ?>
                        <form method="post" action="mark_delivered.php">
                            <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                            <button type="submit" class="btn btn-primary">Mark as Delivered</button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
}
?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>