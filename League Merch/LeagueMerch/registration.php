<?php
$host = 'localhost';
$dbname = 'league_merch';
$user_name = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user_name, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['full_name']) && !empty($_POST['full_name']) &&
        isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password'])
    ) {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {
            // Check if email or username is already registered
            $stmt_email = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt_email->execute([$email]);
            $email_count = $stmt_email->rowCount();

            $stmt_username = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt_username->execute([$username]);
            $username_count = $stmt_username->rowCount();

            if ($email_count > 0) {
                $errorMessage = "This email is already registered. Please use another email.";
            } elseif ($username_count > 0) {
                $errorMessage = "This username is taken. Please choose another username.";
            } else {
                // Insert user data into the database
                $sql = "INSERT INTO users (full_name, username, email, password) VALUES (:full_name, :username, :email, :password)";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':full_name', $full_name);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);

                $stmt->execute();

                // Redirect to merch.php after successful registration
                header("Location: users/home.php");
                exit(); // Make sure to exit after the redirection
            }
        } catch (PDOException $e) {
            die("Registration failed: " . $e->getMessage());
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>League of Legends Shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(background%20images/banner%20ni%20josh.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            color: black; /* Text color */
        }
        
        .registration-form {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            margin-top: 50px;
            text-align: justify;
        }

      
        .cart-icon {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        
        .logo {
            width: 650px; /* Adjust the width as needed */
            display: block;
            margin: 0 auto;
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
        
        h3 {
            text-align: center;
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
        <div class="col-md-4">
            <div class="registration-form">
                <h3>Sign Up</h3>
                <form method="POST">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter your full name">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <!-- Display error message if exists -->
                    <?php if (!empty($errorMessage)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </form>
                <p class="text-center">Already have an account? <a href="index.php">Log In</a></p>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>

</body>
</html>