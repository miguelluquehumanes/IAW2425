<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Asegúrate de que el ID sea un número entero
    $query = "DELETE FROM actividades WHERE id='$id'";

    if (mysqli_query($enlace, $query)) {
        $mensaje = "Actividad eliminada correctamente.";
    } else {
        $mensaje = "Error al eliminar la actividad: " . mysqli_error($enlace);
    }
} else {
    $mensaje = "Error: ID de actividad no proporcionado.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Eliminar Actividad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        .container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .container p {
            margin-bottom: 20px;
            color: #555;
        }
        .container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Eliminar Actividad</h1>
        <p><?php echo $mensaje; ?></p>
        <a href="consultar_actividades2.php">Volver a Consultar Actividades</a>
    </div>
</body>
</html>
