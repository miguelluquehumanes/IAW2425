<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagen Aleatoria</title>
</head>
<body>
    <?php
        $carrusel = ["img/1.jpg","img/2.jpg","img/3.jpg","img/4.jpeg","img/5.png","img/6.jpg","img/7.jpg"];
        $random = rand(0,count($carrusel)-1);
        $imagen = $carrusel[$random];
    ?>
    <img src= <?php echo $imagen;?> width="400px" alt="">
</body>
</html>