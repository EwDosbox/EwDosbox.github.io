<?php
session_start();
include("./../Db.php");

Db::connect('localhost', 'articles', 'root', '');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$clanky = Db::queryAll('
    SELECT *,
    categories.name as category,
    users.name as user
    FROM articles
    LEFT JOIN categories
    ON articles.category_id = categories.id
    LEFT JOIN users
    ON articles.user_id = users.id
');
$category_ids = Db::queryAll('
    SELECT *
    FROM categories
    ');

if (isset($_POST['add'])) {
    Db::insert('articles', [
        'title' => $_POST['title'],
        'text' => $_POST['text'],
        'category_id' => $_POST['category'],
        'user_id' => $_POST['user_id']
    ]);
    header("Location: /web/filtrovaniKategorii");
    die();
}

if (isset($_POST['remove'])) {
    Db::query('DELETE FROM articles WHERE id = ?', $_POST['id']);
    header("Location: /web/filtrovaniKategorii");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Filtrovani Kategorii</title>
</head>

<body>
    <div class="logout">
        <form action="logout.php" method="post">
            <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960">
                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                </svg>

            </button>
        </form>
    </div>

    <form method="get">
        <select name="category">
            <option value="" disabled selected>
                Vyber kategorii
            </option>
            <option value="">
                Vse
            </option>
            <?php
            $categories = array_unique(array_column($clanky, 'category'));
            foreach ($categories as $category): ?>
                <option
                    value="<?= htmlspecialchars($category) ?>"
                    <?php if (isset($_GET['category']) && $_GET['category'] == $category): ?>
                    selected
                    <?php endif; ?>>
                    <?= htmlspecialchars($category) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">
            Odeslat
        </button>
    </form>

    <?php
    function FilterByCategory($clanek)
    {
        return $clanek['category'] === $_GET['category'];
    }

    if (isset($_GET['category'])) {
        $clanky = array_filter($clanky, 'FilterByCategory');
    }
    ?>
    <table id="customers">
        <tr>
            <th>Nazev Clanku</th>
            <th>Kategorie</th>
            <th>Text</th>
            <th>Autor</th>
            <th>Button</th>
        </tr>
        <?php foreach ($clanky as $clanek):  ?>
            <tr>
                <td><?= htmlspecialchars($clanek['title']) ?></td>
                <td><?= htmlspecialchars($clanek['category']) ?></td>
                <td><?= htmlspecialchars($clanek['text']) ?> </td>
                <td><?= htmlspecialchars($clanek['name']) ?> </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $clanek['id'] ?>">
                        <button name="remove" type="submit">remove entry</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr>

            <form method="post">
                <td>
                    <input type="text" name="title" id="name">
                </td>
                <td>
                    <select name="category" id="category">
                        <?php foreach ($category_ids as $category): ?>
                            <option value="<?= htmlspecialchars($category['id']) ?>">
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <input type="text" name="text" id="text">
                </td>
                <td>
                    <?= $_SESSION['name'] ?>
                </td>
                <td>
                    <input type="hidden" name="user_id" id="user_id" value="<?= $_SESSION['user_id'] ?>">
                    <button name="add" type="submit">Odeslat</button>
                </td>
            </form>
        </tr>
    </table>
</body>

</html>