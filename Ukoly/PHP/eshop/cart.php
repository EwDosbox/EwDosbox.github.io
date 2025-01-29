<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit;
}

include("./../Db.php");
Db::connect('localhost', 'eshop', 'root', '');

$cart = $_SESSION['cart'];
$product_id = $cart['id'];
$quantity = $cart['quantity'];

$product = Db::queryOne("SELECT * FROM `products` WHERE `id` = ?", [$product_id]);

if ($product) {
    echo "<h1>Your Cart</h1>";
    echo "<p>Product: " . htmlspecialchars($product['name']) . "</p>";
    echo "<p>Price: $" . htmlspecialchars($product['price']) . "</p>";
    echo "<p>Quantity: " . htmlspecialchars($quantity) . "</p>";
    echo "<p>Total: $" . htmlspecialchars($product['price'] * $quantity) . "</p>";
} else {
    echo "Product not found.";
}
?>