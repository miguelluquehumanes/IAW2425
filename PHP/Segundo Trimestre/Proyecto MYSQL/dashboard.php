<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $_SESSION['user_name']; ?></h1>
    <a href="consultar_actividades.php">Consultar Actividades</a><br>
    <a href="añadir_actividad.php">Añadir Actividad</a><br>
    <a href="logout.php">Cerrar Sesión</a>
</body>
</html>
