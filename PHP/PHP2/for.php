<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>While</title>
</head>
<body>
    <?php
        echo "<table border='1'>";
        for ($numero=1; $numero<= 1000; $numero++){
            echo "<tr><td>" . $numero . "</td></tr>\n";
            $numero += 1;
        }
        echo "</table>";
    ?>
</body>
</html>