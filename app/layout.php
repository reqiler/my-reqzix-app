<?php
$metadata += [
    'title' => 'Reqziel App',
    'description' => 'Default description',
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title><?= htmlspecialchars($metadata['title']) ?></title>
    <meta name="description" content="<?= htmlspecialchars($metadata['description']) ?>">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

    <?= $content ?>

</body>

</html>