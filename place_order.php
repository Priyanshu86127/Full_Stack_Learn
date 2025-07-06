<?php
session_start();
if (!isset($_SESSION['email'], $_SESSION['id'])) {
    header("Location: index.php");
    exit;
}
require 'confignew.php';

// Read POSTed values
$food_id = intval($_POST['food_id']  ?? 0);
$price   = intval($_POST['price']    ?? 0);
$user_id = intval($_SESSION['id']);  // from login

if ($food_id <= 0 || $price < 0) {
    die("Invalid order data");
}

// Insert into your orders table
$stmt = $conn->prepare("
  INSERT INTO orders (user_id, food_id, order_date, total_amount)
  VALUES (?, ?, NOW(), ?)
");
$stmt->bind_param('iii', $user_id, $food_id, $price);
$stmt->execute();
$stmt->close();
$conn->close();

// Redirect to the history page
// header("Location: order_history.php");
// echo "Order placed successfully!";
exit;
