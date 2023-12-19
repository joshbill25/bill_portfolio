<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>League Merch</title>
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
   /* Styling for the body */
body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
}

/* Container styles */
.container {
  max-width: 1200px;
  margin: 0 auto;
  margin-bottom: -30px;
}

/* Header styles */
header {
  background-color: #171b20;
  color: #fff;
  padding: 5px 0;
}

/* Header content alignment and margin */
.header-content {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  margin-left: -100px;
}

/* Logo image styles */
header img {
  /* Adjusting the max-width and margins of the logo */
  max-width: 200px;
  margin-top: -50px;
  margin-bottom: -80px;
}

/* Navigation styles */
nav {
  margin-top: 10px;
}

/* Navigation link styles */
nav a {
  /* Styling for the navigation links */
  color: #fff;
  text-decoration: none;
  margin: 0 80px;
  font-weight: bold;
  transition: color 0.3s ease;
}

/* Hover effect for navigation links */
nav a:hover {
  color: #ed7d3a;
}

/* Styles for search container */
.search-container {
  display: flex;
  justify-content: flex-end; /* Adjusted to space between items */
  padding: 10px;
}

/* Styles for cart icon */
.cart-icon {
  /* Styles for the cart icon */
  font-size: 24px; /* Adjust the size as needed */
  margin-right: 30px; /* Adjust the spacing as needed */
  margin-top: -50px;
  cursor: pointer;
}

/* Hover effect for cart icon */
.cart-icon:hover {
  color: #ff4500; /* Adjust the color on hover */
}

/* Styles for profile icon */
.profile-icon {
  /* Styles for the profile icon */
  font-size: 24px; /* Adjust the size as needed */
  margin-right: 30px; /* Adjust the spacing from the search bar or cart icon */
  margin-top: -100px;
  cursor: pointer;
}

/* Hover effect for profile icon */
.profile-icon:hover {
  color: #007bff; /* Adjust the color on hover */
}

/* Styles for search bar */
.search-bar {
  display: flex;
  align-items: center;
  margin-top: -100px; /* Adjust the margin to move the search bar higher */
  margin-right: -150px;
}

/* Styles for search input */
.search-input {
  width: 200px; /* Adjust the width as needed */
  padding: 10px;
  font-size: 16px;
  border: none;
  border-radius: 100px;
  outline: none;
}

/* Styles for search icon */
.search-icon {
  margin-left: 10px;
  color: #ffffff;
  cursor: pointer;
}

/* Add or adjust these styles */
nav .dropdown-container {
  display: flex;
  align-items: center;
}

.category-item {
  margin-right: 20px;
  position: relative;
}

.category-item .dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.category-item .dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.category-item:hover .dropdown-content {
  display: block;
}
</style>
</head>
<body>

<header>
  <div class="container">
    <div class="header-content">
      <img src="League%20Merch%20LOGO2.png" alt="League Merch Logo">
      <nav>
        <div class="dropdown-container">
          <span class="category-item">
            <a href="home.php">HOME</a>
          </span>
          <span class="category-item dropdown">
            CATEGORY <i class="fas fa-chevron-down"></i>
            <div class="dropdown-content">
              <a href="home.php#t-shirts">T-Shirts</a>
              <a href="home.php#hoodie">Hoodies</a>
              <a href="home.php#mousepad">MousePad</a>
              <a href="home.php#figurine">Figurines</a>
              <a href="home.php#funkopop">Funko Pop</a>
              <a href="home.php#poster">Poster</a>
            </div>
          </span>
        </div>
      </nav>
    </div>
        <div class="search-container">
            <i class="fas fa-shopping-cart cart-icon" onclick="openCartPage()"></i>
            <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle profile-icon" type="button" id="profileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="profileDropdown" id="profileMenu">
        <a class="dropdown-item" href="profile_user.php">Accounts</a>
        <a class="dropdown-item" href="orders_user.php">Order</a>
        <a class="dropdown-item" href="logout.php">Log Out</a>
    </div>
</div>
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Search...">
                <i class="fas fa-search search-icon"></i>
            </div>
        </div>
    </div>
</header>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
<script>
    $(document).ready(function(){
        $('.profile-icon').on('click', function(e){
            e.stopPropagation();
            $(this).next('#profileMenu').toggleClass('show');
        });

        $(document).on('click', function(e){
            if (!$(e.target).closest('.profile-icon').length) {
                $('#profileMenu').removeClass('show');
            }
        });
    });
    function openCartPage() {
        // Redirect to cart.php
        window.location.href = 'cart.php';
    }
</script>
    
</body>
</html>