<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$servername = "sql308.thsite.top";
$username = "thsi_38097508";
$password = "iUgOhGt?";
$bd = "thsi_38097508_bdprueba";
$enlace = mysqli_connect($servername, $username, $password, $bd);

// Verificar conexión
if (!$enlace) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegúrate de que el ID sea un número entero
    $query = "DELETE FROM actividades WHERE id='$id'";

    if (mysqli_query($enlace, $query)) {
        echo "Actividad eliminada correctamente.";
    } else {
        echo "Error al eliminar la actividad: " . mysqli_error($enlace);
    }
} else {
    echo "Error: ID de actividad no proporcionado.";
}

mysqli_close($enlace);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Actividad</title>
</head>
<body>
    <a href="consultar_actividades.php">Volver a Consultar Actividades</a>
</body>
</html>
