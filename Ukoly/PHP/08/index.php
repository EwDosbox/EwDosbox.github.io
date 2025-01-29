<?php
session_start();

// Initialize cart if not already set
$_SESSION['cart'] = $_SESSION['cart'] ?? [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = (float) $_POST['price'];
    $quantity = (int) $_POST['quantity'];

    $found = false;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['name'] === $name) {
            $_SESSION['cart'][$index]['quantity'] += $quantity; // Update quantity
            $found = true;
            break;
        }
    }

    if (!$found) {
        // Add new item to cart
        $_SESSION['cart'][] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity
        ];
    }
    header('Location: index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        main {
            max-width: 800px;
            margin: 2rem auto;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        form {
            margin-bottom: 2rem;
        }
        label {
            display: block;
            margin: 0.5rem 0 0.2rem;
        }
        input {
            width: calc(100% - 20px);
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin: 1rem 0;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f9f9f9;
        }
        h4, h5 {
            margin: 0.2rem 0;
        }
        .total-price {
            text-align: right;
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <h1>Shopping Cart</h1>
    </header>
    <main>
        <form method="post">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>
            <label for="quantity">Quantity:</label>
            <input type="text" id="quantity" name="quantity" required>
            <button type="submit">Add to Cart</button>
        </form>

        <h2>Your Cart</h2>
        <ul>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <li>
                    <h4>Product: <?= htmlspecialchars($item['name']) ?></h4>
                    <h5>Quantity: <?= htmlspecialchars($item['quantity']) ?></h5>
                    <h5>Price per item: $<?= htmlspecialchars(number_format($item['price'], 2)) ?></h5>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="total-price">
            Total Price: $<?= number_format(array_reduce($_SESSION['cart'], function($total, $item) {
                return $total + ($item['price'] * $item['quantity']);
            }, 0), 2) ?>
        </div>
    </main>
</body>

</html>
