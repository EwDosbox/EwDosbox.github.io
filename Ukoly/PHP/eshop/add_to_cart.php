<?php
session_start();
include("./../Db.php");

Db::connect('localhost', 'eshop', 'root', '');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['id'];
    $quantity = (int) $_POST['quantity'];

    if ($quantity <= 0) {
        header("Location: /web/eshop/index.php");
        exit;
    }

    $product = Db::queryOne("SELECT * FROM `products` WHERE `id` = ?", [$product_id]);

    if ($product) {
        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity
            ];
        } else {
            $_SESSION['cart'][$product_id]['quantity'] += $quantity;
        }
    }
}

header("Location: /web/eshop/cart.php");
exit;
?>