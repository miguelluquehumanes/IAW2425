<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['departamento'])) {
        die("Error: Todos los campos son obligatorios.");
    }

    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellidos = htmlspecialchars(trim($_POST['apellidos']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $departamento = htmlspecialchars(trim($_POST['departamento']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || substr(strrchr($email, "@"), 1) !== 'iesamachado.org') {
        die("Error: El email debe pertenecer al dominio @iesamachado.org.");
    }

    $query = "SELECT id FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($enlace, $query);

    if (mysqli_num_rows($resultado) > 0) {
        die("Error: El usuario ya está registrado.");
    } else {
        $password_encrypted = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO usuarios (nombre, apellidos, email, password, departamento) VALUES ('$nombre', '$apellidos', '$email', '$password_encrypted', '$departamento')";

        if (mysqli_query($enlace, $query)) {
            echo "Usuario registrado correctamente.";
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($enlace);
        }
    }
}

mysqli_close($enlace);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
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
        .container h2 {
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
        .container input, .container select {
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
</head>
<body>
    <div class="container">
        <h2>Registro</h2>
        <form method="POST" action="registro2.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
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
            <button type="submit">Registrar</button>
        </form>
        <a href="login2.php">¿Ya tienes una cuenta? Inicia sesión</a>
    </div>
</body>
</html>
