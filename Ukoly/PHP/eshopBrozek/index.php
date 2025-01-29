<?php
    session_start();
include("./../Db.php");
Db::connect('localhost', 'eshop', 'root', '');

$products = Db::queryAll('SELECT * FROM products');
$categories = array_unique(array_column($products, 'category'));

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop</title>

    <style>
        .navbar {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            border: 1px solid #e7e7e7;
            background-color: #f3f3f3;
            display: flex;
            }

            .navbar-item a {
            display: block;
            color: #666;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }

            li a:hover:not(.active) {
            background-color: #ddd;
            }

            li a.active {
            color: white;
            background-color: #04AA6D;
            }

            .products {
                display: flex;
                flex-wrap: wrap;
            }

            .product {
                display: block;
                width: 350px;
                height: 250px;
                background: #ccc;
                border-radius: 15px;
                margin: 10px;
                box-sizing: border-box;
                padding: 15px;

                display: flex;
                flex-direction: column;
                align-items: center;
                
            }

            .product__image img {
                max-width: 150px;
            }
    </style>
</head>
<body>
    <div class="navbar">
            <?php foreach($categories as $category): ?>
                    <div class="navbar-item">
                        <a href="index.php?category=<?= $category ?>">
                            <?= $category ?>
                        </a>
                    </div>
            <?php endforeach; ?>
            <div class="navbar-item">
                <a href="index.php">
                    Vše
                 </a>
            </div>
    </div>
    
    <?php
            if (isset($_GET['category'])) {
                $products = array_filter($products, function($var) {
                    return $var['category'] === $_GET['category'];
                });
            }
    ?>
    <div class="products">
        <?php foreach($products as $product): ?>
        <div class="product">
            <div class="product__image">
                <img src="<?= $product['image'] ?>">
            </div>
            <div class="product__name">
                <?= htmlspecialchars($product['name']) ?>
            </div>
            <div class="product__price">
                <?= $product['price'] ?>
            </div>
            <div class="product__category">
                <?= $product['category'] ?>
            </div>
            <div class="product__add-to-cart">
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="number" min="0" name="qty">
                    <input type="submit" value="Přidat do košíku">
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>