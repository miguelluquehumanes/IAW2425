<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
date_default_timezone_set('Europe/Madrid'); 

$diaSemana = date('N');


switch ($diaSemana){
    case 1: //Lunes
        echo "¡Es lunes! Comienza la semana con energía.";
        break;
    case 2: // Martes
        echo "Martes de productividad. ¡Sigue adelante!";
        break;
    case 3: // Miércoles
        echo "Miércoles, mitad de semana. ¡Ya falta menos!";
        break;
    case 4: // Jueves
        echo "Jueves, casi es viernes. ¡Ánimo!";
        break;
    case 5: // Viernes
        echo "¡Es viernes! La semana está llegando a su fin.";
        break;
    case 6: // Sábado
        echo "Es sábado, ¡disfruta de tu día libre!";
        break;
    case 7: // Domingo
        echo "Domingo de descanso y preparación para la próxima semana.";
        break;
    default:
        echo "Error al obtener el día de la semana.";
}

?>

</body>
</html>