<?php
include("./../database.php");

Database::connect('articles');

/*
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
    */


$clanky = Db::queryAll('
    SELECT *,
    categories.name as category
    FROM articles
    LEFT JOIN categories
    ON articles.category_id = categories.id
');
$category_ids = Db::queryAll('
    SELECT *
    FROM categories
    ');

if (isset($_POST['add'])) {
    Db::insert('articles', [
        'title' => $_POST['title'],
        'text' => $_POST['text'],
        'autor' => 'POST',
        'category_id' => $_POST['category']
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
    <link rel="stylesheet" href="./../styles.css">
    <title>Filtrovani Kategorii</title>
</head>

<body>

    <form method="get">
        <select name="category">
            <option value="" disabled selected>
                Vyber kategorii
            </option>
            <option value="">
                Vse
            </option>
            <?php
            $categories = [];
            foreach ($clanky as $clanek) {
                if (!empty($clanek['category'])) {
                    $categories[$clanek['category']] = $clanek['category'];
                }
            }
            ?>
            <?php foreach ($categories as $category): ?>
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
    if (isset($_GET['category']) && $_GET['category'] !== '') {
        $selectedCategory = $_GET['category'];
        $clanky = Db::queryAll('
            SELECT * ,
            categories.name as category
            FROM articles
            LEFT JOIN categories
            ON articles.category_id = categories.id
            WHERE categories.name = ?
        ', $selectedCategory);
    }
    ?>
    <table id="customers">
        <tr>
            <th>Nazev Clanku</th>
            <th>Kategorie</th>
            <th>Text</th>
            <th>Tlacitko</th>
        </tr>
        <?php foreach ($clanky as $clanek):  ?>
            <tr>
                <td><?= htmlspecialchars($clanek['title']) ?></td>
                <td><?= htmlspecialchars($clanek['category']) ?></td>
                <td><?= htmlspecialchars($clanek['text']) ?> </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $clanek['id'] ?>">
                        <button name="remove" type="submit">Smazat</button>
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
                    <button name="add" type="submit">Odeslat</button>
                </td>
            </form>
        </tr>
    </table>

</body>

</html>