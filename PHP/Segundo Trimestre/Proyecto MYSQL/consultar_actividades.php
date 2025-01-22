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

// Consultar todas las actividades
$query = "SELECT * FROM actividades";
$resultado = mysqli_query($enlace, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Consultar Actividades</title>
</head>
<body>
    <h1>Actividades Registradas</h1>
    <table border="1">
        <tr>
            <th>ID</th>
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
            <th>Acciones</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
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
                <td><?php echo $row['acompañantes']; ?></td>
                <td><?php echo $row['ubicacion']; ?></td>
                <td><?php echo $row['coste']; ?></td>
                <td><?php echo $row['total_alumnos']; ?></td>
                <td><?php echo $row['objetivo']; ?></td>
                <td>
                    <a href="modificar_actividad.php?id=<?php echo $row['id']; ?>">Modificar</a>
                    <a href="eliminar_actividad.php?id=<?php echo $row['id']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>

<?php
mysqli_close($enlace);
?>
