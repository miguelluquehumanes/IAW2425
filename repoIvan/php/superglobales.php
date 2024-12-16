<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super globales</title>
</head>
<body>
    <?php
        $IP_cliente = $_SERVER['REMOTE_ADDR'];    
        $Navegador = $_SERVER['HTTP_USER_AGENT'];
        $Referida = isset($_SERVER['HTTP_REFERER']);
        echo "Usted esta navegado con la IP $IP_cliente y la versión de navegador $Navegador. La página previa que lo ha referido es $Referida.";
    ?>
</body>
</html>