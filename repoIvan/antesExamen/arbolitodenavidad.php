<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display:flex;
            flex-direction: row;
        }
        #soyinvisible{color:white}
        #hierba{color:green;}
        #tronco{color:brown;}
    </style>
</head>
<body>
    
</body>
</html>
<?php
    $numPir = 1;
    echo"<div>";
    while($numPir <= 4){
        for($filas = 1; $filas <= 4; $filas++){
            for($espacio = $filas ; $espacio < 4; $espacio++){
                echo"<span id='soyinvisible'>*</span>";
            }
            for($asterisco = 1; $asterisco <= ($filas*2) - 1 ; $asterisco ++){
                echo"<span id='hierba'>*</span>";
            }
            echo"<br>";
        }
        $numPir++;
    }
    for($filas = 1; $filas <= 4; $filas++){
        for($espacio = 1 ; $espacio < 4; $espacio++){
            echo"<span id='soyinvisible'>*</span>";
        }
        echo"<span id='tronco'>*</span>";
        echo "<br>";
    }
    echo"</div>";
    echo"<div><img src='img/papanoel.png' width='20%'></div>";
?>