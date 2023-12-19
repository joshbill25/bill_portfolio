<?php

// Start or resume the user's session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect the user to the login page or any other page
header("Location: ../index.php");
exit;
?>