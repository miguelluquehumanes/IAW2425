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
    if ($usuario['rol'] !== 'administrador') {
        die("Error: No tienes permiso para realizar esta acción.");
    }
} else {
    die("Error: Usuario no encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($enlace, $_GET['id']);
    $query = "SELECT * FROM actividades WHERE id = '$id'";
    $result = mysqli_query($enlace, $query);

    if (mysqli_num_rows($result) === 1) {
        $actividad = mysqli_fetch_assoc($result);
    } else {
        die("Error: Actividad no encontrada.");
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = mysqli_real_escape_string($enlace, $_POST['id']);
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
    $aprobada = isset($_POST['aprobada']) ? 1 : 0;

    // Validación de fechas
    if (strtotime($fecha_fin) <= strtotime($fecha_inicio)) {
        die("Error: La fecha de fin no puede ser anterior a la fecha de inicio.");
    }

    // Validación de coste y número de alumnos
    if (!is_numeric($coste) || $coste < 0) {
        die("Error: El coste debe ser un número positivo.");
    }
    if (!ctype_digit($total_alumnos) || $total_alumnos < 0) {
        die("Error: El número de alumnos debe ser un número entero positivo.");
    }

    // Validación del año en las fechas
    $year_inicio = date('Y', strtotime($fecha_inicio));
    $year_fin = date('Y', strtotime($fecha_fin));
    if (strlen($year_inicio) != 4 || strlen($year_fin) != 4) {
        die("Error: El año debe tener exactamente 4 dígitos.");
    }

    $query = "UPDATE actividades SET titulo = '$titulo', tipo = '$tipo', departamento = '$departamento', profesor_responsable = '$profesor_responsable', trimestre = '$trimestre', fecha_inicio = '$fecha_inicio', hora_inicio = '$hora_inicio', fecha_fin = '$fecha_fin', hora_fin = '$hora_fin', organizador = '$organizador', acompañantes = '$acompañantes', ubicacion = '$ubicacion', coste = '$coste', total_alumnos = '$total_alumnos', objetivo = '$objetivo', aprobada = '$aprobada' WHERE id = '$id'";

    if (mysqli_query($enlace, $query)) {
        echo "Actividad modificada correctamente.";
    } else {
        echo "Error al modificar la actividad: " . mysqli_error($enlace);
    }
}

mysqli_close($enlace);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modificar Actividad</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            overflow-y: auto;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            margin-top: 20px;
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
    </style>
    <script>
        function validateForm() {
            var fecha_inicio = document.getElementById('fecha_inicio').value;
            var fecha_fin = document.getElementById('fecha_fin').value;
            var coste = document.getElementById('coste').value;
            var total_alumnos = document.getElementById('total_alumnos').value;

            if (new Date(fecha_fin) <= new Date(fecha_inicio)) {
                alert("Error: La fecha de fin no puede ser anterior a la fecha de inicio.");
                return false;
            }

            if (isNaN(coste) || coste < 0) {
                alert("Error: El coste debe ser un número positivo.");
                return false;
            }

            if (isNaN(total_alumnos) || total_alumnos < 0 || !Number.isInteger(parseFloat(total_alumnos))) {
                alert("Error: El número de alumnos debe ser un número entero positivo.");
                return false;
            }

            var year_inicio = new Date(fecha_inicio).getFullYear();
            var year_fin = new Date(fecha_fin).getFullYear();
            if (year_inicio.toString().length != 4 || year_fin.toString().length != 4) {
                alert("Error: El año debe tener exactamente 4 dígitos.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Modificar Actividad</h1>
        <form method="POST" action="modificar_actividad2.php" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo isset($actividad['id']) ? $actividad['id'] : ''; ?>">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" value="<?php echo isset($actividad['titulo']) ? $actividad['titulo'] : ''; ?>" required>
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="extraescolares" <?php echo isset($actividad['tipo']) && $actividad['tipo'] === 'extraescolares' ? 'selected' : ''; ?>>Extraescolares</option>
                <option value="complementarias" <?php echo isset($actividad['tipo']) && $actividad['tipo'] === 'complementarias' ? 'selected' : ''; ?>>Complementarias</option>
            </select>
            <label for="departamento">Departamento:</label>
            <select id="departamento" name="departamento" required>
                <option value="Informática" <?php echo isset($actividad['departamento']) && $actividad['departamento'] === 'Informática' ? 'selected' : ''; ?>>Informática</option>
                <option value="Lengua" <?php echo isset($actividad['departamento']) && $actividad['departamento'] === 'Lengua' ? 'selected' : ''; ?>>Lengua</option>
                <option value="Matemáticas" <?php echo isset($actividad['departamento']) && $actividad['departamento'] === 'Matemáticas' ? 'selected' : ''; ?>>Matemáticas</option>
                <option value="Química" <?php echo isset($actividad['departamento']) && $actividad['departamento'] === 'Química' ? 'selected' : ''; ?>>Química</option>
                <option value="Física" <?php echo isset($actividad['departamento']) && $actividad['departamento'] === 'Física' ? 'selected' : ''; ?>>Física</option>
                <option value="Tecnología" <?php echo isset($actividad['departamento']) && $actividad['departamento'] === 'Tecnología' ? 'selected' : ''; ?>>Tecnología</option>
                <option value="EF" <?php echo isset($actividad['departamento']) && $actividad['departamento'] === 'EF' ? 'selected' : ''; ?>>EF</option>
                <option value="Filosofía" <?php echo isset($actividad['departamento']) && $actividad['departamento'] === 'Filosofía' ? 'selected' : ''; ?>>Filosofía</option>
            </select>
            <label for="profesor_responsable">Profesor Responsable:</label>
            <input type="text" id="profesor_responsable" name="profesor_responsable" value="<?php echo isset($actividad['profesor_responsable']) ? $actividad['profesor_responsable'] : ''; ?>" required>
            <label for="trimestre">Trimestre:</label>
            <select id="trimestre" name="trimestre" required>
                <option value="1" <?php echo isset($actividad['trimestre']) && $actividad['trimestre'] === '1' ? 'selected' : ''; ?>>1</option>
                <option value="2" <?php echo isset($actividad['trimestre']) && $actividad['trimestre'] === '2' ? 'selected' : ''; ?>>2</option>
                <option value="3" <?php echo isset($actividad['trimestre']) && $actividad['trimestre'] === '3' ? 'selected' : ''; ?>>3</option>
            </select>
            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo isset($actividad['fecha_inicio']) ? $actividad['fecha_inicio'] : ''; ?>" required>
            <label for="hora_inicio">Hora Inicio:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" value="<?php echo isset($actividad['hora_inicio']) ? $actividad['hora_inicio'] : ''; ?>" required>
            <label for="fecha_fin">Fecha Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo isset($actividad['fecha_fin']) ? $actividad['fecha_fin'] : ''; ?>" required>
            <label for="hora_fin">Hora Fin:</label>
            <input type="time" id="hora_fin" name="hora_fin" value="<?php echo isset($actividad['hora_fin']) ? $actividad['hora_fin'] : ''; ?>" required>
            <label for="organizador">Organizador:</label>
            <input type="text" id="organizador" name="organizador" value="<?php echo isset($actividad['organizador']) ? $actividad['organizador'] : ''; ?>" required>
            <label for="acompañantes">Acompañantes:</label>
            <textarea id="acompañantes" name="acompañantes"><?php echo isset($actividad['acompañantes']) ? $actividad['acompañantes'] : ''; ?></textarea>
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" value="<?php echo isset($actividad['ubicacion']) ? $actividad['ubicacion'] : ''; ?>" required>
            <label for="coste">Coste:</label>
            <input type="number" step="0.01" id="coste" name="coste" value="<?php echo isset($actividad['coste']) ? $actividad['coste'] : ''; ?>" required>
            <label for="total_alumnos">Total Alumnos:</label>
            <input type="number" id="total_alumnos" name="total_alumnos" value="<?php echo isset($actividad['total_alumnos']) ? $actividad['total_alumnos'] : ''; ?>" required>
            <label for="objetivo">Objetivo:</label>
            <textarea id="objetivo" name="objetivo" required><?php echo isset($actividad['objetivo']) ? $actividad['objetivo'] : ''; ?></textarea>
            <label for="aprobada">Aprobada:</label>
            <select id="aprobada" name="aprobada" required>
                <option value="1" <?php echo isset($actividad['aprobada']) && $actividad['aprobada'] === '1' ? 'selected' : ''; ?>>Sí</option>
                <option value="0" <?php echo isset($actividad['aprobada']) && $actividad['aprobada'] === '0' ? 'selected' : ''; ?>>No</option>
            </select>
            <button type="submit">Modificar Actividad</button>
        </form>
        <a href="dashboard2.php">Volver al Dashboard</a>
    </div>
</body>
</html>
