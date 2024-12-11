<?php
include 'ConexionSeq.php';
session_start();

if (isset($_POST['maestro'])) {
    $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
    $email = mysqli_real_escape_string($enlace, $_POST['CorreoE']);
    $Leng = mysqli_real_escape_string($enlace, $_POST['Lenguaje']);
    $Exp = mysqli_real_escape_string($enlace, $_POST['Exp']);

    echo "Nombre: $nombre, Email: $email, Lenguaje: $Leng, Experiencia: $Exp";

    // Hacer el insert de datos
    $insertarDatos = "INSERT INTO solicitudmaestro (Nombre, CorreoE, Lenguaje, Experiencia) 
                      VALUES ('$nombre', '$email', '$Leng', '$Exp')";

    if (mysqli_query($enlace, $insertarDatos)) {
        echo '<script type="text/javascript">
                alert("Solicitud enviada con éxito.");
                window.location = "../contact.php";
              </script>';
        exit();
    } else {
        echo '<script type="text/javascript">
                alert("Error: ' . mysqli_error($enlace) . '");
              </script>';
    }
    mysqli_close($enlace);
}
?>
