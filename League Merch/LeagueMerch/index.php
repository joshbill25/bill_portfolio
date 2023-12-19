<?php
session_start();
include_once('db.php');

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>League of Legends Shop</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(background%20images/banner%20ni%20josh.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            color: white; /* Text color */
        }
        
        .text-center img{
            width: 50%;
        }
        
        .container {
            text-align: center;
            color: #000000; /* Adjust the color as needed */
            margin-top: 20px; /* Add margin to the top if desired */
            font-size: 50;
        }

        p {
            text-align: justify; /* Justify text in paragraphs */
            margin-bottom: 15px; /* Add margin to the bottom of paragraphs */
            font-weight: 500;
        }
        
    </style>
</head>
<body>

<?php
include('header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-md-8 text-center">
            <img src="icons/League%20Merch%20LOGO.png">
            <h3>League of Legends Merchandise</h3>
            <p>Welcome to our collection of League of Legends merchandise! Immerse yourself in the world of League of Legends with our wide range of products including apparel, accessories, collectibles, and more. Show your love for your favorite champions and regions with our high-quality merchandise.</p>
            <p>Explore our store and discover items inspired by the iconic champions, summoner's rift, and epic battles of the League of Legends universe. Whether you're a seasoned player or a dedicated fan, find something special to add to your collection!</p>
        </div>
            <?php
            include_once('login.php');
            ?>
        </div>
        
<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>