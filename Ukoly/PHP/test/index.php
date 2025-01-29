<?php
session_start();

$_SESSION['products'] = $_SESSION['products'] ?? [];

print_r($_SESSION);
echo "<br>";
print_r($_POST);
echo "<br>";
print_r($_GET);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $_SESSION['products'][] = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'category' => $_POST['category'],
        'image' => $_FILES['image']['name'],
        'quantity' => $_POST['quantity']
    ];
    header('Location: index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Test Page</title>
</head>

<body>
    <form method="get">
        <div>
            <label for="categoryFilter">Filter by Category:</label>
            <select id="categoryFilter" name="categoryFilter">
                <option value="">Select a category</option>
                <?php
                $categories = array_unique(array_column($_SESSION['products'], 'category'));
                foreach ($categories as $category) {
                    echo '<option value="' . htmlspecialchars($category) . '">' . htmlspecialchars($category) . '</option>';
                }
                ?>
                <option value="">All</option>
            </select>
        </div>
        <div>
            <button type="submit">Filter</button>
        </div>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $filteredProducts = $_SESSION['products'];
            if (isset($_GET['categoryFilter']) && $_GET['categoryFilter'] !== '') {
                $filteredProducts = array_filter($filteredProducts, function ($product) {
                    return $product['category'] === $_GET['categoryFilter'];
                });
            }
            foreach ($filteredProducts as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['price']); ?></td>
                    <td><?php echo htmlspecialchars($product['category']); ?></td>
                    <td><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>"></td>
                    <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form method="post">
        <div>
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" required>
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div>
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" required>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <div>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
        </div>
        <div>
            <button type="submit">Add Product</button>
        </div>
    </form>
</body>

</html>