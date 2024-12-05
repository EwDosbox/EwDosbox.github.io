<?php
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
        "category" => "NEEEE",
        "content" => "9=11"
    ]
];

function FilterByCategory($clanek)
{
    return $clanek['category'] === $_GET['category'];
}

if (isset($_GET['category'])) {
    $clanky = array_filter($clanky, 'FilterByCategory');
}
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

    <table id="customers">
    <tr>
        <th>Nazev Clanku</th>
        <th>Kategorie</th>
        <th>Text</th>
    </tr>
    <?php foreach ($clanky as $clanek):  ?>
        <tr>
            <td><?= $clanek['title'] ?></td>
            <td><?= $clanek['category'] ?></td>
            <td><?= $clanek['content'] ?></td>
        </tr>
    <?php endforeach; ?>
    </table>

</body>

</html>