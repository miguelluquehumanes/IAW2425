<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color página web</title>
</head>
<?php
    if (isset($_POST['color'])){
        $color = $_POST["color"];
        setcookie("color", $color, time() + 60 * 60 * 24 * 365, '/');
    } else {
        if (isset($_COOKIE["color"])){
            $color = $_COOKIE["color"];
        } else {
            $color = 'white';
        }
    }

?>
<body <?php echo "style='background-color:$color'";?>>
    <form method="post" action="color.php">
        <label for="color">Escoge un color de fondo</label>
        <select name="color">
            <option value="red">Rojo</option>
            <option value="blue">Azul</option>
            <option value="green">Verde</option>
            <option value="yellow">Amarillo</option>
            <option value="black">Negro</option>
            <option value="grey">Gris</option>
        </select>
        <input type="submit" value="Cambiar color" />
    </form>    
</body>
</html>