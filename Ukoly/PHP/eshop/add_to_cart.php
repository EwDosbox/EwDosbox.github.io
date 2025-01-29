<?php
session_start();
include("./../Db.php");

Db::connect('localhost', 'eshop', 'root', '');

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

if(isset($_POST['id'])){
    $product_id = $_POST['id'];
    $product = Db::queryOne("SELECT * FROM `products` WHERE `id` = ?", [$product_id]);

    if ($product) {
        $_SESSION['cart']['id'] = $product_id;
        $_SESSION['cart']['quantity'] = $_POST['quantity'];
    }
}
header("Location: /web/eshop/index.php");
die();
?>