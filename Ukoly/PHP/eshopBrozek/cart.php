<?php
    session_start();

$products = 
[
    [
        'id' => 1,
        'name' => 'Test 1',
        'price' => 450,
        'category' => 'fashion',
        'image' => 'img/meow.jfif'
    ],
    [
        'id' => 2,
        'name' => 'Test 2',
        'price' => 3580,
        'category' => 'material',
        'image' => 'img/test.png'
    ],
    [
        'id' => 3,
        'name' => 'Test 3',
        'price' => 8480,
        'category' => 'material',
        'image' => 'img/test.png'
    ],
];

// Existuje?
if (!isset($_SESSION['cart'])) {
    echo "neexistuje";
}

// Neni prazdny?
if (!empty($_SESSION['cart'])) {
    echo "je prazdny :(";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
        }
    </style>
</head>
<body>
<table id="customers">
  <tr>
    <th>Nazev</th>
    <th>Mnozstvi</th>
    <th>Cena</th>
    <th>Celkova cena</th>
  </tr>
  <?php $totalPrice = 0 ?>
  <?php foreach($_SESSION['cart'] as $item): ?>
    <?php 
        $product = null;

        foreach($products as $arrayProduct) {
            if ($arrayProduct['id'] == $item['id'])
                $product = $arrayProduct;
        }
    ?>
    <tr>
        <td><?= $product['name'] ?></td>
        <td><?= $item['qty'] ?></td>
        <td><?= $product['price'] ?></td>
        <td><?= $item['qty'] * $product['price'] ?></td>
    </tr>

    <?php $totalPrice += $item['qty'] * $product['price']; ?>
  <?php endforeach; ?>
</table>
        Celkova cena: <?= $totalPrice; ?>
</body>
</html>