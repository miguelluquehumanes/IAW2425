<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>For each</title>
</head>
<body>
    <?php
        $refranes = ["Más vale estar solo que mal acompañado",
        "Perro ladrador poco mordedor","A caballo regalado no le mires el diente",
        "A lo hecho, pecho.","Al mal tiempo, buena cara.","Cada loco con su tema.",
        "De tal palo, tal astilla.","El mundo es un pañuelo",
        "Al que madruga, Dios lo ayuda.","Amor con hambre no dura."];
        echo"<ul>";
        foreach($refranes as $refran){
            echo"<li>$refran</li>";
        }
        echo"</ul>";
    ?>
</body>
</html>