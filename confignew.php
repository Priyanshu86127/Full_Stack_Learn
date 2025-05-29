<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$host     = 'localhost';
$user     = 'root';
$password = '';
$database = 'users_db_food';

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>
