<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
require 'db_connect.php';
$sql   = "SELECT food_id, food_name, image, description, price FROM foods_table";
$result = $conn->query($sql);
if (!$result) {
    die("Query Error: " . $conn->error);
}

// Build an array of rows
$foods = [];
while ($row = $result->fetch_assoc()) {
    // Convert BLOB image to data URI:
    $imgData = base64_encode($row['image']);
    // You might need to detect MIME type; assuming JPEG here:
    $src = 'data:image/jpeg;base64,' . $imgData;

    $foods[] = [
        'title'       => $row['food_name'],
        'image'       => $src,
        'description' => $row['description'],
        'price'       => '₹' . number_format($row['price'], 2)
    ];
}

$result->free();
$conn->close();
// $foods = [
//     ['title' => 'Margherita Pizza', 'image' => 'images/pizza.avif', 'description' => 'Classic cheese and tomato', 'price' => '₹499'],
//     ['title' => 'Veg Burger', 'image' => 'images/burger.jpg', 'description' => 'Grilled veggie patty', 'price' => '₹249'],
//     ['title' => 'Pasta Alfredo', 'image' => 'images/fries.jpg', 'description' => 'Creamy white sauce pasta', 'price' => '₹399'],
//     ['title' => 'Caesar Salad', 'image' => 'images/fries.jpg', 'description' => 'Crispy lettuce with dressing', 'price' => '₹299'],
//     ['title' => 'Chocolate Cake', 'image' => 'images/fries.jpg', 'description' => 'Rich chocolate delight', 'price' => '₹199'],
//      ['title' => 'Margherita Pizza', 'image' => 'images/pizza.avif', 'description' => 'Classic cheese and tomato', 'price' => '₹499'],
//     ['title' => 'Veg Burger', 'image' => 'images/burger.jpg', 'description' => 'Grilled veggie patty', 'price' => '₹249'],
//     ['title' => 'Pasta Alfredo', 'image' => 'images/fries.jpg', 'description' => 'Creamy white sauce pasta', 'price' => '₹399'],
//     ['title' => 'Caesar Salad', 'image' => 'images/fries.jpg', 'description' => 'Crispy lettuce with dressing', 'price' => '₹299'],
//      ['title' => 'Margherita Pizza', 'image' => 'images/pizza.avif', 'description' => 'Classic cheese and tomato', 'price' => '₹499'],
//     ['title' => 'Veg Burger', 'image' => 'images/burger.jpg', 'description' => 'Grilled veggie patty', 'price' => '₹249'],
//     ['title' => 'Pasta Alfredo', 'image' => 'images/fries.jpg', 'description' => 'Creamy white sauce pasta', 'price' => '₹399'],
//     ['title' => 'Caesar Salad', 'image' => 'images/fries.jpg', 'description' => 'Crispy lettuce with dressing', 'price' => '₹299'],
//     // add more items here
// ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="assets/user_page.css">
</head>
<body>
    <div class="nav">
        <div class="greeting">Khate Jao<span><?=$_SESSION['name'];?></span></div>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
        <div class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="dropdown">
            <button onclick="window.location.href='logout.php'">Logout</button>
        </div>
    </div>

    <div class="cards-container">
        <?php foreach ($foods as $food): ?>
            <div class="card">
                <img src="<?= $food['image'] ?>" alt="<?= $food['title'] ?>">
                <h3><?= $food['title'] ?></h3>
                <p class="desc"><?= $food['description'] ?></p>
                <p class="price"><?= $food['price'] ?></p>
                <button class="order-btn">Order Now</button>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal -->
    <div id="order-modal" class="modal">
      <div class="modal-content">
        <div class="tick-animation">✔</div>
        <p>Order placed successfully!</p>
        <button id="modal-ok">OK</button>
      </div>
    </div>

    <script>
        // Hamburger dropdown
        const hamb = document.querySelector('.hamburger');
        const dd = document.querySelector('.dropdown');
        hamb.addEventListener('click', () => {
            hamb.classList.toggle('active');
            dd.style.display = dd.style.display === 'block' ? 'none' : 'block';
        });
        window.addEventListener('click', e => {
            if (!hamb.contains(e.target) && !dd.contains(e.target)) {
                dd.style.display = 'none';
                hamb.classList.remove('active');
            }
        });

        // Order modal logic
        const modal = document.getElementById('order-modal');
        const okBtn = document.getElementById('modal-ok');
        document.querySelectorAll('.order-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                modal.style.display = 'flex';
            });
        });
        okBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });
    </script>
</body>
</html>