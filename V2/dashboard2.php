<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login2.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
            width: 300px;
            text-align: center;
        }
        .container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .container a {
            display: block;
            margin: 10px 0;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
        }
        .container a:hover {
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
        .container {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .switch {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
<body class="light-mode">
    <div class="switch">
        <label for="modeSwitch">Modo Oscuro</label>
        <input type="checkbox" id="modeSwitch">
    </div>
    <div class="container">
        <h1>Bienvenido, <?php echo $_SESSION['user_name']; ?></h1>
        <a href="consultar_actividades2.php">Consultar Actividades</a>
        <a href="añadir_actividad2.php">Añadir Actividad</a>
        <?php if ($_SESSION['user_role'] == 'admin'): ?>
            <a href="aprobar_actividades2.php">Aprobar Actividades</a>
        <?php endif; ?>
        <a href="logout2.php">Cerrar Sesión</a>
    </div>
    <script>
        document.getElementById('modeSwitch').addEventListener('change', function() {
            document.body.classList.toggle('dark-mode', this.checked);
            document.body.classList.toggle('light-mode', !this.checked);
        });
    </script>
</body>
</html>
