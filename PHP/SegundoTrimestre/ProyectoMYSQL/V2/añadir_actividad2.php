<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['titulo']) || empty($_POST['tipo']) || empty($_POST['departamento']) || empty($_POST['profesor_responsable']) || empty($_POST['trimestre']) || empty($_POST['fecha_inicio']) || empty($_POST['hora_inicio']) || empty($_POST['fecha_fin']) || empty($_POST['hora_fin']) || empty($_POST['organizador']) || empty($_POST['ubicacion']) || empty($_POST['coste']) || empty($_POST['total_alumnos']) || empty($_POST['objetivo'])) {
        die("Error: Todos los campos son obligatorios.");
    }

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

    $query = "INSERT INTO actividades (titulo, tipo, departamento, profesor_responsable, trimestre, fecha_inicio, hora_inicio, fecha_fin, hora_fin, organizador, acompañantes, ubicacion, coste, total_alumnos, objetivo, aprobada) VALUES ('$titulo', '$tipo', '$departamento', '$profesor_responsable', '$trimestre', '$fecha_inicio', '$hora_inicio', '$fecha_fin', '$hora_fin', '$organizador', '$acompañantes', '$ubicacion', '$coste', '$total_alumnos', '$objetivo', 0)";

    if (mysqli_query($enlace, $query)) {
        echo "Actividad añadida correctamente.";
    } else {
        echo "Error al añadir la actividad: " . mysqli_error($enlace);
    }
}

mysqli_close($enlace);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Añadir Actividad</title>
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
        <h1>Añadir Nueva Actividad</h1>
        <form method="POST" action="añadir_actividad2.php" onsubmit="return validateForm()">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="extraescolares">Extraescolares</option>
                <option value="complementarias">Complementarias</option>
            </select>
            <label for="departamento">Departamento:</label>
            <select id="departamento" name="departamento" required>
                <option value="Informática">Informática</option>
                <option value="Lengua">Lengua</option>
                <option value="Matemáticas">Matemáticas</option>
                <option value="Química">Química</option>
                <option value="Física">Física</option>
                <option value="Tecnología">Tecnología</option>
                <option value="EF">EF</option>
                <option value="Filosofía">Filosofía</option>
            </select>
            <label for="profesor_responsable">Profesor Responsable:</label>
            <input type="text" id="profesor_responsable" name="profesor_responsable" required>
            <label for="trimestre">Trimestre:</label>
            <select id="trimestre" name="trimestre" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            <label for="fecha_inicio">Fecha Inicio:</label>
            <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            <label for="hora_inicio">Hora Inicio:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required>
            <label for="fecha_fin">Fecha Fin:</label>
            <input type="date" id="fecha_fin" name="fecha_fin" required>
            <label for="hora_fin">Hora Fin:</label>
            <input type="time" id="hora_fin" name="hora_fin" required>
            <label for="organizador">Organizador:</label>
            <input type="text" id="organizador" name="organizador" required>
            <label for="acompañantes">Acompañantes:</label>
            <textarea id="acompañantes" name="acompañantes"></textarea>
            <label for="ubicacion">Ubicación:</label>
            <input type="text" id="ubicacion" name="ubicacion" required>
            <label for="coste">Coste:</label>
            <input type="number" step="0.01" id="coste" name="coste" required>
            <label for="total_alumnos">Total Alumnos:</label>
            <input type="number" id="total_alumnos" name="total_alumnos" required>
            <label for="objetivo">Objetivo:</label>
            <textarea id="objetivo" name="objetivo" required></textarea>
            <button type="submit">Añadir Actividad</button>
        </form>
        <a href="dashboard2.php">Volver al Dashboard</a>
    </div>
</body>
</html>
