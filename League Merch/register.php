<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>League of Legends Merch</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style>
        body {
            background-color: #000; /* Set a black background color */
        }

        .container {
            background-color: transparent;
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
            color: #FFFFFF;
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
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>REGISTRATION FORM</h1>
            </div>
            <div class="col-md-3">
                <form action="registration.php" method="post">
                    <div class="mb-3">
                        <label for="fullname">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname">
                    </div>
                    <div class="mb-3">
                        <label for="fullname">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="uname">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname">
                    </div>
                    <div class="mb-3">
                        <label for="pass1">Password</label>
                        <input type="password" class="form-control" id="pass1" name="pass1">
                    </div>
                    <div class="mb-3">
                        <label for="pass2">Confirm Password</label>
                        <input type="password" class="form-control" id="pass2" name="pass2">
                    </div>
                    <div class="mb-3">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) 
?>