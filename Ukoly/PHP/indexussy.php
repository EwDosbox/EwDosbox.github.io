<?php
$baseDir = __DIR__;
$ignored = ['index.php']; // Files to ignore

function getPhpFiles($dir, $baseDir) {
    $files = scandir($dir);
    $phpFiles = [];
    
    foreach ($files as $file) {
        if ($file === '.' || $file === '..' || in_array($file, $ignored)) {
            continue;
        }
        
        $filePath = "$dir/$file";
        if (is_dir($filePath)) {
            $phpFiles[] = ["name" => "$file/", "path" => null];
            $phpFiles = array_merge($phpFiles, getPhpFiles($filePath, $baseDir));
        } elseif (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            $relativePath = str_replace($baseDir . '/', '', $filePath);
            $phpFiles[] = ["name" => $file, "path" => $relativePath];
        }
    }
    
    return $phpFiles;
}
$phpFiles = getPhpFiles($baseDir, $baseDir);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Crossroad</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>PHP File Navigator</h1>
    <table>
        <tr>
            <th>File Name</th>
        </tr>
        <?php foreach ($phpFiles as $file): ?>
            <tr>
                <td>
                    <?php if ($file['path']): ?>
                        <a href="<?= $file['path'] ?>"><?= $file['name'] ?></a>
                    <?php else: ?>
                        <strong><?= $file['name'] ?></strong>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
