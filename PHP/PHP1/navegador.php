<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navegador PHP</title>
</head>
<body>
    <?php
        echo"Hola usuario navegas con: " . $_SERVER['HTTP_USER_AGENT'] . " desde la dirección IP " . $_SERVER['REMOTE_ADDR']
    ?>
</body>
</html>