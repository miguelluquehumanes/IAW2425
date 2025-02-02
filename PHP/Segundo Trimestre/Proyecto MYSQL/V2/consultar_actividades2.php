<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

// Obtener el campo de ordenación y la dirección
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : 'titulo';
$order_dir = isset($_GET['order_dir']) ? $_GET['order_dir'] : 'asc';

// Consultar todas las actividades
$query = "SELECT * FROM actividades ORDER BY $order_by $order_dir";
$resultado = mysqli_query($enlace, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consultar Actividades</title>
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
            cursor: pointer;
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
    <h1>Actividades Registradas</h1>
    <table border="1">
        <tr>
            <th><a href="?order_by=titulo&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Título</a></th>
            <th><a href="?order_by=tipo&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Tipo</a></th>
            <th><a href="?order_by=departamento&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Departamento</a></th>
            <th><a href="?order_by=profesor_responsable&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Profesor Responsable</a></th>
            <th><a href="?order_by=trimestre&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Trimestre</a></th>
            <th><a href="?order_by=fecha_inicio&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Fecha Inicio</a></th>
            <th><a href="?order_by=hora_inicio&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Hora Inicio</a></th>
            <th><a href="?order_by=fecha_fin&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Fecha Fin</a></th>
            <th><a href="?order_by=hora_fin&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Hora Fin</a></th>
            <th><a href="?order_by=organizador&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Organizador</a></th>
            <th><a href="?order_by=acompañantes&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Acompañantes</a></th>
            <th><a href="?order_by=ubicacion&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Ubicación</a></th>
            <th><a href="?order_by=coste&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Coste</a></th>
            <th><a href="?order_by=total_alumnos&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Total Alumnos</a></th>
            <th><a href="?order_by=objetivo&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Objetivo</a></th>
            <th><a href="?order_by=aprobada&order_dir=<?php echo $order_dir == 'asc' ? 'desc' : 'asc'; ?>">Aprobada</a></th>
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
                    <a href="modificar_actividad2.php?id=<?php echo $row['id']; ?>" class="action-button">Modificar</a>
                    <a href="eliminar_actividad2.php?id=<?php echo $row['id']; ?>" class="action-button">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="dashboard2.php" class="back-link">Volver al Dashboard</a>
</body>
</html>
