<?php
session_start();

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos vacíos
    if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['email']) || empty($_POST['password'])) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Saneamiento de las entradas
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellidos = htmlspecialchars(trim($_POST['apellidos']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Verificar si el usuario ya existe
    $query = "SELECT id FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($enlace, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['error_message'] = "Error: El usuario ya está registrado.";
        header("Location: registro.php");
        exit();
    } else {
        // Cifrar la contraseña
        $password_encrypted = $password; // Sin cifrar (GRAN ERROR)
        // $password_encrypted = crypt($password, '$6$rounds=5000$' . uniqid(mt_rand(), true) . '$');

        // Insertar datos en la base de datos
        $query = "INSERT INTO usuarios (nombre, apellidos, email, password) VALUES ('$nombre', '$apellidos', '$email', '$password_encrypted')";

        if (mysqli_query($enlace, $query)) {
            // Enviar correo electrónico de confirmación
            $asunto = "Registro exitoso";
            $mensaje = "Hola $nombre,\n\nGracias por registrarte. Estos son tus datos:\nNombre: $nombre\nApellidos: $apellidos\nEmail: $email\n\nSaludos.";
            $cabeceras = "From: no-reply@mi-sitio.com";

            if (mail($email, $asunto, $mensaje, $cabeceras)) {
                echo "Usuario registrado correctamente. Se ha enviado un correo de confirmación.";
            } else {
                echo "Usuario registrado, pero no se pudo enviar el correo.";
            }
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($enlace);
        }
    }
}

mysqli_close($enlace);
?>

<!-- Formulario de registro -->
<!DOCTYPE html>
<html>
<head>
    <title>Actividades I.E.S Antonio Machado</title>
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
        .container input {
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
        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['error_message'])): ?>
            <p class="error-message"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
        <?php endif; ?>

        <h2>Actividades I.E.S Antonio Machado</h2>
        <form method="POST" action="registro.php">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Registrar</button>
        </form>
        <a href="login.php">Iniciar sesión</a>
    </div>
</body>
</html>
