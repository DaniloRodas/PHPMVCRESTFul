<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  <?=$data['title']; ?></title>
    <?=$data['css']; ?>

</head>
<body>
    <?= $navbar ?>

    <div class="container p-4">
    <?= $content ?>
    </div>

  <footer><small>Copyright &copy; <?= date('Y') ?>, My Awesome Site</small></footer>
  <?=$data['js']; ?>
</body>
</html>