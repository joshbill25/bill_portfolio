<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>League of Legends Merch</title>
    <link rel="stylesheet" href="css/bootstrap.css"> <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="css/league-style.css"> <!-- Add your custom CSS here -->
    <style>
        body {
            background-image: url('https://drive.google.com/file/d/1aEmdMcAfhKB-W7Bsh4-7PUqBHr9N78tV/view?usp=share_link'); /* Add your background image URL here */
            background-size: cover;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.html">League of Legends</a>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="merch.php">Merch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    
    <section class="merch">
        <div class="container">
            <h1>League of Legends Merchandise</h1>
            <div class="product">
                <img src="tshirt.jpg" alt="League T-Shirt">
                <h2>League T-Shirt</h2>
                <p>Get your League T-Shirt and show your love for the game.</p>
                <span>$19.99</span>
                <a class="btn btn-primary" href="buy.php?id=1">Buy Now</a>
            </div>
            
            <div class="product">
                <img src="figurine.jpg" alt="Figurine">
                <h2>Champion Figurine</h2>
                <p>Collect your favorite champion figurines and display them proudly.</p>
                <span>$24.99</span>
                <a class="btn btn-primary" href="buy.php?id=2">Buy Now</a>
            </div>

            <!-- Add more products here -->
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> League of Legends Merch. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>