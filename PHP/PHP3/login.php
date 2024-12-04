<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
</head>
<body>
    <h1>Sistema de autentificación</h1>
    <form action="login.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuario">
        <input type="password" name="pass">
        <input type="submit" value="login">
    </form>
    <?php
        if (isset($_POST["usuario"]) && isset($_POST["pass"])){
            $usuario = htmlspecialchars($_POST["usuario"]);
            $password = htmlspecialchars($_POST["pass"]);
            if ($usuario=="admin" && $password=="H4CK3R4$1R")
                echo "<p>Bienvenido amo</p>";
            else
                echo "<p>No puedes pasar hacker</p>";
        }
    ?>
</body>
</html>