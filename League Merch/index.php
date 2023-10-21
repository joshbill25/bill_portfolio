<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>League Merch</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        body {
            background-color: #000; /* Set a black background color */
        }

        .container {
            background-color: transparent;
            color: #FFFFFF;
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
        }

        h1 {
            color: #ff9900; /* League of Legends color */
        }

        .form-control {
            background-color: #1c1c1c; /* Dark background color */
            color: white;
        }

        .btn-success {
            background-color: #ff9900;
            border: none;
        }

        .btn-success:hover {
            background-color: #ffcc00;
        }

        .navbar {
            background-color: transparent;
            position: absolute;
            top: 0;
            left: 0;
        }

        .navbar a {
            color: white;
        }

        .navbar .dropdown-menu {
            background-color: #1c1c1c;
        }

        .navbar .dropdown-menu a {
            color: white;
        }

        .promo-container {
            background-color: #1c1c1c;
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .promo-image {
            max-width: 100%;
        }

        .promo-text {
            margin-top: 10px;
        }

        .banner-image {
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Banner Image -->
    <img src="banner.jpg" class="banner-image" alt="Banner Image">

    <!-- Log In -->
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>LEAGUE MERCH</h1>
            </div>
            <div class="col-md-3">
                <form action="login.php" method="post">

                    <div class="mb-3">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname">
                    </div>
                    <div class="mb-3">
                        <label for="pass1">Password</label>
                        <input type="password" class="form-control" id="pass1" name="pass1">
                    </div>
                    
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" value="LogIn">
                        
                </form>
                <a href="register.php" class="btn btn-success">Create Account</a>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.js"></script>
</body>

    <!-- Content Sections -->
    <div class="container promo-container">
        <div class="row">
            <div class="col-md-4">
                <img src="tshirt_promo.jpg" class="promo-image" alt="T-Shirt Promo">
                <div class="promo-text">
                    <h3>T-Shirts</h3>
                    <p>Discover our latest League of Legends T-shirt collection.</p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="poster_promo.jpg" class="promo-image" alt="Poster Promo">
                <div class="promo-text">
                    <h3>Posters</h3>
                    <p>Decorate your walls with stunning League of Legends posters.</p>
                </div>
            </div>
            <div class="col-md-4">
                <img src="figurines_promo.jpg" class="promo-image" alt="Figurines Promo">
                <div class="promo-text">
                    <h3>Figurines</h3>
                    <p>Collect your favorite League of Legends figurines.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bootstrap.js"></script>
</body>
</html>