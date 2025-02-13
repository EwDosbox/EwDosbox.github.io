<?php
session_start();

include("./../Db.php");
Db::connect('localhost', 'eshop', 'root', '');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop Cart</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        .navbar {
            display: flex;
            justify-content: center;
            margin: 10px 0;
        }

        .navbar-item {
            margin-left: 10px;
            display: flex;
            align-items: center;
        }

        .cart {
            width: 60%;
            margin: auto;
            text-align: center;
        }

        .cart-item {
            border: 1px solid black;
            margin: 10px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-item">
            <a href="index.php">Domů</a>
        </div>
    </div>

    <div class="cart">
        <h1>Your Cart</h1>
        <?php
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "<h1>Your Cart is Empty</h1>";
            exit;
        }
        ?>
        <?php foreach ($_SESSION['cart'] as $product_id => $product): ?>
            <div class="cart-item">
                <p><strong>Product:</strong> <?= htmlspecialchars($product['name']); ?></p>
                <p><strong>Price:</strong> $<?= htmlspecialchars($product['price']); ?></p>
                <p><strong>Quantity:</strong> <?= htmlspecialchars($product['quantity']); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>