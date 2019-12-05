<?php require_once "Ti.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php Ti::startBlock("content");?>
    Hola. Esto es un bloque de contenido
<?php Ti::endBlock(); ?>
<hr>
<?php Ti::startBlock("aside");?>
    Y esto es un aside
<?php Ti::endBlock(); ?>
</body>
</html>