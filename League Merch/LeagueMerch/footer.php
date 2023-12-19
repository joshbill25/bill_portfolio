<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Footer</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom CSS for the homepage */
        .footer {
            background-image: url('../LeagueMerch/background%20images/league%20merch%20bg13.jpg'); /* Replace 'path/to/your/image.jpg' with the actual path to your image file */
            background-size: cover;
            background-position: center;
            padding: 20px 0; /* Adjust padding as needed */
            color: white; /* Set text color to white for better visibility */
        }

        .team-members img {
            width: 100%;
            height: auto;
            max-height: 100px;
            object-fit: cover;
        }

        .team-members li {
            list-style: none;
            margin-bottom: 10px;
        }

        /* Add margin to move the team members to the right */
        .team-members {
            margin-right: 20px; /* Adjust this value as needed */
            display: grid;
        }

        /* Move the text to the left */
        .team-members p {
            margin-left: 0px; /* Set the left margin to 0 */
        }

        /* Style for the 3x3 grid */
        .team-members .row {
            margin-bottom: 0px;
        }

        .container {
            margin-top: 0px;
        }

        h3 {
            margin-top: 100px;
        }

        .footer-bottom.text-center.p-3 {
            text-align: center;
        }

        .list-unstyled {
            list-style: none;
        }
    </style>
</head>
<body>

<footer class="bg-dark text-light footer">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <h3>Explore</h3>
                <ul class="list-unstyled">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="../users/profile_user.php">Profile</a></li>
                    <li><a href="../users/orders_user.php">Order</a></li>
                </ul>
            </div>

            <div class="col-md-6">
                <h3>Follow Us</h3>
                <ul class="list-unstyled">
                    <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h3>About Us</h3>
                <div class="team-members">
                    <div class="row">
                        <div class="col-md-4">
                            <li>
                                <img src="../icons/bill.jpg" alt="Member 1" class="img-fluid">
                                <p>Joshua Antivo</p>
                            </li>
                        </div>
                        <div class="col-md-4">
                            <li>
                                <img src="../icons/jerico.jpg" alt="Member 2" class="img-fluid">
                                <p>Jerico Rentosa</p>
                            </li>
                        </div>
                        <div class="col-md-4">
                            <li>
                                <img src="../icons/ace.jpg" alt="Member 3" class="img-fluid">
                                <p>Ace Baylon</p>
                            </li>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <li>
                                <img src="../icons/Anjo.jpg" alt="Member 4" class="img-fluid">
                                <p>Anjo Baraquiel</p>
                            </li>
                        </div>
                        <div class="col-md-4">
                            <li>
                                <img src="../icons/darwin.jpg" alt="Member 5" class="img-fluid">
                                <p>Darwin Fernandez</p>
                            </li>
                        </div>
                        <!-- Add more team members as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom text-center p-3">
        <p>&copy; <?php echo date("Y"); ?> Your Store. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
