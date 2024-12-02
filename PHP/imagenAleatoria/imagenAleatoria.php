<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen Aleatoria</title>
    <style>
        div{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        img {
            width: 240px;
            height: 240px;
        }
        h1{
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
<?php 
    $array = array("audi", "audi2");
    $random = rand(0,9);
    $coche = $array[$random];
?>
    <h1>Coche Aleatorio:</h1><div><img src="<?= $coche; ?>.png" alt=""></div>



</body>
</html>