<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludo.php</title>
</head>
<body>
    <form action="saludo.php" method="post">
        <label for="">Escribe tu nombre</label>
        <input type="text" name="nombre">
        <input type="submit" value="Enviar">
    </form>
    <?php
        if(isset($_POST["nombre"])){
            echo"Hola " . htmlspecialchars($_POST["nombre"]) . " hoy es " . date("d/m/y");
        }
    ?>
</body>
</html>