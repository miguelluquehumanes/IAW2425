<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Refranes</title>
</head>
<body>
<?php
// Array con refranes
$refranes = [
    "Al mal tiempo, buena cara.",
    "Más vale tarde que nunca.",
    "Quien mucho abarca, poco aprieta.",
    "No por mucho madrugar amanece más temprano.",
    "El que no arriesga, no gana."
];

// Recorrer el array y mostrar cada refrán en un párrafo
echo "<ul>"; //Empezar una lista no ordenada
foreach ($refranes as $refran) { 
    echo "<li>$refran</li>"; //Escribo un refrán
}
echo "</ul>"; //Termino la lista
?>

</body>
</html>