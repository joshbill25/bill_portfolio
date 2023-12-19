<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Welcome, [Username]</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your CSS for custom styling -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Custom CSS for League of Legends theme */
        body {
            background-image: url('league_of_legends_background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center center;
            color: white;
        }

        nav {
            background-color: #20232a;
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
            color: white;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.6);
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="merch.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="profile_user.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orders_user.php">Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="container mt-5">
        <h1>Welcome, [Username]!</h1>
        <p>Here, you can access your profile and view your recent orders.</p>
    </div>

    <!-- Include your JavaScript if needed -->

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>