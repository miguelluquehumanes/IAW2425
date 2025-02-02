<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT rol FROM usuarios WHERE id = $user_id";
$result = mysqli_query($enlace, $query);
$user_role = mysqli_fetch_assoc($result)['rol'];

$id = $_GET['id'];
$query = "SELECT * FROM actividades WHERE id = $id";
$result = mysqli_query($enlace, $query);
$actividad = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $aprobada = $user_role == 'administrador' ? (isset($_POST['aprobada']) ? 1 : 0) : $actividad['aprobada'];

    $query = "UPDATE actividades SET titulo = '$titulo', tipo = '$tipo', departamento = '$departamento', profesor_responsable = '$profesor_responsable', trimestre = '$trimestre', fecha_inicio = '$fecha_inicio', hora_inicio = '$hora_inicio', fecha_fin = '$fecha_fin', hora_fin = '$hora_fin', organizador = '$organizador', acompañantes = '$acompañantes', ubicacion = '$ubicacion', coste = '$coste', total_alumnos = '$total_alumnos', objetivo = '$objetivo', aprobada = '$aprobada' WHERE id = $id";

    if (mysqli_query($enlace, $query)) {
        echo "Actividad actualizada correctamente.";
    } else {
        echo "Error al actualizar la actividad: " . mysqli_error($enlace);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Actividad</title>
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
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container label {
            margin-bottom: 5px;
            color: #555;
        }
        .container input, .container select, .container textarea {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .container button {
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .container button:hover {
            background-color: #0056b3;
        }
        .container a {
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }
        .container a:hover {
            text-decoration: underline;
        }
        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 10px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }
        .active, .accordion:hover {
            background-color: #ccc;
        }
        .panel {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
        }
    </style>
    <script>
        function toggleAccordion(id) {
            var panel = document.getElementById(id);
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Editar Actividad</h1>
        <form method="POST" action="editar_actividad.php?id=<?php echo $id; ?>">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo $actividad['titulo']; ?>" required>
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="extraescolares" <?php echo $actividad['tipo'] == 'extraescolares' ? 'selected' : ''; ?>>Extraescolares</option>
                <option value="complementarias" <?php echo $actividad['tipo'] == 'complementarias' ? 'selected' : ''; ?>>Complementarias</option>
            </select>
            <label for="departamento">Departamento:</label>
            <button class="accordion" type="button" onclick="toggleAccordion('panel')">Seleccionar Departamento</button>
            <div id="panel" class="panel">
                <select id="departamento" name="departamento" required>
                    <option value="Informática" <?php echo $actividad['departamento'] == 'Informática' ? 'selected' : ''; ?>>Informática</option>
                    <option value="EF" <?php echo $actividad['departamento'] == 'EF' ? 'selected' : ''; ?>>EF</option>
                    <option value="Lengua" <?php echo $actividad['departamento'] == 'Lengua' ? 'selected' : ''; ?>>Lengua</option>
                    <option value="Matemáticas" <?php echo $actividad['departamento'] == 'Matemáticas' ? 'selected' : ''; ?>>Matemáticas</option>
                    <option value="Historia" <?php echo $actividad['departamento'] == 'Historia' ? 'selected' : ''; ?>>Historia</option>
                    <option value="Química" <?php echo $actividad['departamento'] == 'Química' ? 'selected' : ''; ?>>Química</option>
                    <option value="Física" <?php echo $actividad['departamento'] == 'Física' ? 'selected' : ''; ?>>Física</option>
                    <option value="Tecnología" <?php echo $actividad['departamento'] == 'Tecnología' ? 'selected' : ''; ?>>Tecnología</option>
                </select>
            </div>
            <label for="profesor_responsable">Profesor Responsable:</label>
            <input type="text" id="profesor_responsable" name="profesor_responsable" value="<?php echo $actividad['profesor_responsable']; ?>" required>
            <label for="trimestre">Trimestre:</label>
            <select id="trimestre" name="trimestre" required>
                <option value="1" <?php echo $actividad['trimestre'] == 1 ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo $actividad['trimestre'] == 2 ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo $actividad['trimestre'] == 3 ? 'selected' : ''; ?>>3</option>
            </select>
            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $actividad['fecha_inicio']; ?>" required>
            <label for="hora_inicio">Hora Inicio:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" value="<?php echo $actividad['hora_inicio']; ?>" required>
            <label for="fecha_fin">Fecha Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $actividad['fecha_fin']; ?>" required>
            <label for="hora_fin">Hora Fin:</label>
            <input type="time" id="hora_fin" name="hora_fin" value="<?php echo $actividad['hora_fin']; ?>" required>
            <label for="organizador">Organizador:</label>
            <input type="text" id="organizador" name="organizador" value="<?php echo $actividad['organizador']; ?>" required>
            <label for="acompañantes">Acompañantes:</label>
            <textarea id="acompañantes" name="acompañantes"><?php echo $actividad['acompañantes']; ?></textarea>
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" value="<?php echo $actividad['ubicacion']; ?>" required>
            <label for="coste">Coste:</label>
            <input type="number" step="0.01" id="coste" name="coste" value="<?php echo $actividad['coste']; ?>" required>
            <label for="total_alumnos">Total Alumnos:</label>
            <input type="number" id="total_alumnos" name="total_alumnos" value="<?php echo $actividad['total_alumnos']; ?>" required>
            <label for="objetivo">Objetivo:</label>
            <textarea id="objetivo" name="objetivo" required><?php echo $actividad['objetivo']; ?></textarea>
            <?php if ($user_role == 'administrador') : ?>
                <label for="aprobada">Aprobada:</label>
                <input type="checkbox" id="aprobada" name="aprobada" <?php echo $actividad['aprobada'] ? 'checked' : ''; ?>>
            <?php endif; ?>
            <button type="submit">Guardar Cambios</button>
        </form>
        <a href="dashboard.php">Volver al Dashboard</a>
    </div>
</body>
</html>
