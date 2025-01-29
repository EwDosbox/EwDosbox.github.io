<?php
require_once('Db.php');

Db::connect('localhost', 'posts', 'root', '');

$clanky = Db::queryAll('SELECT * FROM article');

if (isset($_POST['add'])) {
    Db::insert('article', [
        'title' => $_POST['title'],
        'category' => $_POST['category'],
        'text' => $_POST['text'],
    ]);
    header("Location: /web");
    die();
}

if (isset($_POST['remove'])) {
    Db::query('DELETE FROM article WHERE id = ?', $_POST['id']);
    header("Location: /web");
    die();
}

if (isset($_POST['update'])) {
    Db::update('article', [
        'title' => $_POST['title'],
        'category' => $_POST['category'],
        'text' => $_POST['text'],
    ], 'WHERE id = ?', $_POST['id']);
    header("Location: /web");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Database</title>
</head>

<body>

    <form method="get">
        <select name="category">
            <option value="" disabled selected>
                Vyber kategorii
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
            <th>Delete Entry</th>
            <th>Edit Entry</th>
        </tr>
        <?php foreach ($clanky as $clanek):  ?>
            <tr>
                <td><?= htmlspecialchars($clanek['title']) ?></td>
                <td><?= htmlspecialchars($clanek['category']) ?></td>
                <td><?= htmlspecialchars($clanek['text']) ?> </td>
                <td>
                    <form method="post">
                        <input type="hidden" name="id" value="<?= $clanek['id'] ?>">
                        <button name="remove" type="submit">remove entry</button>
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="text" name="title" id="name">
                        <input type="text" name="category" id="category">
                        <input type="text" name="text" id="text">
                        <input type="hidden" name="id" value="<?= $clanek['id'] ?>">
                        <button name="update" type="submit">update entry</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>



    <form method="post">
        <input type="text" name="title" id="name">
        <input type="text" name="category" id="category">
        <input type="text" name="text" id="text">
        <button name="add" type="submit">Odeslat</button>
    </form>

</body>

</html>