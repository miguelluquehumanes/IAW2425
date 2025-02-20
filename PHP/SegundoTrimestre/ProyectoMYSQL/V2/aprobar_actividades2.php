<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login2.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['aprobar'])) {
    $id = intval($_GET['id']);
    $aprobar = intval($_GET['aprobar']);
    $query = "UPDATE actividades SET aprobada='$aprobar' WHERE id='$id'";

    if (mysqli_query($enlace, $query)) {
        $mensaje = "Actividad actualizada correctamente.";
    } else {
        $mensaje = "Error al actualizar la actividad: " . mysqli_error($enlace);
    }
}

$query = "SELECT * FROM actividades";
$resultado = mysqli_query($enlace, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Aprobar Actividades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            margin-top: 20px;
            color: #333;
        }
        table {
            width: 90%;
            margin: 20px 0;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            margin: 0 5px;
        }
        a:hover {
            color: #0056b3;
        }
        .back-link {
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }
        .back-link:hover {
            color: #0056b3;
        }
        .action-button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin: 5px 0;
        }
        .action-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Aprobar Actividades</h1>
    <table border="1">
        <tr>
            <th>Título</th>
            <th>Tipo</th>
            <th>Departamento</th>
            <th>Profesor Responsable</th>
            <th>Trimestre</th>
            <th>Fecha Inicio</th>
            <th>Hora Inicio</th>
            <th>Fecha Fin</th>
            <th>Hora Fin</th>
            <th>Organizador</th>
            <th>Acompañantes</th>
            <th>Ubicación</th>
            <th>Coste</th>
            <th>Total Alumnos</th>
            <th>Objetivo</th>
            <th>Aprobada</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $row['titulo']; ?></td>
                <td><?php echo $row['tipo']; ?></td>
                <td><?php echo $row['departamento']; ?></td>
                <td><?php echo $row['profesor_responsable']; ?></td>
                <td><?php echo $row['trimestre']; ?></td>
                <td><?php echo $row['fecha_inicio']; ?></td>
                <td><?php echo $row['hora_inicio']; ?></td>
                <td><?php echo $row['fecha_fin']; ?></td>
                <td><?php echo $row['hora_fin']; ?></td>
                <td><?php echo $row['organizador']; ?></td>
                <td><?php echo isset($row['acompañantes']) ? $row['acompañantes'] : 'N/A'; ?></td>
                <td><?php echo $row['ubicacion']; ?></td>
                <td><?php echo $row['coste']; ?></td>
                <td><?php echo $row['total_alumnos']; ?></td>
                <td><?php echo $row['objetivo']; ?></td>
                <td><?php echo $row['aprobada'] ? 'Sí' : 'No'; ?></td>
                <td>
                    <a href="aprobar_actividades2.php?id=<?php echo $row['id']; ?>&aprobar=1" class="action-button">Aprobar</a>
                    <a href="aprobar_actividades2.php?id=<?php echo $row['id']; ?>&aprobar=0" class="action-button">Desaprobar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="dashboard2.php" class="back-link">Volver al Dashboard</a>
</body>
</html>

<?php
mysqli_close($enlace);
?>
