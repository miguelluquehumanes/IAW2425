<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT rol FROM usuarios WHERE id = '$user_id'";
$result = mysqli_query($enlace, $query);

if (mysqli_num_rows($result) === 1) {
    $usuario = mysqli_fetch_assoc($result);
    $es_administrador = $usuario['rol'] === 'administrador';
} else {
    die("Error: Usuario no encontrado.");
}

$query = "SELECT * FROM actividades";
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
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("actividadesTable");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
</head>
<body>
    <h1>Actividades Registradas</h1>
    <table id="actividadesTable" border="1">
        <tr>
            <th onclick="sortTable(0)">Título</th>
            <th onclick="sortTable(1)">Tipo</th>
            <th onclick="sortTable(2)">Departamento</th>
            <th onclick="sortTable(3)">Profesor Responsable</th>
            <th onclick="sortTable(4)">Trimestre</th>
            <th onclick="sortTable(5)">Fecha Inicio</th>
            <th onclick="sortTable(6)">Hora Inicio</th>
            <th onclick="sortTable(7)">Fecha Fin</th>
            <th onclick="sortTable(8)">Hora Fin</th>
            <th onclick="sortTable(9)">Organizador</th>
            <th onclick="sortTable(10)">Acompañantes</th>
            <th onclick="sortTable(11)">Ubicación</th>
            <th onclick="sortTable(12)">Coste</th>
            <th onclick="sortTable(13)">Total Alumnos</th>
            <th onclick="sortTable(14)">Objetivo</th>
            <th onclick="sortTable(15)">Aprobada</th>
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
                    <?php if ($es_administrador): ?>
                        <a href="modificar_actividad2.php?id=<?php echo $row['id']; ?>" class="action-button">Modificar</a>
                        <a href="eliminar_actividad2.php?id=<?php echo $row['id']; ?>" class="action-button" onclick="return confirm('¿Estás seguro de que deseas eliminar esta actividad?');">Eliminar</a>
                    <?php endif; ?>
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
