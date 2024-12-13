<?php
// Maestro.php
require 'Conexion_Be.php';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conexion, $_POST['Nombre']);
    $correo = mysqli_real_escape_string($conexion, $_POST['CorreoE']);
    $lenguaje = mysqli_real_escape_string($conexion, $_POST['Lenguaje']);
    $experiencia = mysqli_real_escape_string($conexion, $_POST['Exp']);
    
    $sql = "INSERT INTO solicitudmaestro (Nombre, CorreoE, Lenguaje, Exp) VALUES ('$nombre', '$correo', '$lenguaje', '$experiencia')";
    
    if (mysqli_query($conexion, $sql)) {
        echo "<script>alert('Solicitud enviada exitosamente'); window.location.href='Maestro.php';</script>";
    } else {
        $errors[] = "Error al enviar la solicitud: " . mysqli_error($conexion);
    }
}
?>
