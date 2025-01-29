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
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
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
    <div class="product">
        <?php
        if (isset($_POST['id']) && isset($_POST['quantity'])) {
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];
            if (in_array($id, array_column($products, 'id')) && $quantity > 0) {
                echo "Product with id $id added to cart";
                $product = $products[array_search($id, array_column($products, 'id'))];
                echo "<img src=\"" . $product['img'] . "\" alt=\" " . $product['name'] . "\">";
                echo "<h3>" . $product['name'] . "</h3>";
                echo "<p>" . $product['price'] . " Kč</p>";
                echo "<p>" . $product['category'] . "</p>";
                echo "<p>Quantity: " . $quantity . "</p>";
            } else {
                echo "Error: Product not found or invalid quantity";
            }
        }
        ?>
    </div>
</body>

</html>