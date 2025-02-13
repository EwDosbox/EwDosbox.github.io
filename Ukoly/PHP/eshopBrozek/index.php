<?php
    session_start();
    include("./../Db.php");

    Db::connect('localhost', 'eshop', 'root', '');

    $products = Db::queryAll('
    SELECT *,
    categories.name as category
    FROM products
    LEFT JOIN categories
    ON products.category_id = categories.id
    ');
    
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
                width: 150px;
                height: 150px;
            }
    </style>
</head>
<body>
    <div class="navbar">
            <?php $oldProduct = null; ?>
            <?php foreach($products as $product): ?>
                <?php
                    if (isset($oldProduct) && $product['category'] == $oldProduct['category'] ) {
                        continue ;
                    }
                ?>
                    <div class="navbar-item">
                        <a href="index.php?category=<?= $product['category'] ?>">
                            <?= $product['category'] ?>
                        </a>
                    </div>

                <?php $oldProduct = $product; ?>
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
                    return $var['category'] == $_GET['category'];
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