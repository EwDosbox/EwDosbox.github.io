
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

if ($_POST) {
    //print_r($_POST);

    $productIds = [];
    foreach($products as $product) {
        $productIds[] = $product['id'];
    }

    // Existuje produkt?
    if (!in_array($_POST['product_id'], $productIds)) {
        echo "Nespravne id";
    }

    // qty check
    if (!is_numeric($_POST['qty']) || $_POST['qty'] < 0) {
        echo "Nespravna qty";
    }

    $_SESSION['cart'][] = [ 'id' => $_POST['product_id'], 'qty' => $_POST['qty'] ];

    //print_r($_SESSION);
    header('Location: index.php');
    die();
}
?>