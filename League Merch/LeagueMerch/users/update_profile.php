<?php
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

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate form data
    $full_name = filter_var($_POST['full_name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $shipping_address = filter_var($_POST['shipping_address'], FILTER_SANITIZE_STRING);

    // Update user information in the database
    $user_id = $_SESSION['user_id'];
    $updateQuery = "UPDATE users SET full_name = :full_name, email = :email, shipping_address = :shipping_address WHERE user_id = :user_id";

    try {
        $stmt = $pdo->prepare($updateQuery);
        $stmt->execute([
            'full_name' => $full_name,
            'email' => $email,
            'shipping_address' => $shipping_address,
            'user_id' => $user_id
        ]);

     header("Location: profile_user.php");
        exit();
    } catch (PDOException $e) {
        // Provide more detailed error information for debugging
        echo "Error updating profile: " . $e->getMessage();
    }
} else {
    header("Location: profile_user.php");
    exit();
}
?>
