<?php
if(isset($_POST['name'])){
    header("Location: /web");
    die();
}
$clanky = [
    [
        "title" => "První článek",
        "category" => "nature",
        "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit"
    ],
    [
        "title" => "Grader",
        "category" => "zmrd",
        "content" => "Molestnul me"
    ],
    [
        "title" => "Linus",
        "category" => "zmrd",
        "content" => "NEMolestnul me"
    ],
    [
        "title" => "Planes",
        "category" => "letadlo",
        "content" => "9=11"
    ]
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>My PHP Page</title>
</head>

<body>

<form method="post">
    <input type="text" name="name" id="name">
    <input type="number" name="year" id="year">
    <button type="submit">Odeslat</button>
</form>

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
        </tr>
        <?php foreach ($clanky as $clanek):  ?>
            <tr>
                <td><?= htmlspecialchars($clanek['title']) ?></td>
                <td><?= htmlspecialchars($clanek['category']) ?></td>
                <td><?= htmlspecialchars($clanek['content']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>