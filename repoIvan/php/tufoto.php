<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #php{
            text-align: center;
            justify-content: center;
            align-content: center;
        }
        img,input{margin: 1rem;}
        img{border-radius: 100%; width: 200px; height: 200px}
    </style>
</head>
<body>

<?php

// De la líne 23 a la 56 está todo fulminado de la página de este buen hombre: https://www.jose-aguilar.com/blog/upload-de-imagenes-con-php/

        //Si se quiere subir una imagen
        if (isset($_POST['enviar'])) {
        //Recogemos el archivo y el nombre enviado por el formulario
        $nombre = htmlspecialchars($_POST['nombre']);
        $archivo = $_FILES['archivo']['name'];
        //Si el archivo contiene algo y es diferente de vacio
        if (isset($archivo) && $archivo != "") {
            //Obtenemos algunos datos necesarios sobre el archivo
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
                - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
            }
            else {
                //Si la imagen es correcta en tamaño y tipo
                //Se intenta subir al servidor
                //La carpeta donde estamos metiendo las imagenes debe de tener permisos 777
                if (move_uploaded_file($temp, 'images/'.$archivo)) {
                    //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                    chmod('images/'.$archivo, 0777);
                    //Mostramos el mensaje de que se ha subido con éxito
                    echo '<div id="php"><p><img src="images/'.$archivo.'"></p>';
                    //Mostramos la imagen subida
                    echo '<h1>' . $nombre . '</h1>';
                    //Boton para volver a la página principal
                    echo '<form method="post"><input type="submit" name="volver" value="Volver a la página principal"</form></div>';
                }
                else {
                //Si no se ha podido subir la imagen, mostramos un mensaje de error
                echo '<div id="php"><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
                }
            }

        }
        }

    ?>

</body>
</html>