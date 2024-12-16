<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Autenticación</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
    <label for="usuario">Usuario:</label><input type="text" name="usuario"><br>
    <label for="contrasena">Contraseña</label><input type="password" name="contrasena"><br>
    <input type="submit" value="Login">
</form>

<?php
if ($_POST){
    $usuario = htmlspecialchars($_POST["usuario"]);
    $contrasena = htmlspecialchars($_POST["contrasena"]);
    if ($usuario == "admin" && $contrasena == "H4CK3R4$1R") {
        echo "<p>Acceso concedido</p>";
    }
    else {
        echo strcmp($_POST["usuario"],"") == 0 ? "<p>Debe introducir un nombre de usuario</p>" : "<p>Usuario y/o contraseña inválido</p>";
        echo "<p>Acceso denegado</p>";
    }
}
?>

</body>

</html>