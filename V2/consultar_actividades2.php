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


$query_total = "SELECT COUNT(*) as total FROM actividades";
$query_aprobadas = "SELECT COUNT(*) as aprobadas FROM actividades WHERE aprobada = 1";
$query_pendientes = "SELECT COUNT(*) as pendientes FROM actividades WHERE aprobada = 0";

$result_total = mysqli_query($enlace, $query_total);
$result_aprobadas = mysqli_query($enlace, $query_aprobadas);
$result_pendientes = mysqli_query($enlace, $query_pendientes);

$total = mysqli_fetch_assoc($result_total)['total'];
$aprobadas = mysqli_fetch_assoc($result_aprobadas)['aprobadas'];
$pendientes = mysqli_fetch_assoc($result_pendientes)['pendientes'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Consultar Actividades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: background-color 0.3s, color 0.3s;
        }
        h1 {
            margin-top: 20px;
        }
        body.dark-mode h1 {
            color: #fff; /* Asegura que el título sea visible en modo oscuro */
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
        body.dark-mode th {
            background-color: #0056b3; /* Ajusta el color de fondo para modo oscuro */
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        body.dark-mode tr:nth-child(even) {
            background-color: #444; /* Ajusta el color de fondo para filas pares en modo oscuro */
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        body.dark-mode tr:hover {
            background-color: #555; /* Ajusta el color de fondo para filas al pasar el ratón en modo oscuro */
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
        body.light-mode {
            background-color: #f4f4f4;
            color: #333;
        }
        body.dark-mode {
            background-color: #333;
            color: #f4f4f4;
        }
        .switch {
            position: absolute;
            top: 20px;
            right: 20px;
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
        document.addEventListener('DOMContentLoaded', function() {
            const modeSwitch = document.getElementById('modeSwitch');
            const body = document.body;

            // Cargar el modo guardado en localStorage
            if (localStorage.getItem('mode') === 'dark') {
                body.classList.add('dark-mode');
                modeSwitch.checked = true;
            } else {
                body.classList.add('light-mode');
                modeSwitch.checked = false;
            }

            modeSwitch.addEventListener('change', function() {
                body.classList.toggle('dark-mode', this.checked);
                body.classList.toggle('light-mode', !this.checked);
                // Guardar el modo en localStorage
                localStorage.setItem('mode', this.checked ? 'dark' : 'light');
            });
        });
    </script>
</head>
<body>
<div class="switch">
        <label for="modeSwitch">Modo Oscuro</label>
        <input type="checkbox" id="modeSwitch">
    </div>
    <h1>Actividades Registradas</h1>
    <table id="actividadesTable" border="1">
    <div class="totales">
        <p>Total de actividades: <?php echo $total; ?></p>
        <p>Actividades aprobadas: <?php echo $aprobadas; ?></p>
        <p>Actividades pendientes: <?php echo $pendientes; ?></p>
    </div>
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
