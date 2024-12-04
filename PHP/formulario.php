<form action="formulario.php">
    <input type="text" name="caja" placeholder="Escribe aquí">
    <input type="submit" value="Enviar">

</form>

<?php
    if (!isset($_GET["caja"])){ //Si tiene algo $_GET
        echo 'Hola ' . htmlspecialchars($_GET["caja"]) . '!';
    }
?>