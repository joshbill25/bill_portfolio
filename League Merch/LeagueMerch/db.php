<?php
$host = 'localhost';
$dbname = 'league_merch';
$user_name = 'root';
$db_password = '';

$conn = mysqli_connect($host, $user_name, $db_password, $dbname);

if(!$conn) {
    die();
}
else

?>