<?php

$servidor = "localhost:3307";
$usuario = "root";
$clave = "";
$BaseDeDatos = "idiomas";

$enlace = mysqli_connect($servidor, $usuario, $clave, $BaseDeDatos);

if (!$enlace) {
    echo '
        <script type="text/javascript">
            alert("No se pudo hacer la conexion");
        </script>
    ';
    die("Conexión fallida: " . mysqli_connect_error());
}

?>
