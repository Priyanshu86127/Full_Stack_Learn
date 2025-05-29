<?php
// db_connect.php
$host     = 'sql206.infinityfree.com';
$user     = 'if0_39032389';
$pass     = '1Burger2Pizza';
$dbname   = 'if0_39032389_khatejao';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset('utf8mb4');
?>