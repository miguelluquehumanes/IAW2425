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

// Establecer la codificación de caracteres
mysqli_set_charset($enlace, "utf8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos vacíos
    if (empty($_POST['titulo']) || empty($_POST['tipo']) || empty($_POST['departamento']) || empty($_POST['profesor_responsable']) || empty($_POST['trimestre']) || empty($_POST['fecha_inicio']) || empty($_POST['hora_inicio']) || empty($_POST['fecha_fin']) || empty($_POST['hora_fin']) || empty($_POST['organizador']) || empty($_POST['ubicacion']) || empty($_POST['coste']) || empty($_POST['total_alumnos']) || empty($_POST['objetivo'])) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Saneamiento de las entradas
    $id = mysqli_real_escape_string($enlace, $_GET['id']); // Usar el ID de la URL
    $titulo = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['titulo'])));
    $tipo = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['tipo'])));
    $departamento = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['departamento'])));
    $profesor_responsable = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['profesor_responsable'])));
    $trimestre = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['trimestre'])));
    $fecha_inicio = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['fecha_inicio'])));
    $hora_inicio = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['hora_inicio'])));
    $fecha_fin = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['fecha_fin'])));
    $hora_fin = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['hora_fin'])));
    $organizador = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['organizador'])));
    $acompañantes = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['acompañantes'])));
    $ubicacion = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['ubicacion'])));
    $coste = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['coste'])));
    $total_alumnos = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['total_alumnos'])));
    $objetivo = mysqli_real_escape_string($enlace, htmlspecialchars(trim($_POST['objetivo'])));

    // Actualizar datos en la base de datos
    $query = "UPDATE actividades SET titulo='$titulo', tipo='$tipo', departamento='$departamento', profesor_responsable='$profesor_responsable', trimestre='$trimestre', fecha_inicio='$fecha_inicio', hora_inicio='$hora_inicio', fecha_fin='$fecha_fin', hora_fin='$hora_fin', organizador='$organizador', acompañantes='$acompañantes', ubicacion='$ubicacion', coste='$coste', total_alumnos='$total_alumnos', objetivo='$objetivo' WHERE id='$id'";

    if (mysqli_query($enlace, $query)) {
        echo "Actividad modificada correctamente.";
    } else {
        echo "Error al modificar la actividad: " . mysqli_error($enlace);
    }
}

// Obtener datos de la actividad
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($enlace, $_GET['id']);
    $query = "SELECT * FROM actividades WHERE id='$id'";
    $resultado = mysqli_query($enlace, $query);
    $actividad = mysqli_fetch_assoc($resultado);
} else {
    echo "Error: ID de actividad no proporcionado.";
    exit();
}

mysqli_close($enlace);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Actividad</title>
</head>
<body>
    <h1>Modificar Actividad</h1>
    <form method="POST" action="modificar_actividad.php?id=<?php echo $actividad['id']; ?>">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" value="<?php echo $actividad['titulo']; ?>" required><br>
        <label for="tipo">Tipo:</label>
        <select id="tipo" name="tipo" required>
            <option value="extraescolares" <?php if ($actividad['tipo'] == 'extraescolares') echo 'selected'; ?>>Extraescolares</option>
            <option value="complementarias" <?php if ($actividad['tipo'] == 'complementarias') echo 'selected'; ?>>Complementarias</option>
        </select><br>
        <label for="departamento">Departamento:</label>
        <input type="text" id="departamento" name="departamento" value="<?php echo $actividad['departamento']; ?>" required><br>
        <label for="profesor_responsable">Profesor Responsable:</label>
        <input type="text" id="profesor_responsable" name="profesor_responsable" value="<?php echo $actividad['profesor_responsable']; ?>" required><br>
        <label for="trimestre">Trimestre:</label>
        <select id="trimestre" name="trimestre" required>
            <option value="1" <?php if ($actividad['trimestre'] == '1') echo 'selected'; ?>>1</option>
            <option value="2" <?php if ($actividad['trimestre'] == '2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if ($actividad['trimestre'] == '3') echo 'selected'; ?>>3</option>
        </select><br>
        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $actividad['fecha_inicio']; ?>" required><br>
        <label for="hora_inicio">Hora Inicio:</label>
        <input type="time" id="hora_inicio" name="hora_inicio" value="<?php echo $actividad['hora_inicio']; ?>" required><br>
        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $actividad['fecha_fin']; ?>" required><br>
        <label for="hora_fin">Hora Fin:</label>
        <input type="time" id="hora_fin" name="hora_fin" value="<?php echo $actividad['hora_fin']; ?>" required><br>
        <label for="organizador">Organizador:</label>
        <input type="text" id="organizador" name="organizador" value="<?php echo $actividad['organizador']; ?>" required><br>
        <label for="acompañantes">Acompañantes:</label>
        <textarea id="acompañantes" name="acompañantes"><?php echo $actividad['acompañantes']; ?></textarea><br>
        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $actividad['ubicacion']; ?>" required><br>
        <label for="coste">Coste:</label>
        <input type="number" step="0.01" id="coste" name="coste" value="<?php echo $actividad['coste']; ?>" required><br>
        <label for="total_alumnos">Total Alumnos:</label>
        <input type="number" id="total_alumnos" name="total_alumnos" value="<?php echo $actividad['total_alumnos']; ?>" required><br>
        <label for="objetivo">Objetivo:</label>
        <textarea id="objetivo" name="objetivo" required><?php echo $actividad['objetivo']; ?></textarea><br>
        <button type="submit">Modificar Actividad</button>
    </form>
    <a href="dashboard.php">Volver al Dashboard</a>
</body>
</html>
