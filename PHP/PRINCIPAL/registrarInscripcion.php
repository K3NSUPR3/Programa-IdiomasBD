<?php
include 'ConexionSeq.php';

if(isset($_POST['botonInsc'])){
   $nombre=$_POST['nombre'];
   $email=$_POST['mail'];  
   $fecha=$_POST['fecha'];
   $horario=$_POST['horario'];
   $idioma=$_POST['SIdioma'];
   $Plan=$_POST['SPlan'];


    //validacion plan
    switch ($Plan) {
        case 'PB': // Plan Básico - No se permite repetir nombre ni correo
            $verificar_correo = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Correo='$email'");
            if (mysqli_num_rows($verificar_correo) > 0) {
                echo '
                    <script type="text/javascript">
                        alert("Este correo ya está registrado. Actualiza tu plan.");
                        window.location="service.php";
                    </script>
                ';
                exit();
            }
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre'");
            if (mysqli_num_rows($verificar_usuario) > 0) {
                echo '
                    <script type="text/javascript">
                        alert("Nombre registrado. Intenta contratar otro plan.");
                        window.location="service.php";
                    </script>
                ';
                exit();
            }
            break;

        case 'PF': // Plan Familiar - Permitir hasta 3 repeticiones por idioma
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre' AND Correo='$email' AND Idioma='$idioma'");
            if (mysqli_num_rows($verificar_usuario) >= 3) {
                echo '
                    <script type="text/javascript">
                        alert("Ya tienes 3 inscripciones con este plan. No puedes repetir más.");
                        window.location="service.php";
                    </script>
                ';
                exit();
            }
            break;

        case 'PV': // Plan VIP - Permitir hasta 5 repeticiones
            $verificar_usuario = mysqli_query($enlace, "SELECT * FROM inscripciones WHERE Nombre='$nombre' AND Correo='$email'");
            if (mysqli_num_rows($verificar_usuario) >= 5) {
                echo '
                    <script type="text/javascript">
                        alert("Ya tienes 5 inscripciones con este plan. No puedes repetir más.");
                        window.location="service.php";
                    </script>
                ';
                exit();
            }
            break;
    }


    //fin valida

   //hacer el insert de datos
   $insertarDatos="INSERT INTO inscripciones(Nombre,Correo,Fecha,Horario,Idioma,Plan,Id_Insc) 
   VALUES ('$nombre','$email','$fecha','$horario','$idioma','$Plan','')";
   
   
   //Verificar que el correo no se repita en la bd
   if (mysqli_query($enlace, $insertarDatos)) {
    echo '
        <script type="text/javascript">
            alert("Inscripción exitosa.");
            window.location="service.php";
        </script>
    ';
} else {
    echo '
        <script type="text/javascript">
            alert("Error: ' . mysqli_error($enlace) . '");
        </script>
    ';
}

mysqli_close($enlace);
}

?>