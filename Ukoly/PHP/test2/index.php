<?php
$products = [
    ['id' => '1', 'name' => 'ponozky', 'price' => 100, 'category' => 'nohy', 'img' => 'img/ponozky.png'],
    ['id' => '2', 'name' => 'boty', 'price' => 200, 'category' => 'nohy', 'img' => 'img/boty.png'],
    ['id' => '3', 'name' => 'podpatky', 'price' => 300, 'category' => 'nohy', 'img' => 'img/podpatky.png'],
    ['id' => '4', 'name' => 'kalhoty', 'price' => 400, 'category' => 'stehna', 'img' => 'img/kalhoty.png'],
    ['id' => '5', 'name' => 'teplaky', 'price' => 500, 'category' => 'stehna', 'img' => 'img/teplaky.png']
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Shop</title>
    <style>
        .navbar {
            display: flex;
            justify-content: center;
            margin: 10px;
        }

        .category {
            margin: 0 10px;
            padding: 5px 10px;
            border: 1px solid black;
            text-decoration: none;
            color: black;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .product {
            border: 1px solid black;
            margin: 10px;
            padding: 10px;
            width: 200px;
            text-align: center;
        }

        .product img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    </style>
</head>

<body>
</body>
<div class="navbar">
    <?php
    $filteredCategories = [];
    foreach ($products as $product) {
        if (!in_array($product['category'], $filteredCategories)) {
            $filteredCategories[] = $product['category'];
        }
    }
    ?>
    <?php foreach ($filteredCategories as $category):   ?>
        <a class="category" href="?category=<?= $category; ?>"><?= $category; ?></a>
    <?php endforeach; ?>
    <a class="category" href="index.php">Vse</a>

</div>

<div class="products">
    <?php
    $filteredProducts = [];
    if (isset($_GET['category'])) {
        foreach ($products as $product) {
            if ($product['category'] == $_GET['category']) {
                $filteredProducts[] = $product;
            }
        }
    } else {
        $filteredProducts = $products;
    }
    ?>
    <?php foreach ($filteredProducts as $product) : ?>
        <div class="product">
            <img src="<?= $product['img']; ?>" alt="<?= $product['name']; ?>">
            <h3><?= $product['name']; ?></h3>
            <p><?= $product['price']; ?> Kč</p>
            <p><?= $product['category']; ?></p>

            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="id" value="<?= $product['id']; ?>">
                <input type="number" name="quantity" value="1">
                <button type="submit">Přidat do košíku</button>

            </form>
        </div>
    <?php endforeach; ?>
</div>

</html>