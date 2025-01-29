<?php
session_start();

include("./../Db.php");

Db::connect('localhost', 'eshop', 'root', '');

$products = Db::queryAll("SELECT * FROM `products`");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        E-Shop
    </title>
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

        .products {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .product {
            border: 1px solid black;
            margin: 10px;
            padding: 10px;
            width: 200px;
            text-align: center;
        }

        .product-name {
            font-weight: bold;
            font-size: 20px;
        }

        .product-image img {
            margin: 10px 0;
            width: 10vw;
            height: 10vw;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="navbar-item">
            <a href="cart.php">Kosik</a>
        </div>
        <div class="navbar-item">
            <a href="index.php">Domů</a>
        </div>
        <form method="GET" class="navbar-item">
            <select name="category">
                <option value="">Vše</option>
                <?php
                $filteredCategories = array_unique(array_column($products, 'category'));
                ?>
                <?php foreach ($filteredCategories as $filteredCategory): ?>
                    <?php $selected = (isset($_GET['category']) && $filteredCategory == $_GET['category']) ? 'selected' : ''; ?>
                    <option value="<?= $filteredCategory ?>" <?= $selected ?>><?= $filteredCategory ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Hledat</button>
        </form>
    </div>
    <div class="products">
        <?php
        if (isset($_GET['category']) && $_GET['category'] != '') {
            $filteredProducts = array_filter($products, function ($product) {
                return $product['category'] == $_GET['category'];
            });
        } else {
            $filteredProducts = $products;
        }
        ?>
        <?php foreach ($filteredProducts as $product): ?>
            <div class="product">
                <div class="product-name">
                    <?= $product['name'] ?>
                </div>
                <div class="product-image">
                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                </div>
                <div class="product-price">
                    <?= $product['price'] ?> Kč
                </div>

                <form action="add_to_cart.php" method="post">
                    <input type="hidden" value="<?= $product['id'] ?>">
                    <input type="number" name="quantity">
                    <button>Pridat do Kosiku</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>