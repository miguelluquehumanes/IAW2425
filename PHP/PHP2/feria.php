<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fecha Feria</title>
</head>
<body>
    <?php
        $fechaActual = date('d-m-Y');
        $datetime1 = date_create('06-05-2024');
        $datetime2 = date_create($fechaActual);
        $contador = date_diff($datetime1, $datetime2);
        $differenceFormat = '%a';
        echo "Quedan " .$contador->format($differenceFormat). " días para que comience la feria";

    ?>
</body>
</html>