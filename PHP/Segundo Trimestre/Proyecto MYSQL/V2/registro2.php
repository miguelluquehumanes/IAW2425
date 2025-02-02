<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar campos vacíos
    if (empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['departamento'])) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Saneamiento de las entradas
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellidos = htmlspecialchars(trim($_POST['apellidos']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $departamento = htmlspecialchars(trim($_POST['departamento']));

    // Verificar si el correo electrónico pertenece al dominio @iesamachado.org
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || substr(strrchr($email, "@"), 1) !== 'iesamachado.org') {
        die("Error: El correo electrónico debe pertenecer al dominio @iesamachado.org.");
    }

    // Verificar si el usuario ya existe
    $query = "SELECT id FROM usuarios WHERE email='$email'";
    $resultado = mysqli_query($enlace, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['error_message'] = "Error: El usuario ya está registrado.";
        header("Location: registro2.php");
        exit();
    } else {
        // Cifrar la contraseña
        $password_encrypted = password_hash($password, PASSWORD_BCRYPT);

        // Insertar datos en la base de datos
        $query = "INSERT INTO usuarios (nombre, apellidos, email, password, departamento, rol) VALUES ('$nombre', '$apellidos', '$email', '$password_encrypted', '$departamento', 'usuario')";

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

            // Redirigir al usuario a la página de inicio de sesión
            header("Location: login2.php");
            exit();
        } else {
            echo "Error al registrar el usuario: " . mysqli_error($enlace);
        }
    }
}
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
            display: none;
            background-color: white;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['error_message'])): ?>
            <p class="error-message"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></p>
        <?php endif; ?>

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
            <button class="accordion">Seleccionar Departamento</button>
            <div class="panel">
                <input type="radio" id="informatica" name="departamento" value="Informática" required>
                <label for="informatica">Informática</label><br>
                <input type="radio" id="ef" name="departamento" value="EF" required>
                <label for="ef">EF</label><br>
                <input type="radio" id="lengua" name="departamento" value="Lengua" required>
                <label for="lengua">Lengua</label><br>
                <input type="radio" id="matematicas" name="departamento" value="Matemáticas" required>
                <label for="matematicas">Matemáticas</label><br>
                <input type="radio" id="historia" name="departamento" value="Historia" required>
                <label for="historia">Historia</label><br>
                <input type="radio" id="quimica" name="departamento" value="Química" required>
                <label for="quimica">Química</label><br>
                <input type="radio" id="fisica" name="departamento" value="Física" required>
                <label for="fisica">Física</label><br>
                <input type="radio" id="tecnologia" name="departamento" value="Tecnología" required>
                <label for="tecnologia">Tecnología</label><br>
                <input type="radio" id="filosofia" name="departamento" value="Filosofía" required>
                <label for="filosofia">Filosofía</label><br>
            </div>
            <button type="submit">Registrar</button>
        </form>
        <a href="login2.php">Iniciar sesión</a>
    </div>

    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>
</body>
</html>
