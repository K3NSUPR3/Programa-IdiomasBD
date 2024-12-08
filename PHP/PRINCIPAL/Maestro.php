<?php
include 'ConexionSeq.php';

if (isset($_POST['maestro'])) {
    $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
    $email = mysqli_real_escape_string($enlace, $_POST['CorreoE']);
    $Leng = mysqli_real_escape_string($enlace, $_POST['Lenguaje']);
    $Exp = mysqli_real_escape_string($enlace, $_POST['Exp']);

    // Depuración: Verifica si los datos se reciben correctamente
    echo "Nombre: $nombre, Email: $email, Lenguaje: $Leng, Experiencia: $Exp";

    // Hacer el insert de datos
    $insertarDatos = "INSERT INTO solicitudmaestro (ID_Solicitante,Nombre, CorreoE, Lenguaje, Experiencia) 
                      VALUES ('','$nombre', '$email', '$Leng', '$Exp')";

    if (mysqli_query($enlace, $insertarDatos)) {
        echo '<script type="text/javascript">
                alert("Exito");
              </script>';
        header("location: ../contact.php");
        exit();
    } else {
        echo '<script type="text/javascript">
                alert("Inténtalo de nuevo: ' . mysqli_error($enlace) . '");
              </script>';
    }
    mysqli_close($enlace);
}
?>
