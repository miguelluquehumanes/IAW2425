<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sort</title>
</head>
<body>
    <?php
        $palabras = array("Despertar","Trabajo",
        "Reunión","Rutina","Café","Tráfico",
        "Correo","Almuerzo","Ejercicio","Tareas",
        "Descanso","Estudio","Compras"
        ,"Cena","Familia","Estrés","Productividad",
        "Concentración","Cita","Lluvia", "Comida rápida",
        "Trabajo remoto","Agenda","Tiempo libre", "Amigos",
        "Bicicleta","Multitarea","Sonrisa","Viaje","Descanso");
        sort($palabras);
        $totalPalabras = count($palabras);
        for($i=0;$i<=$totalPalabras-1;$i++){
            echo"$palabras[$i]<br>+";
        }
    ?>
</body>
</html>