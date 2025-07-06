<?php
session_start();
if (!isset($_SESSION['email'], $_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

require 'confignew.php';

$user_id = intval($_SESSION['id']);
$sql = "SELECT order_id, order_date, total_amount, food_id
        FROM orders
        WHERE user_id = ?
        ORDER BY order_date DESC";

$stmt = $conn->prepare($sql) or die("User‑orders prepare failed: " . $conn->error);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$orders = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

require 'db_connect.php';

$ids = array_column($orders, 'food_id');
$nameMap = [];

if (count($ids)) {
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql2 = "SELECT food_id, food_name FROM foods_table WHERE food_id IN ($placeholders)";
    $stmt2 = $conn->prepare($sql2) or die("Food‑names prepare failed: " . $conn->error);
    $types = str_repeat('i', count($ids));
    $stmt2->bind_param($types, ...$ids);
    $stmt2->execute();
    $names = $stmt2->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt2->close();
    $nameMap = array_column($names, 'food_name', 'food_id');
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="assets/user_page.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .history-container {
            padding: 20px;
            max-width: 1000px;
            margin: auto;
        }
        .history-title {
            text-align: center;
            font-size: 32px;
            margin-bottom: 20px;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .orders-table th, .orders-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        .orders-table th {
            background-color: #4CAF50;
            color: white;
        }
        .back-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
        }
        .back-btn:hover {
            background-color: #45a049;
        }
        .order-card {
                display:none;
        }

        /* Mobile Responsive: Display as Cards */
        @media (max-width: 768px) {
            .orders-table {
                display: none;
            }
            .order-card {
                display:block;
                background: white;
                border-radius: 10px;
                padding: 15px;
                margin-bottom: 15px;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            }
            .order-card p {
                margin: 5px 0;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="nav">
        <div class="greeting">Order History of <span><?= htmlspecialchars($_SESSION['name']); ?></span></div>
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

    <div class="history-container">
        <h1 class="history-title">Your Order History</h1>

        <?php if (empty($orders)): ?>
            <p>No orders yet.</p>
        <?php else: ?>
            <!-- Desktop Table View -->
            <table class="orders-table">
                <thead>
                    <tr><th>Order ID</th><th>Dish</th><th>Date</th><th>Amount</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $o): ?>
                        <tr>
                            <td><?= $o['order_id'] ?></td>
                            <td><?= htmlspecialchars($nameMap[$o['food_id']] ?? 'Unknown') ?></td>
                            <td><?= $o['order_date'] ?></td>
                            <td>₹<?= number_format($o['total_amount']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Mobile Card View -->
            <?php foreach ($orders as $o): ?>
                <div class="order-card">
                    <p><strong>Order ID:</strong> <?= $o['order_id'] ?></p>
                    <p><strong>Dish:</strong> <?= htmlspecialchars($nameMap[$o['food_id']] ?? 'Unknown') ?></p>
                    <p><strong>Date:</strong> <?= $o['order_date'] ?></p>
                    <p><strong>Amount:</strong> ₹<?= number_format($o['total_amount']) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <button class="back-btn" onclick="window.location.href='user_page.php'">← Back to Menu</button>
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
    </script>
</body>
</html>
