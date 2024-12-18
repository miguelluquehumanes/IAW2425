<?php
    $text = file_get_contents ("eltiempo.html");
    $resultado = explode("<td>",$text); //El td hace de separador
    echo ($resultado[4]);

?>