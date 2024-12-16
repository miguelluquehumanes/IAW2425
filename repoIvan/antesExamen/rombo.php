<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #invisible{color:white;}
    </style>
</head>
<body>
<?php
$n = 10;
// Parte superior del rombo
    for ($i = 1; $i <= $n; $i++) {
        // Espacios en blanco antes de los asteriscos
        for ($j = 1; $j <= $n - $i; $j++) {
            echo "<span id='invisible'>*</span>";
        }
        // Asteriscos
        for ($j = 1; $j <= (2 * $i - 1); $j++) {
            echo "*";
        }
        echo "<br>";
    }
    
    // Parte inferior del rombo
    for ($i = $n - 1; $i >= 1; $i--) {
        // Espacios en blanco antes de los asteriscos
        for ($j = 1; $j <= $n - $i; $j++) {
            echo "<span id='invisible'>*</span>";
        }
        // Asteriscos
        for ($j = 1; $j <= (2 * $i - 1); $j++) {
            echo "*";
        }
        echo "<br>";
    }

?>
</body>
</html>
