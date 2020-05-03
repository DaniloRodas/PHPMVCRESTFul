<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=NAME_WEB; ?> | <?=$data['title']; ?></title>
    <?=$data['css']; ?>

</head>
<body>


    <?= $navbar ?>
    <?= $content ?>
    <footer><small>Copyright &copy; <?= date('Y') ?>, My Awesome Site</small></footer>
    <?=$data['js']; ?>

</body>
</html>